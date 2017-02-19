<?php
/*	Authentication class.*/
class Authentication
{
	/* @param PDO $db PDO specimen */
	public $db;
	/* @param User $user User specimen */
	public $user;
	
	/* Check if a user with received e-mail is exists in DB 
	 * @param string $email E-mail of user
	 * @return boolean true if user exists or false in other case
	 */
	public function UserExists(string $email)
	{
		if ($email == null)
		{
			CrErrorDispatcher::CatchError(get_class() ."::UserExists: E-mail is null");
		}
		if ($email == "")
		{
			CrErrorDispatcher::CatchError(get_class() ."::UserExists: E-mail is empty");
		}
		if ($this->db == null)
		{
			CrErrorDispatcher::CatchError(get_class() ."::UserExists: Database connector specimen is null");
		}
		
		$sql = $this->db->prepare('SELECT * FROM client WHERE email=:email');
		$sql->bindParam(':email', $email);
		$sql->execute();
		
		if ($sql->rowCount() != 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/* Login on page if user credentials are set on header 
	 * and "Enter" button is pressed
	 * @return boolean|null true if login is OK 
	 * or null if credentials isn't set or empty (i.e. user don't want to login)
	 */
	public function Login()
	{
		if ($this->db == null)
		{
			CrErrorDispatcher::CatchError(get_class() ."::Login: Database specimen is null");
		}
		if ($this->user == null)
		{
			CrErrorDispatcher::CatchError(get_class() ."::Login: User specimen is null");
		}
		/* User credentials may be already set in session */
		if (isset($_SESSION["User"]))
		{
			$this->user = unserialize($_SESSION["User"]);
			return true;
		}
		
		/* User credentials must be set */
		if (!(isset($_POST["login_email"]) && isset($_POST["login_password"]))) 
		{
			return false;
		}
		
		/* ... and not be empty */
		if (!($_POST["login_email"] != "" && $_POST["login_password"] != ""))
		{
			return false;
		}
		
		/* User must exist in DB */
		if ($this->UserExists($_POST["login_email"]))
		{
			/* User password must be compared with password hash in DB */
			if ($this->ComparePassword($_POST["login_email"], $_POST["login_password"]))
			{
				$this->SetUserCredentials($_POST["login_email"]);
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	/* Logout user if user is logined */
	public function Logout()
	{
		if (isset($_SESSION["User"]))
		{
			unset($_SESSION["User"]);
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/* Set user credentials by e-mail
	 * @param string $email E-mail of user
	 * @return User|null User specimen or null
	 */
	public function GetUserCredentials(string $email)
	{
		if ($this->db == null)
		{
			CrErrorDispatcher::CatchError(get_class() ."::Login: Database specimen is null");
		}
		if ($this->user == null)
		{
			CrErrorDispatcher::CatchError(get_class() ."::Login: User specimen is null");
		}
		
		$this->SetUserCredentials($email);
		
		return $this->user;
	}
	
	/* Set user credentials by e-mail
	 * @param string $email E-mail of user
	 */
	private function SetUserCredentials(string $email)
	{
		$stmt = $this->db->prepare("SELECT * FROM client WHERE email=:email");
		$stmt->bindParam(":email", $email);
		$stmt->execute();
		
		/* Abbreviation from 'credentials' */
		$cr = $stmt->fetchAll(PDO::FETCH_OBJ);
		$cr = $cr[0];
		
		$this->user->id = $cr->id_client;
		$this->user->email = $cr->email;
		
		$this->user->name = $cr->name;
		$this->user->surname = $cr->surname;
		$this->user->patronymic = $cr->patronymic;
		
		$this->user->number_of_passport = $cr->pasport_number;
		$this->user->series_of_passport = $cr->pasport_seria;
	}
	
	/* Hash password 
	 * @param string $password Password
	 * @return string Hashed password
	 */
	private function HashPassword(string $password)
	{
		/* Create a random salt */
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		
		/*	"$2a$" means the Blowfish algorithm,
		 *	the following two digits are the cost parameter.
		 */
		$salt = sprintf("$2a$%02d$", 10) . $salt;
		
		return crypt($password, $salt);
	}
	
	/* Compare user password 
	 * @param string $email E-mail of user
	 * @param string $password Password of user
	 * @return boolean true if password is
	 */
	private function ComparePassword(string $email, string $expectedPassword)
	{
		$stmt = $this->db->prepare('SELECT password FROM client WHERE email=:email LIMIT 1');
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		
		$user = $stmt->fetch(PDO::FETCH_OBJ);
		
		if (hash_equals($user->password, crypt($expectedPassword, $user->password))) {
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>
