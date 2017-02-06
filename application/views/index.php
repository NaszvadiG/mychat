<?
    if(isset($_COOKIE['user']))
    {?>
        <script>
        $(document).ready(function(){
            $('#12345').hover(fucntion(){
                $(this).tooltip('show');
            });
        });
            
        </script>
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
            <td class="message<? if($row->user == $_COOKIE['user']) echo ' mymess' ?>">
                <div class="media">
                  <div class="media-left media-middle">
                    <a href="#">
                        <? echo img(array('src' => 'themes/ava.jpg', 'class' => 'avatar small-avatar media-object')); ?>
                    </a>
                  </div>
                  <div class="media-body">
                    <div class="user"><?=$row->user;?></div>
                    <div class="datetime"><?=nice_date($row->date, 'd-m-Y');?> <?=nice_date($row->time, 'H:i');?></div>
                    <div class="text"><?=$row->message;?></div>                  
                  </div>
                </div>
            </td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <!--<button type="button" class="btn btn-default" aria-label="Left Align">
          <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </button>
        <a href="#" id="12345" data-toggle="tooltip" title="Some tooltip text!">Hover over me</a>-->

        <!-- Generated markup by the plugin -->
        <!--<div class="tooltip top" role="tooltip">
          <div class="tooltip-arrow"></div>
          <div class="tooltip-inner">
            Some tooltip text!
          </div>
        </div>
        </div>-->
    <?}
    else{
        echo '<div class="unauth">Уважаемый пользователь, для пользования сайтом Вам необходимо'.br(1).
        anchor('/user/signin', 'Войти', array('class' => 'btn btn-primary')).' или '.anchor('/user/signup', 'Зарегистрироваться', array('class' => 'btn btn-primary')).'</div>';
    }
?>

