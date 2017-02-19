<?php
$sep = DIRECTORY_SEPARATOR;

include_once(dirname(__FILE__) ."{$sep}init.php");

/* Error message must be set */
if (isset($_GET["error"]))
{
	CrErrorDispatcher::CatchError((string)$_GET["error"]);
}
/* Or just redirect user to index page */
else
{
	header("Location: index.php");
}

/*	Render whole page*/
$page->RenderPage();
?>
