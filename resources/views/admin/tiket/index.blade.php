@extends('layouts.admin')
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
          <div class="col-xl-4 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Dikirim</h5>
                  </div>
                  <div class="col-auto">
                    <div class="bg-info text-white p-2 rounded-3">
                      <i class="align-middle" data-feather="mail"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $dikirim }}</h1>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Ditahan</h5>
                  </div>
                  <div class="col-auto">
                    <div class="bg-warning text-white p-2 rounded-3">
                      <i class="align-middle" data-feather="loader"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $ditahan }}</h1>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Ditolak</h5>
                  </div>
                  <div class="col-auto">
                    <div class="bg-danger text-white p-2 rounded-3">
                      <i class="align-middle" data-feather="x-circle"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $ditolak }}</h1>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Berlangsung</h5>
                  </div>
                  <div class="col-auto">
                    <div class="bg-primary text-white p-2 rounded-3">
                      <i class="align-middle" data-feather="send"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $berlangsung }}</h1>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Selesai</h5>
                  </div>
                  <div class="col-auto">
                    <div class="bg-success text-white p-2 rounded-3">
                      <i class="align-middle" data-feather="check-circle"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $selesai }}</h1>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col mt-0">
                    <h5 class="card-title">Komplain</h5>
                  </div>
                  <div class="col-auto">
                    <div class="bg-danger text-white p-2 rounded-3">
                      <i class="align-middle" data-feather="alert-circle"></i>
                    </div>
                  </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $komplain }}</h1>
              </div>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                {{-- <a href="/admin/departemen/create" class="btn btn-primary btn-sm mb-3"><i class="me-2" data-feather="user-plus"></i> <span class="align-middle">Tambah Departemen</span></a> --}}
                <div class="table-responsive">
                <table class="table my-0 table-sm" id="myTable">
									<thead>
										<tr>
											<th>No Tiket</th>
											<th>Status</th>
                      <th>Judul</th>
                      <th>Permintaan</th>
                      <th>Prioritas</th>
                      <th>Dikirim</th>
                      <th>Ekspetasi</th>
                      <th>Selesai</th>
                      <th>Waktu</th>
                      {{-- <th>Penerima Tugas</th> --}}
                      <th>Aksi</th>
										</tr>
									</thead>
									<tbody>
                    @foreach ($tikets as $tiket)
                    @php
                        $awal  = time(); //waktu awal
                        $akhir = strtotime($tiket->ekspetasiSelesai); //waktu akhir
                        $diff  = $akhir - $awal;
                        $jam   = floor($diff / (60 * 60));
                        $menit = $diff - $jam * (60 * 60);
                        $menit = floor( $menit / 60 );
                    @endphp
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
											<td class="align-baseline">{{ $tiket->prioritas }}</td>
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
                      @if ($tiket->status != "Dikirim" && $tiket->status != "Diterima" && $tiket->status != "Ditahan" && $tiket->status != "Ditolak" && $tiket->status != "Selesai")
                        <td class="text-danger fw-bold align-baseline">{{ $jam }} Jam {{ $menit }} Menit</td>
                      @else
                        <td class="align-baseline">-</td>
                      @endif
											{{-- <td>@if ($tiket->status != 'Dikirim')
                        {{ $tiket->Teknisi->nama }}
                      @endif </td> --}}
                      @if ($tiket->status == "Dikirim" || $tiket->status == "Ditahan")
                      <td class="align-baseline">
                        <a href="/admin/tiket/detailKonfirmasi/{{ $tiket->idTiket }}" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="edit"></i></a>                        
                      </td>
                      @elseif ($tiket->status == "Diterima")
                      <td class="align-baseline">
                        <a href="/admin/tiket/detailPenugasan/{{ $tiket->idTiket }}" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="edit"></i></a>                        
                      </td>
                      @elseif ($tiket->status == "Komplain Diterima")
                      <td class="align-baseline">
                        <a href="/admin/tiket/detailPenugasanKomplain/{{ $tiket->idTiket }}" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="edit"></i></a>                        
                      </td>
                      @elseif ($tiket->status == "Ditolak" || $tiket->status == "Penugasan" || $tiket->status == "Penugasan Komplain" || $tiket->status == "Dikerjakan" || $tiket->status == "Validasi" || $tiket->status == "Selesai" || $tiket->status == "Komplain Ditolak")
                      <td class="align-baseline">
                        <a href="/admin/tiket/detail/{{ $tiket->idTiket }}" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="edit"></i></a>                        
                      </td>
                      @elseif ($tiket->status == "Komplain" || $tiket->status == "Komplain Ditahan")
                      <td class="align-baseline">
                        <a href="/admin/tiket/detailKonfirmasiKomplain/{{ $tiket->idTiket }}" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="edit"></i></a>                        
                      </td>
                      @endif
                      {{-- <td>
                        <a href="/admin/tiket/detail/{{ $tiket->idTiket }}" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="edit"></i></a>
                        <form action="/admin/departemen/destroy/" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="align-middle" data-feather="trash"></i></button>
                        </form>
                      </td> --}}
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