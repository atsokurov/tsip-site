<?php
/*	Define model, view and controller site paths
*/
$site_path = dirname(__FILE__, 2);	// Local site path
$sep = DIRECTORY_SEPARATOR;			// Alias of long name of directory separator

define("SEP", DIRECTORY_SEPARATOR);
define("MODEL_PATH", $site_path . $sep . 'model' . $sep);
define("VIEW_PATH", $site_path . $sep . 'view' . $sep);
define("CONTROLLER_PATH", $site_path . $sep . 'controller' . $sep);
define("BASE_PATH", $site_path . $sep);

?>
