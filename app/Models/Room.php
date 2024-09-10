<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    
    protected $fillable = [
        'user_id',
        'bilik',        
        'ext1',
        'ext2',
        
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function parent()
    {
        return $this->hasOne(Self::class, 'id', 'ext1_id');
    }

    public function children()
    {
        return $this->hasMany(Self::class, 'ext1_id', 'id');
    }
}
