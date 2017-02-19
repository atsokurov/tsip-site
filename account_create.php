<?php

$sep = DIRECTORY_SEPARATOR;

include_once(dirname(__FILE__) . $sep . "init.php");
// BankAccount class
include_once(MODEL_PATH . "User{$sep}BankAccount.php");

if (isset($_POST["card_holder_name"]))
{
	$account = new BankAccount($db, $user->id);
	if ($account->Register($_POST["card_holder_name"], $_POST["card_type"], $_POST["banks"]))
	{
		header("Location: accounts.php");
	}
}

$template = new CrTemplate("User", "AccountCreate");
$page->Render($template);

/* Render whole page*/
$page->RenderPage();
?>
