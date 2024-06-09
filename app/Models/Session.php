<?php

namespace App\Models;

//insert here to encrypt
use ParagonIE\CipherSweet\EncryptedRow;
use ParagonIE\CipherSweet\BlindIndex;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
//end here

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model implements CipherSweetEncrypted
{
    use HasFactory;

    use UsesCipherSweet;

    protected $primaryKey = 'session_id';
    protected $table = 'session';
    protected $fillable = [
        'appointment_id',
		'session_px_bp', 
        'session_px_temperature',
        'session_px_respiratoryrate',
        'session_px_heartrate',
        'session_px_oxygensat',
        'session_px_height',
        'session_px_weight',
        'session_complaint',
        'session_findings',
        'session_treatment',
        // 'session_order'
	];

    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addOptionalTextField('session_px_bp')
            ->addOptionalTextField('session_px_temperature')
            ->addOptionalTextField('session_px_respiratoryrate')
            ->addOptionalTextField('session_px_heartrate')
            ->addOptionalTextField('session_px_oxygensat')
            ->addOptionalTextField('session_px_height')
            ->addOptionalTextField('session_px_weight')
            ->addOptionalTextField('session_complaint')
            ->addOptionalTextField('session_findings')
            ->addOptionalTextField('session_treatment')
            ->addBlindIndex('session_px_bp', new BlindIndex('session_px_bp_index'))
            ->addBlindIndex('session_px_temperature', new BlindIndex('session_px_temperature_index'))
            ->addBlindIndex('session_px_respiratoryrate', new BlindIndex('session_px_respiratoryrate_index'))
            ->addBlindIndex('session_px_heartrate', new BlindIndex('session_px_heartrate_index'))
            ->addBlindIndex('session_px_oxygensat', new BlindIndex('session_px_oxygensat_index'))
            ->addBlindIndex('session_px_height', new BlindIndex('session_px_height_index'))
            ->addBlindIndex('session_px_weight', new BlindIndex('session_px_weight_index'))
            ->addBlindIndex('session_complaint', new BlindIndex('session_complaint_index'))
            ->addBlindIndex('session_findings', new BlindIndex('session_findings_index'))
            ->addBlindIndex('session_treatment', new BlindIndex('session_treatment_index'));
    }

    public function sessiontoappointment() {
        return $this->belongsTo(Appointments::class, 'appointment_id', 'appointment_id');
    }

    public function prescriptionfromsession() {
        return $this->hasMany(PrescriptionsSession::class, 'session_id', 'session_id');
    }

    public function prescriptionbeforefromsession() {
        return $this->hasMany(PrescriptionsBefore::class, 'session_id', 'session_id');
    }

    public static function boot() {
        parent::boot();
    
        static::deleting(function($session) {
            foreach ($session->prescriptionbeforefromsession as $med_taken) {
                $med_taken->delete();
            }

            foreach($session->prescriptionfromsession as $med_order) {
                $med_order->delete();
            }
        });
    }

    public $timestamps = true;

}
