<?php

namespace App\Transformers;

class Json
{
    public static function response($data = null)
    {
        return [
            'data'    => $data
        ];
    }
}