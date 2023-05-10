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
  <title>Surat Permintaan Kerja</title>
</head>
<body>
    <div>
      <p style="font-size: 20px; font-weight:bold;">Surat Permintaan Kerja</p>
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
          <p>Kepada : {{ $tiket->Teknisi->nama }}</p>
          <p>Ekspetasi Selesai  : {{ $tiket->ekspetasiSelesai }}</p>
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
        <td>Penugasan</td>
        <td>Teknisi</td>
      </tr>
      <tr>
        <td><br><br>ttd<br><br><br></td>
        <td><br><br>ttd<br><br><br></td>
        <td><br><br>ttd<br><br><br></td>
      </tr>
      <tr>
        <td>{{ $tiket->User->nama }}</td>
        <td>Admin IT Helpdesk</td>
        <td>{{ $tiket->Teknisi->nama }}</td>
      </tr>
    </table>
</body>
</html>