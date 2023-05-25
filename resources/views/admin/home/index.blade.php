@extends('layouts.admin')
@section('container')
    <main class="content">
      <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Home</h1>
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="card flex-fill w-100">
              <div class="card-header">
                <h5 class="card-title">Jumlah Tiket Bulan {{ date('M') }}</h5>
              </div>
              <div class="card-body">
                @if ($label)
                <div class="chart">
                  <canvas id="chartjs-line"></canvas>
                </div>
                @else
                <div class="text-center">
                  <i class="align-middle mb-2" data-feather="alert-circle"></i>
                  <h5>Data is still empty</h5>
                </div>
                @endif 
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card flex-fill w-100">
              <div class="card-header">
                <h5 class="card-title">Tiket Status Dikirim</h5>
              </div>
              <div class="card-body">
                <table class="table my-0 table-sm">
									<thead>
										<tr>
											<th>No Tiket</th>
											<th>Permintaan</th>
                      <th>Judul</th>
										</tr>
									</thead>
									<tbody>
                    @foreach ($tikets as $tiket)
										<tr>
											<td class="align-baseline">{{ $tiket->noTiket }}</td>
											<td class="align-baseline">{{ $tiket->User->nama }}</td>
											<td class="align-baseline">{{ $tiket->permintaan }}</td>
										</tr>
                    @endforeach
                  </tbody>
                </table> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script>
      var label =  {{ Js::from($label) }};
      var total =  {{ Js::from($total) }};

      document.addEventListener("DOMContentLoaded", function() {
        // Line chart
        new Chart(document.getElementById("chartjs-line"), {
          type: "line",
          data: {
            labels: label,
            datasets: [{
              label: "Total",
              fill: true,
              backgroundColor: "transparent",
              borderColor: window.theme.primary,
              data: total
            }]
          },
          options: {
            maintainAspectRatio: false,
            legend: {
              display: false
            },
            tooltips: {
              intersect: false
            },
            hover: {
              intersect: true
            },
            plugins: {
              filler: {
                propagate: false
              }
            },
            scales: {
              xAxes: [{
                reverse: true,
                gridLines: {
                  color: "rgba(0,0,0,0.05)"
                }
              }],
              yAxes: [{
                ticks: {
                  stepSize: 500
                },
                display: true,
                borderDash: [5, 5],
                gridLines: {
                  color: "rgba(0,0,0,0)",
                  fontColor: "#fff"
                }
              }]
            }
          }
        });
      });
    </script>
@endsection