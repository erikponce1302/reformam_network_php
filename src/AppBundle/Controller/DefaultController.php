<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class DefaultController extends Controller
{
    
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function loginAction(Request $request)
    {
        $json = $request->request->all();
        $object = json_decode(json_encode($json), FALSE);
        
        $data = array(
            'status' => 'error',
            'data' => 'Error data'
        );

        $isEmpty = empty((array)$object);
        var_dump($isEmpty);
        if(!$isEmpty){

            $username = (isset($object->username)) ? $object->username : null;

            if(!empty($username)){

                
                $data = array(
                    'status' => 'success',
                    'data' => 'Login Correcto'
                );
            }
        }

        $response = new Response($this->get('jms_serializer')->serialize($data, 'json'));
        return $response;
        // $users = $this->getDoctrine()
        //             ->getManager()
        //             ->getRepository('BackendBundle:User')
        //             ->findAll();

        // $usersSerialize = $this->get('jms_serializer')->serialize($users, 'json');
        
        // return new Response($usersSerialize);
    }
}
