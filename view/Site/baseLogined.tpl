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
					<img src="==HEADER-LOGO-SRC==">
				</div>
			</a>
			<div id="header-center">
				<span class="label">Платёжная система "ТохаБанк"</span>
			</div>
			<div id="header-login">
				<form class="header-form" action="#" method="post">
					<span id="header-hello">Здравствуйте, ==USER-NAME==</span><br/>
					<input class="input button" type="button" value="Личный кабинет" onclick="redirect('==USER-PAGE-SRC==')">
					<input class="input button" type="button" value="Выйти" onclick="redirect('==LOGOUT-PAGE-SRC==')"></br>
				</form>
			</div>
		</div>
	</body>
<html>
