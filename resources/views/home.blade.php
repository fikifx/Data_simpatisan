@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Halaman Dashboard')
@section('content')
    <div class="content">
        <div class="container">
            <div class="mb-3">
                <br>
                <form action="{{ route('home') }}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" name="query" placeholder="cari daftar simpatisan...">
                                <button type="submit" class="btn btn-secondary">Search</button>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('export.simpatisan') }}" class="btn btn-primary">Export Data</a>
                        </div>
                    </div>
                </form>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <style type="text/css">
                
                </style>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <!-- <th>NIK</th> -->
                            <th>Nama Lengkap</th>
                            <th>Kelamin</th>
                            <th>Kecamatan</th>
                            <th>Kabupaten</th>
                            <th>WhatsApp</th>
                            <th>Upload Foto</th>
                            <th>PIC/Timses</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($simpatisans as $simpatisan)
                            <tr>
                                <td align="center">{{ $loop->iteration }}</td>
                                <!-- <td>{{ $simpatisan->nik_ktp }}</td> -->
                                <td style="min-width: 200px;">{{ $simpatisan->nama_lengkap }}</td>
                                <td>{{ $simpatisan->jenis_kelamin }}</td>
                                <td>{{ $simpatisan->nama_kecamatan }}</td>
                                <td>{{ $simpatisan->nama_kabupaten }}</td>
                                <td><a target="_blank" href="https://wa.me/62{{ $simpatisan->no_whatsapp }}">{{ $simpatisan->no_whatsapp }} </a></td>
                                <td>
                                    <img src="{{ asset('storage/images/' . basename($simpatisan->upload_foto)) }}" alt="Foto" style="max-width: 100px; max-height: 60px;">
                                </td>                                
                                <td>{{ $simpatisan->timses }}</td>
                                <td>{{ $simpatisan->nama_petugas }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <div class="d-flex justify-content-center mt-3">
                {{ $simpatisans->links() }}
            </div> --}}
        </div>
    </div>
@endsection
