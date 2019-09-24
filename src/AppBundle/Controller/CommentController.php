<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Services\Helper;

class CommentController extends Controller
{
    /**
     * 
     */
    public function listAction(){
        
        $doctrine = $this->getDoctrine()->getManager();
        $data = $doctrine->getRepository('BackendBundle:Comment')->findAll();
        
        if(!$data){
            $data = new Comment();
        }
        
        $data = array(
            'status' => 'success',
            'code' => 200,
            'msg' => 'Comments GetAll',
            'comments' => $data
        );

        $helpers = $this->get(Helper::class);
        return $helpers->json($data);
    }

    /**
     * 
     */
    public function getAction(Request $request, $id){
        $doctrine = $this->getDoctrine()->getManager();
        $data = $doctrine->getRepository('BackendBundle:Comment')->findOneById($id);
        
        if(!$data){
            $data = new Comment();
        }

        $data = array(
            'status' => 'success',
            'code' => 200,
            'msg' => 'Comment Detail',
            'comment' => $data
        );

        $helpers = $this->get(Helper::class);
        return $helpers->json($data);
    }

    /**
     * 
     */
    public function createAction(Request $request){
        $json = $request->request->all();
        $objectComment = json_decode($json["data"]);
        
        $postId = isset($objectComment->postId) ? $objectComment->postId : null;
        $name = isset($objectComment->name) ? $objectComment->name : null;
        $email = isset($objectComment->email) ? $objectComment->email : null;
        $body = isset($objectComment->body) ? $objectComment->body : null;

        if( !is_null($postId) && !is_null($name) && !is_null($email) && !is_null($body)){
            $doctrine = $this->getDoctrine()->getManager();
            $post = $doctrine->getRepository('BackendBundle:Post')->findOneById($postId);

            $comment = new Comment();
            $comment->setPost($post);
            $comment->setName($name);
            $comment->setEmail($email);
            $comment->setBody($body);
            
            
            $doctrine->persist($comment);
            $doctrine->flush();

            $data = array(
                'status' => 'success',
                'code' => 200,
                'msg' => 'Comment created',
                'comment' => $comment
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
