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
# implements CipherSweetEncrypted
class Patients extends Model implements CipherSweetEncrypted
{
    use HasFactory;
    //lagay specify na model na to ay gumagamit ng ciphersweet
    use UsesCipherSweet;

    protected $primaryKey = 'patient_id';
    protected $table = 'patient';
    public $timestamps = true;
    // ito yung mga lalagyan sa db
    protected $fillable = [
        // columns for patients / patient details
        'hcworker_id',
        'patient_fname',
		'patient_mname', 
        'patient_lname',
        'patient_extension',
        'patient_sex',
        'patient_birthday',
        'patient_barangay',
        'patient_street',
        'patient_cpnum',
        'patient_bloodtype',
        'patient_ec_lname',
        'patient_ec_fname',
        'patient_ec_mname',
        'patient_ec_extension',
        'patient_ec_cpnum',
        'patient_ec_barangay',
        'patient_ec_street',
        'patient_ec_relationship',
        'patient_period_status',
        'patient_preg_status',
	];

    //set fields to encrypt
    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        $encryptedRow
            ->addOptionalTextField('patient_fname')
            ->addOptionalTextField('patient_mname')
            ->addOptionalTextField('patient_lname')
            // ->addField('patient_birthday')
            // ->addField('patient_barangay')
            ->addOptionalTextField('patient_street')
            ->addOptionalTextField('patient_cpnum')
            ->addOptionalTextField('patient_bloodtype')
            ->addBlindIndex('patient_fname', new BlindIndex('patient_fname_index'))
            ->addBlindIndex('patient_mname', new BlindIndex('patient_mname_index'))
            ->addBlindIndex('patient_lname', new BlindIndex('patient_lname_index'))
            // ->addBlindIndex('patient_birthday', new BlindIndex('patient_birthday_index'))
            // ->addBlindIndex('patient_barangay', new BlindIndex('patient_barangay_index'))
            ->addBlindIndex('patient_street', new BlindIndex('patient_street_index'))
            ->addBlindIndex('patient_cpnum', new BlindIndex('patient_cpnum_index'))
            ->addBlindIndex('patient_bloodtype', new BlindIndex('patient_bloodtype_index'));
    }

    public function hcworker() {
        return $this->belongsTo(User::class, 'hcworker_id', 'id');
    }

    public function appointments() {
        return $this->hasMany(Appointments::class, 'patient_id', 'patient_id');
    }

    public function allergyfrompatient() {
        return $this->hasMany(Allergies::class, 'patient_id', 'patient_id');
    }

    public function illnessfrompatient() {
        return $this->hasMany(Illnesses::class, 'patient_id', 'patient_id');
    }

    public function surgeryfrompatient() {
        return $this->hasMany(Surgeries::class, 'patient_id', 'patient_id');
    }

    public function activemedfrompatient() {
        return $this->hasMany(ActiveMeds::class, 'patient_id', 'patient_id');
    }

    public function immunizationfrompatient() {
        return $this->hasMany(Immunizations::class, 'patient_id', 'patient_id');
    }

    public function obgynfrompatient() {
        return $this->hasMany(Obgyns::class, 'patient_id', 'patient_id');
    }

    public static function boot() {
        parent::boot();
    
        static::deleting(function($session) {
            foreach ($session->appointments as $appointments) {
                $appointments->delete();
            }

            foreach($session->allergyfrompatient as $allergy) {
                $allergy->delete();
            }

            foreach($session->illnessfrompatient as $illness) {
                $illness->delete();
            }

            foreach($session->surgeryfrompatient as $surgery) {
                $surgery->delete();
            }

            foreach($session->activemedfrompatient as $active_med) {
                $active_med->delete();
            }

            foreach($session->immunizationfrompatient as $immu) {
                $immu->delete();
            }

            foreach($session->obgynfrompatient as $obgyn) {
                $obgyn->delete();
            }
        });
    }
}
