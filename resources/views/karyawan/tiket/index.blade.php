@extends('layouts.karyawan')
@section('container')
    <main class="content">
      <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Daftar Tiket</h1>
        @if (session()->has('success'))  
        <div class="alert alert-warning alert-dismissible fade show badge bg-success mb-3" role="alert">
          <span>{{ session('success') }}</span>
          <button type="button" class="ms-3 btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session()->has('error'))  
        <div class="alert alert-warning alert-dismissible fade show badge bg-danger mb-3" role="alert">
          <span>{{ session('success') }}</span>
          <button type="button" class="ms-3 btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <a href="/karyawan/tiket/create" class="btn btn-primary btn-sm mb-3"><i class="me-2" data-feather="layers"></i> <span class="align-middle">Buat Tiket</span></a>
                <div class="table-responsive mt-3">
                <table class="table my-0 table-sm" id="myTable">
									<thead>
										<tr>
											<th>No Tiket</th>
											<th>Status</th>
                      <th>Judul</th>
                      <th>Permintaan</th>
                      <th>Dikirim</th>
                      <th>Ekspetasi</th>
                      <th>Selesai</th>
                      <th>Aksi</th>
										</tr>
									</thead>
									<tbody>
                    @foreach ($tikets as $tiket)
										<tr>
											<td class="align-baseline">{{ $tiket->noTiket }}</td>
											@if ($tiket->status == "Ditolak" || $tiket->status == "Komplain" || $tiket->status == "Komplain Ditolak")  
                        <td class="align-baseline"><span class="badge bg-danger text-white">{{ $tiket->status }}</span></td>
                      @elseIf ($tiket->status == "Validasi" || $tiket->status == "Ditahan" || $tiket->status == "Komplain Ditahan")  
                        <td class="align-baseline"><span class="badge bg-warning text-white">{{ $tiket->status }}</span></td>
                      @elseIf ($tiket->status == "Penugasan" || $tiket->status == "Penugasan Komplain" || $tiket->status == "Dikirim" || $tiket->status == "Dikerjakan")  
                        <td class="align-baseline"><span class="badge bg-secondary text-white">{{ $tiket->status }}</span></td>
                      @elseIf ($tiket->status == "Diterima" || $tiket->status == "Komplain Diterima")  
                        <td class="align-baseline"><span class="badge bg-primary text-white">{{ $tiket->status }}</span></td>
                      @elseIf ($tiket->status == "Selesai")  
                        <td class="align-baseline"><span class="badge bg-success text-white">{{ $tiket->status }}</span></td>
                      @endif
											<td class="align-baseline">{{ $tiket->permintaan }}</td>
											<td class="align-baseline">{{ $tiket->User->nama }}</td>
											<td class="align-baseline">{{ $tiket->created_at->format('d/m/y H:i') }}</td>
                      @if (isset($tiket->ekspetasiSelesai))
                        <td class="align-baseline">{{ date('d/m/y H:i', strtotime($tiket->ekspetasiSelesai)) }}</td>
                      @else
                        <td class="align-baseline">-</td>
                      @endif
                      @if ($tiket->status == "Selesai")
											  <td class="align-baseline">{{ $tiket->updated_at->format('d/m/y H:i') }}</td>
                      @else
                        <td class="align-baseline">-</td>
                      @endif
											{{-- <td>{{ $tiket->prioritas }}</td> --}}
											{{-- <td>@if ($tiket->status != 'Dikirim')
                        {{ $tiket->Teknisi->nama }}
                      @endif </td> --}}
                      @if ($tiket->status == "Validasi")
                      <td class="align-baseline">
                        <a href="/karyawan/tiket/detailValidasi/{{ $tiket->idTiket }}" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="edit"></i></a>
                      </td>
                      @else
                      <td class="align-baseline">
                        <a href="/karyawan/tiket/detail/{{ $tiket->idTiket }}" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="edit"></i></a>
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
      </div>
    </main>
@endsection