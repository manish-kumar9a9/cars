<?php

function user_bank_details($Api,$UserId ,$BankAccountId ) {

	try {
		$BankAccount = $Api->Users->GetBankAccount($UserId, $BankAccountId);
	} catch (MangoPay\Libraries\ResponseException $e) {
		// handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()
	} catch (MangoPay\Libraries\Exception $e) {
		// handle/log the exception $e->GetMessage()
	}
	return $BankAccount;
}
