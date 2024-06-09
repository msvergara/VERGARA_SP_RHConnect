<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangays extends Model
{
    use HasFactory;

    protected $primaryKey = 'barangay_id';
    protected $table = 'barangay';
    protected $fillable = [
        'barangay_id',
        'barangay_name'
	];

    public $timestamps = false;
}
