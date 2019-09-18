<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\Photo;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends Controller
{
    public function listAction(){
        $doctrine = $this->getDoctrine()->getManager();
        $data = $doctrine->getRepository('BackendBundle:Photo')->findAll();

        $response = $this->get('jms_serializer')->serialize($data, 'json');

        return new Response($response);
    }

    public function getAction(Request $request, $id){
        $data = new stdClass();
        if(!is_null($id)){
            $doctrine = $this->getDoctrine()->getManager();
            $data = $doctrine->getRepository('BackendBundle:Photo')->findOneById($id);    
        }
        
        $response = $this->get('jms_serializer')->serialize($data, 'json');
        
        return new Response($response);
    }

    public function createAction(Request $request){
        $json = $request->request->all();
        $objectPost = json_decode(json_encode($json), FALSE);
        
        $albumId = isset($objectPost->albumId) ? $objectPost->albumId : null;
        $title = isset($objectPost->title) ? $objectPost->title : null;
        $url = isset($objectPost->url) ? $objectPost->url : null;
        $thumbnailUrl = isset($objectPost->thumbnailUrl) ? $objectPost->thumbnailUrl : null;

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

        $response = $this->get('jms_serializer')->serialize($data, 'json');
        
        return new Response($response);
    }

    public function deleteAction(){

    }

    public function editAction(){

    }
}
