<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class DecryptDataService
{
    public static function decryptData($data)
    {
        try {
            return Crypt::decryptString($data);
        } catch (DecryptException $e) {
            return '';
        }
    }
}
