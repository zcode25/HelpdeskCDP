@extends('layouts.teknisi')
@section('container')

<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3">Detail Tiket</h1>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <form action="/teknisi/tiket/validasi/{{ $tiket->idTiket }}" method="POST">
              @csrf
              <input type="hidden" id="idTiket" name="idTiket" value="{{ $tiket->idTiket }}">
              <div class="mb-3">
                <label for="noTiket" class="form-label">No Tiket</label>
                <input type="text" class="form-control @error('noTiket') is-invalid @enderror" id="noTiket" name="noTiket" value="{{ $tiket->noTiket }}" autocomplete="off" readonly="on">
                @error('noTiket') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="user" class="form-label">Pengguna</label>
                <input type="text" class="form-control @error('user') is-invalid @enderror" id="user" name="user" value="{{ old('user', $tiket->User->nama) }}" autocomplete="off" readonly="on">
                @error('user')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="departemen" class="form-label">Departemen</label>
                <input type="text" class="form-control @error('departemen') is-invalid @enderror" id="departemen" name="departemen" value="{{ old('departemen', $tiket->User->Departemen->namaDepartemen) }}" autocomplete="off" readonly="on">
                @error('departemen')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="permintaan" class="form-label">Permintaan</label>
                <input type="text" class="form-control @error('permintaan') is-invalid @enderror" id="permintaan" name="permintaan" value="{{ old('permintaan', $tiket->permintaan) }}" autocomplete="off" readonly="on">
                @error('permintaan')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="uraianPermintaan" class="form-label">Uraian Permintaan</label>
                <textarea class="form-control @error('uraianPermintaan') is-invalid @enderror" id="uraianPermintaan" name="uraianPermintaan" rows="3" readonly="on">{{ old('uraianPermintaan', $tiket->uraianPermintaan) }}</textarea>
                @error('uraianPermintaan') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <hr />
              <div class="mb-3">
                <label for="prioritas" class="form-label">Prioritas</label>
                <input type="text" class="form-control @error('prioritas') is-invalid @enderror" id="prioritas" name="prioritas" value="{{ old('prioritas', $tiket->prioritas) }}" autocomplete="off" readonly="on">
                @error('prioritas')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="teknisi" class="form-label">Teknisi</label>
                <input type="text" class="form-control @error('teknisi') is-invalid @enderror" id="teknisi" name="teknisi" value="{{ old('teknisi', $tiket->Teknisi->nama) }}" autocomplete="off" readonly="on">
                @error('teknisi')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="ekspetasiSelesai" class="form-label">Ekspetasi Selesai</label>
                <input type="text" class="form-control @error('ekspetasiSelesai') is-invalid @enderror" id="ekspetasiSelesai" name="ekspetasiSelesai" value="{{ old('ekspetasiSelesai', $tiket->ekspetasiSelesai) }}" autocomplete="off" readonly="on">
                @error('ekspetasiSelesai')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <hr />
              <div class="mb-3">
                <label for="keteranganTambahan" class="form-label">Keterangan</label>
                <textarea class="form-control @error('keteranganTambahan') is-invalid @enderror" id="keteranganTambahan" name="keteranganTambahan" rows="3" required>{{ old('keteranganTambahan', $tiket->keteranganTambahan) }}</textarea>
                @error('keteranganTambahan') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="d-grid gap-2">
                <button type="submit" name="status" value="Validasi" class="btn btn-primary">Validasi</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">Histori Status</h5>
          </div>
          <div class="card-body h-100">
            {{-- {{ dd($detailTikets) }} --}}
            @foreach ($detailTikets as $detailTiket)

              <div class="d-flex align-items-start">
                @if ($detailTiket->status == "Ditolak" || $detailTiket->status == "Komplain" || $detailTiket->status == "Komplain Ditolak")  
                  <div><i class="me-2 text-danger" data-feather="{{ $detailTiket->ikon }}"></i></div>
                @elseIf ($detailTiket->status == "Validasi" || $detailTiket->status == "Ditahan" || $detailTiket->status == "Komplain Ditahan")  
                  <div><i class="me-2 text-warning" data-feather="{{ $detailTiket->ikon }}"></i></div>
                @elseIf ($detailTiket->status == "Penugasan" || $detailTiket->status == "Penugasan Komplain" || $detailTiket->status == "Dikirim" || $detailTiket->status == "Dikerjakan")  
                  <div><i class="me-2 text-secondary" data-feather="{{ $detailTiket->ikon }}"></i></div>
                @elseIf ($detailTiket->status == "Diterima" || $detailTiket->status == "Komplain Diterima")  
                  <div><i class="me-2 text-primary" data-feather="{{ $detailTiket->ikon }}"></i></div>
                @elseIf ($detailTiket->status == "Selesai")  
                  <div><i class="me-2 text-success" data-feather="{{ $detailTiket->ikon }}"></i></div>
                @endif
                {{-- <img src="img/avatars/avatar-5.jpg" width="36" height="36" class="rounded-circle me-2"> --}}
                <div class="flex-grow-1">
                  <small class="float-end text-navy">{{ $detailTiket->created_at->diffForHumans() }}</small>
                  <strong>{{ $detailTiket->status }}</strong><br />
                  <span>{{ $detailTiket->keterangan }}</span><br />
                  @isset($detailTiket->keteranganTambahan)
                    <div class="border text-sm text-muted p-2 mt-1 md-2">{{ $detailTiket->keteranganTambahan }}</div>
                  @endisset
                  <small class="text-muted">{{ $detailTiket->created_at }}</small><br />
                </div>
              </div>
              <hr />
            @endforeach
          
          </div>
        </div>
      </div>
    </div>
     
  </div>
</main>

@endsection