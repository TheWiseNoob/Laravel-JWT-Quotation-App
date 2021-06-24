<?php

function Age_Load($age)
{

	if($age < 18)
	{

		return 0;

	}

	if(($age >= 18) && ($age <= 30))
	{

		return 0.6;

	}

	elseif(($age >= 31) && ($age <= 40))
	{

		return 0.7;

	}

	elseif(($age >= 41) && ($age <= 50))
	{

		return 0.8;

	}

	elseif(($age >= 51) && ($age <= 60))
	{

		return 0.9;

	}

	elseif(($age >= 61) && ($age <= 70))
	{

		return 1.0;

	}



	return 1;

}

function Currencies()
{

	return
	[
	    'GBP' => (object)([
			'currency' => 'British Pounds Sterling',
			'fixed_rate' => '826'
		]),
    	'EUR' => (object)([
			'currency' => 'Euro',
			'fixed_rate' => '978'
		]),
	    'USD' => (object)([
			'currency' => 'US Dollars',
			'fixed_rate' => '840'
		]),
	];

}

function Ver()
{

	return "0.01";

}
