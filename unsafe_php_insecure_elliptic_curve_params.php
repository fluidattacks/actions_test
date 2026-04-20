<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpseclib\Crypt\RSA;
use phpseclib\Math\BigInteger;

class EncryptionController extends Controller
{
    public function insecure_encrypt(Request $request)
    {
        $rsa = new RSA();
        $rsa->setPublicKeyFormat(RSA::PUBLIC_FORMAT_OPENSSH);
        $rsa->setPrivateKeyFormat(RSA::PRIVATE_FORMAT_PKCS1);

        $hash_type = 'md5';

        // Set weak elliptic curve
        $rsa->setHash('md5');
        $rsa->setMGFHash($hash_type);
        $rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);

        $plaintext = $request->input('plaintext');

        $ciphertext = $rsa->encrypt($plaintext);

        return response()->json(['ciphertext' => base64_encode($ciphertext)]);
    }

}

?>
