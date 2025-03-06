<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MyParent extends Model
{
    use HasTranslations;
    public $translatable = ['name_father', 'name_mother', 'job_father', 'job_mother'];
    protected $guarded = [];
    protected $table = 'my_parents';
}
