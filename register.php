<?php
$sep = DIRECTORY_SEPARATOR;

include_once(dirname(__FILE__) ."{$sep}init.php");

include_once(MODEL_PATH . "{$sep}Auth{$sep}Registration.php");
include_once(MODEL_PATH . "{$sep}Auth{$sep}Authentication.php");
include_once(MODEL_PATH . "{$sep}Validator{$sep}POST.php");

$auth = new Authentication();
$auth->db = $db;
$register = new Registration();
$register->db = $db;

/* Already logined user can't register himself twice */
if (isset($_POST["email"])
	&& isset($user)
)
{
	header("Location: index.php");
}
	
/* User with registration email must not exist on site */
if (isset($_POST["email"]) 
	&& ($auth->UserExists($_POST["email"])	
	|| isset($_SESSION["User"]))
)
{
	$page->Render($register->GetUserExistsTemplate());
}

/* Email must be sent
 * if registration form has been submitted */
else if (isset($_POST["email"]))
{
	/* And must not be null */
	if ($_POST["email"] == null)
	{
		CrErrorDispatcher::CatchError("register: Email is null");
	}
	
	/* Validate registration parameters 
	 * if registration form is sent */
	POSTValidator::Validate(["email", "password", "repeat_password"]);
	POSTValidator::Validate(["name", "surname", "patronymic",]);
	POSTValidator::Validate(["series_of_passport", "number_of_passport"]);
	
	$user = new User();
	$user->email = $_POST["email"];
	$user->password = $_POST["password"];
	
	$user->name = $_POST["name"];
	$user->surname = $_POST["surname"];
	$user->patronymic = $_POST["patronymic"];
	
	$user->series_of_passport = $_POST["series_of_passport"];
	$user->number_of_passport = $_POST["number_of_passport"];
	
	$register->user = $user;
	
	/* If registration completed -
	 * - redirect user to index page */
	if ($register->Register())
	{
		$page->Render($register->GetSuccessTemplate());
	}
}
else
{
	$page->Render($register->GetTemplate());
}

/*	Render whole page*/
$page->RenderPage();
?>
