<?php

namespace App\Http\Controllers;

use App\Models\ActiveMeds;
use App\Models\Allergies;
use App\Models\Appointments;
use App\Models\Barangays;
use App\Models\Illnesses;
use App\Models\Immunizations;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Obgyns;
use App\Models\Patients;
use App\Models\PrescriptionActiveMeds;
use App\Models\Prescriptions;
use App\Models\PrescriptionsBefore;
use App\Models\PrescriptionsObgyn;
use App\Models\PrescriptionsSession;
use App\Models\Session;
use App\Models\Surgeries;
use App\Models\Transactions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
// ANALYTICS____________________________________________________________________________
	public function dashboard(Request $request) {
        if(Auth::check()){
            $data = User::orderBy('created_at', 'desc')->get();

			$year = date('Y');
			
			if ($request->input('analytics-year')) {
				$year = $request->input('analytics-year');
			}
			
            # patient sex count
            $sc_male = Patients::where('patient_sex', 'Male')->whereYear('created_at', $year)->count();
            $sc_female = Patients::where('patient_sex', 'Female')->whereYear('created_at', $year)->count();
            $sc_data = collect([
                'male' => $sc_male, 
                'female' => $sc_female
            ]);
            $sc_data->toArray();

			$new_January = Patients::whereMonth('created_at', 1)->whereYear('created_at', $year)->count();
            $new_February = Patients::whereMonth('created_at', 2)->whereYear('created_at', $year)->count();
            $new_March = Patients::whereMonth('created_at', 3)->whereYear('created_at', $year)->count();
            $new_April = Patients::whereMonth('created_at', 4)->whereYear('created_at', $year)->count();
            $new_May = Patients::whereMonth('created_at', 5)->whereYear('created_at', $year)->count();
            $new_June = Patients::whereMonth('created_at', 6)->whereYear('created_at', $year)->count();
            $new_July = Patients::whereMonth('created_at', 7)->whereYear('created_at', $year)->count();
            $new_August = Patients::whereMonth('created_at', 8)->whereYear('created_at', $year)->count();
            $new_September = Patients::whereMonth('created_at', 9)->whereYear('created_at', $year)->count();
            $new_October = Patients::whereMonth('created_at', 10)->whereYear('created_at', $year)->count();
            $new_November = Patients::whereMonth('created_at', 11)->whereYear('created_at', $year)->count();
            $new_December = Patients::whereMonth('created_at', 12)->whereYear('created_at', $year)->count();

            $new_px_count = collect([
                'january' => $new_January,
                'february' => $new_February,
                'march' => $new_March,
                'april' => $new_April,
                'may' => $new_May,
                'june' => $new_June,
                'july' => $new_July,
                'august' => $new_August,
                'september' => $new_September,
                'october' => $new_October,
                'november' => $new_November,
                'december' => $new_December,
            ]);
            $new_px_count->toArray();

            $treatment_January = Session::whereMonth('created_at', 1)->whereYear('created_at', $year)->count();
            $treatment_February = Session::whereMonth('created_at', 2)->whereYear('created_at', $year)->count();
            $treatment_March = Session::whereMonth('created_at', 3)->whereYear('created_at', $year)->count();
            $treatment_April = Session::whereMonth('created_at', 4)->whereYear('created_at', $year)->count();
            $treatment_May = Session::whereMonth('created_at', 5)->whereYear('created_at', $year)->count();
            $treatment_June = Session::whereMonth('created_at', 6)->whereYear('created_at', $year)->count();
            $treatment_July = Session::whereMonth('created_at', 7)->whereYear('created_at', $year)->count();
            $treatment_August = Session::whereMonth('created_at', 8)->whereYear('created_at', $year)->count();
            $treatment_September = Session::whereMonth('created_at', 9)->whereYear('created_at', $year)->count();
            $treatment_October = Session::whereMonth('created_at', 10)->whereYear('created_at', $year)->count();
            $treatment_November = Session::whereMonth('created_at', 11)->whereYear('created_at', $year)->count();
            $treatment_December = Session::whereMonth('created_at', 12)->whereYear('created_at', $year)->count();

            $treatment_count = collect([
                'january' => $treatment_January,
                'february' => $treatment_February,
                'march' => $treatment_March,
                'april' => $treatment_April,
                'may' => $treatment_May,
                'june' => $treatment_June,
                'july' => $treatment_July,
                'august' => $treatment_August,
                'september' => $treatment_September,
                'october' => $treatment_October,
                'november' => $treatment_November,
                'december' => $treatment_December,
            ]);
            $treatment_count->toArray();

            $brgy_pob1 = Patients::where('patient_barangay', 'Poblacion I')->whereYear('created_at', $year)->count();
            $brgy_pob2 = Patients::where('patient_barangay', 'Poblacion II')->whereYear('created_at', $year)->count();
            $brgy_pob3 = Patients::where('patient_barangay', 'Poblacion III')->whereYear('created_at', $year)->count();
            $brgy_pob4 = Patients::where('patient_barangay', 'Poblacion IV')->whereYear('created_at', $year)->count();
            $brgy_betania = Patients::where('patient_barangay', 'Betania')->whereYear('created_at', $year)->count();
            $brgy_canantong = Patients::where('patient_barangay', 'Canantong')->whereYear('created_at', $year)->count();
            $brgy_nauzon = Patients::where('patient_barangay', 'Nauzon')->whereYear('created_at', $year)->count();
            $brgy_pinagbayanan = Patients::where('patient_barangay', 'Pinagbayanan')->whereYear('created_at', $year)->count();
            $brgy_sagana = Patients::where('patient_barangay', 'Sagana')->whereYear('created_at', $year)->count();
            $brgy_santonio = Patients::where('patient_barangay', 'San Antonio')->whereYear('created_at', $year)->count();
            $brgy_sfelipe = Patients::where('patient_barangay', 'San Felipe')->whereYear('created_at', $year)->count();
            $brgy_sisidro = Patients::where('patient_barangay', 'San Isidro')->whereYear('created_at', $year)->count();
            $brgy_sjosep = Patients::where('patient_barangay', 'San Josep')->whereYear('created_at', $year)->count();
            $brgy_sjuan = Patients::where('patient_barangay', 'San Juan')->whereYear('created_at', $year)->count();
            $brgy_svicente = Patients::where('patient_barangay', 'San Vicente')->whereYear('created_at', $year)->count();
            $brgy_siclong = Patients::where('patient_barangay', 'Siclong')->whereYear('created_at', $year)->count();

			$brgy_count = collect([
                'Poblacion I' => $brgy_pob1, 
                'Poblacion II' => $brgy_pob2,
                'Poblacion III' => $brgy_pob3,
                'Poblacion IV' => $brgy_pob4,
                'Betania' => $brgy_betania,
                'Canantong' => $brgy_canantong,
                'Nauzon' => $brgy_nauzon,
                'Pinagbayanan' => $brgy_pinagbayanan,
                'Sagana' => $brgy_sagana,
                'San Antonio' => $brgy_santonio,
                'San Felipe' => $brgy_sfelipe,
                'San Isidro' => $brgy_sisidro,
                'San Josep' => $brgy_sjosep,
                'San Juan' => $brgy_sjuan,
                'San Vicente' => $brgy_svicente,
                'Siclong' => $brgy_siclong,
            ]);
            $brgy_count->toArray();

            return view('pages.dashboard', ['data' => $data, 'sc_data' => $sc_data, 'new_px_count' => $new_px_count, 'treatment_count' => $treatment_count, 'brgy_count' => $brgy_count]);
        } else {
            return redirect("/")->withSuccess('Access denied.');
        }        
    }

