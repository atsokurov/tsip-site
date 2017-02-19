<?php
$sep = DIRECTORY_SEPARATOR;

include_once(dirname(__FILE__) ."{$sep}init.php");

include_once(MODEL_PATH . "{$sep}Auth{$sep}Authentication.php");

/* If user isn't logined -- 
 * -- redirect unauthorized user to index page
 */
if (!isset($user))
{
	header("Location: index.php");
}

if (isset($_GET["change"]) && $_GET["change"] == "credentials")
{
	$auth = new Authentication();
	$auth->db = $db;
	$auth->user = $user;
	
	$user = $auth->GetUserCredentials($user->email);
	if ($user == null)
	{
		CrErrorDispatcher::CatchError("userpage: Get user credentials error");
	}
	
	$_SESSION["User"] = serialize($user);
}

$userpage = new CrTemplate("User", "UserPage");
$userpage->SetValue("==USER-CREDENTIALS==", $user->surname ." " .$user->name ." " .$user->patronymic);
$userpage->SetValue("==USER-SERIES-OF-PASSPORT==", $user->series_of_passport);
$userpage->SetValue("==USER-NUMBER-OF-PASSPORT==", $user->number_of_passport);
$userpage->SetValue("==USER-EMAIL==", $user->email);
$amount = GetBankAccountAmount($db, $user->id);
$userpage->SetValue("==BANK-ACCOUNT-AMOUNT==", $amount);
if ($amount > 0) {
	$userpage->SetValue("==BANK-ACCOUNT-INFORMATION-LINK==", "<a href=\"accounts.php\">Зарегистрированные карты</a></br>");
} else {
	$userpage->SetValue("==BANK-ACCOUNT-INFORMATION-LINK==", "");
}
$userpage->SetValue("==BANK-ACCOUNT-CREATE==", "account_create.php");

$page->Render($userpage);

/* Get amount of bank accounts of user
 * @param PDO $db Database specimen
 * @param string|integer $id_user User ID
 * @return integer|null Amount of bank accounts of user
 */
function GetBankAccountAmount(PDO $db, $id_user)
{
	$stmt = $db->prepare("SELECT COUNT(id_card) FROM card WHERE id_client=:id_user");
	$stmt->bindParam(":id_user", $id_user);
	$stmt->execute();
	
	return $stmt->fetch()["COUNT(id_card)"];
}

/*	Render whole page*/
$page->RenderPage();
?>
