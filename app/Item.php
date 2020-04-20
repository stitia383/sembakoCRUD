<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{   protected $table = 'item';
    protected $dates = ['exp'];
    protected $fillable = ['id', 'name', 'stock', 'input_barang', 'exp'];
}
