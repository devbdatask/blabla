<?php if(isset($data) && array_key_exists('auth', $data)): ?>
    <h2>Вы не авторизированы!</h2>
<?php else: ?>
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
            <th></th>
        </thead>
        <tbody>
        <?php if(isset($data) && array_key_exists('tasks', $data)): ?>
            <?php if(count($data['tasks'])): ?>
                <?php foreach ($data['tasks'] as $task): ?>
                    <tr>
                        <td id="col-<?php echo $task['id']?>-user"><?php echo $task['user'] ?></td>
                        <td id="col-<?php echo $task['id']?>-email"><?php echo $task['email'] ?></td>
                        <td id="col-<?php echo $task['id']?>-text"><?php echo $task['text'] ?></td>
                        <td>
                            <?php if($task['status'] == 1): ?>
                                <span class="uk-text-success">выполнено</span><br>
                            <?php endif ?>
                            <?php if($task['change_admin'] == 1): ?>
                                <span class="uk-text-warning">отредактировано администратором</span>
                            <?php endif ?>
                        </td>
                        <td><button data-status="<?php echo $task['status']?>" data-change="<?php echo $task['change_admin']?>" uk-toggle="target: #modalTask" class="uk-button uk-button-small" onclick="editTask(this)" data-id="<?php echo $task['id']?>">Редактировать</button></td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr><td colspan="3" class="uk-text-center">Задачи отсутствуют</td></tr>
            <?php endif ?>
        <?php endif ?>
        </tbody>
        <?php if(isset($_GET['page']) && isset($pages) && count($pages)): ?>
            <ul class="uk-pagination uk-flex-center" uk-margin>
                <?php foreach ($tasks as $task): ?>
                    <?php if($task[''] > 1): ?>
                        <li><a href="#"><span uk-pagination-previous></span></a></li>
                    <?php endif ?>
                <?php endforeach ?>
                <li><a href="#">1</a></li>
                <li class="uk-disabled"><span>...</span></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li class="uk-active"><span>7</span></li>
                <li><a href="#">8</a></li>
                <li><a href="#"><span uk-pagination-next></span></a></li>
            </ul>
        <?php endif ?>
    </table>
    <?php
        $adminPanel = 'admin';
        require 'inc/pagination.php';
    ?>
<?php endif ?>

