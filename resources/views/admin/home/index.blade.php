@extends('layouts.admin')
@section('container')
    <main class="content">
      <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Analisis</h1>
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="card flex-fill w-100">
              <div class="card-header">
                <h5 class="card-title">Jumlah Duga Bahaya Tahun {{ date('Y') }}</h5>
                {{-- <h6 class="card-subtitle text-muted">A line chart is a way of plotting data points on a line.</h6> --}}
              </div>
    
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Kategori Stop 6</h5>
                {{-- <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6> --}}
              </div>
              
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Top Five Pelapor</h5>
                {{-- <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6> --}}
              </div>
              <div class="card-body">
                <table class="table my-0 table-sm">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Pelapor</th>
											<th>Jumlah Laporan</th>
										</tr>
									</thead>
									
                </table> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

@endsection