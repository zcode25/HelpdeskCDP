@extends('layouts.karyawan')
@section('container')

<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3">Detail Tiket</h1>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <form action="" method="POST">
              @csrf
              <div class="mb-3">
                <label for="noTiket" class="form-label">No Tiket</label>
                <input type="text" class="form-control @error('noTiket') is-invalid @enderror" id="noTiket" name="noTiket" value="{{ $tiket->noTiket }}" autocomplete="off" readonly="on">
                @error('noTiket') 
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
                <div><i class="me-2 text-success" data-feather="{{ $detailTiket->ikon }}"></i></div>
                {{-- <img src="img/avatars/avatar-5.jpg" width="36" height="36" class="rounded-circle me-2"> --}}
                <div class="flex-grow-1">
                  <small class="float-end text-navy">{{ $detailTiket->created_at->diffForHumans() }}</small>
                  <strong>{{ $detailTiket->status }}</strong><br />
                  <span>{{ $detailTiket->keterangan }}</span><br />
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