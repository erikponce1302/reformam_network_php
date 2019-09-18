<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function listAction(){
        $doctrine = $this->getDoctrine()->getManager();
        $data = $doctrine->getRepository('BackendBundle:Post')->findAll();

        if(!$data){
            $data = new Post();
        }

        $response = $this->get('jms_serializer')->serialize($data, 'json');

        return new Response($response);
    }

    public function getAction(Request $request, $id){
        $doctrine = $this->getDoctrine()->getManager();
        $data = $doctrine->getRepository('BackendBundle:Post')->findOneById($id);
        
        if(!$data){
            $data = new Post();
        }
        $response = $this->get('jms_serializer')->serialize($data, 'json');
        
        return new Response($response);
    }

    public function createAction(Request $request){
        $json = $request->request->all();
        $objectPost = json_decode(json_encode($json), FALSE);
        
        $userId = isset($objectPost->userId) ? $objectPost->userId : null;
        $title = isset($objectPost->title) ? $objectPost->title : null;
        $body = isset($objectPost->body) ? $objectPost->body : null;

        if( !is_null($userId) && !is_null($title) && !is_null($body)){
            $doctrine = $this->getDoctrine()->getManager();
            $user = $doctrine->getRepository('BackendBundle:User')->findOneById($userId);

            $post = new Post();
            $post->setUser($user);
            $post->setTitle($title);
            $post->setBody($body);
            
            
            $doctrine->persist($post);
            $doctrine->flush();

            $data = array(
                'status' => 'success',
                'code' => 200,
                'msg' => 'Post created',
                'post' => $post
            );
            
        } else {
            $data = array(
                'status' => 'error',
                'code' => 400,
                'msg' => 'Parameters invalid'
            );
        }

        $response = $this->get('jms_serializer')->serialize($data, 'json');
        
        return new Response($response);
    }

    public function deleteAction(){

    }

    public function editAction(){

    }
}
