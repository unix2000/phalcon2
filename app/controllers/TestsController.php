<?php
namespace app\controllers;

class TestsController extends \phalcon\Mvc\Controller{
    public function helloAction(){
        $this->view->disable();
        echo 'ab webbench tests';
    }
    public function uploadAction(){
        if($this->request->hasFiles()){
            // Print the real file names and sizes
            foreach ($this->request->getUploadedFiles() as $file) {
                // Print file details
                echo $file->getName(), " ", $file->getSize(), "\n";
                // Move the file into the application
                $file->moveTo('files/' . $file->getName());
            }
        }
    }
}