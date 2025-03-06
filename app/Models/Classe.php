<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classe extends Model
{
    use HasTranslations;
    public $translatable = ['classe_name'];
    protected $fillable = ['grade_id', 'classe_name'];

    public function grades()
    {
        return $this->belongsTo(Grade::class,'grade_id', 'id');
    }
    
    protected $casts = [
        'classe_name' => 'array',
    ];
}
