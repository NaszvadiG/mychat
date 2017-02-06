<html>
<head>
<title><?php echo $title;?></title>

<link rel="stylesheet" type="text/css" href="/themes/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="/themes/site.css"/>

<script src="/themes/jquery/jquery-2.1.4.min.js"></script>
<script src="/themes/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top mynavbar">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" title="На главную" href="/">Chat</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><? echo anchor('/chat/about', 'О проекте') ?></li>
      </ul>
      <!--<form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Поиск..." />
        </div>
        <button type="submit" class="btn btn-default">Вперед!</button>
      </form>-->
      <ul class="nav navbar-nav navbar-right">
        <li><? if(isset($_COOKIE['user'])) echo anchor('/user/profile', $_COOKIE['user'], array('class' => 'cur_user', 'title' => 'Текущий пользователь')); ?></li>
        <li><? if(!isset($_COOKIE['user'])) echo anchor('/user/signin', 'Вход'); else echo anchor('/user/signout', 'Выйти'); ?></li>
        <li><? if(!isset($_COOKIE['user'])) echo anchor('/user/signup', 'Регистрация') ?></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>