// PERSONNEL____________________________________________________________________________

	// 
	// READ
	public function personnel_view(){
        if (Auth::check()) {

			$personnel = User::get();

            return view('pages.personnel.viewpersonnellist', ['personneldata'=>$personnel]);
        } else {
            return view('pages.login');
        }
    }
	// CREATE
    public function personnel_create(Request $request){
		if (Auth::check()) {
			if($request->isMethod('post')){

				try{
					$data = User::create([
						'fname' => $request->input('fname'),
						'lname' => $request->input('lname'),
						'email' => $request->input('email'),
						'password' => Hash::make($request->input('password')),
						'roles' => $request->input('roles'),					
					]); 

					// $data = User::create(array_merge($request->all()));
				
					if ($data) {
						$request->session()->flash('alert-success', 'Success! Entry successfully created.');
						return redirect()->route('pages.personnel.viewpersonnellist');
					} else {
						$request->session()->flash('alert-danger', 'Something went wrong. Entry creation failed.');
						return view('pages.personnel.createpersonnel');
					}
				}
				catch(Exception $e){
					return redirect()->route('pages.personnel.viewpersonnellist')->with('failed',"operation failed");
				}
			}else{
				return view('pages.personnel.createpersonnel');
			}
			
        } else {
            return view('pages.login');
		}

    }
	// UPDATE
	public function personnel_edit(Request $request, int $id = NULL){
		if (Auth::check()) {
			if($request->isMethod('POST')){

				try{
					$data = User::find($id);
	
					$data->fname = $request->input("fname");
					$data->lname = $request->input("lname");
					$data->email = $request->input("email");
					// $data->password = Hash::make($request->input("password"));
					// $data->roles = $request->input("roles");
	
					$data->update();
	
					return redirect()->route('pages.personnel.viewpersonnellist')->with('success',"Successfully Edited");                
	
				}catch(Exception $e){
					return redirect()->route('pages.personnel.viewpersonnellist')->with('failed',"Unsuccessfully Edited");
				}
			}
			else{
				$data = User::find($id);
				return view('pages.personnel.editpersonnel',['personneldata'=>$data]);            
			}
		} else {
			return view('pages.login');
		}
    }
	// DELETE
	public function personnel_delete(int $id = NULL){
		if (Auth::check()) {
			try{
				$data = User::where('id',$id)->first();
	
				$data->delete();
	
				if ($data){
					return redirect()->route('pages.personnel.viewpersonnellist')->with('success',"Successfully Deleted");
				}
				else{
					return redirect()->route('pages.personnel.viewpersonnellist')->with('failed',"Unsuccessfully Deleted");
				}
			}
			catch(Exception $e){
				return redirect()->route('pages.personnel.viewpersonnellist')->with('failed',"Unsuccessfully Deleted");
			}
		} else {
			return view('pages.login');
		}
    }

