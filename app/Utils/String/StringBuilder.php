<?php namespace App\Utils\String;

use Illuminate\Support\Str;

class StringBuilder extends Str {

    public function html($text)
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
    
}