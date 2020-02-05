<?php
    $getPage = '';
    if(isset($_GET['page']))
        $getPage = '&page='.$_GET['page'];
    $order = 'asc';
    $orderIco = 'down';
    $activeColOrder = '';
    if(isset($_GET['order'])) {
        if(substr($_GET['order'], -3) == 'asc') {
            $order = 'desc';
            $orderIco = 'up';
        }
        $activeColOrder = explode('-', $_GET['order'])[0];
    }
?>
<table class="uk-table uk-table-small uk-table-divider uk-table-striped uk-table-hover">
    <thead>
        <th id="user" class="uk-width-1-5"><a href="/?order=user-<?php echo $order?><?php echo $getPage?>"><span <?php if($activeColOrder != 'user'): ?>class="uk-hidden"<?php endif ?> uk-icon="triangle-<?php echo $orderIco?>"></span> Имя пользователя</a></th>
        <th class="uk-width-1-4"><a href="/?order=email-<?php echo $order?><?php echo $getPage?>"><span <?php if($activeColOrder != 'email'): ?>class="uk-hidden"<?php endif ?> uk-icon="triangle-<?php echo $orderIco?>"></span> E-mail</a></th>
        <th class="uk-width-expand">Текст задачи</th>
        <th class="uk-width-1-5"><a href="/?order=status-<?php echo $order?><?php echo $getPage?>"><span <?php if($activeColOrder != 'status'): ?>class="uk-hidden"<?php endif ?> uk-icon="triangle-<?php echo $orderIco?>"></span> Статус</a></th>
    </thead>
    <tbody>
        <?php if(isset($data) && array_key_exists('tasks', $data)): ?>
            <?php if(count($data['tasks'])): ?>
                <?php foreach ($data['tasks'] as $task): ?>
                    <tr>
                        <td><?php echo $task['user'] ?></td>
                        <td><?php echo $task['email'] ?></td>
                        <td><?php echo $task['text'] ?></td>
                        <td>
                            <?php if($task['status'] == 1): ?>
                                <span class="uk-text-success">выполнено</span><br>
                            <?php endif ?>
                            <?php if($task['change_admin'] == 1): ?>
                                <span class="uk-text-warning">отредактировано администратором</span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr><td colspan="3" class="uk-text-center">Задачи отсутствуют</td></tr>
            <?php endif ?>
        <?php endif ?>
    </tbody>
</table>
<?php
    $adminPanel = '';
    require 'inc/pagination.php';
?>
<div class="uk-text-center">
    <button class="uk-button uk-button-secondary" uk-toggle="target: #modalTask">Добоваить задачу</button>
</div>
