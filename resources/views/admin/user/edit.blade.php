@extends('layouts.admin')
@section('container')

<main class="content">
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3">Edit User</h1>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <form action="/admin/user/update/{{ $user->nik }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $user->nik)}}" autocomplete="off">
                @error('nik') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $user->nama)}}" autocomplete="off">
                @error('nama') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="departemen" class="form-label">Departemen</label>
                <select class="form-select" id="departemen" name="departemen">
                    @foreach ($departemens as $departemen)
                        @if (old('departemen', $user->departemen) == $departemen->kodeDepartemen)
                            <option value="{{ $departemen->kodeDepartemen }}" selected>{{ $departemen->namaDepartemen }}</option>
                            @else
                            <option value="{{ $departemen->kodeDepartemen }}">{{ $departemen->namaDepartemen }}</option>
                        @endif
                    @endforeach
                  </select>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" autocomplete="off">
                @error('email') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="tel" class="form-label">Telepon</label>
                <input type="tel" class="form-control @error('tel') is-invalid @enderror" id="tel" name="tel" value="{{ old('tel', $user->tel) }}" autocomplete="off">
                @error('tel') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="tipe" class="form-label">Tipe</label>
                <select class="form-select" id="tipe" name="tipe">
                    @foreach ($tipes as $tipe)
                        @if (old('tipe', $user->tipe) == $tipe['tipe'])
                            <option value="{{ $tipe['tipe'] }}" selected>{{ $tipe['tipe'] }}</option>
                            @else
                            <option value="{{ $tipe['tipe'] }}">{{ $tipe['tipe'] }}</option>
                        @endif
                    @endforeach
                  </select>
              </div>
              <div class="d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-primary">Edit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <form action="/admin/user/updatePassword/{{ $user->nik }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" autocomplete="off">
                @error('password') 
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>        
              <div class="d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-primary">Ubah Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

@endsection