<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MyParent extends Authenticatable
{
    use HasTranslations;
    public $translatable = ['name_father', 'name_mother', 'job_father', 'job_mother'];
    protected $guarded = [];
    protected $table = 'my_parents';
}