// PATIENT______________________________________________________________________________
	// READ
	public function patient_view(){
        if (Auth::check()) {

			$patient = Patients::get();
            return view('pages.patient.viewpatientlist', ['patientdata'=>$patient]);
        } else {
            return view('pages.login');
        }
    }

    public function patient_create(Request $request){
		if (Auth::check()) {
			if($request->isMethod('post')){
				try{
					$patient_data = [
						'patient_fname' => $request->input('patient_fname'),
						'patient_mname' => $request->input('patient_mname'),
						'patient_lname' => $request->input('patient_lname'),
						'patient_extension' => $request->input('patient_extension'),
						'patient_sex' => $request->input('patient_sex'),
						'patient_birthday' => $request->input('patient_birthday'),
						'patient_barangay' => $request->input('patient_barangay'),
						'patient_street' => $request->input('patient_street'),
						'patient_cpnum' => $request->input('patient_cpnum'),
						'hcworker_id' => Auth::user()->id,
						'patient_bloodtype' => $request->input('patient_bloodtype'),
						'patient_ec_lname' => $request->input('patient_ec_lname'),
						'patient_ec_fname' => $request->input('patient_ec_fname'),
						'patient_ec_mname' => $request->input('patient_ec_mname'),
						'patient_ec_extension' => $request->input('patient_ec_extension'),
						'patient_ec_cpnum' => $request->input('patient_ec_cpnum'),
						'patient_ec_barangay' => $request->input('patient_ec_barangay'),	
						'patient_ec_street' => $request->input('patient_ec_street'),
						'patient_ec_relationship' => $request->input('patient_ec_relationship'),
						'patient_period_status' => $request->input('patient_period_status'),
						'patient_preg_status' => $request->input('patient_preg_status'),
					];

					$patient = Patients::create($patient_data);

					$allergy_data = [];
					if ($request->input('patient_allergy_name') > 0) {
						for($i = 0; $i < count($request->input('patient_allergy_name')); $i++) {
							$allergy_data[] = ([
								'patient_allergy_cat' => $request->input('patient_allergy_cat')[$i],
								'patient_allergy_name' => $request->input('patient_allergy_name')[$i]
							]);
						}
					}
				
					$allergy = $patient->allergyfrompatient()->createMany($allergy_data);

					$illness_data = [];
					if ($request->input('col_parent_illness_row_count') > 0) {
						for ($i = 0; $i < count($request->input('patient_ill_name')); $i++) {
							$illness_data[] = ([
								'patient_id' => $patient->patient_id,
								'patient_ill_date' => $request->input('patient_ill_date')[$i],
								'patient_ill_name' => $request->input('patient_ill_name')[$i],
								'patient_ill_ssx' => $request->input('patient_ill_ssx')[$i]
							]);
	
							$prescription_data = [];
							if ($request->input('col_parent_illness_row_count') > 0) {
								for ($j = 0; $j < $request->input('col_child_ill_med_row_count')[$i]; $j++) {
									$prescription_data[] = array(
										'patient_medname' => $request->input('patient_medname_' . ($i + 1))[$j],
										'patient_meddose' => $request->input('patient_meddose_' . ($i + 1))[$j],
										'patient_medfreq' => $request->input('patient_medfreq_' . ($i + 1))[$j]
									);
								}
							}
	
							$illness = Illnesses::create($illness_data[$i]);
							$prescription = $illness->prescriptionfromillness()->createMany($prescription_data);
						}
					}

					$surgery_data = [];
					if ($request->input('patient_surg_name') > 0) {
						for($i = 0; $i < count($request->input('patient_surg_name')); $i++) {
							$surgery_data[] = ([
								'patient_surg_date' => $request->input('patient_surg_date')[$i],
								'patient_surg_name' => $request->input('patient_surg_name')[$i],
								'patient_surg_comp' => $request->input('patient_surg_comp')[$i]
							]);
						}
					}
				
					$surgery = $patient->surgeryfrompatient()->createMany($surgery_data);
					
					$obgyn_data = [];
					if ($request->input('col_obgyn_cond_row_count') > 0) {
						for ($i = 0; $i < count($request->input('patient_obgyn_cond_name')); $i++) {
							$obgyn_data[] = ([
								'patient_id' => $patient->patient_id,
								'patient_ob_name' => $request->input('patient_obgyn_cond_name')[$i]
							]);
	
							$prescription_data = [];
							if ($request->input('col_obgyn_cond_row_count') > 0) {
								for ($j = 0; $j < $request->input('col_child_obgyn_med_row_count')[$i]; $j++) {
									$prescription_data[] = array(
										'patient_medname' => $request->input('patient_obgyn_medname_' . ($i + 1))[$j],
										'patient_meddose' => $request->input('patient_obgyn_meddose_' . ($i + 1))[$j],
										'patient_medfreq' => $request->input('patient_obgyn_medfreq_' . ($i + 1))[$j]
									); 
								}
							}
	
							$obgyn = Obgyns::create($obgyn_data[$i]);
							$prescription = $obgyn->prescription_from_obgyn()->createMany($prescription_data);
						}
					}

					$active_med_data = [];
					if ($request->input('col_active_med_row_count') > 0) {
						for ($i = 0; $i < count($request->input('patient_active_med_name')); $i++) {
							$active_med_data[] = ([
								'patient_id' => $patient->patient_id,
								'patient_active_condition' => $request->input('patient_active_med_name')[$i]
							]);
	
							$prescription_data = [];
							if ($request->input('col_active_med_row_count') > 0) {
								for ($j = 0; $j < $request->input('col_child_active_med_row_count')[$i]; $j++) {
									$prescription_data[] = array(
										'patient_medname' => $request->input('patient_active_med_medname_' . ($i + 1))[$j],
										'patient_meddose' => $request->input('patient_active_med_meddose_' . ($i + 1))[$j],
										'patient_medfreq' => $request->input('patient_active_med_medfreq_' . ($i + 1))[$j]
									);
								}
							}
	
							$active_med = ActiveMeds::create($active_med_data[$i]);
							$prescription = $active_med->prescription_from_active_med()->createMany($prescription_data);
						}
					}

					$immunization_data = [];
					if ($request->input('patient_immu_name') > 0) {
						for($i = 0; $i < count($request->input('patient_immu_name')); $i++) {
							$immunization_data[] = ([
								'patient_immu_date' => $request->input('patient_immu_date')[$i],
								'patient_immu_name' => $request->input('patient_immu_name')[$i],
								'patient_immu_cat' => $request->input('patient_immu_cat')[$i],
								'patient_immu_reax' => $request->input('patient_immu_reax')[$i]
							]);
						}
					}
				
					$immunization = $patient->immunizationfrompatient()->createMany($immunization_data);

					session()->flash('alert-success', 'Success! Entry successfully created.');
					return redirect()->route('pages.patient.viewpatientlist');
				} catch(Exception $e){
					session()->flash('alert-danger', 'Something went wrong. Entry creation failed.');
					return redirect()->route('pages.patient.viewpatientlist');
				}
			}else{
				$barangay_list = Barangays::all();
				return view('pages.patient.createpatient', ['barangay_list' => $barangay_list]);
			}
			
        } else {
            return view('pages.login');
		}

    }

	public function patient_update(Request $request, $patient_id = null){
		if (Auth::check()) {
			if($request->isMethod('POST')){
				try{
					$id = $request->input('id');
                    $patient = Patients::where('patient_id', $id)->first();

					$patient_data = [
						'patient_fname' => $request->input('patient_fname'),
						'patient_mname' => $request->input('patient_mname'),
						'patient_lname' => $request->input('patient_lname'),
						'patient_extension' => $request->input('patient_extension'),
						'patient_sex' => $request->input('patient_sex'),
						'patient_birthday' => $request->input('patient_birthday'),
						'patient_barangay' => $request->input('patient_barangay'),
						'patient_street' => $request->input('patient_street'),
						'patient_cpnum' => $request->input('patient_cpnum'),
						'hcworker_id' => Auth::user()->id,
						'patient_bloodtype' => $request->input('patient_bloodtype'),
						'patient_ec_lname' => $request->input('patient_ec_lname'),
						'patient_ec_fname' => $request->input('patient_ec_fname'),
						'patient_ec_mname' => $request->input('patient_ec_mname'),
						'patient_ec_extension' => $request->input('patient_ec_extension'),
						'patient_ec_cpnum' => $request->input('patient_ec_cpnum'),
						'patient_ec_barangay' => $request->input('patient_ec_barangay'),	
						'patient_ec_street' => $request->input('patient_ec_street'),
						'patient_ec_relationship' => $request->input('patient_ec_relationship'),
						'patient_period_status' => $request->input('patient_period_status'),
						'patient_preg_status' => $request->input('patient_preg_status'),
					];

					Patients::updateOrCreate([
						'patient_id' => $id
					], $patient_data);

					$allergy_data = [];
					if ($request->input('patient_allergy_name') > 0) {
						for($i = 0; $i < count($request->input('patient_allergy_name')); $i++) {
							$allergy_data[] = ([
								'patient_id' => $id,
								'patient_allergy_cat' => $request->input('patient_allergy_cat')[$i],
								'patient_allergy_name' => $request->input('patient_allergy_name')[$i]
							]);

							Allergies::updateOrCreate([
                                'allergy_id' => $request->input('patient_allergy_id')[$i]
                             ], $allergy_data[$i]);

							 # delete entries removed by delete button
							 Allergies::where('patient_id', '=', $id)->whereNotIn('allergy_id', $request->input('patient_allergy_id'))->delete();
						}
					} else {
						# delete all entries
						Allergies::where('patient_id', '=', $id)->delete();
					}

					// dd($allergy_data);

					$illness_data = [];
					$illness_tbd = array_map('trim', explode(',', $request->input('col_illness_tbd')));
					if ($request->input('col_parent_illness_row_count') > 0) {
						for ($i = 0; $i < $request->input('col_parent_illness_row_count'); $i++) {
							$illness_data[] = ([
								'patient_id' => $patient->patient_id,
								'patient_ill_date' => $request->input('patient_ill_date')[$i],
								'patient_ill_name' => $request->input('patient_ill_name')[$i],
								'patient_ill_ssx' => $request->input('patient_ill_ssx')[$i]
							]);
	
							$illness = Illnesses::updateOrCreate([
                            	'patient_ill_id' => $request->input('patient_ill_id')[$i]
                            ], $illness_data[$i]);

							# delete batch
							foreach ($illness_tbd as $ill_tbd) {
								$prescription = Prescriptions::where('patient_cat_id', '=', $ill_tbd)->get();
								if ($prescription) {
									Prescriptions::where('patient_cat_id', '=', $ill_tbd)->delete();
								}
								Illnesses::where('patient_id', '=', $id)->where('patient_ill_id', '=', $ill_tbd)->delete();
							}

							$prescription_illness_data = [];
							if ($request->input('col_child_ill_med_row_count')[$i] > 0) {
								for ($j = 0; $j < $request->input('col_child_ill_med_row_count')[$i]; $j++) {
									if ($request->has('patient_medid_' . $request->input('child_ill_med_id')[$i])) {
										$prescription_illness_data[] = ([
											'patient_medname' => $request->input('patient_medname_' . $request->input('child_ill_med_id')[$i])[$j],
											'patient_meddose' => $request->input('patient_meddose_' . $request->input('child_ill_med_id')[$i])[$j],
											'patient_medfreq' => $request->input('patient_medfreq_' . $request->input('child_ill_med_id')[$i])[$j]
										]);

										$illness->prescriptionfromillness()->updateOrCreate([
											'patient_medid' => $request->input('patient_medid_' . $request->input('child_ill_med_id')[$i])[$j]
										], $prescription_illness_data[$j]);

										# delete medications (single)
										$illness->prescriptionfromillness()->whereNotIn('patient_medid', $request->input('patient_medid_' . $request->input('child_ill_med_id')[$i]))->delete();
									}
								}
							} else {
								# delete medications if only one remains
								Prescriptions::where('patient_cat_id', '=', $request->input('patient_ill_id')[$i])->delete();
							}
						}
					} else {
						# delete all entries
						Prescriptions::whereNotNull('patient_medid')->delete();
                        Illnesses::where('patient_id', '=', $id)->delete();
					}

					$surgery_data = [];
					if ($request->input('patient_surg_name') > 0) {
						for($i = 0; $i < count($request->input('patient_surg_name')); $i++) {
							$surgery_data[] = ([
								'patient_id' => $id,
								'patient_surg_date' => $request->input('patient_surg_date')[$i],
								'patient_surg_name' => $request->input('patient_surg_name')[$i],
								'patient_surg_comp' => $request->input('patient_surg_comp')[$i]
							]);

							Surgeries::updateOrCreate([
                                'patient_surg_id' => $request->input('patient_surg_id')[$i]
                             ], $surgery_data[$i]);

							 # delete entries removed by delete button
							 Surgeries::where('patient_id', '=', $id)->whereNotIn('patient_surg_id', $request->input('patient_surg_id'))->delete();
						}
					} else {
						# delete all entries
						Surgeries::where('patient_id', '=', $id)->delete();
					}
					
					$obgyn_data = [];
					$obgyn_tbd = array_map('trim', explode(',', $request->input('col_obgyn_tbd')));
					if ($request->input('col_obgyn_cond_row_count') > 0) {
						for ($i = 0; $i < $request->input('col_obgyn_cond_row_count'); $i++) {
							$obgyn_data[] = ([
								'patient_id' => $patient->patient_id,
								'patient_ob_name' => $request->input('patient_obgyn_cond_name')[$i]
							]);
	
							$obgyn = Obgyns::updateOrCreate([
                            	'patient_ob_id' => $request->input('patient_obgyn_id')[$i]
                            ], $obgyn_data[$i]);

							# delete batch
							foreach ($obgyn_tbd as $o_tbd) {
								$prescription_obgyn = PrescriptionsObgyn::where('patient_ob_id', '=', $o_tbd)->get();
								if ($prescription_obgyn) {
									PrescriptionsObgyn::where('patient_ob_id', '=', $o_tbd)->delete();
								}
								Obgyns::where('patient_id', '=', $id)->where('patient_ob_id', '=', $o_tbd)->delete();
							}

							$prescription_obgyn_data = [];
							if ($request->input('col_child_obgyn_med_row_count')[$i] > 0) {
								for ($j = 0; $j < $request->input('col_child_obgyn_med_row_count')[$i]; $j++) {
									if ($request->has('patient_obgyn_medid_' . $request->input('child_obgyn_med_id')[$i])) {
										$prescription_obgyn_data[] = ([
											'patient_medname' => $request->input('patient_obgyn_medname_' . $request->input('child_obgyn_med_id')[$i])[$j],
											'patient_meddose' => $request->input('patient_obgyn_meddose_' . $request->input('child_obgyn_med_id')[$i])[$j],
											'patient_medfreq' => $request->input('patient_obgyn_medfreq_' . $request->input('child_obgyn_med_id')[$i])[$j]
										]);

										$obgyn->prescription_from_obgyn()->updateOrCreate([
											'patient_medid' => $request->input('patient_obgyn_medid_' . $request->input('child_obgyn_med_id')[$i])[$j]
										], $prescription_obgyn_data[$j]);

										# delete medications (single)
										$obgyn->prescription_from_obgyn()->whereNotIn('patient_medid', $request->input('patient_obgyn_medid_' . $request->input('child_obgyn_med_id')[$i]))->delete();
									}
								}
							} else {
								# delete medications if only one remains
								PrescriptionsObgyn::where('patient_ob_id', '=', $request->input('patient_obgyn_id')[$i])->delete();
							}
						}
					} else {
						# delete all entries
						PrescriptionsObgyn::whereNotNull('patient_medid')->delete();
                        Obgyns::where('patient_id', '=', $id)->delete();
					}

					$active_med_data = [];
					$active_med_tbd = array_map('trim', explode(',', $request->input('col_active_med_tbd')));
					if ($request->input('col_active_med_row_count') > 0) {
						for ($i = 0; $i < $request->input('col_active_med_row_count'); $i++) {
							$active_med_data[] = ([
								'patient_id' => $patient->patient_id,
								'patient_active_condition' => $request->input('patient_active_med_name')[$i]
							]);
	
							$active_med = ActiveMeds::updateOrCreate([
                            	'patient_active_id' => $request->input('patient_active_med_id')[$i]
                            ], $active_med_data[$i]);

							# delete batch
							foreach ($active_med_tbd as $ac_tbd) {
								$prescription_active_med = PrescriptionActiveMeds::where('patient_active_id', '=', $ac_tbd)->get();
								if ($prescription_active_med) {
									PrescriptionActiveMeds::where('patient_active_id', '=', $ac_tbd)->delete();
								}
								ActiveMeds::where('patient_id', '=', $id)->where('patient_active_id', '=', $ac_tbd)->delete();
							}

							$prescription_active_med_data = [];
							if ($request->input('col_child_active_med_row_count')[$i] > 0) {
								for ($j = 0; $j < $request->input('col_child_active_med_row_count')[$i]; $j++) {
									if ($request->has('patient_active_med_medid_' . $request->input('child_active_med_id')[$i])) {
										$prescription_active_med_data[] = ([
											'patient_medname' => $request->input('patient_active_med_medname_' . $request->input('child_active_med_id')[$i])[$j],
											'patient_meddose' => $request->input('patient_active_med_meddose_' . $request->input('child_active_med_id')[$i])[$j],
											'patient_medfreq' => $request->input('patient_active_med_medfreq_' . $request->input('child_active_med_id')[$i])[$j]
										]);

										$active_med->prescription_from_active_med()->updateOrCreate([
											'patient_medid' => $request->input('patient_active_med_medid_' . $request->input('child_active_med_id')[$i])[$j]
										], $prescription_active_med_data[$j]);

										# delete medications (single)
										$active_med->prescription_from_active_med()->whereNotIn('patient_medid', $request->input('patient_active_med_medid_' . $request->input('child_active_med_id')[$i]))->delete();
									}
								}
							} else {
								# delete medications if only one remains
								PrescriptionActiveMeds::where('patient_active_id', '=', $request->input('patient_active_med_id')[$i])->delete();
							}
						}
					} else {
						# delete all entries
						PrescriptionActiveMeds::whereNotNull('patient_medid')->delete();
                        ActiveMeds::where('patient_id', '=', $id)->delete();
					}

					$immunization_data = [];
					if ($request->input('patient_immu_name') > 0) {
						for($i = 0; $i < count($request->input('patient_immu_name')); $i++) {
							$immunization_data[] = ([
								'patient_id' => $id,
								'patient_immu_date' => $request->input('patient_immu_date')[$i],
								'patient_immu_name' => $request->input('patient_immu_name')[$i],
								'patient_immu_cat' => $request->input('patient_immu_cat')[$i],
								'patient_immu_reax' => $request->input('patient_immu_reax')[$i]
							]);

							Immunizations::updateOrCreate([
                                'patient_immu_id' => $request->input('patient_immu_id')[$i]
                             ], $immunization_data[$i]);

							 # delete entries removed by delete button
							 Immunizations::where('patient_id', '=', $id)->whereNotIn('patient_immu_id', $request->input('patient_immu_id'))->delete();
						}
					} else {
						# delete all entries
						Immunizations::where('patient_id', '=', $id)->delete();
					}

					session()->flash('alert-success', 'Success! Entry successfully updated.');
					return redirect()->route('pages.patient.viewpatientlist');
				} catch(Exception $e){
					$error = sprintf('[%s],[%d] ERROR:[%s]', __METHOD__, $e->getLine(), json_encode($e->getMessage(), true));
        			Log::error($error);
					session()->flash('alert-danger', 'Something went wrong. '. $error);
					return redirect()->route('pages.patient.viewpatientlist');
				}			
			}else{
				$id = $request->patient_id;
				$data = Patients::where('patient_id', $id)->first();
				$barangay_list = Barangays::all();
				# Y-m-d\TH:i -> this works with datetime-local format fields
				$dob = date('Y-m-d', strtotime($data->patient_birthday));
				return view('pages.patient.updatepatient', ['data' => $data, 'barangay_list' => $barangay_list, 'patient_id' => $id, 'dob' => $dob]);
			}
		} else {
			return view('pages.login');
		}
    }

	// DELETE
	public function patient_delete($patient_id = NULL){
		if (Auth::check()) {
			try{
				$appointment_data = Appointments::with('appointmenttosession')
				->where('patient_id', $patient_id)->get();

				foreach($appointment_data as $appointment) {
					# each delete from the collection
					# will be passed to the deleting() function on the session model
					$appointment->delete();
				}

				$data = Patients::with('appointments')
				->with('allergyfrompatient')
				->with('illnessfrompatient')
				->with('surgeryfrompatient')
				->with('activemedfrompatient')
				->with('immunizationfrompatient')
				->with('obgynfrompatient')
				->where('patient_id', $patient_id)
				->get();

				foreach($data as $patient) {
					# each delete from the collection
					# will be passed to the deleting() function on the session model
					$patient->delete();
				}
	
				session()->flash('alert-sucess', 'Sucess! Patient deleted successfully.');
				return redirect()->route('pages.patient.viewpatientlist');
			} catch(Exception $e){
				$error = sprintf('[%s],[%d] ERROR:[%s]', __METHOD__, $e->getLine(), json_encode($e->getMessage(), true));
				Log::error($error);
				session()->flash('alert-danger', 'Something went wrong. '. $error);
				// session()->flash('alert-danger', 'Sorry. Something went wrong.');
				return redirect()->route('pages.patient.viewpatientlist');
			}
		} else {
			return view('pages.login');
		}
    }

	// INDIVIDUAL VIEW
	public function patient_indivview(Request $request, int $patient_id = NULL){
		if (Auth::check()) {
			if($request->isMethod('POST')){

				try{
					$data = Patients::find($patient_id)->get();
	
					return redirect()->route('pages.patient.indivviewpatient')->with('success',"Successfully Edited");                
	
				}catch(Exception $e){
					return redirect()->route('pages.patient.indivviewpatient')->with('failed',"Unsuccessfully Edited");
				}
			}
			else{
				$indivdata = Patients::find($patient_id);
				$sessiondata = Session::all();
				$allergydata = Allergies::where('patient_id', '=', $indivdata->patient_id)->get();
				$illnessdata = Illnesses::where('patient_id', '=', $indivdata->patient_id)->get();
				$illprescdata = Prescriptions::all();
				$surgerydata = Surgeries::where('patient_id', '=', $indivdata->patient_id)->get();
				$obgyndata = Obgyns::where('patient_id', '=', $indivdata->patient_id)->get();
				$obprescdata = PrescriptionsObgyn::all();
				$activedata = ActiveMeds::where('patient_id', '=', $indivdata->patient_id)->get();
				$actprescdata = PrescriptionActiveMeds::all();
				$immunodata = Immunizations::where('patient_id', '=', $indivdata->patient_id)->get();
				return view('pages.patient.indivviewpatient',['indivdata'=>$indivdata],['sessiondata'=>$sessiondata, 'allergydata'=>$allergydata, 'surgerydata'=>$surgerydata, 'illnessdata'=>$illnessdata, 'illprescdata'=>$illprescdata, 'obgyndata'=>$obgyndata, 'obprescdata'=>$obprescdata, 'activedata'=>$activedata, 'actprescdata'=>$actprescdata, 'immunodata'=>$immunodata]);            
			}
		} else {
			return view('pages.login');
		}
    }

