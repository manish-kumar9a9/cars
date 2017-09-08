<?php

function make_other_bank_account($Api, $user_id, $data = array()) {

	$bank_account = new \MangoPay\BankAccount();

	$details = new \MangoPay\BankAccountDetailsOTHER();
	$details->Type = 'OTHER';
	$details->Country =$data[ 'Bank_Country'];
	$details->BIC = $data['BIC'];
	$details->AccountNumber = $data['AccountNumber'];
	
	
	$bank_account->Details = $details;
	$bank_account->OwnerName = $data['OwnerName'];
	$bank_account->OwnerAddress = new \MangoPay\Address();
	$bank_account->OwnerAddress->AddressLine1 = $data['AddressLine1'];
	$bank_account->OwnerAddress->AddressLine2 = $data['AddressLine2'];
	$bank_account->OwnerAddress->City = $data['City'];
	$bank_account->OwnerAddress->PostalCode = $data['PostalCode'];
	$bank_account->OwnerAddress->Country = $data['Country'];
	$bank_account->OwnerAddress->Region = $data['Region'];
	$created_account = $Api->Users->CreateBankAccount($user_id, $bank_account);
	if(count($created_account ) > 0 && array_key_exists('Id', $created_account)){
		return $created_account;
	}
	return false;
}
