<?php
/*	PDO Database connector using database configuration */
class CrDatabase
{
	public function Connect()
	{
		$sep = DIRECTORY_SEPARATOR;
		$dsn = include_once(BASE_PATH .$sep ."config" .$sep ."DB.php");
		$opt = [
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
		];
		try {
			$dsn_string = "{$dsn['dbtype']}:dbname={$dsn['dbname']};host={$dsn['host']};port:{$dsn['port']};charset={$dsn['charset']}";
			$dbh = new PDO($dsn_string, $dsn['user'], $dsn['pass'], $opt);
			return $dbh;
		} catch (PDOException $e) {
			CrErrorDispatcher::CatchError("Couldn't connect to database");
		}
	}
}
?>
