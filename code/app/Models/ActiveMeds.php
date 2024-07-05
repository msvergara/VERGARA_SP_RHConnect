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

class ActiveMeds extends Model implements CipherSweetEncrypted
{
    use HasFactory;

    use UsesCipherSweet;

    protected $primaryKey = 'patient_active_id';
    protected $table = 'active_med';
    protected $fillable = [
        'patient_id',
        'patient_active_condition',
	];

    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addOptionalTextField('patient_active_condition')
            ->addBlindIndex('patient_active_condition', new BlindIndex('patient_active_condition_index'));
    }
    
    public function active_med_to_patient() {
        return $this->belongsTo(Patients::class, 'patient_id', 'patient_id');
    }

    public function prescription_from_active_med() {
        return $this->hasMany(PrescriptionActiveMeds::class, 'patient_active_id', 'patient_active_id');
    }
    
    public $timestamps = true;
}
