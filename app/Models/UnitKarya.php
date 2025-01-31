<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKarya extends Model
{
    use HasFactory;

    protected $fillable = ['nama_unit_karya', 'division_id'];

    // Matikan timestamps otomatis
    public $timestamps = false;

    // Relasi ke Division
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
