<?php
/* POST array validation */
class POSTValidator implements ICrValidator
{
	/* Checks if value is set inside POST array 
	 * @param array $params Parameters which is needed to validate
	 */
	public static function Validate($params)
	{	
		reset($params);
		while ($param_name = next($params))
		{
			if (!isset($_POST[$param_name]))
			{
				CrErrorDispatcher::CatchError("register controller: \$_POST[{$param_name}] isn't set");
			}
		}
	}
}
?>
