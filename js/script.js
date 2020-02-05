window.onload = function() {

};
function editTask(elm) {

    let id = elm.dataset.id;
    console.log('editTask', id);

    let user = document.getElementById('col-' + id + '-user');
    let email = document.getElementById('col-' + id + '-email');
    let text = document.getElementById('col-' + id + '-text');

    userField.value = user.innerHTML;
    emailField.value = email.innerHTML;
    textField.textContent = text.innerHTML;

    titleModal.textContent = 'Редактирование задачи';
    methodTask.value = 'edit';
    formModal.setAttribute('action', location.href);
    taskId.value = id;
    statusField.value = elm.dataset.status;
    changeAdmin.value = elm.dataset.change;

}