// ADMISSIONS SCHEDULE__________________________________________________________________
	public function admissions_view(){
        if (Auth::check()) {
			$data = Appointments::all();
            return view('pages.admissions.view', ['data'=>$data]);
        } else {
            return view('pages.login');
        }
    }	

	// CREATE
	public function admissions_create(Request $request){
		if (Auth::check()) {
			if($request->isMethod('POST')){
				try{
					$data = Appointments::create([
						'title' => $request->input('title'),
						'description' => $request->input('description'),
						'appointment_datetime' => $request->input('appointment_datetime'),
						'patient_id' => $request->input('patient'),
					]);
				
					if ($data){
						return redirect()->route('pages.schedule.schedule')->with('success',"Successfully Created");
					}
					else{
						return redirect()->route('pages.schedule.schedule')->with('failed',"Unsuccessfully Created");
					}
				}
				catch(Exception $e){
					return redirect()->route('pages.patient.viewpatientlist')->with('failed',"Unsuccessfully Created");
				}			
			}else{
				$data = Patients::where('hcworker_id', '=', Auth::user()->id)
				->orderBy('patient_lname', 'desc')->get();
				return view('pages.admissions.create', ['data' => $data]);
			}
		} else {
			return view('pages.login');
		}
    }

	// UPDATE
	public function admissions_update(Request $request, $patient_id = null){
		if (Auth::check()) {
			if($request->isMethod('POST')){
				try{
					$id = $request->input('id');
					$data = Appointments::where('appointment_id', $id)
					->update([
						'title' => $request->input('title'),
						'description' => $request->input('description'),
						'appointment_datetime' => $request->input('appointment_datetime'),
						'patient_id' => $request->input('patient'),
					]);
				
					if ($data){
						return redirect()->route('pages.schedule.schedule')->with('success',"Successfully Created");
					}
					else{
						return redirect()->route('pages.schedule.schedule')->with('failed',"Unsuccessfully Created");
					}
				}
				catch(Exception $e){
					return redirect()->route('pages.patient.viewpatientlist')->with('failed',"Unsuccessfully Created");
				}			
			}else{
				$id = $request->patient_id;
				$data = Appointments::where('appointment_id', $id)->first();
				$patient_list = Patients::where('hcworker_id', '=', Auth::user()->id)
				->orderBy('patient_lname', 'desc')->get();
				# Y-m-d\TH:i -> this works with datetime-local format fields
				$admission_datetime = date('Y-m-d\TH:i', strtotime($data->appointment_datetime));
				return view('pages.admissions.update', ['data' => $data, 'patient_id' => $id, 'admission_datetime' => $admission_datetime, 'patient_list' => $patient_list]);
			}
		} else {
			return view('pages.login');
		}
    }

	// DELETE
	public function admissions_delete($appointment_id = null) {
		if (Auth::check()) {
			try {
				$data = Appointments::with('appointmenttosession')
				->where('appointment_id', $appointment_id)->get();

				foreach($data as $appointment) {
					# each delete from the collection
					# will be passed to the deleting() function on the session model
					$appointment->delete();
				}
	
				session()->flash('alert-sucess', 'Sucess! Session deleted successfully.');
				return redirect()->route('pages.admissions.view');
			} catch(Exception $e){
				session()->flash('alert-danger', 'Sorry. Something went wrong.');
				return redirect()->route('pages.admissions.view');
			}
		} else {
			return view('pages.login');
		}
	}

