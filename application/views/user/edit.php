<div class="profile">
<?
foreach($profile as $row){
    echo img(array('src' => '/themes/ava.jpg', 'class' => 'avatar'));
    
    echo form_open('/user/edit', array('class' => 'form', 'method' => 'post'));
    echo form_label('Имя', 'name');
    echo form_input(array('name' => 'name', 'class' => 'form-control', 'placeholder' => 'Введите ваше имя..', 'value' => set_value('name', $row->name))).br(1);
    echo form_label('Фамилия', 'surname');
    echo form_input(array('name' => 'surname', 'class' => 'form-control', 'placeholder' => 'Введите вашу фамилию..', 'value' => set_value('surname', $row->surname))).br(1);
    echo form_label('Электронная почта', 'email');
    echo form_input(array('name' => 'email', 'class' => 'form-control', 'placeholder' => 'Введите вашу электронную почту..', 'value' => set_value('email', $row->email))).br(1);
    echo form_label('Телефон', 'phone');
    echo form_input(array('name' => 'phone', 'class' => 'form-control', 'placeholder' => 'Введите ваш номер телефона..', 'value' => set_value('phone', $row->phone))).br(1);
    echo form_label('Обо мне', 'about');
    echo form_textarea(array('name' => 'about', 'class' => 'form-control', 'placeholder' => 'Введите информацию о себе..', 'value' => set_value('about', $row->about))).br(1);
    echo form_submit(array('class' => 'btn btn-primary'), 'Сохранить');
    if(isset($message)){
        echo '
        <div id="form-messages"><div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
          <strong>'.$message.'</strong>
        </div></div>';
    }
    echo form_close();
}
?>
</div>