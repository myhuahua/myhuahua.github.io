<?php 

 function login(){
if(!isset($_POST['username']) || trim($_POST['username']) ==''){

    $GLOBALS['error']='请输入用户名';
    return;
}
if(!isset($_POST['password']) || trim($_POST['password']) ==''){

    $GLOBALS['error']='请输入密码';
    return;

 }
 $userName= $_POST['username'];
 $userPwd = $_POST['password'];

 $str = file_get_contents('./users.json');
 $arr = json_decode($str,true);

 foreach($arr as $key => $value){
     if($value['username'] == $userName){
       $user = $value;
       break;
     }
 }
 if(!isset($user)){
  $GLOBALS['error']='用户名不存在';
  return;
 }
 if($user['password'] != $userPwd){
  $GLOBALS['error']='密码错误';
  return;
 }
 setcookie("isLogin",true);

 header('location:./main.php');
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    login();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>登录</title>
  <link rel="stylesheet" href="bootstrap.css">
  <style>
    body {
      background-color: #f8f9fb;
    }

    .login-form {
      width: 360px;
      margin: 100px auto;
      padding: 30px 20px;
      background-color: #fff;
      border: 1px solid #eee;
    }

    .login-form h1 {
      font-size: 30px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <h1>登录</h1>   
    <!-- 下面的错误提示信息结构 需要在有错误信息的时候进行显示 -->
    <?php
      if(isset($GLOBALS["error"])){ ?>
        <div class="alert alert-danger" role="alert"><?php echo $GLOBALS["error"]; ?></div>
      <?php }
    ?>
    <div class="form-group">
      <label for="username">用户名</label>
      <input type="text" class="form-control" id="username" name="username"">
    </div>
    <div class="form-group">
      <label for="password">密码</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary btn-block">登录</button>
  </form>
</body>
</html>