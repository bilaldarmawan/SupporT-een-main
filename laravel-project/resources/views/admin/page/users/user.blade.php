@extends('admin.layout.index')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">User Management</h1>
            </div>
          </div>
        </div>
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="col-md-12">
            <div class="card card-outline card-info">
              <div class="card-header">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">Tambah</button>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Level</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                          @if ($user->level == 1)
                            <span class="badge bg-success">Admin</span>
                          @else
                            <span class="badge bg-primary">Resepsionis</span>
                          @endif
                        </td>
                        <td>
                          <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                          <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

  <!-- Modal -->
  <div class="modal fade" id="tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Users</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" placeholder="Nama Users">
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" name="username" placeholder="Username Users">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password Users">
            </div>
            <div class="form-group">
              <label>Level Users</label>
              <select name="level" class="form-control" required>
                <option value="">--- Pilih Level ---</option>
                <option value="1">Admin</option>
                <option value="2">Resepsionis</option>                
              </select>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

@endsection