<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      font-size: 12px;
    }

    table, th, td {
      border-collapse: collapse;
    }

    th {
      background-color: #222E3C;
      color: white;
      text-align: left;
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
  <title>Laporan Semua Tiket</title>
</head>
<body>
    <div>
      <p style="font-size: 20px; font-weight:bold">Laporan Semua Tiket</p>
      <p>Tanggal : {{ date('d M Y') }}</p>
      <br>
    </div>
    <table style="width:100%">
      <tr>
        <th>No Tiket</th>
        <th>Status</th>
        <th>Judul</th>
        <th>Permintaan</th>
        <th>Prioritas</th>
        <th>Dikirim</th>
        {{-- <th>Ekspetasi Selesai</th> --}}
        <th>Selesai</th>
      </tr>
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
      </tr>
      @endforeach
    </table>
    <br />
    <br />
    <table class="ttd" style="width:100%; text-align:center; border:none">
      <tr>
        <td tyle="width:50%;">Pembuat</td>
        <td>Pimpinan</td>
      </tr>
      <tr>
        <td><br><br>ttd<br><br><br></td>
        <td><br><br>ttd<br><br><br></td>
      </tr>
      <tr>
        <td>Admin IT Helpdesk</td>
        <td>Agung Maulana</td>
      </tr>
    </table>
</body>
</html>