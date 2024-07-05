<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// LOGIN
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'userLogin'])->name('login.userlogin');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');
Route::get('dashboard', [MainController::class, 'dashboard'])->name('dashboard');
// Route::get('dashboard/{year}', [MainController::class, 'dashboard'])->name('dashboard')->defaults('year', date('Y'));

// Route::get('/haha', function () { return view('pages.exports.medcert');})->name("pages.export.medcert");

// INVENTORY ________________________________________________________________________________________________________________
// CREATE INVENTORY 
Route::middleware(['auth'])->group(function(){
    //common routes will goes here
    //check if logged in

    // admin routes
    // check roles to be given access
    Route::middleware(['checkrole:admin'])->group(function() {
        Route::get('/inventory/create', [MainController::class,'inventory_create'])->name("pages.inventory.createinventory");
        Route::post('/inventory/create', [MainController::class,'inventory_create'])->name("pages.inventory.createinventory");

        // USERS ________________________________________________________________________________________________________________
        // READ PERSONNEL LIST
        Route::get('/personnel', [MainController::class, 'personnel_view'
        ])->name("pages.personnel.viewpersonnellist");

        // CREATE USER
        Route::get('/personnel/create', [MainController::class,'personnel_create'])->name("pages.personnel.createpersonnel");
        Route::post('/personnel/create', [MainController::class,'personnel_create'])->name("pages.personnel.createpersonnel");

        // UPDATE USER
        Route::get('/personnel/edit/{id}', [MainController::class,'personnel_edit'
        ])->name("pages.personnel.editpersonnel");
        Route::post('personnel/update/{id}', [MainController::class,'personnel_edit'
        ])->name("pages.personnel.updatepersonnel");

        // DELETE USER
        Route::get('/personnel/delete/{id}', [MainController::class,'personnel_delete'
        ])->name("pages.personnel.deletepersonnel");
        
    });

    Route::middleware(['checkrole:user'])->group(function() {
        //user routes go here
        // SCHEDULE ________________________________________________________________________________________________________________
        // READ
        Route::get('/schedule', [MainController::class,'schedule_view'
        ])->name("pages.schedule.schedule");

        // CREATE
        Route::get('/schedule/create/', [MainController::class,'admissions_create'
        ])->name("pages.admissions.create");
        Route::post('/schedule/create/', [MainController::class,'admissions_create'
        ])->name("pages.admissions.create");

        Route::get('/schedule/delete/{id}', [MainController::class,'admissions_delete'
        ])->name("pages.admissions.delete");
        Route::post('/schedule/delete/', [MainController::class,'admissions_delete'
        ])->name("pages.admissions.delete");

        Route::get('/schedule/update/{id?}', [MainController::class,'admissions_update'
        ])->name("pages.admissions.update");
        Route::post('/schedule/update/', [MainController::class,'admissions_update'
        ])->name("pages.admissions.update");

        // CREATE PATIENT
        Route::get('/patient/create', [MainController::class,'patient_create'])->name("pages.patient.createpatient");
        Route::post('/patient/create', [MainController::class,'patient_create'])->name("pages.patient.createpatient");

        // UPDATE PATIENT
        Route::get('/patient/update/{id?}', [MainController::class,'patient_update'
        ])->name("pages.patient.updatepatient");
        Route::post('/patient/update/', [MainController::class,'patient_update'
        ])->name("pages.patient.updatepatient");

        // DELETE PATIENT
        Route::get('/patient/delete/{id}', [MainController::class,'patient_delete'
        ])->name("pages.patient.deletepatient");
    });

    // READ INVENTORY
    Route::get('/inventory', [MainController::class, 'inventory_view'
    ])->name("pages.inventory.inventory");

    // UPDATE INVENTORY
    Route::get('/inventory/edit/{id}', [MainController::class,'inventory_edit'
    ])->name("pages.inventory.editinventory");

    Route::post('inventory/update/{id}', [MainController::class,'inventory_edit'
    ])->name("pages.inventory.updateinventory");

    // DELETE INVENTORY
    Route::get('/inventory/delete/{id}', [MainController::class,'inventory_delete'
    ])->name("pages.inventory.deleteinventory");

    // ADD TRANSACTION TO INVENTORY
    Route::get('/inventory/newtransaction/{id}', [MainController::class,'transaction_create'
    ])->name("pages.inventory.createtransaction");

    Route::post('inventory/newtransaction/{id}', [MainController::class,'transaction_create'
    ])->name("pages.inventory.createtransaction");

    // VIEW TRANSACTIONS
    Route::get('/inventory/transactions', [MainController::class,'transaction_view'
    ])->name("pages.inventory.viewtransactions");

    // ADMISSIONS ________________________________________________________________________________________________________________
    Route::get('admissions/view', [MainController::class, 'admissions_view'])->name('pages.admissions.view');


    // CHECKUP / SESSION _______________________________________________________________________________________________________
    // CREATE
    Route::get('/session/create/{id}', [MainController::class,'session_create'
    ])->name("pages.appointment.createsession");
    Route::post('/session/create/', [MainController::class,'session_create'
    ])->name("pages.appointment.createsession");

    // UPDATE SESSION
    Route::get('/session/update-session/{id?}', [MainController::class,'session_update'
    ])->name("pages.appointment.updatesession");
    Route::post('/session/update-session/', [MainController::class,'session_update'
    ])->name("pages.appointment.updatesession");

    // READ
    Route::get('/session/view/fullreport/{id}', [MainController::class,'session_indivview'
    ])->name("pages.appointment.indivviewsession");

    // DELETE
    Route::get('/session/delete/{id}', [MainController::class,'session_delete'
    ])->name("pages.appointment.deletesession");

    // GENERATE PDF
    Route::get('/export-pdfmedcert/{id}', [PDFController::class,'generate_pdfmedcert'
    ])->name("pdf.generate.pdfmedcert");
    Route::get('/export-pdfreferral/{id}', [PDFController::class,'generate_pdfreferral'
    ])->name("pdf.generate.pdfreferral");
    // PATIENT ________________________________________________________________________________________________________________
    // READ PATIENT LIST
    Route::get('/patient', [MainController::class, 'patient_view'
    ])->name("pages.patient.viewpatientlist");
    Route::get('/patient/view/{id}', [MainController::class,'patient_indivview'
    ])->name("pages.patient.indivviewpatient");

});