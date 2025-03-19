<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $translatable = ['title'];
    protected $table = 'fees';
    protected $guarded = [];
}
