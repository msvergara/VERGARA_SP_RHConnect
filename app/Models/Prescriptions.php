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

class Prescriptions extends Model implements CipherSweetEncrypted
{
    use HasFactory;

    use UsesCipherSweet;

    protected $primaryKey = 'patient_medid';
    protected $table = 'prescription';
    protected $fillable = [
        'patient_cat_id',
        'patient_medname',
        'patient_meddose',
        'patient_medfreq'
	];

    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addOptionalTextField('patient_medname')
            ->addOptionalTextField('patient_meddose')
            ->addOptionalTextField('patient_medfreq')
            ->addBlindIndex('patient_medname', new BlindIndex('patient_medname_index'))
            ->addBlindIndex('patient_meddose', new BlindIndex('patient_meddose_index'))
            ->addBlindIndex('patient_medfreq', new BlindIndex('patient_medfreq_index'));

    }

    public function prescriptiontoillness() {
        return $this->belongsTo(Illnesses::class, 'patient_cat_id', 'patient_ill_id');
    }
    
    public $timestamps = true;
}
