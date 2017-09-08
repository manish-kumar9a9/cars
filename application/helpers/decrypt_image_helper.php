<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('encrypt_to_decrypt_img')){
    function encrypt_to_decrypt_img($url,$password){
        if($url =='' ){
            return '';
        }
      $ci = &get_instance();
      $ci->load->library('decrypt_img');
      $result = $ci->decrypt_img->encrypt_img_convert_decrypt_img($url,$password);
      if($result){
          return "data:image/jpeg;base64,$result";
      }else{
        return $result = '';
      }

    }
}
