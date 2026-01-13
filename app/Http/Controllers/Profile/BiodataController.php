<?php
namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Models\PatientBiodata;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil biodata pasien jika ada
        $biodata = PatientBiodata::where('user_id', $user->id)->first();

        return view('pages.profile.biodata.biodata-index', compact('user', 'biodata'));
    }

    public function store(Request $request)
    {

        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'nik' => 'nullable|string|size:16|unique:patient_biodatas,nik,' . optional($user->patientBiodata)->id,
            'no_bpjs' => 'nullable|string|max:20',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'blood_type' => 'nullable|in:A,B,AB,O',
            'place_of_birth' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
            'religion' => 'nullable|string|max:50',
            'marital_status' => 'nullable|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'address' => 'nullable|string',
            'village' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:20',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relation' => 'nullable|string|max:50',
        ]);

        // Cek apakah sudah ada biodata
        $biodata = PatientBiodata::updateOrCreate(
            [
                'user_id' => $user->id,
            ],
           $validated,
        );

        // Update flag isFilledBiodata di users
        $user->is_filled_biodata = true;
        $user->save();

        $message = $biodata->wasRecentlyCreated ? "Biodata Berhasil Dibuat" : "Biodata Berhasil Diperbarui";


        return redirect()->route('profile.biodata.index')
            ->with('success', $message);
    }

    public function createOrEdit()
    {
        $biodata = PatientBiodata::where("user_id", Auth::user()->id)->first() ?? false;

        return view('pages.profile.biodata.biodata-create', compact('biodata'));
    }

}

