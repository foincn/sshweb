<html>
<head>
   <title>401 Authorization Required</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <style type="text/css">
html, body {
   background: #0b1933;
   text-align: center;
}
body {
   font: 80% Tahoma;
}
#wrapper {
   margin: 100px auto;
   width: 500px;
   text-align: left;
   background: #fff;
   padding: 10px;
   border: 5px solid #ccc;
}
form { 
   margin: 5px;
   background: #eee;
   padding: 5px;
}
label {
   display: block;
}
   </style>
   <base href="<?php echo GLYPE_URL; ?>/">
</head>
<body>
   <div id="wrapper">
      <h1>需要授权</h1>
      <p>站点 <strong><?php echo $site; ?></strong> 需要用户名、密码来访问。"<strong><?php echo $realm; ?></strong>".</p>
      <form action="includes/process.php?action=authenticate" method="post">
         <label for="user">用户名:</label>
         <input type="text" name="user" id="user">
         <label for="pass">密码:</label>
         <input type="password" name="pass" id="pass">
         <input type="submit" value="登陆">
         
         <input type="hidden" name="site" value="<?php echo $site; ?>">
         <input type="hidden" name="return" value="<?php echo $return; ?>">
      </form>      
   </div>
</body>
</html>