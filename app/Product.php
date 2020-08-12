<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    // use SoftDeletes;
    use Uuid;
    protected $fillable = ['name', 'quantity','barcode'];
    protected $attributes = ['quantity' => 0, 'barcode' => ''];
    protected $keyType = 'string';
    public $incrementing = false;
}
