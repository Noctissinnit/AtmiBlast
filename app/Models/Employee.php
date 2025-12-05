<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['name', 'email', 'institusi_id', 'unit_karya_id'];

    // Relasi ke UnitKarya
    public function unitKarya()
    {
        return $this->belongsTo(UnitKarya::class, 'unit_karya_id');
    }
    
    public function institusi()
    {
        return $this->belongsTo(Institusi::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
}
