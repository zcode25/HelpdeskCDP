@extends('layouts.teknisi')
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
                {{-- <a href="/karyawan/tiket/create" class="btn btn-primary btn-sm mb-3"><i class="me-2" data-feather="layers"></i> <span class="align-middle">Buat Tiket</span></a> --}}
                <table class="table my-0 table-sm">
									<thead>
										<tr>
											<th>No Tiket</th>
											<th>Status</th>
                      <th>Judul</th>
                      <th>Permintaan</th>
                      <th>Prioritas</th>
                      <th>Dikirim</th>
                      <th>Ekspetasi Selesai</th>
                      {{-- <th>Prioritas</th> --}}
                      {{-- <th>Penerima Tugas</th> --}}
                      <th>Aksi</th>
										</tr>
									</thead>
									<tbody>
                    @foreach ($tikets as $tiket)
										<tr>
											<td>{{ $tiket->noTiket }}</td>
											@if ($tiket->status == "Ditolak" || $tiket->status == "Komplain" || $tiket->status == "Komplain Ditolak")  
                        <td><span class="badge bg-danger text-white">{{ $tiket->status }}</span></td>
                      @elseIf ($tiket->status == "Validasi" || $tiket->status == "Ditahan" || $tiket->status == "Komplain Ditahan")  
                        <td><span class="badge bg-warning text-white">{{ $tiket->status }}</span></td>
                      @elseIf ($tiket->status == "Penugasan" || $tiket->status == "Penugasan Komplain" || $tiket->status == "Dikirim" || $tiket->status == "Dikerjakan")  
                        <td><span class="badge bg-secondary text-white">{{ $tiket->status }}</span></td>
                      @elseIf ($tiket->status == "Diterima" || $tiket->status == "Komplain Diterima")  
                        <td><span class="badge bg-primary text-white">{{ $tiket->status }}</span></td>
                      @elseIf ($tiket->status == "Selesai")  
                        <td><span class="badge bg-success text-white">{{ $tiket->status }}</span></td>
                      @endif
											<td>{{ $tiket->permintaan }}</td>
											<td>{{ $tiket->User->nama }}</td>
											<td>{{ $tiket->prioritas }}</td>
											<td>{{ $tiket->created_at }}</td>
											<td>{{ $tiket->ekspetasiSelesai }}</td>
											{{-- <td>{{ $tiket->prioritas }}</td> --}}
											{{-- <td>@if ($tiket->status != 'Dikirim')
                        {{ $tiket->Teknisi->nama }}
                      @endif </td> --}}
                      @if ($tiket->status == "Penugasan" || $tiket->status == "Penugasan Komplain")
                      <td>
                        <a href="/teknisi/tiket/detailPenugasan/{{ $tiket->idTiket }}" class="btn btn-success btn-sm"><i class="align-middle" data-feather="eye"></i></a>
                      </td>
                      @elseif ($tiket->status == "Dikerjakan")
                      <td>
                        <a href="/teknisi/tiket/detailValidasi/{{ $tiket->idTiket }}" class="btn btn-success btn-sm"><i class="align-middle" data-feather="eye"></i></a>
                      </td>
                      @elseif ($tiket->status == "Validasi" || $tiket->status == "Selesai")
                      <td>
                        <a href="/teknisi/tiket/detail/{{ $tiket->idTiket }}" class="btn btn-success btn-sm"><i class="align-middle" data-feather="eye"></i></a>
                      </td>
                      @endIf
                      
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