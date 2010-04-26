<html>
<head>
	<title>安全警告</title>
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
   text-align: center;
}
	</style>
   <base href="<?php echo GLYPE_URL; ?>/">
</head>
<body>
	<div id="wrapper">
		<h1>警告!</h1>
		<p>你试图访问的站点需要安全连接。然而这个代理不是安全连接。</p>
      <p>目标站点可能会发送敏感信息，当代理服务器再发送给你时可能会被第三方截取。</p>
      <form action="includes/process.php" method="get">
         <input type="hidden" name="action" value="sslagree">
			<input type="submit" value="仍然继续…">
         <input type="button" value="返回首页" onclick="window.location='.';">
		</form>
      <p><b>注:</b>这个警告不会再次出现。</p>
	</div>
</body>
</html>