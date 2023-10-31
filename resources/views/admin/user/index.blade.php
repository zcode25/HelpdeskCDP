@extends('layouts.admin')
@section('container')
    <main class="content">
      <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Daftar User</h1>
        @if (session()->has('success'))  
        <div class="alert alert-warning alert-dismissible fade show badge bg-success mb-3" role="alert">
          <span>{{ session('success') }}</span>
          <button type="button" class="ms-3 btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <a href="/admin/user/create" class="btn btn-primary btn-sm mb-3"><i class="me-2" data-feather="user-plus"></i> <span class="align-middle">Tambah User</span></a>
                <div class="table-responsive mt-3">
                <table class="table my-0 table-sm" id="myTable">
									<thead>
										<tr>
											<th>No</th>
											<th>NIK</th>
											<th>Nama</th>
											<th>Departemen</th>
											<th>Email</th>
											<th>Telepon</th>
											<th>Tipe</th>
                      <th>Aksi</th>
										</tr>
									</thead>
									<tbody>
                    @php($i = 1)
                    @foreach ($users as $user)
              
										<tr>
											<td class="align-baseline">{{ $i }}</td>
											<td class="align-baseline">{{ $user->nik }}</td>
											<td class="align-baseline">{{ $user->nama }}</td>
											<td class="align-baseline">{{ $user->Departemen->namaDepartemen }}</td>
											<td class="align-baseline">{{ $user->email }}</td>
											<td class="align-baseline">{{ $user->tel }}</td>
                      <td class="align-baseline">
                        @if ($user->tipe == 'karyawan')
                          <span class="badge bg-success">{{ $user->tipe }}</span>  
                        @elseIf ($user->tipe == 'admin')
                          <span class="badge bg-primary">{{ $user->tipe }}</span>
                        @elseIf ($user->tipe == 'teknisi')
                          <span class="badge bg-secondary">{{ $user->tipe }}</span> 
                        @elseIf ($user->tipe == 'pimpinan')
                          <span class="badge bg-info">{{ $user->tipe }}</span>  
                        @endif
                      </td>
                      <td>
                      @if ($user->nik != '123456789')
                        <a href="/admin/user/edit/{{ $user->nik }}" class="btn btn-primary btn-sm"><i class="align-middle" data-feather="edit"></i></a>
                        <form action="/admin/user/destroy/{{ $user->nik }}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')"><i class="align-middle" data-feather="trash"></i></button>
                        </form>
                      @endif 
                        
                      </td>
										</tr>
                    @php($i++)
                    @endforeach
                  </tbody>
                </table>  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
@endsection