<?php
// src/Generator/Crypt.php
namespace App\Generator;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class Crypt
{

    private $pab_key;
    private $private_key;

    public function __construct(ParameterBagInterface $params)
    {
        $this->private_key = file_get_contents($params->get('sm_private_key_path'));
        $this->pab_key = file_get_contents($params->get('sm_public_key_path'));
    }
    public function encrypt($message)
    {
        openssl_public_encrypt($message, $data, $this->pab_key);
        return base64_encode($data);
    }

    public function decrypt($encrypted)
    {
        openssl_private_decrypt(base64_decode($encrypted), $decrypted, $this->private_key);
        return $decrypted;
    }
}
