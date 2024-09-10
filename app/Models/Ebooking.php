<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebooking extends Model
{
    use HasFactory;
    protected $table = 'ebooking';
    
    protected $fillable = [
        'user_id',
        'mesyuarat',
        'tarikhMula',
        'tarikhTamat',
        'lokasi',
        'pengerusi',
        'makanan',
        'minuman',
        'bil_ahli',
        'nama_pemohon',
        'email_pemohon',
        'bahagian_pemohon',
        'ext_pemohon',
        'pengesahan_pemohon',
        'tarikh_pemohon',
        'pengesahan_bkp',
        'nama_bkp',
        'tarikh_bkp',
        'catatan_bkp',
        'lampiran1',
        'lampiran2',
        'mohon_tukar',
        'catatan_tukar',
        'sn',
        'sah_tukar',
        'ext1',
        'ext2',
        'ext3',
        
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
