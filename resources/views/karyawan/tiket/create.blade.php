@extends('layouts.karyawan')
@section('container')

<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3">Buat Tiket</h1>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <form action="/karyawan/tiket/store" method="POST">
              @csrf
              <div class="mb-3">
                <label for="noTiket" class="form-label">No Tiket</label>
                <input type="text" class="form-control @error('noTiket') is-invalid @enderror" id="noTiket" name="noTiket" value="{{ "CDP/IT/" . date('y/m/d/') . rand(1000, 9999) }}" autocomplete="off" readonly="on">
                @error('noTiket') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="permintaan" class="form-label">Permintaan</label>
                <input type="text" class="form-control @error('permintaan') is-invalid @enderror" id="permintaan" name="permintaan" value="{{ old('permintaan') }}" autocomplete="off">
                @error('permintaan')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="uraianPermintaan" class="form-label">Uraian Permintaan</label>
                <textarea class="form-control @error('uraianPermintaan') is-invalid @enderror" id="uraianPermintaan" name="uraianPermintaan" rows="3">{{ old('uraianPermintaan') }}</textarea>
                @error('uraianPermintaan') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              
              <div class="d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-primary">Buat</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

@endsection