<span class="label">Регистрация банковской карты</span>

<div class="form-wrapper">

<form class="form" action="#" method="POST">
	</br>
	<span class="text"><span class="form-required-field">*</span> Все поля необходимы к заполнению.</span>
	</br>
	<fieldset class="register-user-credentials">
	<legend>Идентификационные данные</legend>
		<input class="input" type="text" name="card_holder_name" placeholder="Фамилия и имя латинскими буквами" pattern="[a-zA-Z]{2,20}\s[a-zA-Z]{2,20}" title="Фамилия и имя латинскими буквами" required> <br/>
		<select name="card_type" class="input" required>
			<option value="" disabled selected>Тип карты</option>
			<option value="Кредитная">Кредитная</option>
			<option value="Дебетовая">Дебетовая</option>
		</select>
		<select name="banks" class="input" onclick="selectBankNamesAndIDs();">
		</select>
	</fieldset>
	<br/>
	<input class="input button" type="submit" name="register" value="Регистрация карты"> 
	<br/><br/>
</form>

</div>
