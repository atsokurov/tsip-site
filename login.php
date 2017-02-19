<?php
$sep = DIRECTORY_SEPARATOR;

include_once(dirname(__FILE__) ."{$sep}init.php");

include_once(MODEL_PATH . "{$sep}Auth{$sep}Authentication.php");

/*	Login if user credentials are set
	and password is equal to hashed password in DB
*/
$user = new User();

$auth = new Authentication();
$auth->db = $db;
$auth->user = $user;

/* Reset login credentials if user is logined */
if ($auth->Login())
{
	unset($_POST["login_email"]);
	unset($_POST["login_password"]);
	
	$user = $auth->user;
	$_SESSION["User"] = serialize($user);
	
	$page->Render(new CrTemplate("Authentication", "LoginSuccess"));
}
else
{
	$page->Render(new CrTemplate("Authentication", "LoginError"));
}

/*	Render whole page*/
$page->RenderPage();
?>
