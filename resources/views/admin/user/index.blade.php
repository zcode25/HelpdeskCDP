@extends('layouts.admin')
@section('container')
    <main class="content">
      <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Daftar User</h1>
        @if (session()->has('success'))  
          <div class="badge bg-success text-white mb-2">
            {{ session('success') }}
          </div>
        @endif
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <a href="/admin/user/create" class="btn btn-primary btn-sm mb-3"><i class="me-2" data-feather="user-plus"></i> <span class="align-middle">Tambah User</span></a>
                <table class="table my-0 table-sm">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Departemen</th>
											<th>Email</th>
											<th>Telephone</th>
											<th>Tipe</th>
                      <th>Aksi</th>
										</tr>
									</thead>
									<tbody>
                    @php($i = 1)
                    @foreach ($users as $user)
              
										<tr>
											<td>{{ $i }}</td>
											<td>{{ $user->nama }}</td>
											<td>{{ $user->Departemen->namaDepartemen }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->tel }}</td>
                      <td>
                        @if ($user->tipe == 'karyawan')
                          <span class="badge bg-success">{{ $user->tipe }}</span>  
                          @elseIf ($user->tipe == 'admin')
                          <span class="badge bg-primary">{{ $user->tipe }}</span>  
                        @endif
                      </td>
                      <td><a href="/admin/user/editUser/{{ $user->id }}" class="btn btn-primary btn-sm">View</a></td>
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
    </main>
@endsection