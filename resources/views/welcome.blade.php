@php
	use Carbon\Carbon;
@endphp





<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel Quotation App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css?' . Ver()) }}">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

		<!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="{{ asset('js/main.js?' . Ver()) }}"></script>
		<script>
			var site_url = '{{ URL::to("/") }}';
		</script>
    </head>
    <body>
		<div id="login-container">
			<form id="login-form"
				onsubmit="Login_Submit(event);"
				action="javascript:void(0)" enctype="multipart/form-data">

				<label for="login-email">
					Email
				</label>
				<input type="email" id="login-email" name="email" required>



				<label for="login-password">
					Password
				</label>
				<input type="password" id="login-password" name="password" required>



				<button type="submit" id="login-submit-button">
					<span>
						Login
					</span>

					<div id="login-submit-button-loading-overlay">
						<i class="fas fa-spinner fa-spin fa-fw"></i>
					</div>
				</button>



				<div id="login-error">
				</div>
			</form>
		</div>





		<div id="quotation-container">
			<form id="quotation-form"
				onsubmit="Quotation_Submit(event);"
				action="javascript:void(0)" enctype="multipart/form-data">

				<label for="quotation-ages">
					Ages
				</label>
				<input type="text" id="quotation-ages" name="age" required>



				<label for="quotation-currency">
					Currency
				</label>
				<select id="quotation-currency" name="currency_id" required>
					<option selected disabled hidden value="">
						Select A Currency
					</option>

					@foreach(Currencies() as $currency_code => $currency)
						<option value="{{ $currency_code }}">
							{{ $currency -> currency }} ({{ $currency_code }})
						</option>
					@endforeach
				</select>



				<label for="quotation-start-date">
					Start Date
				</label>
				<input type="date" id="quotation-start-date" name="start_date" value="{{ Carbon::now() -> format('Y-m-d') }}" required>



				<label for="quotation-end-date">
					End Date
				</label>
				<input type="date" id="quotation-end-date" name="end_date" value="{{ Carbon::now() -> addWeeks(1) -> format('Y-m-d') }}" required>



				<button type="submit" id="quotation-submit-button">
					<span>
						Calculate
					</span>

					<div id="quotation-submit-button-loading-overlay">
						<i class="fas fa-spinner fa-spin fa-fw"></i>
					</div>
				</button>
			</form>



			<div id="quotation-results">
				<div>
					<b>Total Cost</b>: <span id="quotation-total">-</span>
				</div>

				<div>
					<b>Quotation ID</b>: <span id="quotation-id">-</span>
				</div>
				<div id="quotation-error">
				</div>
			</div>
		</div>
    </body>
</html>
