<?php
namespace app\controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\NativeArray as Paginator;
use Phalcon\Paginator\Pager;

class IncubatorController extends Controller {
	public function indexAction(){
		//phalcon incubator tests
		
	}
	
	public function pagesAction(){
	    $currentPage = abs($this->request->getQuery('page','int',1));
	    if($currentPage == 0 ){
	        $currentPage = 1;
	    }
	    
	    $pager = new Pager(
	        new Paginator(array(
	            'data'  => range(1, 200),
	            'limit' => 10,
	            'page'  => $currentPage,
	        )),
	        array(
	            // We will use Bootstrap framework styles
	            'layoutClass' => 'Phalcon\Paginator\Pager\Layout\Bootstrap',
	            // Range window will be 5 pages
	            'rangeLength' => 5,
	            // Just a string with URL mask
	            'urlMask'     => '?page={%page_number}',
                // Or something like this
//                 'urlMask'     => sprintf(
//                     '%s?page={%%page_number}',
//                     $this->url->get(array(
//                         'for'        => 'index:posts',
//                         'controller' => 'incubator',
//                         'action'     => 'pages'
//                     ))
//                 ),
            )
        );
	    
        $this->view->setVar('pager', $pager);
	}
}