<?php

namespace App;

use Exception;

class Router {
    /**
     * @var string
     */
    private $viewPath;

    /**
     * @var AltoRouter
     */
    private $router;
    private $controllerPath =  '../controller';
    
    private $loader;
    private $twig;

    public function __construct(){
        $this->router = new \AltoRouter();
        $this->loader  = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/views');
        $this->twig = new \Twig\Environment($this->loader,[
            'cache' => false,
            'debug' => true
        ]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    public function get(string $url, string $view , ?string $name = null): self {
        $this->router->map('GET', $url, $view, $name);

        return $this;
    }

    public function post(string $url, string $view , ?string $name = null): self {
        $this->router->map('POST', $url, $view, $name);

        return $this;
    }
    public function match(string $url, string $view , ?string $name = null): self {
        $this->router->map('POST|GET', $url, $view, $name);

        return $this;
    }


    public function url(string $name, array $params = []) {
        return $this->router->generate($name,$params);
    }

    public function run() : self {
        $match = $this->router->match();
        
        try {
        $view = $match['target'] . '.html';
        
        $controller = $match['target'] . '.php';
        $params = $match['params'];
        } catch (Exception $e){
            http_response_code(404);
            echo $this->twig->render('e404.html');
            exit();
        }
        
        
        $router = $this;
        $twig = $this->twig;
        require $this->controllerPath . '/' . $controller;
        
        return $this;
    }   
}