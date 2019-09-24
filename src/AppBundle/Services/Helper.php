<?php
namespace AppBundle\Services;

class Helper {
    public $manager;

    public function __construct($manager){
        $this->manager = $manager;
    }

    public function json($data){
        $asd = array(new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer());
        $enco = array("json" => new \Symfony\Component\Serializer\Encoder\JsonEncoder());

        $serializer = new \Symfony\Component\Serializer\Serializer($asd, $enco);
        $json = $serializer->serialize($data, 'json');

        $response = new \Symfony\Component\HttpFoundation\Response();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Credentials', true);

        // $response->headers->set('Access-Control-Allow-Origin','*');
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:3000');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS'); 

        return $response;
    }
}
