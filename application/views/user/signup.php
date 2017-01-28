<?
    echo form_open('/user/signup', array('class' => 'form', 'method' => 'post'));
    echo form_input(array('name' => 'login', 'class' => 'form-control', 'placeholder' => 'Введите ваше имя..', 'value' => set_value('login'))).br(1);
    echo form_password(array('name' => 'pass', 'class' => 'form-control', 'placeholder' => 'Введите ваш пароль..')).br(1);
    echo form_password(array('name' => 'passconf', 'class' => 'form-control', 'placeholder' => 'Подтвердите ваш пароль..')).br(1);
    echo form_submit(array('class' => 'btn btn-primary'),'Зарегистрироваться');
    echo form_close();
    echo '<div id="form-messages">';
    if(isset($message)){
        if($mes_type == 'error') $type = 'alert-danger'; else $type = 'alert-success';
        echo '
        <div class="alert '.$type.' alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
          <strong>'.$message.'</strong>
        </div>';
    }
    echo validation_errors();
    echo '</div>';
?>