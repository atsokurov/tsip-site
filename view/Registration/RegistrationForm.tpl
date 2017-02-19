<span class="label">Регистрация</span>

<div class="form-wrapper">

<form class="form" action="#" method="POST">
	</br>
	<span class="text"><span class="form-required-field">*</span> Все поля необходимы к заполнению.</span>
	</br>
	<fieldset class="register-user-credentials">
	<legend>Идентификационные данные</legend>
		<input class="input" type="email" name="email" placeholder="Адрес электронной почты" pattern="[a-zA-Z][a-zA-Z0-9.!_-]+@[a-zA-Z0-9_.-]+\.[a-zA-Z]+" title="Введите адрес электронной почты" required> <br/>
		<input class="input" type="password" name="password" placeholder="Пароль" pattern="[a-zA-Z0-9.!_-]+" title="Введите свой пароль" required> <br/>
		<input class="input" type="password" name="repeat_password" placeholder="Повторите пароль" pattern="[a-zA-Z0-9.!_-]+" title="Повторите введённый Вами пароль" required> <br/>
	</fieldset>
	<br/>
	<fieldset class="register-user-data">
	<legend>Личная информация</legend>
		<input class="input" type="text" name="surname" placeholder="Фамилия" pattern="[a-zA-Zа-яйёА-ЯЙЁ]{2,64}" required> <br/>
		<input class="input" type="text" name="name" placeholder="Имя" pattern="[a-zA-Zа-яйёА-ЯЙЁ]{2,64}" required> <br/>
		<input class="input" type="text" name="patronymic" placeholder="Отчество" pattern="[a-zA-Zа-яйёА-ЯЙЁ]{2,64}" required> <br/>
		<input class="input" type="text" name="series_of_passport" placeholder="Серия паспорта" pattern="\d{4}" required> <br/>
		<input class="input" type="text" name="number_of_passport" placeholder="Номер паспорта" pattern="\d{6}" required> <br/>
	</fieldset>
	<br/>
	<input class="input button" type="submit" name="register" value="Регистрация"> 
	<br/><br/>
</form>

</div>
