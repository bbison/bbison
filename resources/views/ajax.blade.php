<table class="table table-hover">
    <tr>
        <th>Nama</th>
        <th>Tipe</th>
        <th>Aksi</th>
    </tr>
    @foreach ($folders as $folder)
        <tr>
            <td>{{ $folder->name }}</td>
            <td>{{ $folder->type }}</td>
            <td>
                @if ($folder->type == 'folder')
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Aksi
                        </button>
                        <ul class="dropdown-menu">
                            <li>@if (auth()->user()->role->name == $folder->role->name)
                                <div class="nav-link ms-4 ps-1" data-bs-toggle="modal"
                                    data-bs-target="#editfolder{{ $folder->id }}">
                                    Edit
                                </div>
                                @endif
                            </li>
                            <li><a class="dropdown-item"
                                    href="/{{ $folder->role->name }}/{{ $folder->name }}/akses">Lihat</a></li>
                        </ul>
                    </div>
                @elseif($folder->type == 'file')
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Aksi
                        </button>
                        <ul class="dropdown-menu">

                            @if (auth()->user()->role->name == $folder->role->name)
                                <li><a class="dropdown-item" href="/file/delete/{{ $folder->id }}">Hapus
                                        {{ csrf_field() }}</a></li>
                            @endif
                            <li><a class="dropdown-item"
                                    href="/file/download/{{ $folder->path }}/{{ $folder->name }}">Download</a>
                            </li>
                        </ul>
                    </div>
                @endif
            </td>
            <!-- Modal Edit Folder -->
            <form action="/folderOrFile/{{ $folder->id }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal fade" id="editfolder{{ $folder->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Folder</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-center">
                                    <div class="col-sm-8">
                                        <img class="img-preview " style="display: block;" src="" width="100%">
                                        <small class="text-danger" id="skala"> </small>
                                    </div>
                                </div>
                                <input class="form-control mt-2 mb-2" name="foto" id="image" type="file"
                                    placeholder="foto" onchange="previewImage()">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Nama Folder</span>
                                    <input type="text" class="form-control" placeholder="Nama Folder"
                                        aria-label="Nama Folder" aria-describedby="basic-addon1" name="name"
                                        value="{{ $folder->name }}">
                                </div>
                                <input type="hidden" value="folder" name="type">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success col-3">Edit Folder</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </tr>
    @endforeach
</table>
