<?php
/* User class*/
class User
{
	/*	@param integer $id ID of user in DB */
	public $id;
	/*	@param integer $id_individual ID of individual in DB */
	public $id_individual;
	/*	@param string $email E-mail */
	public $email;
	/*	@param string $password Password hash */
	public $password;
	
	/* @param string $name Name of user */
	public $name;
	/* @param string $surname Surname of user */
	public $surname;
	/*	@param string $patronymic Patronymic of user */
	public $patronymic;
	
	/* @param integer $number_of_passport Number of passport */
	public $number_of_passport;
	/* @param integer $series_of_passport Series of passport */
	public $series_of_passport;
}
?>
