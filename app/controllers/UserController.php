<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\User;
use Model\RoleUser;
use Petruk\Framework\UploadFile;
use Petruk\Framework\Auth;
use Petruk\Framework\Paginator;
use Josantonius\Session\Session;
use Validator\ValidatorFactory;

class UserController extends Controller {

    protected $user;

    public function __construct(){
        parent::__construct();

        $this->user = new User();
    }

    public function getQueryParam() {
        $request = $this->request->query->get();

        return $request;
    }

    public function index() {

        if (Auth::isAuth()) {

            $keyword = $this->request->query->get('search');
            $perPage = 25;
            $page = empty($this->request->query->get('page')) ? 1 : $this->request->query->get('page');

            if  (!empty($page)) {
                $from = $page > 1 ? ($page * $perPage) - $perPage : $page - 1;
                $to = $page > 1 ? ($perPage * $page) : $perPage;
            } else {
                $from = 0;
                $to = $perPage;
            }

            $users = $this->user->whereHas('role', function($q) {
                $q->where('role_id', 2);
            });

            if (!empty($keyword)) {
                $users = $users->where(function($q) use ($keyword){
                    $q->where('name', 'LIKE', "%$keyword%");
                    $q->orWhere('email', 'LIKE', "%$keyword%");
                });
            } else {
                $users = $users;
            }
            $items = $users->get();

            $users = $users
                        ->offset($from)
                        ->limit($perPage)
                        ->get();

            $paginator = Paginator::paginate($users, $perPage, $page);

            // return $this->json(compact('users', 'paginator'));
            
            return $this->render('page/customer/index', compact('users', 'paginator'));
        } else {
            return $this->redirect('/home');
        }

    }

    public function create() {

        if (Auth::isAuth()) {    

            return $this->render('page/customer/create');            
        } else {
            return $this->redirect('/home');
        }
    }

    public function createAdmin() {
        $requestData = $this->request->request->all();
        $this->user->fill([
            'username' => $requestData['username'],
            'password' => $this->hash($requestData['password'])
        ]);
        $this->user->save();
    }

    public function store() {

        if (Auth::isAuth()) {

            $requestData = $this->request->request->all();
    
            $valid = $this->_validate($requestData);
    
            if ($valid->passes() === TRUE) {
    
                $this->user->fill([
                    'name' => $requestData['name'],
                    'email' => $requestData['email'],
                    'password' => $this->hash($requestData['password']),
                ]);
    
                if ($this->user->save()) {
    
                    (new RoleUser)->fill([
                        'role_id' => 2,
                        'user_id' => $this->user->id
                    ])->save();

                    return $this->redirect('/admin/customers');
                } else {
                    return $this->redirect('/admin/customer/create');
                }
            } else {
                $errors = $valid->errors();
                return $this->render('page/customer/create', compact('errors'));
            }
        } else {
            return $this->redirect('/home');
        }
        
    }

    public function createUserFront() {
        $requestData = $this->request->request->all();

        $valid = $this->_validate($requestData);

        if ($valid->passes() === TRUE) {

            $this->user->fill([
                'name' => $requestData['name'],
                'email' => $requestData['email'],
                'password' => $this->hash($requestData['password']),
            ]);

            if ($this->user->save()) {

                (new RoleUser)->fill([
                    'role_id' => 2,
                    'user_id' => $this->user->id
                ])->save();

                $message['msg'] = "Register success.";

                // return $this->json($message);

                return $this->render('/page/front/login', compact('message'));
            } else {
                $message['msg'] = "Register failed.";
                // return $this->json($message);

                return $this->render('/page/front/login', compact('message'));
            }
        } else {
            $errors = $valid->errors();
            return $this->render('page/front/login', compact('errors'));
        }
    }

    public function showUser() {
        return $this->render('page/front/customer');
    }

    public function edit($id) {

        if (Auth::isAuth()) {
            $user = $this->user->with('role.role')->findOrFail($id);
            
            // return $this->json($user);
            return $this->render('page/customer/edit', compact('user'));

        } else {
            return $this->redirect('/home');
        }

    }

    public function update($id) {

        if (Auth::isAuth()) {
            $user = $this->user->findOrFail($id);
    
            $requestData = $this->request->request->all();
    
            $valid = $this->_validate($requestData);
    
            if ($valid->passes() === TRUE) {
    
                $user->name = $requestData['name'];
                $user->email = $requestData['email'];

                if (!empty($requestData['password'])) {
                    $user->password = $this->hash($requestData['password']);
                }
    
                if ($user->save()) {
    
                    return $this->redirect('/admin/customers');
                } else {
                    return $this->redirect('/admin/customer/edit');
                }
            } else {
                $errors = $valid->errors();
                return $this->render('page/customer/edit', compact('errors', 'user'));
            }
        } else {
            return $this->redirect('/home');
        }
        
    }

    public function destroy($id) {
        if (Auth::isAuth()) {
            $this->user->destroy($id);
    
            return $this->redirect('/admin/customers');
        } else {
            return $this->redirect('/home');
        }
    }

    protected function _validate($data) {
        $validators = $this->user->validate;
        $messages = $this->user->message;

        if (!empty($fields)) {
            foreach ($fields as $field) {
                $validator[$field] = $validators[$field];
            }
        } else {
            $validator = $validators;
        }

        $invalid = (new ValidatorFactory)->make($data, $validator, $messages);

        return $invalid;        
    }

}