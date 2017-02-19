window.onload = function() 
{
	if (document.getElementsByClassName("registration-success")[0]
		|| (document.location.pathname == '\/login.php')
		|| (document.location.pathname == '\/logout.php')
	)
	{
		redirectAfter('index.php', 3);
	}
}

/* Redirect user to requested path after selected time
 * @param {string} path - Redirection path
 * @param {integer} delay - Delay in seconds
 */
function redirectAfter(path, delay)
{
	setTimeout(function() {
		redirect(path);
	}.bind(this), delay/*sec*/ * 1000/*millisec*/);
}

/* Redirect user to requested path
 * @param {string} path Р’В­ Redirected path
 */
function redirect(path)
{
	// Just an alias of doc location
	var loc = document.location;
	
	console.log(loc.origin + '\/' + path);

	if (loc.pathname != '\/' + path)
	{
		document.location.href = loc.origin + '\/' + path;
	}
}

/* @param {boolean} isAjaxRequestSend - Prevent multiple requests */
var isAjaxRequestSend = false;

/* Validates registration form 
 * and set errors in case of validation errors 
 */
function validateRegistrationForm()
{
	var passwordElement = document.getElementsByName("password")[0];
	var passwordRepeatElement = document.getElementsByName("repeat_password")[0];
	
	if (passwordElement.value !== passwordRepeatElement.value)
	{
		return false;
	}
	
	if (elementValue("series_of_passport").length == 4 
		|| elementValue("number_of_passport").length == 6
	)
	{
		return false;
	}
	
	/* User input errors */
	var fields = [
		"email",
		"password",
		"repeat_password",
		
		"name",
		"surname",
		"patronymic",
		
		"series_of_passport",
		"number_of_passport",
	];
	
	/* Is form completely validated */
	var validated = true;	
	
	/* Check user input errors */
	for (var i = 0, count = errors.length; i < count; i++)
	{
		if (validateElement(fields[i]) === false)
		{
			setErrorToInput(fields[i]);
			validated = false;
		}
	}
	
	return validated;
}

/* Set class 'input-error' to elements
 * which are not passed validation,
 * else return true if validation is passed
 * @param {string} inputName - Input element name
 * @return {boolean} true if validation 
 */
function setErrorToInput(inputName)
{
	if (inputName === null || typeof inputName !== "string" || inputName === "")
	{
		return false;
	}
	
	var inputElement = document.getElementsByName(inputName)[0];
	
	inputElement.className = "input-error";
	
	return true;
}

/* Validates element on page by his name
 * @param {string} elementName - Name of DOM element 
 */
function validateElement(elementName)
{
	if (elementName === null || typeof elementName !== "string" || elementName === "")
	{
		return false;
	}
	var element = document.getElementsByName(elementName)[0];
	if (element === null)
	{
		return false;
	}
	var pattern = new RegExp(element.pattern);
	
	return pattern.test(element.value);
}


/* Get element value by his name 
 * @param {string} elementName - DOM element name
 * @return {string} Element value
 */
function elementValue(elementName)
{
	return document.getElementsByName(elementName)[0];
}
