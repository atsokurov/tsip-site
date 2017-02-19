<?php
/*	Static errors dispatcher. */
class CrErrorDispatcher
{
	private $immediateErrorMessage = "FATAL ERROR: Error during dispatch error! Code of error is ERROR_CODE. Program halted.";
	/*	Get error message
	 *	@param string $errorMessage Error message
	 */
	public static function CatchError(string $errorMessage)
	{
		CrErrorDispatcher::RenderErrorDiv($errorMessage);
		CrErrorDispatcher::PutErrorInLog("site_errors", $errorMessage);
		CrErrorDispatcher::HaltProgram();
	}
	
	/* Render page with error div
	 * @param string $errorMessage Error message in div
	 */
	private static function RenderErrorDiv(string $errorMessage)
	{
		// Code of error is 1
		if ($errorMessage == null)
		{
			CrErrorDispatcher::HaltProgramImmediately(str_replace("ERROR_CODE", "1", $this->immediateErrorMessage));
		}
		$errorPage = new CrPage("base");
		if ($errorPage == null)
		{
			CrErrorDispatcher::HaltProgramImmediately(str_replace("ERROR_CODE", "2", $this->immediateErrorMessage));
		}
		
		$template = new CrTemplate("CrErrorDispatcher", "Error");
		if ($template == null)
		{
			CrErrorDispatcher::HaltProgramImmediately(str_replace("ERROR_CODE", "3", $this->immediateErrorMessage));
		}
		
		$errorPage->Render($template);
		$errorPage->RenderPage();
	}
	
	/* Puts error in error log
	 * @param string $file_name File name in base directory
	 * @param string $errorMessage Error message
	 */
	private static function PutErrorInLog(string $file_name, string $errorMessage)
	{
		$backtrace = debug_backtrace();
		$errorMessage = date("d M Y H:i:s O") . " $errorMessage \r\nStack trace: \r\n";
		$i = count($backtrace);
		foreach($backtrace as $b)	/* 'b' is abbreviation of 'bug' */
		{
			$errorMessage .= $i-- ."." .$b['file'] .":" .$b['line'];
			
			if (isset($b['class']))
			{
				$errorMessage .= " => " .$b['class'] .$b['type'] .$b['function'];
			}
			else if (isset($b['function']))
			{
				$errorMessage .= " " .$b['function'];
			}
			
			if (isset($b['args']))
			{
				$errorMessage .= "(";
				foreach ($b['args'] as $key=>$value)
				{
					$t = gettype($value);
					if ($t == "array" || $t == "object")
					{
						if ($t == "array") $errorMessage .= "[";
						else if ($t == "object") $errorMessage .= "{";
						
						foreach ($value as $ak=>$av)	/*	as ArrayKey => ArrayValue */
						{
							$errorMessage .= $ak ."=>" .$av ."; ";
						}
						
						if ($t == "array") $errorMessage .= "]";
						else if ($t == "object") $errorMessage .= "}";
					}
					else if ($t == null) 
					{
						$errorMessage .= "\"null\", ";
					}
					else 
					{
						$errorMessage .= "\"" .$value ."\"" .",";
					}
				}
				$errorMessage .= ") ";
			}
			
			if (isset($b['object']))
			{
				$errorMessage .= " class object: {";
				foreach($b['object'] as $key=>$value)
				{
					/*	Value may be string or null or empty */
					$errorMessage .= $key ."=>" .($value != null ? ($value != "" ? $value : "\"\"") : "null") .", ";
				}
				$errorMessage .= "}";
			}
			$errorMessage .= "\r\n";
		}
		
		$state = file_put_contents(BASE_PATH."{$file_name}.log", $errorMessage, FILE_APPEND | LOCK_EX);
		if ($state === false) 
		{
			CrErrorDispatcher::HaltProgramImmediately(str_replace("ERROR_CODE", "4", $this->immediateErrorMessage));
		}
	}
	
	/*	In case of error during dispatch program error
	 *	halt program immediately and show error message
	 *	@param string $errorMessage Error message
	 */
	private static function HaltProgramImmediately(stirng $errorMessage)
	{
		exit($errorMessage);
	}
	
	/*	Normal program halting */
	private static function HaltProgram()
	{
		exit();
	}
}
?>
