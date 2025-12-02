<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

// app/Models/Division.php
class Institusi extends Model
{
    use HasFactory;

    // Mengizinkan mass assignment untuk kolom 'name'
    protected $fillable = ['name'];

    // Relasi ke karyawan (employees)
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    // Relasi ke unit_karyas (unit karya)
    public function unit_karyas()
    {
        return $this->hasMany(UnitKarya::class, 'institusi_id');
    }
}
