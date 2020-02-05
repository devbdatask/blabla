<?php
class Model_Main extends Model
{
    public function getTasks()
    {
        $l1 = 0;
        $l2 = 3;
        if(isset($_GET['page'])) {
            $l1 = ($_GET['page'] * 3) - 3;
        }
        $order = '';
        if(isset($_GET['order'])){
            $order = explode('-', $_GET['order']);
            $order = ' ORDER BY '.$order[0].' '.$order[1];
        }
        return $this->query('SELECT * FROM `task`'.$order.' LIMIT '.$l1.','.$l2);
    }
    public function addTasks()
    {
        $ret = false;
        if(isset($_POST['user']) && isset($_POST['email']) && isset($_POST['text'])) {
            $user = '';
            if ($_POST['user'])
                $user = $this->getField($_POST['user']);
            $email = '';
            if ($_POST['email'])
                $email = $this->getField($_POST['email']);
            $text = '';
            if ($_POST['text'])
                $text = $this->getField($_POST['text']);
            if($user && $email&& $text) {
                $sql = 'INSERT INTO `task` SET `user`="' . $user . '", `email`="' . $email . '", `text`="' . $text . '", `status` = 0, `change_admin` = 0';
                $this->query($sql);
                $ret = true;
            }
        }
        return $ret;
    }
    function editTasks() {
        $ret = false;

        if(isset($_POST['user']) && isset($_POST['email']) && isset($_POST['text'])) {
            $user = '';
            if ($_POST['user'])
                $user = $this->getField($_POST['user']);
            $email = '';
            if ($_POST['email'])
                $email = $this->getField($_POST['email']);
            $text = '';
            if ($_POST['text'])
                $text = $this->getField($_POST['text']);

            if($user && $email&& $text) {
                $sql = 'UPDATE `task` SET `user`="' . $user . '", `email`="' . $email . '", `text`="' . $text . '", `status` = '.$_POST['status'].', `change_admin` = '.$_POST['change_admin'].' WHERE `id` = '.$_POST['id'];
                $this->query($sql);
                $ret = true;
            }
        }
        return $ret;

    }
    function getField($field) {
//        $field = strip_tags($field);
//        $field = htmlentities($field, ENT_QUOTES, "UTF-8");
        $field = htmlspecialchars($field, ENT_QUOTES);
        return $field;
    }
    public function getCount() {
        $sql = 'SELECT COUNT(*) AS cnt FROM `task`';
        $cnt = $this->query($sql);
        $cnt = ceil($cnt[0]['cnt']/3);
        return $cnt;
    }

}
