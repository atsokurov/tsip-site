<?php
class BankAccount
{
	/*	@param PDO $db Database specimen */
	private $db;
	
	/*	@param string|integer Client ID */
	private $id_client;
	
	/**
	 * Bank account constructor
	 * @param PDO $db Database specimen
	 * @param string|integer 
	 */
	public function __construct(PDO $db, $id_client)
	{
		if ($db == null)
		{
			CrErrorDispatcher::CatchError(get_class() ."::Register: Database specimen is null");
		}
		if (!is_string($id_client) && !is_integer($id_client))
		{
			CrErrorDispatcher::CatchError(get_class() ."Register: Client ID is not of type string or integer");
		}
		$this->db = $db;
		$this->id_client = $id_client;
	}
	
	/**
	 * Register bank account
	 * @param string $card_holder_name Card holder name
	 * @param string $type_of_card Type of card: credit or debit
	 * @param string|integer $id_bank Bank ID
	 * @return bool true if registration successful; false in case of error
	 */
	public function Register(string $card_holder_name, string $type_of_card, $id_bank)
	{
		$stmt = $this->db->prepare("INSERT INTO card(name_on_card, month, year, number_card, type_of_card, id_client, balance, id_bank) VALUES(:card_holder_name, :month, :year, :card_number, :type_of_card, :id_client, :balance, :id_bank)");
		$month = date("m");
		$year = (integer)date("Y") + 3; // russian cards are valid for 3 years
		$card_number = $this->GenerateBankAccount();
		$balance = 0;
		if ($type_of_card == "Кредитная") {
			$balance = 50000;	// start credit limit
		} else if ($type_of_card == "Дебетовая") {
			$balance = 10;		// 10 bonus roubles
		}
		
		$stmt->bindParam(":card_holder_name", $card_holder_name);
		$stmt->bindParam(":month", $month);
		$stmt->bindParam(":year", $year);
		$stmt->bindParam(":card_number", $card_number);
		$stmt->bindParam(":type_of_card", $type_of_card);
		$stmt->bindParam(":id_client", $this->id_client);
		$stmt->bindParam(":balance", $balance);
		$stmt->bindParam(":id_bank", $id_bank);
		
		try 
		{
			$stmt->execute();
		}
		catch (PDOException $e)
		{
			CrErrorDispatcher::CatchError(get_class() . "::Register: PDO exception error: " . $stmt->errorInfo()[2]);
		}
		
		return true;
	}
	
	/* Get cards of user
	 * @param string|integer $id_user ID of user
	 */
	public function GetUserCards($id_user)
	{
		if ($this->db == null)
		{
			CrErrorDispatcher::CatchError("accounts:GetUserCards: Database specimen is null");
		}
		if (!is_string($id_user) && !is_integer($id_user))
		{
			CrErrorDispatcher::CatchError("accounts::GetUserCards: User ID in not of type string or integer");
		}
		$stmt = $this->db->prepare("SELECT * FROM card WHERE id_client=:id_user");
		$stmt->bindParam(":id_user", $id_user);
		$stmt->execute();
		
		return $stmt->fetchAll();
	}
	
	/* Gets bank name by it's ID
	 * @param integer|string $id_bank Bank ID
	 * @return string|null Bank name
	 */
	public function GetBankNameById($id_bank)
	{
		if ($this->db == null)
		{
			CrErrorDispatcher::CatchError("accounts:GetUserCards: Database specimen is null");
		}
		if (!is_string($id_bank) && !is_integer($id_bank))
		{
			CrErrorDispatcher::CatchError("accounts:GetBankNameById: Bank ID is not of type string or integer");
		}
	
		$stmt = $this->db->prepare("SELECT name FROM bank WHERE id_bank=:id_bank");
		$stmt->bindParam(":id_bank", $id_bank);
		$stmt->execute();
		
		return $stmt->fetch()["name"];	
	}
	
	/* Generate bank account 
	 * @return integer Unique bank account
	 */
	private function GenerateBankAccount()
	{
		/* Existing bank account */
		$bank_account = "";
		
		// Generate bank account 
		// while he will be unique in DB
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
		if (!is_string($card_number) && !is_integer($card_number))
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
		$num = 0;
		
		for ($i = 0; $i < 16; $i++)
		{
			$num .= rand(0,9);
		}
		
		return (integer)$num;
	}
}
?>
