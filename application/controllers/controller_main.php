<?php

class Controller_Main extends Controller
{
    public $get_data = array();

    function __construct()
    {
        $this->model = new Model_Main();
        $this->view = new View();
    }

    function action_index()
    {
        $this->get_data['pages'] = $this->model->getCount();
        $this->get_data['tasks'] = $this->model->getTasks();
        $this->view->generate('main_view.php', 'template_view.php', $this->get_data);
    }

    function action_task() {
        if (isset($_POST['task']) && $_POST['task'] == 'add') {
            if ($this->model->addTasks())
                $this->get_data['dialog'] = 'confirm';
            else
                $this->get_data['dialog'] = 'error';

        }
        $this->action_index();
    }
    function action_auth()
    {
        if (!isset($_SESSION['auth']))
            $_SESSION['auth'] = 0;
        if (isset($_POST['login']) && isset($_POST['psswd'])) {
            if ($_POST['login'] == 'admin' && $_POST['psswd'] == '123') {
                $_SESSION['auth'] = 1;
                header('Location: ' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/admin');
            }
        }
        if ($_SESSION['auth'] == 0)
            $this->get_data['auth'] = 'error';
        $this->action_index();
    }
}