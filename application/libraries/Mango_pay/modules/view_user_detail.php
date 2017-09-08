<?php

function view_user_detail($Api, $data) {
    try {

        $UserId = $data;

        $User = $Api->Users->Get($UserId);
    } catch (MangoPay\Libraries\ResponseException $e) {
// handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()
    } catch (MangoPay\Libraries\Exception $e) {
// handle/log the exception $e->GetMessage()
    }
    return $User;
}
