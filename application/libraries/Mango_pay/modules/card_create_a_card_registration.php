<?php

function create_a_registration($Api, $data = array()) {

	try {
		$CardRegistration = new \MangoPay\CardRegistration();
		$CardRegistration->Tag = $data['Tag'];
		$CardRegistration->UserId = $data['UserId'];
		$CardRegistration->Currency = $data['Currency'];
		$CardRegistration->CardType = $data['CardType'];

		$Result = $Api->CardRegistrations->Create($CardRegistration);
	} catch (MangoPay\Libraries\ResponseException $e) {
		// handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()
	} catch (MangoPay\Libraries\Exception $e) {
		// handle/log the exception $e->GetMessage()
	}

	return $Result;
}
