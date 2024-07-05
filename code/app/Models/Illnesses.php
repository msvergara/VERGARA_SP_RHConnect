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

class Illnesses extends Model implements CipherSweetEncrypted
{
    use HasFactory;
    use UsesCipherSweet;

    protected $primaryKey = 'patient_ill_id';
    protected $table = 'illness';
    protected $fillable = [
        'patient_id',
        'patient_ill_date',
        'patient_ill_name',
        'patient_ill_ssx'
	];

    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addOptionalTextField('patient_ill_name')
            ->addOptionalTextField('patient_ill_ssx')

            ->addBlindIndex('patient_ill_name', new BlindIndex('patient_ill_name_index'))
            ->addBlindIndex('patient_ill_ssx', new BlindIndex('patient_ill_ssx_index'));

    }
    public function illnesstopatient() {
        return $this->belongsTo(Patients::class, 'patient_id', 'patient_id');
    }

    public function prescriptionfromillness() {
        return $this->hasMany(Prescriptions::class, 'patient_cat_id', 'patient_ill_id');
    }
    
    public $timestamps = true;
}
