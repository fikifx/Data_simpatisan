<!DOCTYPE html>
<html lang="en">
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
      <title>Ikhwan Arief Menang Pasti Menang</title>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Input Data Pemilih Ikhwan Arief</h2>
        <p class="text-center">Caleg DPR RI PSI Dapil 3 jawa Timur</p>
        <br>
         <!-- Tampilkan pesan kesalahan jika NIK sudah ada -->
         @error('nik_ktp')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
        @enderror
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <form method="post" action="{{ url('/simpatisan/store') }}" enctype="multipart/form-data">
            @csrf
        
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-left mb-4">Data Pemilih </h4>
                    <!-- Personal Information -->
                    <div class="form-group">
                        <label for="nik_ktp">NIK</label>
                        <input type="number" name="nik_ktp" class="form-control" required placeholder="Masukan NIK">
                    </div>
        
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" required placeholder="Masukan nama lengkap">
                    </div>
        
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="" disabled selected>Pilih Salah Satu</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
        
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        @php
                            $provinces = \Laravolt\Indonesia\Models\Province::pluck('name', 'code');
                        @endphp
                        <select class="form-control" name="provinsi" id="provinsi" required>
                            <option>Pilih Provinsi</option>
                            @foreach ($provinces as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="form-group">
                        <label for="kota">Kabupaten / Kota</label>
                        <select class="form-control" name="kota" id="kota" required>
                            <option>Pilih Kota/Kabupaten</option>
                        </select>
                    </div>
        
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <select class="form-control" name="kecamatan" id="kecamatan" required>
                            <option>Pilih Kecamatan</option>
                        </select>
                    </div>
        
                    <div class="form-group">
                        <label for="desa">Desa</label>
                        <select class="form-control" name="desa" id="desa" required>
                            <option>Pilih Kelurahan/Desa</option>
                        </select>
                    </div>
        
                    <div class="form-group">
                        <label for="rt_rw">Dusun RT/RW</label>
                        <input type="text" name="rt_rw" class="form-control" required placeholder="Masukkan Dusun RT/RW">
                    </div>
                </div>
        
                <div class="col-md-6">
                    <!-- Address and Contact Information -->
                    <div class="form-group">
                        <label for="no_whatsapp">No WhatsApp</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping">+62</span>
                            <input type="text" name="no_whatsapp" class="form-control" required>
                        </div>
                    </div>
        
                    <div class="form-group">
                        <label for="nama_email">Email</label>
                        <input type="email" name="nama_email" class="form-control" required placeholder="Masukan Email Aktif">
                    </div>
        
                    <!-- Upload Foto -->
                    <div class="form-group">
                        <label for="upload_foto">Upload Foto (max 1MB)</label>
                        <input type="file" name="upload_foto" class="form-control-file" accept="image/jpeg,image/png,image/gif" >
                        <small class="form-text text-muted"><i>hanya support file jpg, jpeg, png, gif </i></small>
                    </div>
        

                    <br><br>
                    <h4 class="text-left mb-4">Data Petugas </h4>
                    <!-- Additional Information -->
                    <div class="form-group">
                        <label for="timses">Jabatan Anda</label>
                        <select name="timses" class="form-control" required>
                            <option value="" disabled selected>Pilih Jabatan</optio>
                            <option value="Korcam">Korcam</option>
                            <option value="Kordes">Kordes</option>
                            <option value="Relawan">Relawan</option>
                            <option value="Admin_PSI">Admin PSI</option>
                            <option value="Caleg_PSI">Caleg PSI</option>
                        </select>
                    </div>
        
                    <div class="form-group">
                        <label for="nama_petugas">Nama Anda</label>
                        <input type="text" name="nama_petugas" class="form-control" required placeholder="Masukan Nama Anda Input">
                    </div>
            <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger"><i class="fa-brands fa-telegram"></i>Kirim Data</button>
                    </div>
                </div>
            </div>
        
            @error('nik_ktp')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </form>
        
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script>
    function onChangeSelect(url, id, name) {
        // send ajax request to get the cities of the selected province and append to the select tag
        $.ajax({
            url: url + '/' + id, // Perbaikan: tambahkan id ke URL
            type: 'GET',
            success: function (data) {
                $('#' + name).empty();
                $('#' + name).append('<option>Pilih Salah Satu;</option>');
                $.each(data, function (key, value) {
                    $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                });
            },
            error: function (error) { // Tambahkan fungsi penanganan kesalahan
                console.error('Error:', error);
            }
        });
    }
    
    $(function () {
        $('#provinsi').on('change', function () {
            onChangeSelect('{{ url("/get-kabupaten") }}', $(this).val(), 'kota'); 
        });
        $('#kota').on('change', function () {
            onChangeSelect('{{ url("/get-kecamatan") }}', $(this).val(), 'kecamatan'); 
        });
        $('#kecamatan').on('change', function () {
            onChangeSelect('{{ url("/get-desa") }}', $(this).val(), 'desa'); 
        });
    });
    </script>
    
</body>
</html>