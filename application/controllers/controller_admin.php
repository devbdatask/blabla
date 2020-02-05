<?php

include 'application/models/model_main.php';
class Controller_Admin extends Controller
{
    public $get_data = array();

    function __construct()
    {
        $this->model = new Model_Main();
        $this->view = new View();
    }

    function action_logout() {
        session_destroy();
        header('Location: ' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/');
    }
    function action_index()
    {
        if (isset($_POST['task']) && $_POST['task'] == 'edit') {
            if($this->model->editTasks())
                $this->get_data['dialog'] = 'confirm';
            else
                $this->get_data['dialog'] = 'error';
        }

        $this->get_data['pages'] = $this->model->getCount();
        if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1){
            $this->get_data['tasks'] = $this->model->getTasks();
        } else {
            $this->get_data['auth'] = 'error';
        }

        $this->view->generate('admin_view.php', 'template_view.php', $this->get_data);
    }
}