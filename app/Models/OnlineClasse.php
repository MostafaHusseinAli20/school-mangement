<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineClasse extends Model
{
    protected $fillable = [
        'meeting_id',
        'meeting_topic',
        'meeting_start_at',
        'meeting_duration',
        'meeting_password',
        'start_url',
        'join_url',
        'grade_id',
        'classe_id',
        'section_id',
        'user_id',
        'type'
    ];
    
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
