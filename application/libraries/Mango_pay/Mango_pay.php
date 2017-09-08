<?php

Class Mango_pay {

	public $Api;

	public function __construct() {

		require_once("vendor/autoload.php");
		$Api = new \MangoPay\MangoPayApi();
		$Api->Config->ClientId = get_web_meta_data('mango_pay_Client_id'); //#TODO Update with your own info
		$Api->Config->ClientPassword = get_web_meta_data('mango_pay_passphrase'); //#TODO Update with your own info
		$Api->Config->TemporaryFolder = __dir__ . "/writeable_folder_for_oauth_token"; //#TODO The SDK will store it's oauth token here in a file
		//$MangopayApi->Config->BaseUrl = "https://api.mangopay.com"; //uncomment this line to use the production environment
		//Uncomment any of the following to use a custom value (these are all entirely optional)
		//$MangopayApi->Config->CurlResponseTimeout = 20; //The cURL response timeout in seconds (its 30 by default)
		//$MangopayApi->Config->CurlConnectionTimeout = 60; //The cURL connection timeout in seconds (its 80 by default)
		//$MangopayApi->Config->CertificatesFilePath = ''; //Absolute path to file holding one or more certificates to verify the peer with (if empty, there won't be any verification of the peer's certificate)
		$this->Api = $Api;
	}

	public function mango_class_test() {

		$this->mango_create_registration();
	}

	/* user */

	public function mango_create_natural_user($data) {
		require_once("modules/user_create_natural_user.php");
		return create_natural_user($this->Api, $data);
	}

	/* Wallet */

	public function mango_create_wallet($data) {
		require_once("modules/wallet_create_a_wallet.php");
		return create_a_wallet($this->Api, $data);
	}

	public function mango_view_wallet($WalletId) {
		require_once("modules/wallet_view_a_wallet.php");
		return view_a_wallet($this->Api, $WalletId);
	}

	/* card */

	public function mango_create_registration($data) {
		require_once("modules/card_create_a_card_registration.php");
		return create_a_registration($this->Api, $data);
	}

	/* add a card */

	public function add_card_to_user($cardRegisterId, $data) { /* this function is not working */

		$mangoPayApi = $this->Api;
		$cardRegister = $mangoPayApi->CardRegistrations->Get($cardRegisterId);
		$cardRegister->RegistrationData = isset($data['data']) ? 'data=' . $data['data'] : 'errorCode=' . $data['errorCode'];


		$updatedCardRegister = $mangoPayApi->CardRegistrations->Update($cardRegister);
		if ($updatedCardRegister->Status != \MangoPay\CardRegistrationStatus::Validated || !isset($updatedCardRegister->CardId)) {
			return false;
			die('<div style="color:red;">Cannot create card. Payment has not been created.<div>');
		} else {
			return $card = $mangoPayApi->Cards->Get($updatedCardRegister->CardId);
		}
	}

	/* view a crad */

	public function view_a_card($card_id) {

		require_once("modules/card_view_a_card.php");
		return card_view($this->Api, $card_id);
	}

	/* delete card form mango pay */

	public function delete_card($card_id) {
		require_once("modules/delete_user_card.php");
		return delete_user_card($this->Api, $card_id);
	}

	public function direct_payin_from_card($data) {

		$mangoPayApi = $this->Api;
		// create pay-in CARD DIRECT
		$payIn = new \MangoPay\PayIn();
		$payIn->CreditedWalletId = $data['CreditedWalletId']; //$createdWallet->Id;
		$payIn->AuthorId = $data['AuthorId']; //$updatedCardRegister->UserId;

		$payIn->DebitedFunds = new \MangoPay\Money();
		$payIn->DebitedFunds->Amount = $data['DebitedFunds_amount']; //$_SESSION['amount'];
		$payIn->DebitedFunds->Currency = $data['DebitedFunds_currency']; //$_SESSION['currency'];
		$payIn->Fees = new \MangoPay\Money();
		$payIn->Fees->Amount = $data['Fees_amount']; //0;
		$payIn->Fees->Currency = $data['Fees_Currency']; //$_SESSION['currency'];
		// payment type as CARD
		$payIn->PaymentDetails = new \MangoPay\PayInPaymentDetailsCard();
		$payIn->PaymentDetails->CardType = $data['CardType']; //$card->CardType;
		$payIn->PaymentDetails->CardId = $data['CardId']; //$card->Id;
		// execution type as DIRECT
		$payIn->ExecutionDetails = new \MangoPay\PayInExecutionDetailsDirect();
		$payIn->ExecutionDetails->SecureModeReturnURL = $data['ReturnURL'];
		$payIn->ExecutionDetails->SecureMode = "FORCE";

		// create Pay-In
		return $createdPayIn = $mangoPayApi->PayIns->Create($payIn);
	}

	public function web_payin_from_card($data) {

		$mangoPayApi = $this->Api;
		// create pay-in CARD DIRECT
		$payIn = new \MangoPay\PayIn();
		$payIn->CreditedWalletId = $data['CreditedWalletId']; //$createdWallet->Id;
		$payIn->AuthorId = $data['AuthorId']; //$updatedCardRegister->UserId;

		$payIn->DebitedFunds = new \MangoPay\Money();
		$payIn->DebitedFunds->Amount = $data['DebitedFunds_amount']; //$_SESSION['amount'];
		$payIn->DebitedFunds->Currency = $data['DebitedFunds_currency']; //$_SESSION['currency'];
		$payIn->Fees = new \MangoPay\Money();
		$payIn->Fees->Amount = $data['Fees_amount']; //0;
		$payIn->Fees->Currency = $data['Fees_Currency']; //$_SESSION['currency'];
		// payment type as CARD
		$payIn->PaymentDetails = new \MangoPay\PayInPaymentDetailsCard();
		$payIn->PaymentDetails->CardType = $data['CardType']; //$card->CardType;
		$payIn->PaymentDetails->CardId = $data['CardId']; //$card->Id;
		// execution type as DIRECT
		$payIn->ExecutionDetails = new \MangoPay\PayInExecutionDetailsWeb();
		$payIn->ExecutionDetails->ReturnURL = $data['ReturnURL'];
		$payIn->ExecutionDetails->Culture = "EN";

		$payIn->ExecutionDetails->SecureMode = "FORCE";

		// create Pay-In
		return $createdPayIn = $mangoPayApi->PayIns->Create($payIn);
	}

	public function get_payin_view($id) {
		$mangoPayApi = $this->Api;
		$PayInId = $id;
		$PayIn = $mangoPayApi->PayIns->Get($PayInId);
		return $PayIn;
	}

	public function payout_to_bank($data) {
		$mangoPayApi = $this->Api;
		
		$PayOut = new \MangoPay\PayOut();
		$PayOut->AuthorId = $data['AuthorId'];
		$PayOut->DebitedWalletId = $data['DebitedWalletId'];
		$PayOut->DebitedFunds = new \MangoPay\Money();
		$PayOut->DebitedFunds->Currency = "EUR";
		$PayOut->DebitedFunds->Amount = $data['DebitedFunds']['Amount'];
		$PayOut->Fees = new \MangoPay\Money();
		$PayOut->Fees->Currency = "EUR";
		$PayOut->Fees->Amount = $data['Fees']['Amount'];
		$PayOut->PaymentType = \MangoPay\PayOutPaymentType::BankWire;
		$PayOut->MeanOfPaymentDetails = new \MangoPay\PayOutPaymentDetailsBankWire();
		$PayOut->MeanOfPaymentDetails->BankAccountId = $data['MeanOfPaymentDetails']['BankAccountId'];
		$result = $mangoPayApi->PayOuts->Create($PayOut);

		return $result;
	}

	public function get_payout_view($PayOutId) {
		$mangoPayApi = $this->Api;
		$PayOut = $mangoPayApi->PayOuts->Get($PayOutId);
		return $PayOut;
	}	
	
	/*	 * *************  incomplete functions ******************** */

	public function mango_create_legal_user() {
		require_once("modules/user_create_a_legal_user.php");
		$data = array();
		create_a_legal_user($this->Api, $data);
	}

	public function mango_view_user() {
		require_once("modules/user_view_a_user.php");
		$data = array();
		view_user($this->Api, $data);
	}

	public function mango_update_wallet() {
		require_once("modules/wallet_update_a_wallet.php");
		$data = array();
		update_a_wallet($this->Api, $data);
	}

	/* update user address */

	public function mango_update_address($data = array()) {
		require_once("modules/update_user_address.php");
		$result = update_user_address($this->Api, $data);
		return $result;
	}

	public function mango_view_user_detail($data) {
		require_once("modules/view_user_detail.php");
		$result = view_user_detail($this->Api, $data);
		return $result;
	}

	/* create bank account */

	/* other */

	public function create_other_bank_account($mango_user_id, $data) {
		require_once("modules/create_other_bank_account.php");
		$result = make_other_bank_account($this->Api, $mango_user_id, $data);
		return $result;
	}

	/* iban */

	public function create_iban_bank_account($mango_user_id, $data) {
		require_once("modules/create_iban_bank_account.php");
		$result = make_iban_bank_account($this->Api, $mango_user_id, $data);
		return $result;
	}

	public function get_user_bank_details($mango_user_id, $bank_id) {
		require_once("modules/user_bank_details.php");
		return user_bank_details($this->Api, $mango_user_id, $bank_id);
	}

}
