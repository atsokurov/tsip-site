<?php
/*	PageView. 
	Keeps HTML code of visited page, 
	renders templates 
	and renders the HTML code of visited page a whole site page.
*/
class CrPage
{
	/* @param string $html HTML of page */
	private $html;
	/* @param DOMDocument $dom DOM of page */
	private $dom;
	/* @param User|null $user Logined user(if he's logined) */
	private $user;
	
	/*	Sets page base template
	 *	@param string $base Base template of page, default site template is 'base'
	 */
	public function __construct(string $file_name = "base", User $user = null)
	{
		$site_base = new CrTemplate("Site", $file_name);
		$site_base->SetValue("==SITE-INDEX-SRC==", "");
		$site_base->SetValue("==CSS-SRC==", "css/styles.css");
		$site_base->SetValue("==HEADER-LOGO-SRC==", "img/Header-Logo.jpg");
		$site_base->SetValue("==REGISTRATION-PAGE-SRC==", "register.php");
		$site_base->SetValue("==LOGIN-PAGE-SRC==", "login.php");
		$site_base->SetValue("==LOGOUT-PAGE-SRC==", "logout.php");
		if ($file_name == "baseLogined")
		{
			if ($user == null)
			{
				CrErrorDispatcher::CatchError(get_class() ."::__construct: User specimen is null, but expected object specimen for render base part of site for logined user");
			}
			$username = $user->surname ." " .$user->name ." " .$user->patronymic;
			$site_base->SetValue("==USER-NAME==", $username);
			$this->user = $user;
		}
		$site_base->SetValue("==USER-PAGE-SRC==", "userpage.php");
	   
		$this->html = $site_base->html;
		if ($this->html == null)
		{
			CrErrorDispatcher::CatchError(get_class()." loading of base part of site failed");
		}
		$this->SetDOM();
	}
	
	/*	Inserts template into div#content of base page
	 *	@param CrTemplate $template Template
	 */
	public function Render(CrTemplate $template)
	{
		if ($template == null || $template->html == null)
		{
			CrErrorDispatcher::CatchError("Assigned template is null in " . get_class() . "::" . debug_backtrace()[1]['function']);
		}
		
		$tempDoc = new DOMDocument();
		$tempDoc->loadHTML('<div id="html-wrapper">' .$template->html ."</div>");
		if ($tempDoc == null)
		{
			CrErrorDispatcher::CatchError(get_class() .": Creating temporary document error");
		}
		foreach ($tempDoc->getElementById('html-wrapper')->childNodes as $node) 
		{
			$node = $this->dom->importNode($node, true);
			$this->dom->appendChild($node);
		}
	}
	
	/*	Renders whole page
	*/
	public function RenderPage()
	{
		$footer = new CrTemplate("Site", "base-footer");
		$this->Render($footer);
		echo $this->dom->saveHTML();
	}
	
	/*	Sets DOM of document
	*/
	private function SetDOM()
	{
		$this->dom = new DOMDocument();
		$this->dom->loadHTML($this->html);
		if ($this->dom == null)
		{
			CrErrorDispatcher::CatchError("DOMDocument isn't loaded");
		}
	}
}
?>
