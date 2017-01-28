<?
    echo form_open('/user/signin', array('class' => 'form', 'method' => 'post'));
    echo form_input(array('name' => 'login', 'class' => 'form-control', 'placeholder' => 'Введите ваше имя..', 'value' => set_value('login'))).br(1);
    echo form_password(array('name' => 'pass', 'class' => 'form-control', 'placeholder' => 'Введите ваш пароль..')).br(1);
    echo form_submit(array('class' => 'btn btn-primary'),'Войти');
    echo form_close();
    echo '<div id="form-messages">';
    if(isset($message)){
        echo '
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
          <strong>'.$message.'</strong>
        </div>';
    }
    echo validation_errors();
    echo '</div>';
?>