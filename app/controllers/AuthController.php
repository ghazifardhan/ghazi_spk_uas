<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\User;
use Petruk\Framework\UploadFile;
use Petruk\Framework\Auth;
use Josantonius\Session\Session;

class AuthController extends Controller {

    protected $user;

    public function __construct() {
        parent::__construct();

        $this->user = new User();

    }

    public function loginPage() {

        if ((new Auth)->isAuth()) {
            return $this->render('home');
        } else {
            return $this->render('login');
        }
    }

    public function customerLoginPage() {
        if ((new Auth)->isAuthUser()) {
            return $this->redirect('/home');
        } else {
            return $this->render('page/front/login');
        }
    }

    public function login() {

        $requestData = $this->request->request->all();

        $user = $this->user->where('username', $requestData['username'])->first();
        
        if ($this->verify($requestData['password'], $user->password)) {

            // $user['logged_id'] = true;
            if ($user) {
                $auth = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'logged_in' => true,
                ];

                (new Auth)->login($auth);

                return $this->redirect('/home');
            } else {
                return $this->render('/login');
            }
        } else {
            return $this->redirect('/login');            
        }
    }

    public function customerLogin() {
        $requestData = $this->request->request->all();

        $user = $this->user->with('role.role')->where('email', $requestData['email'])->first();
        
        if ($user) {
            if ($this->verify($requestData['password'], $user->password)) {
    
                // $user['logged_id'] = true;
                if ($user->role->role_id == 2) {
                    $auth = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'logged_in' => true,
                        'role' => $user->role->role_id,
                        'role_name' => $user->role->role->name
                    ];
    
                    (new Auth)->login($auth);
    
                    return $this->redirect('/');
                } else {                
                    $message['msg'] = "You dont have previlige to access this page.";
    
                    return $this->render('/page/front/login', compact('message'));
                }
            } else {
                $message['msg'] = "Login Failed. Email or password false.";

                return $this->render('/page/front/login', compact('message'));            
            }
        } else {
            $message['msg'] = "Login Failed. User not registered.";

            return $this->render('/page/front/login', compact('message')); 
        }
    }

    public function logout() {
        (new Auth)->logout();

        return $this->redirect('/');
    }

    public function admin() {
        if ((new Auth)->isAuth()) {
            return $this->render('admin');
        } else {
            return $this->render('login');
        }
    }

    public function getUser() {
        $data = Session::get();

        return $this->json($data);
    }




}