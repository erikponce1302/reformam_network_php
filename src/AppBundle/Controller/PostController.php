<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Services\Helper;

class PostController extends Controller
{
    /**
     * 
     */
    public function listAction(){
        
        $doctrine = $this->getDoctrine()->getManager();
        $data = $doctrine->getRepository('BackendBundle:Post')->findAll();

        if(!$data){
            $data = new Post();
        }

        $data = array(
            'status' => 'success',
            'code' => 200,
            'msg' => 'Posts GetAll',
            'posts' => $data
        );

        $helpers = $this->get(Helper::class);
        return $helpers->json($data);
    }

    /**
     * 
     */
    public function getAction(Request $request, $id){
        $doctrine = $this->getDoctrine()->getManager();
        $data = $doctrine->getRepository('BackendBundle:Post')->findOneById($id);
        
        if(!$data){
            $data = new Post();
        }
        
        $data = array(
            'status' => 'success',
            'code' => 200,
            'msg' => 'Post Detail',
            'post' => $data
        );

        $helpers = $this->get(Helper::class);
        return $helpers->json($data);
    }

    public function createAction(Request $request){
        $json = $request->request->all();
        $objectPost = json_decode($json["data"]);
        
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

        $helpers = $this->get(Helper::class);
        return $helpers->json($data);
    }

    public function deleteAction(){

    }

    public function editAction(){

    }
}
