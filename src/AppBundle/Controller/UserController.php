<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use \stdClass;
use AppBundle\Services\Helper;

class UserController extends Controller
{
    /**
     * 
     */
    public function listAction(Request $request){
        $doctrine = $this->getDoctrine()->getManager();
        $users = $doctrine->getRepository('BackendBundle:User')->findAll();

        // $data = $this->parseUser($users);
        // $response = $this->get('jms_serializer')->serialize($data, 'json');

        // return new Response($response);

        $helpers = $this->get(Helper::class);
        return $helpers->json($users);
        // die;
    }
    
    /**
     * 
     */
    public function getAction(Request $request, $id){
        if(!is_null($id)){
            $doctrine = $this->getDoctrine()->getManager();
            $data = $doctrine->getRepository('BackendBundle:User')->findById($id);    
        }
        
        $response = $this->get('jms_serializer')->serialize($data, 'json');

        return new Response($response);
    }

    /**
     * 
     */
    public function createAction(Request $request){
        $json = $request->request->all();
        $objectUser = json_decode(json_encode($json), FALSE);
        
        
        $name = isset($objectUser->name) ? $objectUser->name : null;
        $username = isset($objectUser->username) ? $objectUser->username : null;
        $email = isset($objectUser->email) ? $objectUser->email : null;
        $street = isset($objectUser->street) ? $objectUser->street : null;
        $suite = isset($objectUser->suite) ? $objectUser->suite : null;
        $city = isset($objectUser->city) ? $objectUser->city : null;
        $zipcode = isset($objectUser->zipcode) ? $objectUser->zipcode : null;
        $lat = isset($objectUser->lat) ? $objectUser->lat : null;
        $lng = isset($objectUser->lng) ? $objectUser->lng : null;
        $phone = isset($objectUser->phone) ? $objectUser->phone : null;
        $website = isset($objectUser->website) ? $objectUser->website : null;
        $nameCompany = isset($objectUser->nameCompany) ? $objectUser->nameCompany : null;
        $catchphrase = isset($objectUser->catchphrase) ? $objectUser->catchphrase : null;
        $bs = isset($objectUser->bs) ? $objectUser->bs : null;


        if( !is_null($name) && !is_null($username) && !is_null($email) && !is_null($street) &&
            !is_null($suite) && !is_null($city) && !is_null($zipcode) && !is_null($lat) && 
            !is_null($lng) && !is_null($phone) && !is_null($website) && !is_null($nameCompany) && 
            !is_null($catchphrase) && !is_null($bs)){
            
            $user = new User();
            $user->setName($name);
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setStreet($street);
            $user->setSuite($suite);
            $user->setCity($city);
            $user->setZipcode($zipcode);
            $user->setLat($lat);
            $user->setLng($lng);
            $user->setPhone($phone);
            $user->setWebsite($website);
            $user->setNameCompany($nameCompany);
            $user->setCatchphrase($catchphrase);
            $user->setBs($bs);
            
            $doctrine = $this->getDoctrine()->getManager();
            $exist_user = $doctrine->getRepository('BackendBundle:User')->findByUsername($username);
            
            if(count($exist_user) == 0){
                $doctrine->persist($user);
                $doctrine->flush();

                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'msg' => 'User created',
                    'user' => $user
                );
            } else {
                $data = array(
                    'status' => 'error',
                    'code' => 400,
                    'msg' => 'Username exist, user not created'
                );
            }
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

    private function parseUser($listUser){
        $arrayParse = array();

        foreach($listUser as $user){

            $userParse = new stdClass();
            $userParse->id = $user->getId();
            $userParse->name = $user->getName();
            $userParse->username = $user->getUsername();
            $userParse->email = $user->getEmail();

            $address = new stdClass();
            $address->street = $user->getStreet();
            $address->suite = $user->getSuite();
            $address->city = $user->getCity();
            $address->zipcode = $user->getZipcode();
            
            
            $geo = new stdClass();
            $geo->lat = $user->getLat();
            $geo->lng = $user->getLng();
            
            $address->geo = (array)$geo;
            
            $userParse->address = (array)$address;

            $userParse->phone = $user->getPhone();
            $userParse->website = $user->getWebsite();

            $company = new stdClass();
            $company->name = $user->getNameCompany();
            $company->catchPhrase = $user->getCatchphrase();
            $company->bs = $user->getBs();

            $userParse->company = (array)$company;

            $arrayParse[] = (array)$userParse;
        }
        
        return $arrayParse;
    }
}
