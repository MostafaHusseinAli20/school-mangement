<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Grade extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = ['name', 'notes'];

    public function classes()
    {
        return $this->hasMany(Classe::class, 'classe_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'grade_id');
    }
}
