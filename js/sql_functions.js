/* Select bank names and IDs
 */
function selectBankNamesAndIDs()
{
	if (isAjaxRequestSend) {
		return false;
	}
	
	$.ajax({
		url: "rest.php",
		method: "POST",
		data: {rest_info: "select_bank_names"},
		beforeSend: function() {
			isAjaxRequestSend = true;
		}
	}).done(function(data){
		var encoded = JSON.parse(data);
		
		/* In case of error redirect to 500 page */
		if (encoded !== null && Object.prototype.hasOwnProperty.call(encoded, "error"))
		{
			redirect("500.php?error=encoded_data_error");
		}
		
		var banks = document.getElementsByName("banks")[0];
		var length = encoded.length;
		/* Create element for show that nothing was found */
		if (length == 0)
		{
			var elem = document.createElement("option");
			elem.value = "";
			elem.innerHTML = "---";
			elem.disabled = true;
			
			banks.appendChild(elem);
		}
		
		/* Set all HIC */
		for (var i = 0; i < length; i++)
		{
			var elem = document.createElement("option");
			elem.value = encoded[i].id_bank;
			elem.innerHTML = encoded[i].name;
			
			banks.appendChild(elem);
		}
		
	}.bind(this));
}
