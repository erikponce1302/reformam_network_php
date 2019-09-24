<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\Album;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Services\Helper;

class AlbumController extends Controller
{
    /**
     * 
     */
    public function listAction(){
        
        $doctrine = $this->getDoctrine()->getManager();
        $data = $doctrine->getRepository('BackendBundle:Album')->findAll();

        if(!$data){
            $data = new Album();
        }

        $data = array(
            'status' => 'success',
            'code' => 200,
            'msg' => 'Albums GetAll',
            'albums' => $data
        );

        $helpers = $this->get(Helper::class);
        return $helpers->json($data);
    }

    /**
     * 
     */
    public function getAction(Request $request, $id){
        $doctrine = $this->getDoctrine()->getManager();
        $data = $doctrine->getRepository('BackendBundle:Album')->findOneById($id);
        
        if(!$data){
            $data = new Album();
        }

        $data = array(
            'status' => 'success',
            'code' => 200,
            'msg' => 'Album Detail',
            'album' => $data
        );

        $helpers = $this->get(Helper::class);
        return $helpers->json($data);
    }

    /**
     * 
     */
    public function createAction(Request $request){
        $json = $request->request->all();
        $objectPost = json_decode($json["data"]);
        
        $userId = isset($objectPost->userId) ? $objectPost->userId : null;
        $title = isset($objectPost->title) ? $objectPost->title : null;

        if( !is_null($userId) && !is_null($title)){
            $doctrine = $this->getDoctrine()->getManager();
            $user = $doctrine->getRepository('BackendBundle:User')->findOneById($userId);

            $album = new Album();
            $album->setUser($user);
            $album->setTitle($title);
            
            $doctrine->persist($album);
            $doctrine->flush();

            $data = array(
                'status' => 'success',
                'code' => 200,
                'msg' => 'Album created',
                'album' => $album
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
