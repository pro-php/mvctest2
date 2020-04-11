<?php

class Controller
{
    protected $name = 'home';

    public $session = null;
	public $request = null;


    public function __construct($name)
    {
        $this->name = $name;
        $this->session = new Session();
		$this->request = new Request();
    }

    public function loadModel($name)
    {
        $path = APP . 'model' . DIRECTORY_SEPARATOR . $name . '.php';

        if (file_exists($path))
        {
            require_once ($path);
            $class = ucfirst($name);
            return new $class();
        }
    }

    public function loadLib($name)
    {
        $path = APP . 'libs' . DIRECTORY_SEPARATOR . $name . '.php';

        if (file_exists($path))
        {
            require_once ($path);
            $class = ucfirst($name);
            return new $class();
        }
    }

    public function render($view, $vars = [])
    {
        $path = APP . 'view' . DIRECTORY_SEPARATOR . $view . '.php';

        if (file_exists($path))
        {
            @extract($vars);

            $admin_login = false;
            if ($this->session->get('admin'))
                $admin_login = true;

            ob_start();
            require $path;
            $content = ob_get_clean();

            require APP . 'view' . DIRECTORY_SEPARATOR . 'layout.php';
        }
    }

    public function redirect($path)
    {
        exit(header('location: ' . URL . $path));
    }

	public function message($status, $message, $url='') {
		$msg = array('status' => $status, 'message' => $message, 'url' => $url);
		exit(json_encode($msg,JSON_UNESCAPED_UNICODE));
	}

	public function location($url) {
		exit(json_encode(['url' => $url]));
	}
}
