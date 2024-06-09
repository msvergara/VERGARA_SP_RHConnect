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

class PrescriptionsBefore extends Model implements CipherSweetEncrypted
{
    use HasFactory;

    use UsesCipherSweet;

    protected $primaryKey = 'session_taken_id';
    protected $table = 'prescription_before';
    protected $fillable = [
        'session_id',
        'session_taken_medname',
        'session_taken_meddose',
        'session_taken_meddate',
        'session_taken_medcat',
	];

    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addOptionalTextField('session_taken_medname')
            ->addOptionalTextField('session_taken_meddose')
            ->addBlindIndex('session_taken_medname', new BlindIndex('session_taken_medname_index'))
            ->addBlindIndex('session_taken_meddose', new BlindIndex('session_taken_meddose_index'));

    }

    public function prescriptionbeforetosession() {
        return $this->belongsTo(Session::class, 'session_id', 'session_id');
    }
    
    public $timestamps = true;
}
