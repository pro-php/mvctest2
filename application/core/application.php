<?php

class Application
{
    private $url_controller = 'tasks';
    private $url_action = 'index';
    private $url_params = array();


    public function __construct()
    {
        $this->parseUrl();

        $name = $this->url_controller;
        $this->url_controller .= 'Controller';

        $path = APP . 'controller/' . $this->url_controller . '.php';

        if (file_exists($path))
        {

            require $path;
            $this->url_controller = new $this->url_controller($name);

            if (method_exists($this->url_controller, $this->url_action))
            {
                call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
            } 
            else
            {
                if (strlen($this->url_action) == 0)
                {
                    $this->url_controller->index();
                } 
                else
                {
                    $this->url_controller->redirect('error');
                }
            }
        } else
        {
            header('location: ' . URL . 'error');
        }
    }

    private function parseUrl()
    {
        if (isset($_GET['url']))
        {
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            if (isset($url[0]))
                $this->url_controller = $url[0];

            if (isset($url[1]))
                $this->url_action = $url[1];

            unset($url[0], $url[1]);

            $this->url_params = array_values($url);
        }
    }
}
