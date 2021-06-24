var jwt_token = null;

var login_active = false;

var quotation_active = false;





function Login_Submit(event)
{

	if(login_active)
	{

		return;

	}

	login_active = true;



	jQuery('#login-submit-button-loading-overlay') . css('display', 'flex');



	var form = jQuery(event . currentTarget);



	jQuery . ajaxSetup(
	{
		headers:
		{
			'Content-Type': 'application/json',
		}
	});

	jQuery . ajax(
	{

		method: 'POST',

		url: site_url + '/api/auth/login',

		data:
		JSON . stringify({ 
			'email': form . find('input[name="email"]') . val(),
			'password': form . find('input[name="password"]') . val(),
		}),

		success: function(response)
		{

			if(response . error != '')
			{

				jQuery('#login-error') . html(response . error);

			}

			else
			{

				jQuery('#login-error') . html('');

				jwt_token = response . access_token;

				jQuery("#quotation-container") . css("display", "flex");

				jQuery("#login-container") . css("display", "none");

			}



 			setTimeout(function()
			{

				jQuery('#login-submit-button-loading-overlay') . css('display', 'none');

				login_active = false;

			}, 100);

		},

		error: function(jqXHR, textStatus, errorThrown)
		{

			console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

		}

	});

}

function Quotation_Submit(event)
{

	if(quotation_active)
	{

		return;

	}

	quotation_active = true;



	jQuery("#quotation-error") . html('');

	jQuery('#quotation-submit-button-loading-overlay') . css('display', 'flex');



	var form = jQuery(event . currentTarget);



	jQuery . ajaxSetup(
	{
		headers:
		{
			'Content-Type': 'application/json',
			'Authorization': 'Bearer ' + jwt_token,
		}
	});

	jQuery . ajax(
	{

		method: 'POST',

		url: site_url + '/api/auth/quotation',

		data:
		JSON . stringify({ 
			'age': form . find('input[name="age"]') . val(),
			'start_date': form . find('input[name="start_date"]') . val(),
			'end_date': form . find('input[name="end_date"]') . val(),
			'currency_id': form . find('select[name="currency_id"]') . val(),
		}),

		success: function(response)
		{

			if(response . error != '')
			{

				jQuery('#quotation-total') . html('ERROR');

				jQuery('#quotation-id') . html('ERROR');

				jQuery("#quotation-error") . html(response . error);

			}

			else
			{

				jQuery('#quotation-total') . html(response . total . toFixed(2) + ' ' + response . currency_id);

				jQuery('#quotation-id') . html(response . quotation_id);

				jQuery("#quotation-error") . html('');

			}




			setTimeout(function()
			{

				jQuery('#quotation-submit-button-loading-overlay') . css('display', 'none');

				quotation_active = false;

			}, 100);

		},

		error: function(jqXHR, textStatus, errorThrown)
		{

			console.log("AJAX error: " + textStatus + ' : ' + errorThrown);

		}

	});

}
