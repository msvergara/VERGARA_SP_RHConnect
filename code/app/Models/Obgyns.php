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

class Obgyns extends Model implements CipherSweetEncrypted
{
    use HasFactory;

    use UsesCipherSweet;

    protected $primaryKey = 'patient_ob_id';
    protected $table = 'obgyn';
    protected $fillable = [
        'patient_id',
        'patient_ob_name',
	];

    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addOptionalTextField('patient_ob_name')
            ->addBlindIndex('patient_ob_name', new BlindIndex('patient_ob_name_index'));
    }
    
    public function obgyn_to_patient() {
        return $this->belongsTo(Patients::class, 'patient_id', 'patient_id');
    }

    public function prescription_from_obgyn() {
        return $this->hasMany(PrescriptionsObgyn::class, 'patient_ob_id', 'patient_ob_id');
    }
    
    public $timestamps = true;
}
