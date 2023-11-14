<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restriction extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['service', 'token', 'restriction', 'data'];

    public static function createOrUpdate($data)
    {
        try {
            $zapis = self::updateOrCreate(
                ['service' => $data['service'], 'token' => $data['token']],
                $data
            );

            return [
                'wasRecentlyCreated' => $zapis->wasRecentlyCreated,
                'data' => $zapis
            ];
        } catch (Exception $e) {
            throw $e; // Пробрасываем исключение вверх для обработки в контроллере/сервисе
        }
    }

}
