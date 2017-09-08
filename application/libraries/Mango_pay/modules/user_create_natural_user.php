<?php

/*
  Parameters
  Tag
  string
  optional

  Custom data that you can add to this item
  FirstName
  string
  required

  The name of the user
  LastName
  string
  required

  The last name of the user
  Address
  Address
  optional

  The address
  Birthday
  timestamp
  required

  The date of birth of the user - be careful to set the right timezone (should be UTC) to avoid 00h becoming 23h (and hence interpreted as the day before)
  Nationality
  CountryIso
  required

  The user’s nationality. ISO 3166-1 alpha-2 format is expected
  CountryOfResidence
  CountryIso
  required

  The user’s country of residence. ISO 3166-1 alpha-2 format is expected
  Occupation
  string
  optional

  User’s occupation, ie. Work
  IncomeRange
  int
  optional

  Could be only one of these values: 1 - for incomes <18K€),2 - for incomes between 18 and 30K€, 3 - for incomes between 30 and 50K€, 4 - for incomes between 50 and 80K€, 5 - for incomes between 80 and 120K€, 6 - for incomes >120K€
  Email
  string
  required

  The person's email address - must be a valid email
 */

function create_natural_user($Api, $data = array()) {
	try {
		$UserNatural = new \MangoPay\UserNatural();
		$UserNatural->Tag = $data['Tag'];
		$UserNatural->FirstName = $data['FirstName'];
		$UserNatural->LastName = $data['LastName'];
		/* $UserNatural->Address = new \MangoPay\Address();
		  $UserNatural->Address->AddressLine1 = $data['addressLine1'];
		  $UserNatural->Address->AddressLine2 = $data['addressLine2'];
		  $UserNatural->Address->City = $data['city'];
		  $UserNatural->Address->Region = "Ile de France";
		  $UserNatural->Address->PostalCode = "75001";
		  $UserNatural->Address->Country = "FR"; */

		$UserNatural->Birthday = $data['Birthday'];
		$UserNatural->Nationality = $data['Nationality'];
		$UserNatural->CountryOfResidence = $data['CountryOfResidence'];
		//$UserNatural->Occupation = "Carpenter";
		//$UserNatural->IncomeRange = 2;
		$UserNatural->Email = $data['Email'];

		$Result = $Api->Users->Create($UserNatural);
	} catch (MangoPay\Libraries\ResponseException $e) {
		// handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()
	} catch (MangoPay\Libraries\Exception $e) {
		// handle/log the exception $e->GetMessage()
	}

	return $Result;
}
