<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\Photo;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Services\Helper;

class PhotoController extends Controller
{
    /**
     * 
     */
    public function listAction(){

        $doctrine = $this->getDoctrine()->getManager();
        $data = $doctrine->getRepository('BackendBundle:Photo')->findAll();

        if(!$data){
            $data = new Photo();
        }

        $data = array(
            'status' => 'success',
            'code' => 200,
            'msg' => 'Photos GetAll',
            'photos' => $data
        );

        $helpers = $this->get(Helper::class);
        return $helpers->json($data);
    }

    /**
     * 
     */
    public function getAction(Request $request, $id){
    
        if(!is_null($id)){
            $doctrine = $this->getDoctrine()->getManager();
            $data = $doctrine->getRepository('BackendBundle:Photo')->findOneById($id);    
        }
        
        if(!$data){
            $data = new Photo();
        }

        $data = array(
            'status' => 'success',
            'code' => 200,
            'msg' => 'Photo Detail',
            'photo' => $data
        );

        $helpers = $this->get(Helper::class);
        return $helpers->json($data);
    }

    public function createAction(Request $request){
        $json = $request->request->all();
        $objectPhoto = json_decode($json["data"]);
        
        $albumId = isset($objectPhoto->albumId) ? $objectPhoto->albumId : null;
        $title = isset($objectPhoto->title) ? $objectPhoto->title : null;
        $url = isset($objectPhoto->url) ? $objectPhoto->url : null;
        $thumbnailUrl = isset($objectPhoto->thumbnailUrl) ? $objectPhoto->thumbnailUrl : null;

        if( !is_null($albumId) && !is_null($title) && !is_null($url) && !is_null($thumbnailUrl)){
            $doctrine = $this->getDoctrine()->getManager();
            $album = $doctrine->getRepository('BackendBundle:Album')->findOneById($albumId);

            $photo = new Photo();
            $photo->setAlbum($album);
            $photo->setTitle($title);
            $photo->setUrl($url);
            $photo->setThumbnailurl($thumbnailUrl);
            
            $doctrine->persist($photo);
            $doctrine->flush();

            $data = array(
                'status' => 'success',
                'code' => 200,
                'msg' => 'Photo created',
                'photo' => $photo
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
