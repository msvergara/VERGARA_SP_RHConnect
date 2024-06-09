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

class Immunizations extends Model implements CipherSweetEncrypted
{
    use HasFactory;

    use UsesCipherSweet;

    protected $primaryKey = 'patient_immu_id';
    protected $table = 'immunization';
    protected $fillable = [
        'patient_id',
        'patient_immu_date',
        'patient_immu_name',
        'patient_immu_cat',
        'patient_immu_reax'
	];


    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addOptionalTextField('patient_immu_name')
            ->addOptionalTextField('patient_immu_cat')
            ->addOptionalTextField('patient_immu_reax')

            ->addBlindIndex('patient_immu_name', new BlindIndex('patient_immu_name_index'))
            ->addBlindIndex('patient_immu_cat', new BlindIndex('patient_immu_cat_index'))
            ->addBlindIndex('patient_immu_reax', new BlindIndex('patient_immu_reax_index'));

    }

    public function immunizationtopatient() {
        return $this->belongsTo(Patients::class, 'patient_id', 'patient_id');
    }

    
    public $timestamps = true;
}
