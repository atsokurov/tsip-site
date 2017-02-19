<html>
	 <head>
		  <title>Платёжная система "ТохаБанк"</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<!-- Charset must be ISO-8859-1 -->
			<link rel="stylesheet" href="==CSS-SRC=="/>
			<script src="js/functions.js"></script>
			<script src="js/sql_functions.js"></script>
			<script src="js/jquery.min.js"></script>
	</head>
	<body>
		<div id="header">
			<a href="==SITE-INDEX-SRC==">
				<div id="header-logo">
					<img src="==HEADER-LOGO-SRC==" border=0>
				</div>
			</a>
			<div id="header-center">
				<span class="label">Платёжная система "ТохаБанк"</span>
			</div>
			<div id="header-login">
				<form class="header-form" action="==LOGIN-PAGE-SRC==" method="post">
					<span id="header-label">Учётная запись</span><br/>
					<input class="input" type="email" name="login_email" pattern="[a-zA-Z][a-zA-Z0-9.!/\_-]+@[a-zA-Z0-9_.-]+\.[a-zA-Z]+" title="Адрес электронной почты" placeholder="E-mail" required/><br/>
					<input class="input" type="password" name="login_password" pattern="[a-zA-Z][a-zA-Z0-9.!/\_@-]+" title="Пароль" placeholder="Пароль" required/></br>
					<input class="input button" type="submit" value="Войти"></br>
					<input class="input button" type="button" value="Регистрация" onclick="redirect('==REGISTRATION-PAGE-SRC==')">
				</form>
			</div>
		</div>
	</body>
<html>
