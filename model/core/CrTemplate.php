<?php
/*	HTML Templator.
 * Simple HTML templator for rendering HTML templates with format .tpl
 */
class CrTemplate
{
	/*	HTML of template */
	public $html;
	
	/*	Get HTML from file VIEW_PATH/class_name/file_name.tpl
	 * @param string $class_name Class name, represents folder with all class templates
	 * @param string $file_name File name, represents template file name
	 */
	public function __construct(string $class_name, string $file_name)
	{
		$sep = DIRECTORY_SEPARATOR;	// just alias
		$fileDirectory = VIEW_PATH . "{$class_name}{$sep}{$file_name}.tpl";
		if (!file_exists($fileDirectory))
		{
			CrErrorDispatcher::CatchError("Template file '{$fileDirectory}' doesn't exist");
		}
		$this->html = file_get_contents($fileDirectory);
		if ($this->html == null)
		{
			CrErrorDispatcher::CatchError("Couldn't get content of template file '{$fileDirectory}'(maybe access rules not set)");
		}
	}
	
	/*	Set value in template.
	 * Name and value can be arrays, 
	 * then their elements are processed first to last.
	 * @param string|array $name Name of property or properties
	 * @param string|array $value Value of property or properties
	 */
	public function SetValue($name, $value)
	{
		$type = '';
		if (($type = gettype($name)) != 'string' && $type != 'array')
		{
		  CrErrorDispatcher::CatchError(get_class()."::SetValue: {$name} isn't an instance of type 'string' or 'array'");
		}
		if (($type = gettype($value)) != 'string' && $type != 'array')
		{
		  CrErrorDispatcher::CatchError(get_class()."::SetValue: Value isn't an instance of type 'string' or 'array'");
		}
		unset($type);
		
		$this->html = str_replace($name, $value, $this->html);
	}
	
	/*
	 * "a quick and dirty solution 
	 * to stop mb_convert_encoding from filling your string 
	 * with question marks whenever it encounters an illegal 
	 * character for the target encoding"
	 * (http://php.net/manual/ru/function.mb-convert-encoding.php#86878)
	 * @param string $source Unconverted string
	 * @param string $target_encoding Target encoding for mb_convert_encoding
	 * @return string $target Converted string
	 */
	private function SafeConvertEncoding(string $source, string $target_encoding)
	{
		// detect the character encoding of the incoming file
		$encoding = mb_detect_encoding( $source, "auto" );
       
		// escape all of the question marks so we can remove artifacts from
		// the unicode conversion process
		$target = str_replace( "?", "[question_mark]", $source );
       
		// convert the string to the target encoding
		$target = mb_convert_encoding( $target, $target_encoding, $encoding);
       
		// remove any question marks that have been introduced because of illegal characters
		$target = str_replace( "?", "", $target );
       
		// replace the token string "[question_mark]" with the symbol "?"
		$target = str_replace( "[question_mark]", "?", $target );
		
		if ($target == null)
		{
			CrErrorDispatcher::CatchError("4e-to IIu3dets KaKoi-To");
		}
		if ($target == null)
		{
			CrErrorDispatcher::CatchError("Couldn't safely convert string in templator");
		}
		return $target;
	}
}
?>
