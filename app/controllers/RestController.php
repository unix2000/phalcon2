<?php
namespace app\controllers;
//use Phalcon\Mvc\Controller;
use PhalconRest\Mvc\Controllers\FractalController;
use PhalconRest\Constants\Services;
use PhalconRest\Di\FactoryDefault;

class RestController extends FractalController{
//     function responseAction(){
        
//     }
    public function createResponse($response){
        if($this->responseValid($response)){
            return $response;
        }
        return null;
    }
    public function authenticate() {
        return $this->createArrayResponse([
            'token' => $this->session->get('token'),
            'expires' => $this->session->get('expires'),
        ]);
    }
    public function serviceAction(){
//         $di = new FactoryDefault();
//         $request = $di->get(Services::REQUEST);
//         $response = $di->get(Services::RESPONSE);
//         $authenticationManager = $di->get(Services::AUTH_MANAGER);
//         //$fractalManager = $di->get(Services::FRACTAL_MANAGER);
//         $tokenParser = $di->get(Services::TOKEN_PARSER);
//         $query = $di->get(Services::QUERY);
//         $phqlQueryParser = $di->get(Services::PHQL_QUERY_PARSER);
//         $urlQueryParser = $di->get(AppServices::URL_QUERY_PARSER);
//         dump($request);
    }
}