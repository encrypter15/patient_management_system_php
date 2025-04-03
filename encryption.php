<?php
// encryption.php
// Author: Rick Hayes
// License: MIT
// Version: 1.0

require_once 'vendor/autoload.php';
require_once 'config.php';
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

class Encryptor {
    private $key;

    public function __construct() {
        $this->key = Key::loadFromAsciiSafeString(ENCRYPTION_KEY);
    }

    public function encrypt($data) {
        return Crypto::encrypt($data, $this->key);
    }

    public function decrypt($encrypted_data) {
        return Crypto::decrypt($encrypted_data, $this->key);
    }
}

$encryptor = new Encryptor();
