<?php
session_start();
if (isset($_SESSION['userName'])) session_destroy();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Авторизация</title>
</head>

<body>

<div class="container">
<div class="row vertical-offset-90">
<div class="col-md-4 col-md-offset-4">
<div class="panel panel-default">

<div class="panel-heading">
  <h4 class="panel-title">Вход</h4>
</div>
                
<div class="panel-body">
<fieldset class="panel-body">
<legend class="panel-title">Войти как гость:</legend>
<form accept-charset="UTF-8" class="form-horizontal" action="index.php" method="POST">
  <div class="form-group">
    <label class="control-label col-xs-3" for="userName">Имя:</label>
    <div class="col-xs-9">
      <input name="userName" type="text" class="form-control" id="userName" placeholder="Введите имя" required value="">
    </div>
  </div>
</fieldset>
 
<fieldset class="panel-body">
<legend class="panel-title">Авторизация:</legend>
  <div class="form-group" class="panel-body">
    <label class="control-label col-xs-3" for="login">Login:</label>
    <div class="col-xs-9">
      <input name="login" type="text" class="form-control" id="login" placeholder="Введите логин" value="">
    </div>
  </div>

  <div class="form-group" class="panel-body">
    <label class="control-label col-xs-3" for="password">Password:</label>
    <div class="col-xs-9" >
      <input name="password" type="password" class="form-control" id="password" placeholder="Введите пароль" value="">
    </div>
  </div>
</fieldset>
    
<div class="form-group" class="panel-body">
  <div class="col-xs-offset-3 col-xs-9">
      <input type="submit" class="btn btn-primary" value="Войти">
      <input type="reset" class="btn btn-default" value="Очистить форму">
  </div>
</div>

</div>

</div>
</div>
</div>
</div>
</form>
</body>
