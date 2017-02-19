<?php
/* Registration class. */
class Registration
{
	/*	@param CrTemplate $template Template of registration */
	public $template; 
	/* @param User $user User to register */
	public $user;
	/* @param integer $hic_id Health insurance company identifier */
	public $hic_id;
	/* @param PDO $db Database connection specimen */
	public $db;
	
	/* Get template of registration page */
	public function GetTemplate()
	{
		return $this->template = new CrTemplate(get_class(), "RegistrationForm");
	}
	
	/* Get template of successful registration */
	public function GetSuccessTemplate()
	{
		return new CrTemplate(get_class(), "RegistrationSuccess");
	}
	
	/* Get template of entering email 
	 * of existing user during registration */
	public function GetUserExistsTemplate()
	{
		return new CrTemplate(get_class(), "UserExists");
	}
	
	/* Registrate user on site
	 * @return boolean true if registration completed successfully
	 */
	public function Register()
	{
		if ($this->user == null)
		{
			CrErrorDispatcher::CatchError((string)get_class() ."::Register: User specimen is null (maybe he's just forgotten to set?)");
		}
		if ($this->db == null)
		{
			CrErrorDispatcher::CatchError((string)get_class() ."::Registration: Database specimen isn't set");
		}
		
		/* Individual */
		$stmt = $this->db->prepare("INSERT INTO client(name, surname, patronymic, pasport_seria, pasport_number, email, password) VALUES (:name, :surname, :patronymic, :series_of_passport, :number_of_passport, :email, :password)");
		$stmt->bindParam(":name", $this->user->name);
		$stmt->bindParam(":surname", $this->user->surname);
		$stmt->bindParam(":patronymic", $this->user->patronymic);
		$stmt->bindParam(":series_of_passport", $this->user->series_of_passport);
		$stmt->bindParam(":number_of_passport", $this->user->number_of_passport);
		$stmt->bindParam(":email", $this->user->email);
		$hashedPassword = $this->HashPassword($this->user->password);
		$stmt->bindParam(":password", $hashedPassword);
		
		$stmt->execute();
		if ($stmt->errorCode() != 0)
		{
			CrErrorDispatcher::CatchError((string)get_class() ."::Register: Insert into 'individual' error. Here is the error message of SQL: " .$stmt->errorInfo()[2]);
		}
		
		return true;
	}
	
	/* Generate health bank account 
	 * @return integer Unique bank account
	 */
	public function GenerateBankAccount()
	{
		/* Existing bank account */
		$bank_account = "";
		
		do
		{
			$bank_account = $this->BankAccountGenerator();
		}
		while ($this->CheckBankAccountInDB($bank_account) == 0);
		
		return $bank_account;
	}
	
	/* Sending request to check 
	 * if generated bank account is already set to someone
	 * @param integer | string $bank_account Policy number of user
	 * @return integer Count of bank accounts which are equal to $bank_account
	 */
	private function CheckBankAccountInDB($card_number)
	{
		if (!is_string($card_number) || !is_integer($card_number))
		{
			CrErrorDispatcher::CatchError(get_class() ."::CheckBankAccountInDB: Card number is not of type string or integer");
		}	
		/* Check link to DB specimen */
		if ($this->db == null)
		{
			CrErrorDispatcher::CatchError(get_class() ."::GenerateBankAccount: Database specimen is null (maybe he's just forgotten to set)");
		}
		/* Send request to count of bank account */
		$stmt = $this->db->prepare("SELECT COUNT(number_card) FROM card WHERE number_card=:number_card");
		$stmt->bindParam(":number_card", $bank_account);
		$stmt->execute();
		
		if ($stmt->errorCode() != 0)
		{
			CrErrorDispatcher::CatchError(get_class() ."::GenerateBankAccount: Select count of bank accounts in 'individual' error. Here is the error message of SQL: " .$stmtu->errorInfo()[2]);
		}
		
		return $stmt->rowCount();
	}
	
	/* Generate bank account number
	 * @return integer Bank account number of user
	 */
	private function BankAccountGenerator()
	{
		for ($i = 0; $i < 16; $i++)
		{
			$num .= rand(0,9);
		}
		
		return $num;
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
}
?>
