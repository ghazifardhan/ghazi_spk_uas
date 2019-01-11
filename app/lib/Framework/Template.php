<?php

namespace Petruk\Framework;

use Symfony\Component\HttpFoundation\Response;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_SimpleFunction;
use Twig_Extension_Debug;
use Model\Category;
use Model\Product;
use Petruk\Framework\Auth;

class Template {

    protected $view;
    protected $response;
    
    public function __construct(){

        $this->response = new Response();
        
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../../../views');
        $this->view = new Twig_Environment($loader, ['debug' => true]);
        $this->view->addExtension(new Twig_Extension_Debug());
        $this->view->addFunction(new Twig_SimpleFunction('asset', function($asset) {
            return sprintf("/../../../assets/%s", ltrim($asset, '/'));
        }));
        $this->view->addFunction(new Twig_SimpleFunction('storage', function($asset) {
            return sprintf("/../../../storage/%s", ltrim($asset, '/'));
        }));

        // $category = (new Category)->getCategory();
        // $hotProducts = (new Product)->hotProduct();
        $user = (new Auth)->authUser();
        $isAuth = (new Auth)->isAuthUser();

        // $this->view->addGlobal('categories', $category);
        // $this->view->addGlobal('hotProducts', $hotProducts);
        $this->view->addGlobal('user', $user);
        $this->view->addGlobal('isAuth', $isAuth);

        // $this->view->loadFromExtension('twig', array(
        //     'globals' => array(
        //         'name' => 'Ghazi Fadil Ramadhan'
        //     ),
        // ));
    }

    public function render($view, $data = array()){
        return $this->response->setContent($this->view->render($view . '.html', $data));
    }
}