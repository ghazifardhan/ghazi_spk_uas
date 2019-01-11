<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\User;
use Petruk\Framework\UploadFile;
use Petruk\Framework\Auth;
use Josantonius\Session\Session;

class HomeController extends Controller {

    public function __construct(){
        parent::__construct();
               
    }

    public function home(){
        if ((new Auth)->isAuth()) {
            return $this->render('home');
        } else {
            return $this->render('login');
        }
    }

}