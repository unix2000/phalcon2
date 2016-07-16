<?php
namespace app\controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Error\Error;
//phalcon incubator - extends phalcon
class ErrorController extends Controller {
    protected $error;
    
    public function initialize(){
        /** @var \Phalcon\Error\Error $error */
        $error = $this->dispatcher->getParam('error');

        if (!$error instanceof Error) {
            $error = new Error([
                'type'        => -1,
                'message'     => 'Something is not quite right',
                'file'        => __FILE__,
                'line'        => __LINE__,
                'exception'   => null,
                'isException' => false,
                'isError'     => true,
            ]);
        }

        $this->error = $error;

        $this->view->setVars([
            'error' => $this->error,
            'debug' => 'debug info',
        ]);
    }
    
    public function indexAction()
    {
        switch ($this->error->type()) {
            case 404:
                $this->tag->setTitle('Page not found');
                $code = 404;
                $message = 'Unfortunately, the page you are requesting can not be found!';
                break;
            case 403:
                $this->tag->setTitle('Access is denied');
                $code = 403;
                $message = 'Access to this resource is denied by the administrator.';
                break;
            case 401:
                $this->tag->setTitle('Authorization required');
                $code = 401;
                $message = 'To access the requested resource requires authentication.';
                break;
            default:
                $this->tag->setTitle('Something is not quite right');
                $code = 500;
                $message = 'Unfortunately an unexpected system error occurred.';
        }
    
        $this->response->resetHeaders()->setStatusCode($code, null);
    
        $this->view->setVars([
            'code'    => $code,
            'message' => $message,
        ]);
    }
    
    public function route404Action()
    {
        $this->tag->setTitle('Page not found');
        $code = 404;
    
        $this->view->setVars([
            'code'    => $code,
            'message' => 'Unfortunately, the page you are requesting can not be found!',
        ]);
    
        $this->response->resetHeaders()->setStatusCode($code, 'Not Found');
    }
}