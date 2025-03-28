<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class exam extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $table = 'exams';
    protected $fillable = [
        'name',
        'term',
        'academic_year'
    ];
}