// APPOINTMENT SCHEDULE_________________________________________________________________
    // READ
	public function schedule_view(){
        if (Auth::check()) {
			$data = Appointments::get();
            return view('pages.schedule.schedule', ['data'=>$data]);
        } else {
            return view('pages.login');
        }
    }

// CHECKUP / SESSION DETAILS____________________________________________________________
	// READ

	// CREATE
	public function session_create(Request $request, int $appointment_id = NULL){
		if (Auth::check()) {
			if($request->isMethod('POST')){
				try{
					// $patientdata = Patients::where('patient_id',$patient_id)->first();
					$a_id = $request->input('appointment_id');

					$session_data = [
						'appointment_id' => $a_id,
						'session_px_bp' => $request->input('session_px_bp'),
						'session_px_heartrate' => $request->input('session_px_heartrate'),
						'session_px_temperature' => $request->input('session_px_temperature'),
						'session_px_respiratoryrate' => $request->input('session_px_respiratoryrate'),
						'session_px_oxygensat' => $request->input('session_px_oxygensat'),
						'session_px_height' => $request->input('session_px_height'),
						'session_px_weight' => $request->input('session_px_weight'),
						'session_complaint' => $request->input('session_complaint'),
						'session_findings' => $request->input('session_findings'),
						'session_treatment' => $request->input('session_treatment'),
					]; 

					$session = Session::create($session_data);

					$appointment = Appointments::where('appointment_id', $a_id)
					->update([
						'session_status' => 1,
					]);
					
					$prescriptionbefore_data = [];
					if ($request->input('session_taken_medname') > 0) {
						for($i = 0; $i < count($request->input('session_taken_medname')); $i++) {
							$prescriptionbefore_data[] = ([
								'session_taken_medname' => $request->input('session_taken_medname')[$i],
								'session_taken_meddose' => $request->input('session_taken_meddose')[$i],
								'session_taken_meddate' => $request->input('session_taken_meddate')[$i],
								'session_taken_medcat' => $request->input('session_taken_medcat')[$i]
							]);
						}
					}
				
					$prescriptionbefore = $session->prescriptionbeforefromsession()->createMany($prescriptionbefore_data);
				
					$prescription_data = [];
					if ($request->input('session_order_medname') > 0) {
						for($i = 0; $i < count($request->input('session_order_medname')); $i++) {
							$prescription_data[] = ([
								'session_order_medname' => $request->input('session_order_medname')[$i],
								'session_order_meddose' => $request->input('session_order_meddose')[$i],
								'session_order_medfreq' => $request->input('session_order_medfreq')[$i]
							]);
						}
					}
				
					$prescription = $session->prescriptionfromsession()->createMany($prescription_data);
					
					if ($session_data){
						return redirect()->route('pages.schedule.schedule')->with('success',"Successfully Created");
					}
					else{
						return redirect()->route('pages.inventory.inventory')->with('failed',"Unsuccessfully Created");
					}
				}
				catch(Exception $e){
					return redirect()->route('pages.patient.viewpatientlist')->with('failed',"Unsuccessfully Created");
				}			
			}else{
				$appointmentdata = Appointments::where('appointment_id',$appointment_id)->first();
				return view('pages.appointment.createsession', ['appointmentdata'=>$appointmentdata]);
			}
		} else {
			return view('pages.login');
		}
    }
	
	// UPDATE
	public function session_update(Request $request, $appointment_id = null) {
		if (Auth::check()) {
			if($request->isMethod('post')){
				try {
					$a_id = $request->input('id');
					$session = Session::where('appointment_id', $a_id)->first();
	
					$session_data = [
						'appointment_id' => $a_id,
						'session_px_bp' => $request->input('session_px_bp'),
						'session_px_heartrate' => $request->input('session_px_heartrate'),
						'session_px_temperature' => $request->input('session_px_temperature'),
						'session_px_respiratoryrate' => $request->input('session_px_respiratoryrate'),
						'session_px_oxygensat' => $request->input('session_px_oxygensat'),
						'session_px_height' => $request->input('session_px_height'),
						'session_px_weight' => $request->input('session_px_weight'),
						'session_complaint' => $request->input('session_complaint'),
						'session_findings' => $request->input('session_findings'),
						'session_treatment' => $request->input('session_treatment'),
					]; 
	
					Session::updateOrCreate([
						'session_id' => $session->session_id
					], $session_data);
	
					$prescriptionbefore_data = [];
					if ($request->input('session_taken_medname') > 0) {
						for($i = 0; $i < count($request->input('session_taken_medname')); $i++) {
							$prescriptionbefore_data[] = ([
								'session_id' => $session->session_id,
								'session_taken_medname' => $request->input('session_taken_medname')[$i],
								'session_taken_meddose' => $request->input('session_taken_meddose')[$i],
								'session_taken_meddate' => $request->input('session_taken_meddate')[$i],
								'session_taken_medcat' => $request->input('session_taken_medcat')[$i]
							]);
	
							PrescriptionsBefore::updateOrCreate([
								'session_taken_id' => $request->input('session_taken_medid')[$i]
							], $prescriptionbefore_data[$i]);
	
							# delete entries removed by delete button
							PrescriptionsBefore::where('session_id', '=', $session->session_id)->whereNotIn('session_taken_id', $request->input('session_taken_medid'))->delete();
						}
					} else {
						# delete all entries
						PrescriptionsBefore::where('session_id', '=', $session->session_id)->delete();
					}

					$prescription_data = [];
					if ($request->input('session_order_medname') > 0) {
						for($i = 0; $i < count($request->input('session_order_medname')); $i++) {
							$prescription_data[] = ([
								'session_id' => $session->session_id,
								'session_order_medname' => $request->input('session_order_medname')[$i],
								'session_order_meddose' => $request->input('session_order_meddose')[$i],
								'session_order_medfreq' => $request->input('session_order_medfreq')[$i]
							]);
	
							PrescriptionsSession::updateOrCreate([
								'session_order_id' => $request->input('session_order_medid')[$i]
							], $prescription_data[$i]);
	
							# delete entries removed by delete button
							PrescriptionsSession::where('session_id', '=', $session->session_id)->whereNotIn('session_order_id', $request->input('session_order_medid'))->delete();
						}
					} else {
						# delete all entries
						PrescriptionsSession::where('session_id', '=', $session->session_id)->delete();
					}

					session()->flash('alert-success', 'Success! Entry successfully updated.');
					return redirect()->route('pages.patient.indivviewpatient', ['id' => $request->input('patient_id')]);
				} catch(Exception $e){
					$error = sprintf('[%s],[%d] ERROR:[%s]', __METHOD__, $e->getLine(), json_encode($e->getMessage(), true));
        			Log::error($error);
					session()->flash('alert-danger', 'Something went wrong. '. $error);
					return redirect()->route('pages.patient.indivviewpatient', ['id' => $request->input('patient_id')]);
				}
			} else {
				$id = $request->appointment_id;
				$data = Appointments::with('appointmenttosession', 'patientowner')->where('appointment_id', $id)->first();
				$patient_id = $data->patientowner->patient_id;
				$session_data = $data->appointmenttosession;
				$prescription_before_data = $data->appointmenttosession->prescriptionbeforefromsession;
				$prescription_order_data = $data->appointmenttosession->prescriptionfromsession;
				return view('pages.appointment.updatesession', ['data' => $data, 'patient_id' => $patient_id, 'appointment_id' => $id, 'session_data' => $session_data, 'prescription_before_data' => $prescription_before_data, 'prescription_order_data' => $prescription_order_data]);	
			}
		} else {
			return view('pages.login');
		}
	}

	public function session_delete($session_id = null) {
		if (Auth::check()) {
			try {
				$data = Session::with('prescriptionbeforefromsession')->with('prescriptionfromsession')->where('session_id', $session_id)->get();

				foreach($data as $session) {
					# each delete from the collection
					# will be passed to the deleting() function on the session model
					$session->delete();
				}
	
				session()->flash('alert-sucess', 'Sucess! Session deleted successfully.');
				return redirect()->route('pages.patient.viewpatientlist');
			} catch(Exception $e){
				session()->flash('alert-danger', 'Sorry. Something went wrong.');
				return redirect()->route('pages.patient.viewpatientlist');
			}
		} else {
			return view('pages.login');
		}
	}

	// FULL REPORT VIEW
	public function session_indivview(Request $request, int $session_id = NULL){
		if (Auth::check()) {
			if($request->isMethod('POST')){

				try{
					$data = Patients::find($session_id)->get();
	
					return redirect()->route('pages.appointment.indivviewsession')->with('success',"Successfully Edited");                
	
				}catch(Exception $e){
					return redirect()->route('pages.appointment.indivviewsession')->with('failed',"Unsuccessfully Edited");
				}
			}
			else{
				$sessiondata = Session::find($session_id);
				$prescriptionbefore = PrescriptionsBefore::where('session_id', '=', $sessiondata->session_id)->get();
				$prescriptionorder = PrescriptionsSession::where('session_id', '=', $sessiondata->session_id)->get();
				return view('pages.appointment.indivviewsession',['sessiondata'=>$sessiondata, 'beforedata'=>$prescriptionbefore, 'orderdata'=>$prescriptionorder]);    
			}
		} else {
			return view('pages.login');
		}
    }


