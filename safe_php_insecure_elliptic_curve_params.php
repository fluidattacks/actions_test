<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpseclib\Crypt\RSA;
use phpseclib\Math\BigInteger;

class EncryptionController extends Controller
{
    public function secure_encrypt(Request $request)
    {
        $rsa = new RSA();
        $rsa->setPublicKeyFormat(RSA::PUBLIC_FORMAT_OPENSSH);
        $rsa->setPrivateKeyFormat(RSA::PRIVATE_FORMAT_PKCS1);

        $hash_type = 'sha256';

        // Set secure elliptic curve
        $rsa->setHash($hash_type);
        $rsa->setMGFHash('sha256');
        $rsa->setEncryptionMode(RSA::ENCRYPTION_OAEP);

        $plaintext = $request->input('plaintext');

        $ciphertext = $rsa->encrypt($plaintext);

        return response()->json(['ciphertext' => base64_encode($ciphertext)]);
    }
}

?>
