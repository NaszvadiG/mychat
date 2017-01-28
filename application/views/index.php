<?
    if(isset($_COOKIE['user']))
    {?>
        
        <div class="wrapper">
        <?  echo heading($heading, 4);
            echo validation_errors();
            echo form_open('/', array('method' => 'post'));
            echo form_textarea(array('name' => 'message', 'class' => 'form-control', 'id' => 'message_text', 'placeholder' => 'Введите ваше сообщение..')).br(1);
            echo form_submit(array('class' => 'btn btn-primary'),'Отправить');
            echo form_close();
        
        ?>
        <table class="table">
            <tbody>
            <?php foreach($query as $row):?>
            <tr>
            <td class="message <? if($row->user == $_COOKIE['user']) echo 'mymess' ?>">
                <? echo img(array('src' => '/themes/ava.jpg', 'class' => 'avatar small-avatar')); ?>
                <div class="user"><?=$row->user;?></div>
                <div class="datetime"><?=nice_date($row->date, 'd-m-Y');?> <?=nice_date($row->time, 'H:i');?></div>
                <div class="text"><?=$row->message;?></div>
            </td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        </div>  
    <?}
    else{
        echo '<div class="unauth">Уважаемый пользователь, для пользования сайтом Вам необходимо'.br(1).
        anchor('/user/signin', 'Войти', array('class' => 'btn btn-primary')).' или '.anchor('/user/signup', 'Зарегистрироваться', array('class' => 'btn btn-primary')).'</div>';
    }
?>

