<?php

namespace Petruk\Framework;

use Josantonius\Session\Session;
use Model\User;

class Auth {
    
    public function isAuth() {

        if (count(Session::get()) == 0) {
            return false;
        } else {
            return true;
        }

    }

    public function isAuthUser() {
        if (count(Session::get()) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function authUser() {
        if (count(Session::get()) == 0) {
            return false;
        } else {
            $id = Session::get('id');
            $user = (new User)->findOrFail($id);

            return $user;        
        }
    }

    public function login($data) {
        Session::set($data);
    }

    public function logout() {
        Session::destroy();
    }

}