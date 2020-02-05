<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Задачник</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<div class="uk-container">
    <div class="uk-grid uk-margin-remove">
        <div class="uk-width-1-1 uk-padding-remove uk-background-secondary">
            <h1 class="uk-text-muted uk-text-center uk-padding-small"><a href="/">Задачник</a>
                <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1): ?>
                    <a href="/admin/logout" class="uk-align-right uk-margin-small-left uk-text-muted uk-button uk-button-small uk-button-default">Выход</a>
                    <a href="/admin" class="uk-align-right uk-text-muted uk-button uk-button-small uk-button-default">Перейти в панель</a>
                <?php else: ?>
                    <button class="uk-align-right uk-text-muted uk-button uk-button-small uk-button-default" uk-toggle="target: #modalAuth">Авторизация</button>
                <?php endif ?>
            </h1>
        </div>
    </div>
    <div>
        <?php include 'application/views/' . $content_view; ?>
    </div>
</div>

<div id="modalTask" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title" id="titleModal">Новая задача</h2>
        <form class="uk-form-stacked" id="formModal" action="/main/task" method="post">
            <input type="hidden" name="task" id="methodTask" value="add">
            <div class="uk-margin">
                <label class="uk-form-label uk-text-small" for="userField">Имя пользователя</label>
                <div class="uk-form-controls">
                    <input required class="uk-input uk-form-small" name="user" id="userField" type="text" placeholder="Новое имя пользователя">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label uk-text-small" for="emailField">E-mail</label>
                <div class="uk-form-controls">
                    <input required class="uk-input uk-form-small" name="email" id="emailField" type="email" placeholder="E-mail пользователя">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label uk-text-small" for="textField">Текст задачи</label>
                <div class="uk-form-controls">
                    <textarea <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1): ?>onchange="changeAdmin.value = 1" <?php endif ?>required class="uk-textarea uk-form-small" name="text" id="textField" placeholder="Текст задачи"></textarea>
                </div>
            </div>
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1): ?>
                <input type="hidden" id="taskId" name="id" value="0">
                <input type="hidden" id="changeAdmin" name="change_admin" value="0">
                <div class="uk-margin">
                    <label class="uk-form-label uk-text-small" for="statusField">Статус</label>
                    <div class="uk-form-controls">
                        <select name="status" id="statusField" class="uk-select">
                            <option value="0">Не выполнено</option>
                            <option value="1">Выполнено</option>
                        </select>
                    </div>
                </div>
            <?php endif ?>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close uk-button-small" type="button">Отмена</button>
                <button class="uk-button uk-button-primary uk-button-small" type="submit">Сохранить</button>
            </p>
        </form>
    </div>
</div>
<div id="modalAuth" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">Авторизация</h2>
        <form class="uk-form-stacked" action="/main/auth" method="post">
            <input type="hidden" name="task" value="add">
            <div class="uk-margin">
                <label class="uk-form-label uk-text-small" for="loginField">Логин</label>
                <div class="uk-form-controls">
                    <input required class="uk-input uk-form-small" name="login" id="loginField" type="text" placeholder="Логин">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label uk-text-small" for="psswdField">Пароль</label>
                <div class="uk-form-controls">
                    <input required class="uk-input uk-form-small" name="psswd" id="psswdField" type="password" placeholder="Пароль">
                </div>
            </div>
            <p class="uk-text-right">
                <a href="/" class="uk-link" type="button">Вернуться на главную</a>
                <button class="uk-button uk-button-primary uk-button-small" type="submit">Вход</button>
            </p>
        </form>
    </div>
</div>

<link rel="stylesheet" href="/css/uikit.min.css"/>
<script src="/js/uikit.min.js"></script>
<script src="/js/uikit-icons.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    <?php if (isset($data) && array_key_exists('dialog', $data)): ?>
    <?php if($data['dialog'] == 'confirm'): ?>
    UIkit.notification('<span uk-icon="icon: check"></span> Операция выполнена успешно!', {status: 'success'});
    <?php elseif($data['dialog'] == 'error'): ?>
    UIkit.notification('<span uk-icon="icon: warning"></span> Ошибка выполнения операции, попробуйте еще раз.', {status: 'warning'});
    <?php endif ?>
    <?php endif ?>
    <?php if (isset($data) && array_key_exists('auth', $data)): ?>
    UIkit.notification('<span uk-icon="icon: warning"></span> Ошибка аторизации! Не верно введен логин или пароль.', {status: 'warning'});
    <?php endif ?>
</script>
<script src="/js/script.js"></script>
</body>
</html>