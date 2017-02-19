<?php

$sep = DIRECTORY_SEPARATOR;

include_once(dirname(__FILE__) . $sep . "init.php");
include_once(MODEL_PATH . "User{$sep}BankAccount.php");

if (!isset($user))
{
	header("Location: index.php");
}

$bank_account = new BankAccount($db, $user->id);

foreach ($bank_account->GetUserCards($user->id) as $card)
{
	$template = new CrTemplate("User", "AccountItem");
	$bank_name = $bank_account->GetBankNameById($card["id_bank"]);
	$template->SetValue("==CARD-BANK-NAME==", $bank_name);
	$card_number = FormatCardNumber($card["number_card"]);
	$template->SetValue("==CARD-NUMBER==", $card_number);
	$card_validity_date = FormatValidityDate($card["month"], $card["year"]);
	$template->SetValue("==CARD-VALIDITY-DATE==", $card_validity_date);
	$template->SetValue("==CARD-TYPE==", $card["type_of_card"]);
	$template->SetValue("==CARD-HOLDER-NAME==", $card["name_on_card"]);
	$card_balance = $card["balance"] ." руб.";
	$template->SetValue("==CARD-BALANCE==", $card_balance);
	
	$page->Render($template);
}

/* Formats the validity date of card
 * @param string|integer $month Month of validity
 * @param string|integer $year Year of validity
 * @return string Formatted validity of date
 */
function FormatValidityDate($month, $year)
{
	$formatted = (isset($month[1]) ? ($month[0]. $month[1]) : ("0" . $month[0]));
	$formatted .= "/";
	$formatted .= $year[2] . $year[3];
	return $formatted;
}

/* Formats card number from integer to format: 1234 5678 9012 3456
 * @param string|integer $card_number Card number
 * @return string Formatted card number
 */
function FormatCardNumber($card_number)
{
	// Short alias
	$c = $card_number;
	$formatted = "{$c[0]}{$c[1]}{$c[2]}{$c[3]} ";
	$formatted .= "{$c[4]}{$c[5]}{$c[6]}{$c[7]} ";
	$formatted .= "{$c[8]}{$c[9]}{$c[10]}{$c[11]} ";
	$formatted .= "{$c[12]}{$c[13]}{$c[14]}{$c[15]}";
	return $formatted;
}

/* Render whole page*/
$page->RenderPage();
?>
