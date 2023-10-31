<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKegiatan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pamongs()
    {
        
        return $this->belongsTo(Pamong::class,'pamong_id');
    }

    public function dpls()
    {
        return $this->belongsTo(Dpl::class,'dpl_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
