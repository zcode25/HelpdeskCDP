@extends('layouts.pimpinan')
@section('container')
    <main class="content">
      <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Home</h1>
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="card flex-fill w-100">
              <div class="card-header">
                <h5 class="card-title">Jumlah {{ date('Y') }}</h5>
              </div>
    
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Kategori</h5>
                {{-- <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6> --}}
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </main>

@endsection