// INVENTORY____________________________________________________________________________
	// READ
	public function inventory_view(Request $request){
        if (Auth::check()) {
			$inventory = Inventory::get();

			$year = date('Y');
			$month = date('m');

			if ($request->input('analytics-year')) {
				$year = $request->input('analytics-year');
				$month = $request->input('analytics-month');

			}

			$data = User::orderBy('created_at', 'desc')->get();

			$inventories = Inventory::whereMonth('created_at', $month)->whereYear('created_at', $year)->orderBy('created_at', 'desc')->get();
			$transactions = Transactions::whereMonth('created_at', $month)->whereYear('created_at', $year)->orderBy('created_at', 'desc')->get();

            return view('pages.inventory.inventory', ['inventorydata'=>$inventory, 'data' => $data, 'transactions' => $transactions, 'inventories' => $inventories]);
        } else {
            return view('pages.login');
        }
    }

	// CREATE
    public function inventory_create(Request $request){
		if (Auth::check()) {
			if($request->isMethod('post')){
				try{
					$data = Inventory::create(array_merge($request->all()));

					if ($data) {
						session()->flash('alert-success', 'Success! Entry successfully created.');
						return redirect()->route('pages.inventory.inventory');
					} else {
						session()->flash('alert-danger', 'Something went wrong. Entry creation failed.');
						return view('pages.inventory.createinventory');
					}
				}
				catch(Exception $e){
					return redirect()->route('pages.inventory.inventory')->with('failed',"operation failed");
				}
			}else{
				return view('pages.inventory.createinventory');
			}
			
        } else {
            return view('pages.login');
		}

    }

	// DELETE
	public function inventory_delete(int $resource_id = NULL){
		if (Auth::check()) {
			try{
				$data = Inventory::with('transactionfrominventory')->where('resource_id', $resource_id)->get();

				foreach($data as $inventory) {
					# each delete from the collection
					# will be passed to the deleting() function on the session model
					$inventory->delete();
				}
	
				session()->flash('alert-sucess', 'Sucess! Inventory deleted successfully.');
				return redirect()->route('pages.inventory.inventory');
			} catch(Exception $e){
				session()->flash('alert-danger', 'Sorry. Something went wrong.');
				return redirect()->route('pages.inventory.inventory');
			}
		} else {
			return view('pages.login');
		}
    }


	// UPDATE
	public function inventory_edit(Request $request, int $resource_id = NULL){
		if (Auth::check()) {
			if($request->isMethod('POST')){

				try{
					$data = Inventory::find($resource_id);
	
					$data->resource_name = $request->input("resource_name");
					$data->resource_category = $request->input("resource_category");
					// $data->resource_stocks = $request->input("resource_stocks");
					$data->resource_notes = $request->input("resource_notes");
	
					$data->update();
	
					return redirect()->route('pages.inventory.inventory')->with('success',"Successfully Edited");                
	
				}catch(Exception $e){
					return redirect()->route('pages.inventory.inventory')->with('failed',"Unsuccessfully Edited");
				}
			}
			else{
				$data = Inventory::find($resource_id);
				return view('pages.inventory.editinventory',['inventorydata'=>$data]);            
			}
		} else {
			return view('pages.login');
		}
    }

	// VIEW TRANSACTIONS
	public function transaction_view() {
		if (Auth::check()) {
			$data = Transactions::with('transactiontoinventory')->get();

			return view('pages.inventory.transaction', ['data' => $data]);
		} else {
			return view('pages.login');
		}
	}

	// CREATE TRANSACTION
	public function transaction_create(Request $request, $resource_id = NULL){
		if (Auth::check()) {
			if($request->isMethod('POST')){
				try{
					$data = Transactions::create([
						'transaction_cat' => $request->input('transaction_cat'),
						'transaction_qty' => $request->input('transaction_qty'),
						'resource_id' => $resource_id,
					]); 

					$inventorydata = Inventory::find($resource_id);
					
					if($request->input('transaction_cat') == 1 ){
						$inventorydata->resource_stocks = $inventorydata->resource_stocks - $request->input('transaction_qty');
						$inventorydata->update();
					}
					elseif ($request->input('transaction_cat') == 2 ) {
						$inventorydata->resource_stocks = $inventorydata->resource_stocks - $request->input('transaction_qty');
						$inventorydata->update();
					}
					elseif ($request->input('transaction_cat') == 3 ) {
						$inventorydata->resource_stocks = $inventorydata->resource_stocks + $request->input('transaction_qty');
						$inventorydata->update();
					}
					else{
						$inventorydata->resource_stocks = $inventorydata->resource_stocks + $request->input('transaction_qty');
						$inventorydata->update();
					}
				
					if ($data){
						return redirect()->route('pages.inventory.inventory')->with('success',"Successfully Created");
					}
					else{
						return redirect()->route('pages.inventory.inventory')->with('failed',"Unsuccessfully Created");
					}
				}
				catch(Exception $e){
					return redirect()->route('pages.inventory.inventory')->with('failed',"Unsuccessfully Created");
				}			
			}else{
				// $inventorydata = Inventory::where('resource_id',$resource_id)->first();
				// return view('pages.inventory.createtransaction', ['inventorydata'=>$inventorydata]);
				return redirect()->route('pages.inventory.inventory')->with('success',"Successfully Created");
			}
		} else {
			return view('pages.login');
		}
    }
}
