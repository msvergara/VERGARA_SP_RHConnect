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

class PrescriptionsSession extends Model implements CipherSweetEncrypted
{
    use HasFactory;

    use UsesCipherSweet;

    protected $primaryKey = 'session_order_id';
    protected $table = 'prescription_session';
    protected $fillable = [
        'session_id',
        'session_order_medname',
        'session_order_meddose',
        'session_order_medfreq',
	];

    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addOptionalTextField('session_order_medname')
            ->addOptionalTextField('session_order_meddose')
            ->addOptionalTextField('session_order_medfreq')
            ->addBlindIndex('session_order_medname', new BlindIndex('session_order_medname_index'))
            ->addBlindIndex('session_order_meddose', new BlindIndex('session_order_meddose_index'))
            ->addBlindIndex('session_order_medfreq', new BlindIndex('session_order_medfreq_index'));

    }

    public function prescriptiontosession() {
        return $this->belongsTo(Session::class, 'session_id', 'session_id');
    }
    
    public $timestamps = true;
}
