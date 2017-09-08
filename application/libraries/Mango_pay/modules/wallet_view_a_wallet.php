<?php

function view_a_wallet($Api, $WalletId) {

	try {

		$Result = $Api->Wallets->Get($WalletId);
	} catch (MangoPay\Libraries\ResponseException $e) {
		// handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()
	} catch (MangoPay\Libraries\Exception $e) {
		// handle/log the exception $e->GetMessage()
	}

	return $Result;
}
