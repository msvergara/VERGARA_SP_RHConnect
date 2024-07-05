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

//lalagay if ieencrypt yung table
class Inventory extends Model implements CipherSweetEncrypted

{
    use HasFactory;
    //lagay specify na model na to ay gumagamit ng cypersweet
    use UsesCipherSweet;

    protected $primaryKey = 'resource_id';
    protected $table = 'inventory';
    public $timestamps = true;
    // ito yung mga lalagyan sa db
    protected $fillable = [
        // 'resource_date',
		'resource_name', 
        'resource_category',
        'resource_stocks',
        'resource_notes'
	];

    //set fields to encrypt
    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            //specify yung field na ieencrypt
            ->addField('resource_name')
            ->addOptionalTextField('resource_notes')
            //kapag nageencrypt, pag di nilagyan ng blind index, lalabas
            //na jumbled sa site
            //specify na ito yung idedecrypt pag hinugot na from database
            ->addBlindIndex('resource_name', new BlindIndex('resource_name_index'))
            ->addBlindIndex('resource_notes', new BlindIndex('resource_notes_index'));
    }

    public function transactionfrominventory() {
        return $this->hasMany(Transactions::class, 'resource_id', 'resource_id');
    }

    public static function boot() {
        parent::boot();
    
        static::deleting(function($inventory) {
            foreach ($inventory->transactionfrominventory as $transaction) {
                $transaction->delete();
            }
        });
    }
}
