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

class Allergies extends Model implements CipherSweetEncrypted
{
    use HasFactory;

    use UsesCipherSweet;

    protected $primaryKey = 'allergy_id';
    protected $table = 'allergy';
    protected $fillable = [
        'allergy_id',
        'patient_id',
        'patient_allergy_cat',
        'patient_allergy_name',
	];

    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addOptionalTextField('patient_allergy_cat')
            ->addOptionalTextField('patient_allergy_name')
            ->addBlindIndex('patient_allergy_cat', new BlindIndex('patient_allergy_cat_index'))
            ->addBlindIndex('patient_allergy_name', new BlindIndex('patient_allergy_name_index'));

    }

    public function allergytopatient() {
        return $this->belongsTo(Patients::class, 'patient_id', 'patient_id');
    }
    
    public $timestamps = true;
}
