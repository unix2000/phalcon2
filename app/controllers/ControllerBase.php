<?php
namespace app\controllers;
use Phalcon\Mvc\Controller;
use app\models\Items;
use Phalcon\Http\Response\Exception;

class ControllerBase extends Controller {
    protected function initialize(){
        //登陆判断
        if($this->session->get('userInfo')){
            //
        }
    }
    public function cAction(){
        //items add
        if($this->request->isPost()){
            //
        }
        $objects = new Items();
        $objects->name = "xiaolin";
        $objects->email = "xiexxl2000@163.com";
        $objects->address = "苏州xxx";
        $objects->registration_date = "2012-01-01";
        $objects->save();
    }
    public function rAction(){
        $data = Items::findFirst(1);
        if(!$data){
            throw new Exception('data errors');
        }
        dump($data->toArray());
    }
    public function uAction(){
        if($this->request->isPost()){
            //valid id
        }
        $objects = Items::findFirst(17995);
        $objects->address = "苏州xxxxxxxx";
        $objects->update();
    }
    public function dAction(){
        if($this->request->isPost()){
            //valid id
        }
        $objects = Items::findFirst(17994);
        $objects->delete();
    }
    /**
     * 消息输出
     * param string $msg
     */
    protected function output( $msg )
    {
        if( $this->request->isAjax() )
        {
            $this->error( $msg );
        }
        else
        {
            exit( $msg );
        }
    }
    /**
     * 消息的输出
     * param int $status 状态 0：代表成功，1：代表失败，2:代表其
     * param string $msg 消息内容
     * param array $data 其他自定义数据
     */
    protected function message( $status = 0, $msg = '', $data = array() )
    {
        $ret[ 'status' ] = $status;
        $ret[ 'msg' ] = $msg;
        $ret = array_merge( $ret, $data );
        echo json_encode( $ret );
        exit;
    }
    
    /**
     *成功消息返回 
     * param string $msg
     * param array $data 其他自定义数据
     */
    protected function success( $msg = '', $data = array() )
    {
        $this->message( 0, $msg, $data );
    }
    
     /**
     * 错误消息返回 
     * param string $msg
     * param array $data 其他自定义数据
     */
    public function  error( $msg = '', $data = array() )
    {
        $this->message( 1, $msg, $data );
    }
       
    /**
     * 显示404错误页面
     */
    public function show404( $msg = '' )
    {
        $referer = '';
        if( ! empty( $_SERVER[ 'HTTP_REFERER']))
        {
            $referer = str_replace( '/', '$', $_SERVER[ 'HTTP_REFERER' ] );
        }
        
        $this->response->redirect( '/admin/index/show404/msg/' . $msg . '/referer/'. $referer );
    }
}
