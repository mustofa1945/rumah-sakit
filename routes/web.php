<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TenagaMedisController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BpjsInformationController;
use App\Http\Controllers\Resource\ProfileController;
use App\Http\Controllers\Resource\RevisiHistoryPatientController;
use App\Http\Controllers\Resource\PatientHistoryController;
use App\Http\Controllers\Resource\Admin\PolyResourceController;
use App\Http\Controllers\Resource\Admin\DoctorResourceController;
use App\Http\Controllers\Resource\PatientQueueResourceController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Tenaga Medis
Route::get('/tenaga-medis', [TenagaMedisController::class, 'index'])->name('tenaga-medis.index');

// Dokter Siaga
Route::get('/dokter-siaga', [DoctorController::class, 'index'])->name('dokter-siaga.index');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('auth.register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('auth.register.create');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('auth.login.index');
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login.process');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout.process');

/*
|--------------------------------------------------------------------------
| Patient Routes (requires auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Patient Home / Poli
    Route::get('/poli', [PoliController::class, 'index'])->name('poli.index');
    // Poli Detail
    Route::get('doctor/poli/{id}', [PoliController::class, 'doctorByPoly'])->name('doctor.poli.index');

    // Antrian
    Route::resource('queue', PatientQueueResourceController::class)
        ->only(['index', 'create', 'store']);

    Route::patch('/queue/{id}/next-status', [PatientQueueResourceController::class, 'nextStatus'])
        ->name('queue.nextStatus');


});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/riwayat-medis', [ProfileController::class, 'historyPovPatient'])->name('profile.medical.histories');
    Route::get('/profile/riwayat-medis/{id}/{status}', [PatientHistoryController::class, 'ajukanDownload'])->name('patient.ajukan.download');

});



/*
|--------------------------------------------------------------------------
| Admin Routes (prefix: admin)
|--------------------------------------------------------------------------
*/
Route::prefix('super/admin')->middleware('auth')->group(function () {

    /*
    |------------------------------------------------
    | Poli Management
    |------------------------------------------------
    */
    Route::prefix('poli')->group(function () {
        Route::get('/', [PolyResourceController::class, 'index'])->name('admin.poli.index');
        Route::get('/create', [PolyResourceController::class, 'create'])->name('admin.poli.create');
        Route::post('/', [PolyResourceController::class, 'store'])->name('admin.poli.store');
        Route::get('/edit/{poli}', [PolyResourceController::class, 'edit'])->name('admin.poli.edit');
        Route::put('/{poli}', [PolyResourceController::class, 'update'])->name('admin.poli.update');
        Route::delete('/{poli}', [PolyResourceController::class, 'destroy'])->name('admin.poli.destroy');
    });

    /*
    |------------------------------------------------
    | Dokter Management
    |------------------------------------------------
    */
    Route::prefix('dokter')->group(function () {
        Route::get('/', [DoctorResourceController::class, 'index'])->name('admin.dokter.index');
        Route::get('/create', [DoctorResourceController::class, 'create'])->name('admin.dokter.create');
        Route::post('/', [DoctorResourceController::class, 'store'])->name('admin.dokter.store');
        Route::get('/edit/{dokter}', [DoctorResourceController::class, 'edit'])->name('admin.dokter.edit');
        Route::put('/{dokter}', [DoctorResourceController::class, 'update'])->name('admin.dokter.update');
        Route::delete('/{dokter}', [DoctorResourceController::class, 'destroy'])->name('admin.dokter.destroy');
    });
});
/*
   |------------------------------------------------
   | Manajement Patient
   |------------------------------------------------
   */


Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/dashboard/history-rekap', [DashboardController::class, 'rekapMedisDefault'])
            ->name('admin.history-rekap');

        Route::post('/antrian/call-next', [DashboardController::class, 'callNextPatient'])
            ->name('admin.dashboad.antrian.call-next');

        Route::get('rekap-medis', [DashboardController::class, 'rekapMedis'])
            ->name('admin.rekap-medis');


        // Form revisi
        Route::get('/admin/rekap-medis/revisi/{id}', [RevisiHistoryPatientController::class, 'index'])
            ->name('revision.index');
            

        // Simpan revisi
        Route::post('/admin/rekap-medis/revisi', [RevisiHistoryPatientController::class, 'create'])
            ->name('revision.store');

    Route::get('/dokter/rekap/ajukan-revisi/{id}', [PatientHistoryController::class, 'ajukanRevisi'])
     ->name('patient-history.ajukan-revisi');
            
    });

//History

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {

        Route::prefix('patients/{patient}')
            ->group(function () {

                Route::get(
                    'histories',
                    [PatientHistoryController::class, 'index']
                )->name('patients.histories.index');



            });

        Route::post(
            '/patient-histories/store/{user}',
            [PatientHistoryController::class, 'store']
        )->name('admin.patients.histories.store');

        Route::get(
            '/patient-histories/create/{user}',
            [PatientHistoryController::class, 'create']
        )->name('admin.patient-histories.create');

        Route::get(
            '/patient-histories/edit/{history}',
            [PatientHistoryController::class, 'edit']
        )->name('admin.patients.histories.edit');

        Route::patch(
            'histories/{history}/emergency',
            [PatientHistoryController::class, 'emergency']
        )->name('histories.emergency');


    });

//bpjs
Route::middleware('auth')->group(function () {
    Route::get('/profile/bpjs', [BpjsInformationController::class, 'index'])
        ->name('profile.bpjs.index');
    Route::get('/profile/bpjs/create', [BpjsInformationController::class, 'create'])->name('profile.bpjs.create');
    Route::post('/profile/bpjs', [BpjsInformationController::class, 'store'])->name('profile.bpjs.store');
});

