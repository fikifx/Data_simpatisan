<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpatisan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik_ktp',
        'nama_lengkap',
        'jenis_kelamin',
        'nama_provinsi',
        'nama_kabupaten',
        'nama_kecamatan',
        'nama_desa',
        'rt_rw',
        'no_whatsapp',
        'nama_email',
        'upload_foto',
        'timses',
        'nama_petugas',
    ];

    public function viewData()
    {
        //$simpatisans = Simpatisan::all();
       /* $simpatisans = DB::table('simpatisans')
        ->inRandomOrder()
        ->first();

        return view('home', compact('simpatisans')); */
    }

    public function storeData($data)
    {
        return Simpatisan::create($data);
    }

}
