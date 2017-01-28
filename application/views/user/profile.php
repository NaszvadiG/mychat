
<div class="profile">
<? echo anchor('/user/edit', 'Редактировать профиль', array('class' => 'btn btn-default', 'id' => 'prof_edit')) ?>
<?php foreach($profile as $row):?>
    <p class="profile-term name">
    <? echo img(array('src' => '/themes/ava.jpg', 'class' => 'avatar'));
     echo $row->name.' '.$row->surname; ?></p>
    <p class="profile-term registered">
    <label>Дата регистрации</label> <?=nice_date($row->registered, 'd.m.Y');?></p>
    <p class="profile-term phone">
    <label>Телефон</label> <?=$row->phone;?></p>
    <p class="profile-term email">
    <label>Электронная почта</label> <?=$row->email;?></p>
    <p class="profile-term about">
    <label>Обо мне</label> <?=$row->about;?></p>
<?php endforeach;?>
</div>