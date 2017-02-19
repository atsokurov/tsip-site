<?php
/*	REST API for site */

/*	Set file path constants 
*/
$sep = DIRECTORY_SEPARATOR;
include_once(dirname(__FILE__) . "{$sep}config{$sep}MVCFilePaths.php");

/*	Core classes folder path */
$core_classes_path = "core{$sep}";

/*	All core modules are included only once */
include_once(MODEL_PATH . $core_classes_path . "CrPage.php");
include_once(MODEL_PATH . $core_classes_path . "CrTemplate.php");
include_once(MODEL_PATH . $core_classes_path . "CrErrorDispatcher.php");
include_once(MODEL_PATH . $core_classes_path . "CrDatabase.php");

$db_obj = new CrDatabase();
$db = $db_obj->Connect();

/*	POST must receive an 'info' mark */
if (!isset($_POST["rest_info"])) 
{
	SendMessage(["error" => "No info mark for REST API, expected info mark"]);
}

$error = ["error" => "Invalid POST data"];

/* REST Service Information:
 * SELECT,
 * UPDATE,
 * DELETE
 * queries
 */
switch ($_POST["rest_info"])
{
	case "select_bank_names":
		SendMessage(SelectBankNamesAndIDs($db));
		break;
}


/* Select array of bank names and IDs
 * @param PDO $db Database specimen
 * @return array Associative array of bank names and IDs
 */
function SelectBankNamesAndIDs(PDO $db)
{
	$stmt = $db->prepare("SELECT id_bank, name FROM bank");
	
	return ExecutePDOStatement($stmt, "all");
}

/* Validate parameter on null and emptiness 
 * @return bool|array true if validation is successful
 * or array with error if validation is unsuccessful
 */
function ValidateParam($param)
{
	if (!isset($param))
	{
		return ["error" => "{$param} not set, expected string"];
	}
	else if ($param == "")
	{
		return ["error" => "{$param} is empty, expected not empty string"];
	}
	return true;
}

/* Executes PDO statement 
 * and returns the result of execution or error array
 * or null if the result of execution isn't needed
 * @param PDOStatement $stmt PDO statement
 * @param string $fetchMode What to fetch: one element, all or nothing
 * @return array|string|integer|null Needed result of execution
 */
function ExecutePDOStatement(PDOStatement $stmt, string $fetchMode = "none")
{
	try
	{
		$stmt->execute();
	}
	catch (PDOException $e)
	{
		return ["error" => $stmt->errorInfo()[2]];
	}
	
	switch ($fetchMode)
	{
		case "all":
			return $stmt->fetchAll();
		case "one":
			return $stmt->fetch();
		case "none":
		default:
			return null;
	}
}

/**
 * Sends(echoes) JSON encoded message to output
 * @param string|array Encoded message 
 */
function SendMessage($message)
{
	echo json_encode($message, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

?>
