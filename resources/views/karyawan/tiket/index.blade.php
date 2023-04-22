@extends('layouts.karyawan')
@section('container')
    <main class="content">
      <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Daftar Tiket</h1>
        @if (session()->has('success'))  
          <div class="badge bg-success text-white mb-2">
            {{ session('success') }}
          </div>
        @endif
        @if (session()->has('error'))  
          <div class="badge bg-danger text-white mb-2">
            {{ session('error') }}
          </div>
        @endif
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <a href="/karyawan/tiket/create" class="btn btn-primary btn-sm mb-3"><i class="me-2" data-feather="layers"></i> <span class="align-middle">Buat Tiket</span></a>
                <table class="table my-0 table-sm">
									<thead>
										<tr>
											<th>No Tiket</th>
											<th>Status</th>
                      <th>Judul</th>
                      <th>Permintaan</th>
                      <th>Dikirim</th>
                      {{-- <th>Prioritas</th> --}}
                      <th>Penerima Tugas</th>
                      <th>Aksi</th>
										</tr>
									</thead>
									<tbody>
                    @foreach ($tikets as $tiket)
										<tr>
											<td>{{ $tiket->noTiket }}</td>
											<td>{{ $tiket->status }}</td>
											<td>{{ $tiket->permintaan }}</td>
											<td>{{ $tiket->User->nama }}</td>
											<td>{{ $tiket->created_at }}</td>
											{{-- <td>{{ $tiket->prioritas }}</td> --}}
											<td>@if ($tiket->status != 'Dikirim')
                        {{ $tiket->Teknisi->nama }}
                      @endif </td>
                      <td>
                        <a href="/karyawan/tiket/detail/{{ $tiket->idTiket }}" class="btn btn-success btn-sm"><i class="align-middle" data-feather="eye"></i></a>                        
                      </td>
										</tr>
                    @endforeach
                  </tbody>
                </table> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
@endsection