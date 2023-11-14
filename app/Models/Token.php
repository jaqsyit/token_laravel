<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['service', 'token_new', 'token_old'];


    public static function refreshToken($data)
    {
        $newStr = new self();
        $newStr->service = $data['service'];
        $newStr->token_old = $data['token'];

        $newStr->token_new = rand('1000','9999');

        $newStr->save();

        return $newStr;
    }

}
