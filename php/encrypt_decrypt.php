<?php 

class Encry_Decry
{
   public function encrypt($value){
   	 $ciphermeth="AES-128-CTR";
       $iv_len=openssl_cipher_iv_length($ciphermeth);
       $opt=0;
       $encryption_iv='1234567891111110';
       $encryption_key='pimecbook';
       $ieid=openssl_encrypt($value, $ciphermeth, $encryption_key,$opt,$encryption_iv);
       return $ieid;
	}
	public function decrypt($value){
    $cipher_meth="AES-128-CTR";
     $iv_len=openssl_cipher_iv_length($cipher_meth);
     $opt=0;
     $decryption_iv='1234567891111110';
     $decryption_key='pimecbook';
     $idx=openssl_decrypt($value, $cipher_meth,$decryption_key,$opt,$decryption_iv);
     return $idx;

	}
}