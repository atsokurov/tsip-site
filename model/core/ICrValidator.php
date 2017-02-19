<?php
/* Interface for validator */
interface ICrValidator
{
	/* Base validation. 
	 * @param array|object|string|integer Item(s) to validate
	 */
	public static function Validate($params);
}
?>
