<?php

class TasksController extends Controller
{

    public function index($page = 0)
    {
        $this->model = $this->loadModel($this->name);

        $page = (int)$page;

        $max = $this->model->getTotalTasks();
        $show = 3;

        $pagination = new Pagination($max, $page, $show, $this->name);

        if ($page >= 1)
        {
            $page = $page - 1;
        } 
		else
        {
            $page = 0;
        }

        $params = [
			'start' => (int)($page * $show), 
			'max' => (int)$show
		];

        $field = 'id';
        $sort = 'ASC';
        if ($this->session->get('field'))
            $field = $this->session->get('field');
        if ($this->session->get('sort'))
            $sort = $this->session->get('sort');

        $tasks = $this->model->getListTasks($params, $field, $sort);

        $vars = [ 
            'tasks' => $tasks, 
            'pagination' => $pagination->get()
        ];

        $this->render($this->name, $vars);
    }

    public function page($page = 0)
    {
        $this->index($page);
    }

    public function addTask()
    {
		if (isset($this->request->post["name"]) || isset($this->request->post["email"]) || isset($this->request->post["description"]))
		{
			if (!filter_var($this->request->post["email"], FILTER_VALIDATE_EMAIL))
				$this->message('error', 'Ошибка, указан не верный e-mail!');
			
			if ($this->request->post["name"] != '' && $this->request->post["description"] != '')
			{
				$this->model = $this->loadModel($this->name);			

				$vars = ['name' => $this->request->post["name"], 'email' => $this->request->post["email"], 'description' => $this->request->post["description"]];

				$this->model->addTask($vars);
			
				$this->message('success', 'Задача добавлена!', $this->name);
			}			
		}
		
        $this->message('error', 'Ошибка, укажите верные данные!');
    }

    public function deleteTask($id)
    {
        if (isset($id) && is_numeric($id))
        {
            $this->model = $this->loadModel($this->name);

            $params = ['id' => $id];

            $this->model->deleteTask($params);
        }

        $this->redirect($this->name);
    }

    public function editTask($id)
    {
        if (isset($id) && is_numeric($id))
        {
            $this->model = $this->loadModel($this->name);

            $params = ['id' => $id];

            $vars = ['task' => $this->model->getTask($params)];

            $this->render('edit', $vars);

        } 
		else
        {
            $this->redirect($this->name);
        }
    }

    public function updateTask()
    {	
		if (!$this->session->get('admin'))
		{	
			http_response_code(403); exit();
		}
		
		if (isset($this->request->post["name"]) || isset($this->request->post["email"]) || isset($this->request->post["description"]))
		{
			if (!filter_var($this->request->post["email"], FILTER_VALIDATE_EMAIL))
				$this->message('error', 'Ошибка, указан не верный e-mail!');
			
			if ($this->request->post["name"] != '' && $this->request->post["description"] != '')
			{
				$this->model = $this->loadModel($this->name);

				$params = ['id' => $this->request->post["id"]];

				$task = $this->model->getTask($params);
				$edit = $task->edit;
				if ($task->description != $this->request->post["description"])
					$edit = 1;

				$vars = ['name' => $this->request->post["name"], 'email' => $this->request->post["email"], 'description' => $this->request->post["description"],
					'edit' => $edit, 'id' => $this->request->post["id"]];

				$this->model->updateTask($vars);
			
				$this->message('success', 'Задача отредактированна!');
			}			
		}
		
        $this->message('error', 'Ошибка, укажите верные данные!');		
    }

    public function ajaxCheckbox()
    {
		if (!$this->session->get('admin'))
		{	
			http_response_code(403); exit();
		}
		
        if (isset($this->request->post["id"]) && is_numeric($this->request->post["id"]))
        {
            $status = 0;
            if (isset($this->request->post["status"]) && $this->request->post["status"] == 'Yes')
                $status = 1;

            $params = ['id' => $this->request->post["id"], 'status' => $status];

            $this->model = $this->loadModel($this->name);

            $this->model->updateTask($params);
        } 
    }

    public function sort($field)
    {
        $sort = 'ASC';
        $accept = array('id', 'name', 'email', 'description', 'status');
		
        if (in_array($field, $accept))
            if (!$this->session->get('field'))
            {
                $this->session->set('field', $field);
                $this->session->set('sort', $sort);
            } else
            {
                $this->session->set('field', $field);

                if (!$this->session->get('sort') || $field != $this->session->get('field'))
                    $this->session->set('sort', $sort);
                else
                {
                    $sort = $this->session->get('sort') == $sort ? 'DESC' : $sort;
                    $this->session->set('sort', $sort);
                }
            }

            $this->index();
    }

    public function login()
    {
		if (isset($this->request->post["login"]) || isset($this->request->post["pass"]))
		{
			if ($this->request->post["login"] == ADMIN_LOGIN && $this->request->post["pass"] == ADMIN_PASS)
			{
				$this->session->set('admin', 1);
				$this->message('success', 'Вход разрешен!', $this->name);
			}

			$this->message('error', 'Ошибка, логин или пароль не верный');
		}

        $this->render('login');
    }

    public function logout()
    {
        $this->session->destroy();

        $this->redirect($this->name);
    }
}