@extends('layouts.admin')
@section('container')

<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3">Edit Departemen</h1>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <form action="/admin/departemen/update/{{ $departemen->kodeDepartemen }}" method="POST">
              @csrf
              <input type="hidden" id="kodeDepartemen" name="kodeDepartemen" value="{{ $departemen->kodeDepartemen }}">
              <div class="mb-3">
                <label for="namaDepartemen" class="form-label">Nama Departement</label>
                <input type="text" class="form-control @error('namaDepartemen') is-invalid @enderror" id="namaDepartemen" name="namaDepartemen" value="{{ old('namaDepartemen', $departemen->namaDepartemen) }}" autocomplete="off">
                @error('namaDepartemen') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-primary">Edit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

@endsection