<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use Uuid;
    protected $fillable = ['type', 'date'];
    protected $keyType = 'string';
    public $incrementing = false;
    public function products()
    {
        return $this->belongsToMany(\App\Product::class)->withPivot([
            'quantity',
        ]);
    }
}
