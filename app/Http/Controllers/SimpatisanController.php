<?php

namespace App\Http\Controllers;


use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SimpatisanExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use App\Models\Simpatisan;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmissionMail;
use Imagine\Image\Box;
use Imagine\Gd\Imagine;
use Illuminate\Support\Facades\Storage;


class SimpatisanController extends Controller
{
    public function getKabupaten($province_code)
    {
        $kabupatenData = City::where('province_code', $province_code)->pluck('name', 'code');
        return response()->json($kabupatenData);
    } 
    public function getKecamatan($city_code)
    {
        $kecamatanData = District::where('city_code', $city_code)->pluck('name', 'code');
        return response()->json($kecamatanData);
    }
    public function getDesa($district_code)
    {
        // Mengambil data desa berdasarkan district_code
        $desaData = Village::where('district_code', $district_code)->pluck('name', 'code');
        return response()->json($desaData);
    }

    public function store(Request $request)
    {
        // Validasi data formulir jika diperlukan
        $request->validate([
           'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'no_whatsapp' => 'required',
            'nama_email' => 'required|email',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'rt_rw' => 'required',
            'timses' => 'required',
            'nama_petugas' => 'required',
        ]);

         // Handle upload foto
         if ($request->hasFile('upload_foto')) {
             $uploadedImage = $request->file('upload_foto');
     
             // Pastikan direktori penyimpanan sudah ada
             $storagePath = 'public/images/';
             if (!Storage::exists($storagePath)) {
                 Storage::makeDirectory($storagePath, 0755, true); // Buat direktori jika belum ada
             }
     
             // Menggunakan Imagine untuk meresize gambar
             $imagine = new Imagine();
             $image = $imagine->open($uploadedImage->getPathname());
             $resizedImage = $image->resize(new Box(500, 350));
     
             // Path untuk menyimpan gambar resized
             $path = $storagePath . uniqid() . '.jpg';
     
             // Pastikan path disimpan dengan benar ke dalam penyimpanan Laravel
             Storage::put($path, $resizedImage->get('jpg'));
     
             // Jika Anda masih ingin menghilangkan 'public/' dari path yang disimpan di database, Anda dapat menggunakan ini:
             $pathForDatabase = str_replace('public/', '', $path);
             
             // Simpan data formulir ke dalam database
            Simpatisan::create([
            'nik_ktp' => $request->nik_ktp,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_whatsapp' => $request->no_whatsapp,
            'nama_email' => $request->nama_email,
            'nama_provinsi' => $request->provinsi,
            'nama_kabupaten' => $request->kota,
            'nama_kecamatan' => $request->kecamatan,
            'nama_desa' => $request->desa,
            'rt_rw' => $request->rt_rw,
            'upload_foto' => $path,
            'timses' => $request->timses,
            'nama_petugas' => $request->nama_petugas,
        ]);
             
         } else {
             $pathForDatabase = null;
             // Simpan data formulir ke dalam database
            Simpatisan::create([
            'nik_ktp' => $request->nik_ktp,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_whatsapp' => $request->no_whatsapp,
            'nama_email' => $request->nama_email,
            'nama_provinsi' => $request->provinsi,
            'nama_kabupaten' => $request->kota,
            'nama_kecamatan' => $request->kecamatan,
            'nama_desa' => $request->desa,
            'rt_rw' => $request->rt_rw,
            'timses' => $request->timses,
            'nama_petugas' => $request->nama_petugas,
        ]);
         }
        // Kirim email
        $formData = $request->all();
        Mail::to($formData['nama_email'])->send(new FormSubmissionMail($formData));
    

        

        $referer = URL::previous();

        // Tambahkan variabel session untuk menunjukkan bahwa sukses
        Session::flash('success', 'Data Simpatisan berhasil disimpan.');
        Session::flash('showPopup', true);

        // Redirect ke halaman asal formulir
        return redirect($referer);
    }

    public function export()
    {
        $simpatisanData = Simpatisan::all();
        return Excel::download(new SimpatisanExport($simpatisanData), 'simpatisan_data.xlsx');
    }
    
}

