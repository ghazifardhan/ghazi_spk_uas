<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Petruk\Framework\Template;
use Josantonius\Session\Session;

class Controller {

    protected $request;
    protected $response;
    protected $json;
    protected $view;
    protected $bcrypt;

    public function __construct(){
        $this->request = Request::createFromGlobals();
        $this->response = new Response();
        $this->json = new JsonResponse();
        $this->view = new Template();
        $this->bcrypt = new \Bcrypt\Bcrypt('prefix', 15);
    }

    public function render($view, $data = array()){
        return $this->view->render($view, $data);
    }

    public function json($data = array()){
        return $this->json->setData($data);
    }

    public function redirect($url, $data = array()){
        return new RedirectResponse($url);
    }

    public function hash($string) {
        $hash = $this->bcrypt->hash($string);
        return $hash;
    }

    public function verify($plainText, $hash) {
        $valid = $this->bcrypt->verify($plainText, $hash);
        return $valid;
    }

    public function middleware($middleware) {

        // return $middleware;

        switch ($middleware) {
            case 'auth':
                if (Session::get() == NULL) {
                    return $this->redirect('/home');
                }
                break;
        }

    }
}