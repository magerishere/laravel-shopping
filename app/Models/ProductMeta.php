<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'phone',
        'city',
        'address',
    ];

    public function getPhoneAttribute($phone)
    {
        return explode('-',$phone)[1];
    }
    public function getCityAttribute($city)
    {
        $cityCodeAndPhone = explode('-',$this->getRawOriginal('phone'));
        $cityCode = $cityCodeAndPhone[0];
        $cityNameWithCode = $cityCode . ' - ' . $city;
        return [$cityCode,$cityNameWithCode];
    }
}
