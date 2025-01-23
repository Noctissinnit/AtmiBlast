<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Division.php
class Division extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relasi ke employee
    public function employees()
    {
        return $this->hasMany(Employee::class, 'iddevisi'); // Menyebutkan kolom foreign key yang benar
    }
}
