@extends('layouts.admin')
@section('container')
    <main class="content">
      <div class="container-fluid p-0">
        <h1 class="h3 mb-3">List User</h1>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                @if (session()->has('success'))  
                  <div class="badge bg-success text-white mb-2">
                    {{ session('success') }}
                  </div>
                @endif
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
                        @if ($user->type == 'employee')
                          <span class="badge bg-danger">{{ $user->tipe }}</span>  
                          @elseIf ($user->type == 'admin')
                          <span class="badge bg-primary">{{ $user->tipe }}</span>  
                          @else
                          <span class="badge bg-success">{{ $user->tipe }}</span>  
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