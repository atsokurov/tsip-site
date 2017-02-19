<?php
$sep = DIRECTORY_SEPARATOR;

include_once(dirname(__FILE__) ."{$sep}init.php");

include_once(MODEL_PATH . "{$sep}Auth{$sep}Authentication.php");

/*	Logout if user credentials are set
*/
$auth = new Authentication();
$auth->db = $db;
$auth->user = $user;

/* Reset login credentials if user is logined */
if ($auth->Logout())
{
	$page->Render(new CrTemplate("Authentication", "LogoutSuccess"));
}
else
{
	$page->Render(new CrTemplate("Authentication", "LogoutError"));
}

/*	Render whole page*/
$page->RenderPage();
?>
