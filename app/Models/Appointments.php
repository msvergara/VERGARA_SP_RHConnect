<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $primaryKey = 'appointment_id';
    protected $table = 'appointments';
    protected $fillable = [
        'patient_id',
		'title', 
        'description',
        'appointment_datetime',
        'session_status',
	];

    public function patientowner() {
        return $this->belongsTo(Patients::class, 'patient_id', 'patient_id');
    }

    public function appointmenttosession() {
        return $this->hasOne(Session::class, 'appointment_id', 'appointment_id');
    }

    public static function boot() {
        parent::boot();
    
        static::deleting(function($appointment) {
            # check if appointment has sessions
            if ($appointment->appointmenttosession()->count() > 0) {
                $appointment->appointmenttosession->delete();
            }
        });
    }

    public $timestamps = true;

}
