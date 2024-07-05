<?php

namespace App\Models;

use ParagonIE\CipherSweet\EncryptedRow;
use ParagonIE\CipherSweet\BlindIndex;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_id';
    protected $table = 'inventorytransaction';
    protected $fillable = [
        'resource_id',
        'transaction_cat',
        'transaction_qty',
	];

    public function transactiontoinventory() {
        return $this->belongsTo(Inventory::class, 'resource_id', 'resource_id');
    }
    
    public $timestamps = true;
}
