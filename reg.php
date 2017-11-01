<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录页面</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<form class="form-inline" method="post" action ='doLogin.php'>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail3">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
  </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputPassword3">verifyCode</label>
    <input type="password" name="verifycode" class="form-control" id="exampleInputPassword3" placeholder="verifyCode">
  </div>
  <div class="form-group">
  	<img src="testCaptcha.php"/>
  </div>
  <button type="submit" class="btn btn-default">Sign in</button>
</form>
	
</body>
</html>