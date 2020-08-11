<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use Uuid;
    protected $fillable = ['name', 'quantity','barcode'];
    protected $attributes = ['quantity' => 0, 'barcode' => ''];
    protected $keyType = 'string';
    public $incrementing = false;
}
