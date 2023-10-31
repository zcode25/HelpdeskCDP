@extends('layouts.admin')
@section('container')
    <main class="content">
      <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Laporan</h1>
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
                <form class="row g-3" action="/admin/laporan/target" method="GET">
                  <div class="col-auto">
                    <label for="dariTanggal" class="visually-hidden">Dari Tanggal</label>
                    <input type="date" class="form-control form-control-sm" id="dariTanggal" name="dariTanggal" placeholder="Dari Tanggal" required>
                  </div>
                  <div class="col-auto">
                    <label for="sampaiTanggal" class="visually-hidden">Sampai Tanggal</label>
                    <input type="date" class="form-control form-control-sm" id="sampaiTanggal" name="sampaiTanggal" placeholder="Sampai Tanggal" required>
                  </div>
                  <div class="col-auto">
                    <button type="submit" class="btn btn-primary btn-sm mb-3" formtarget="_blank"><i data-feather="printer"></i></button>
                  </div>
                  <div class="col-auto">
                    <a href="/admin/laporan/all" target="_Blank" class="btn btn-primary btn-sm mb-3"><i class="me-2" data-feather="printer"></i> <span class="align-middle">Print Semua Tiket</span></a>
                  </div>
                </form>
                <div class="table-responsive mt-3">
                <table class="table my-0 table-sm" id="myTable">
									<thead>
										<tr>
											<th>No Tiket</th>
											<th>Status</th>
                      <th>Judul</th>
                      <th>Permintaan</th>
                      <th>Prioritas</th>
                      <th>Dikirim</th>
                      {{-- <th>Ekspetasi Selesai</th> --}}
                      <th>Selesai</th>
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
											<td>{{ $tiket->created_at->format('d/m/y H:i') }}</td>
                      {{-- @if (isset($tiket->ekspetasiSelesai))
											  <td>{{ date('d/m/y H:i', strtotime($tiket->ekspetasiSelesai)) }}</td>
                      @else
                        <td>-</td>
                      @endif --}}
                      @if ($tiket->status == "Selesai")
											  <td>{{ $tiket->updated_at->format('d/m/y H:i') }}</td>
                      @else
                        <td>-</td>
                      @endif
                      <td><a href="/admin/laporan/one/{{ $tiket->idTiket }}" target="_Blank" class="btn btn-primary btn-sm"><i  data-feather="printer"></i> <span class="align-middle"></span></a></td>
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