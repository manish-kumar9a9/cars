<?php

function card_view($Api, $CardId) {

	try {

		$Result = $Api->Cards->Get($CardId);
	} catch (MangoPay\Libraries\ResponseException $e) {
		// handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()
	} catch (MangoPay\Libraries\Exception $e) {
		// handle/log the exception $e->GetMessage()
	}
	return $Result;
}
