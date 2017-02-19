<?php
/*	Initialize all components of site
*/

/*	Site config variables*/
// Disable internal errors to XML parser
libxml_use_internal_errors(true);
// Set encoding to utf-8
mb_internal_encoding("UTF-8");
header("Content-type: text/html; charset=utf-8");

/*	Set file path constants 
*/
$sep = DIRECTORY_SEPARATOR;
include_once(dirname(__FILE__) . "{$sep}config{$sep}MVCFilePaths.php");

/*	Core classes folder path */
$core_classes_path = "core{$sep}";
/*	Load core classes.
 * Firstly load this classes:
 * - CrPage
 * - CrTemplate
 * Then:
 * - CrErrorDispatcher, because of CrErrorDispather depends on first ones
 * 
 * Load others classes.
 */
include_once(MODEL_PATH . $core_classes_path . "CrPage.php");
include_once(MODEL_PATH . $core_classes_path . "CrTemplate.php");
include_once(MODEL_PATH . $core_classes_path . "CrErrorDispatcher.php");
include_once(MODEL_PATH . $core_classes_path . "CrDatabase.php");

/*	Load core interfaces and base classes */
/* Load interfaces */
include_once(MODEL_PATH . $core_classes_path . "ICrValidator.php");

/*	Modules folder path */
$modules_path = "modules" . $sep;

/* Load class for user specimens,
 * this is needed to work with users of site
 */
include_once(MODEL_PATH . "{$sep}User{$sep}User.php");

/*	Connect to database
*/
$db_obj = new CrDatabase();
$db = $db_obj->Connect();

session_start();

/*	 Global variables of file which using .php:
	 $db - Database connection object
	 $page - Main page
	 $user ­ User credentials (for logined user)
*/
$page = null;
$user = null;
/*	Render base part of site
*/
if (isset($_SESSION["User"]))
{
	$user = unserialize($_SESSION["User"]);
	
	$page = new CrPage("baseLogined", $user);
}
else
{
	$page = new CrPage("base");
}

?>
