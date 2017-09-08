<?php

function create_a_wallet($Api, $data = array()) {

	try {
		$Wallet = new \MangoPay\Wallet();
		$Wallet->Tag = $data['Tag'];
		$Wallet->Owners = $data['Owners'];
		$Wallet->Description = $data['Description'];
		$Wallet->Currency = $data['Currency'];

		$Result = $Api->Wallets->Create($Wallet);
	} catch (MangoPay\Libraries\ResponseException $e) {
		// handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()
	} catch (MangoPay\Libraries\Exception $e) {
		// handle/log the exception $e->GetMessage()
	}
	
	return $Result;
}
