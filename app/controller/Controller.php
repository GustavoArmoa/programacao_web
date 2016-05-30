<?php

namespace CRUD\controller;

use CRUD\view\View;

abstract class Controller {

    protected $view;
    /**
     * Query string
     *
     * @var string
     */
    protected $getParams;
    /**
     * POST, PUT or DELETE content body
     *
     * @var array
     */
    protected $content;
    /**
     * HTTP request method
     *
     * @var string
     */
    protected $requestMethod;

    /**
     * Class constructor
     *
     */

    abstract public function createAction();
    abstract public function readAction();
    abstract public function updateAction();
    abstract public function deleteAction();

    public function __construct(){
        $this->view          = new View();
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->content       = [];
        $this->getParams     = [];
        $this->getRequest();
        $this->view->setTemplate("template");
    }

    /**
     * @return string
     */
    public function getGetParams($key = null)
    {
        if(is_null($key))
            return $this->getParams;

        return isset($this->getParams[$key]) ? $this->getParams[$key] : null ;
    }

    /**
     * @param string $getParams
     */
    public function setGetParams($getParams)
    {
        $this->getParams = $getParams;
    }

    /**
     * @return array
     */
    public function getContent($key = null)
    {
        if(is_null($key))
            return $this->content;

        return isset($this->content[$key]) ? $this->content[$key] : null ;
    }

    /**
     * @param array $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @param string $requestMethod
     */
    public function setRequestMethod($requestMethod)
    {
        $this->requestMethod = $requestMethod;
    }

    /**
     * Get the request from client
     *
     */
    public function getRequest(){

        $this->getParams = $_GET;

        if($this->isPOST()){
            $post = file_get_contents('php://input');

            if($this->isJSON($post))
                $_POST = json_decode($post, true);

            $this->content = $_POST;
        }

        if($this->isPUT()){
            $put = file_get_contents("php://input");

            if($this->isJSON($put))
                $this->content = json_decode($put, true);

            else
                $this->content = [];
        }

        if($this->isDELETE()){
            $delete = file_get_contents("php://input");

            if($this->isJSON($delete))
                $this->content = json_decode($delete, true);
            else
                $this->content = [];
        }
    }

    /**
     * Check if it's a GET method
     *
     * @return True if the method is GET, false if it's not
     */
    public function isGET(){
        return $this->requestMethod === 'GET';
    }

    /**
     * Check if it's a POST method
     *
     * @return True if the method is POST, false if it's not
     */
    public function isPOST(){
        return $this->requestMethod === 'POST';
    }

    /**
     * Check if it's a PUT method
     *
     * @return True if the method is PUT, false if it's not
     */
    public function isPUT(){
        return $this->requestMethod === 'PUT';
    }

    /**
     * Check if it's a DELETE method
     *
     * @return True if the method is DELETE, false if it's not
     */
    public function isDELETE(){
        return $this->requestMethod === 'DELETE';
    }

    /**
     * Check if the string is in JSON format
     *
     * @param string $str A string
     * @return True if the method is GET, false if it's not
     */
    public function isJSON($str){
        return is_string($str) && is_object(json_decode($str)) ? true : false;
    }

    public function getView()
    {
        return $this->view;
    }

    public function setView($view)
    {
        $this->view = $view;
    }

    public function indexAction(){
        echo "É necessario fazer uma sobregada desse metodo!";
    }

    public function sendJSON(array $msg){
        $responseSuccess = function($code) use (&$msg){
            return [
                'meta' => ['code' => $code],
                'data' => $msg,
            ];
        };

        $responseError = function() use (&$msg){
            return [
                'meta' => [
                    'code'          => 400,
                    'error_message' => $msg['error'],
                ],
            ];
        };

        if($this->isGET())
            return (isset($msg['error']) ? $responseError() : $responseSuccess(200));

        elseif($this->isPOST() || $this->isPUT())
            return (isset($msg['error']) ? $responseError() : $responseSuccess(201));

        elseif($this->isDELETE())
            return (isset($msg['error']) ? $responseError() : $responseSuccess(204));

        else
            return ($msg);
    }
}