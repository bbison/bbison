@extends('layout.admin')
@section('body')
<button type="button" class="d-inline btn btn-success m-3" data-bs-toggle="modal" data-bs-target="#adduser">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
      </svg>
</button>
    <table class="table table-striped-rows m-1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Bagian</th>
            <th>Action</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td class="row">
                    <button type="button" class="d-inline col-4 btn btn-success" data-bs-toggle="modal" data-bs-target="#user{{ $user->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                          </svg>
                    </button>
                    <form action="/account/user/{{ $user->id }}" method="post" class="d-inline col-4">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" value="Hapus" onclick="return confirm('Yakin Menghapus Data ini ?')" id=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                          </svg></button>
                    </form>
                </td>
                 {{-- modal edit --}}
    <form action="/account/user/{{ $user->id }}" method="POST">
        @method('PUT')
        @csrf
        <div class="modal fade" id="user{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Nama</span>
                            <input type="text" class="form-control" placeholder="Nama Folder"
                                aria-label="Nama Folder" aria-describedby="basic-addon1" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Bagian</span>
                            <select name="role_id" id="" class="form-control">
                                <option>Silahkan Pilih Bagian</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @if ($user->role->id == $role->id) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Email</span>
                            <input type="email" class="form-control" placeholder="Nama Folder"
                                aria-label="Nama Folder" aria-describedby="basic-addon1" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Password</span>
                            <input type="password" class="form-control" placeholder="Nama Folder"
                                aria-label="Nama Folder" aria-describedby="basic-addon1" name="password" value="{{ $user->password }}">
                        </div>
                        <input type="hidden" value="folder" name="type">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success col-3">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
            </tr>
        @endforeach
    </table>
   
{{-- tambah user --}}
    <form action="/account/user" method="POST">
        @csrf
        <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Nama User</span>
                            <input type="text" class="form-control" placeholder="Nama User"
                                aria-label="Nama User" aria-describedby="basic-addon1" name="name">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Bagian</span>
                            <select name="role_id" id="" class="form-control">
                                <option>Silahkan Pilih Bagian</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Email</span>
                            <input type="Email" class="form-control" placeholder="Nama Folder"
                                aria-label="Email" aria-describedby="basic-addon1" name="email">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">password</span>
                            <input type="password" class="form-control" placeholder="Password"
                                aria-label="Nama Folder" aria-describedby="basic-addon1" name="password">
                        </div>                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success col-3">Tambah User</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
