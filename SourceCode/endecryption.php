<?php

class Encryption {
	const CYPHER = MCRYPT_RIJNDAEL_256;
	const MODE   = MCRYPT_MODE_CBC;
        const KEY    = MD5('somesecretphrase');

	public function encrypt($plaintext) {
        	$td = mcrypt_module_open(self::CYPHER, '', self::MODE, '');
	        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        	mcrypt_generic_init($td, self::KEY, $iv);
	        $crypttext = mcrypt_generic($td, $plaintext);
	        mcrypt_generic_deinit($td);
	        return base64_encode($iv.$crypttext);
    	}

	public function decrypt($crypttext) {
	        $crypttext = base64_decode($crypttext);
	        $plaintext = '';
	        $td        = mcrypt_module_open(self::CYPHER, '', self::MODE, '');
	        $ivsize    = mcrypt_enc_get_iv_size($td);
	        $iv        = substr($crypttext, 0, $ivsize);
	        $crypttext = substr($crypttext, $ivsize);
        	
		if ($iv) {
		        mcrypt_generic_init($td, self::KEY, $iv);
	                $plaintext = mdecrypt_generic($td, $crypttext);
                }
	
        	return trim($plaintext);
        }
}

?>
