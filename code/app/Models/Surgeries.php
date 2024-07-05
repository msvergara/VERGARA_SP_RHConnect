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

class Surgeries extends Model implements CipherSweetEncrypted
{
    use HasFactory;

    use UsesCipherSweet;

    protected $primaryKey = 'patient_surg_id';
    protected $table = 'surgery';
    protected $fillable = [
        'patient_surg_id',
        'patient_id',
        'patient_surg_date',
        'patient_surg_name',
        'patient_surg_comp'
	];

    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addOptionalTextField('patient_surg_name')
            ->addOptionalTextField('patient_surg_comp')
            ->addBlindIndex('patient_surg_name', new BlindIndex('patient_surg_name_index'))
            ->addBlindIndex('patient_surg_comp', new BlindIndex('patient_surg_comp_index'));
    }
    

    public function surgerytopatient() {
        return $this->belongsTo(Patients::class, 'patient_id', 'patient_id');
    }

    
    public $timestamps = true;
}
