<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>

    .page-break {
        page-break-after: always;
    }

    body {
      font-family: 'Open Sans', sans-serif;
      font-size: 12px;
    }

    table, th, td {
      /* border:1px solid black; */
      border-collapse: collapse;
    }

    th, td {
      border-bottom: 1px solid #ddd;
      padding: 5px;
    }

    td {
      vertical-align: top;
    }

    .ttd td {
      border:none;
    }
  </style>
  <title>Laporan Tiket ({{ $tiket->noTiket }})</title>
</head>
<body>
    <div>
      <p style="font-size: 20px; font-weight:bold;">Laporan Tiket ({{ $tiket->noTiket }})</p>
      {{-- <img src="{{ asset('/img/cdp.png') }}" alt=""> --}}
    </div>
    <table style="width:100%">
      <tr>
        <td style="width:50%">
          <p>No Tiket : <strong>{{ $tiket->noTiket }}</strong></p>
          <p>Tanggal  : {{ $tiket->created_at }}</p>
          <p>Diminta Oleh  : {{ $tiket->User->nama }}</p>
        </td>
        <td style="width:50%">
          <p>Status : <strong>{{ $tiket->status }}</strong></p>
          <p>Teknisi : @isset($tiket->teknisi) {{ $tiket->Teknisi->nama }} @endisset </p>
          <p>Ekspetasi Selesai  : {{ $tiket->ekspetasiSelesai }}</p>
          <p>Waktu Selesai  : @if ($tiket->status == 'Selesai') {{ $tiket->updated_at }} @endif</p>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <p>Permintaan :</p>
          <p>{{ $tiket->permintaan }}</p>
        </td>
      <tr>
        <td colspan="2">
          <p>Uraian Permintaan : </p>
          <p>{{ $tiket->uraianPermintaan }}</p>
        </td>
      </tr>
    </table>

    <br /><br /><br /><br />
    <table class="ttd" style="width:100%; text-align: center">
      <tr>
        <td>Pelapor</td>
        <td>Penerima</td>
        @isset($tiket->teknisi) <td>Teknisi</td> @endisset
      </tr>
      <tr>
        <td><br><br>ttd<br><br><br></td>
        <td><br><br>ttd<br><br><br></td>
        @isset($tiket->teknisi) <td><br><br>ttd<br><br><br></td> @endisset
      </tr>
      <tr>
        <td>{{ $tiket->User->nama }}</td>
        <td>Admin IT Helpdesk</td>
        @isset($tiket->teknisi) <td>{{ $tiket->Teknisi->nama }}</td> @endisset
      </tr>
    </table>

    <div class="page-break"></div>
    <p style="font-size: 16px; font-weight:bold;">Histori Status</p>
    <table style="width:100%">
      @foreach ($detailTikets as $detailTiket)
      <tr>
        <td>
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
              {{-- <small class="float-end text-navy">{{ $detailTiket->created_at->diffForHumans() }}</small> --}}
              <p><strong>{{ $detailTiket->status }}</strong></p>
              <p>{{ $detailTiket->keterangan }}</p>
              @isset($detailTiket->keteranganTambahan)
                  <p>Keterangan : {{ $detailTiket->keteranganTambahan }}</p>
              @endisset
            </div>
          </div>
        </td>
        <td>
          <p class="text-muted">{{ $detailTiket->created_at }}</p>
        </td>
      </tr>
      @endforeach
    </table>
          {{-- {{ dd($detailTikets) }} --}}

            
          
    
</body>
</html>