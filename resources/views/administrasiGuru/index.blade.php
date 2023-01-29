@extends('layout.admin')
@section('body')
    <div class="ms-3 pt-3">

        @if (auth()->user()->role->name == $akses)
            <div class="d-flex justify-content-start">
                {{-- trigger tambah folder --}}
                <button type="button" class="nav-link m-2" data-bs-toggle="modal" data-bs-target="#folder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-folder-plus" viewBox="0 0 16 16">
                        <path
                            d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z" />
                        <path
                            d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                </button>
                {{-- trigger FIle --}}
                <button type="button" class="nav-link m-2" data-bs-toggle="modal" data-bs-target="#file">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-file-plus" viewBox="0 0 16 16">
                        <path
                            d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z" />
                        <path
                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
                    </svg>
                </button>
            </div>
        @endif

        <div id="show">
            @if (count($folders))
                <h4>Folder</h4>
            @elseif(count($files))
            @else
                <h4 class="text-center mt-3 text-secondary"> Belum Ada Data</h4>
            @endif
            {{-- Folder --}}
            <div class="row mt-3">
                <ul class="d-flex flex-wrap" style="list-style-type: none">
                    @foreach ($folders as $folder)
                        <li class="col-3 mb-3">
                            <div href="" class="card -1" height='300px'>
                                @if (
                                    $folder->logo !=
                                        'https://www.seekpng.com/png/detail/12-127264_yellow-folder-png-clipart-transparent-download-open-folder.png')
                                    <img src="{{ url('') . '/app/file/' . $folder->logo }}" width="100%" height=""
                                        class="card__image object-fit-scale" alt="" />
                                @else
                                    <img src="{{ $folder->logo }}" class="card__image" alt="" />
                                @endif
                                <div class="card__overlay shadow">
                                    <a href="/{{ $folder->role->name }}/{{ $folder->name }}/akses"
                                        class="text-decoration-none">
                                        <div class="card__header">
                                            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
                                                <path />
                                            </svg>
                                            <div class="card__header-text">
                                                <h3 class="card__title">{{ $folder->name }}</h3>
                                                <span class="card__status">
                                                    {{ $folder->created_at }}
                                                </span><br>
                                                <span>
                                                    oleh : {{ $folder->user->name }}
                                                </span>
                                                <div class="border bg-light text-center" id="buka">
                                                    Buka
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @if (auth()->user()->role->name == $folder->role->name)
                                        <div class="d-flex justify-content-end" id="dot3">
                                            <div class="dropdown">
                                                <div class="" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-three-dots-vertical"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                    </svg>
                                                </div>
                                                <ul class="dropdown-menu">
                                                    <li> {{-- trigger edit folder --}}
                                                        <div class="nav-link ms-4 ps-1" data-bs-toggle="modal"
                                                            data-bs-target="#editfolder{{ $folder->id }}">
                                                            Edit
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <form class="  btn btn-white"
                                                            action="/folderOrFile/{{ $folder->id }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <input class="dropdown-item" type="submit"
                                                                onclick="return confirm('Yakin Menghapus Folder Dan Semua File Yang Ada didalamnya ?')"
                                                                value="Hapus Folder">
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </li>
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
                                                    <img class="img-preview " style="display: block;" src=""
                                                        width="100%">
                                                    <small class="text-danger" id="skala"> </small>
                                                </div>
                                            </div>
                                            <input class="form-control mt-2 mb-2" name="foto" id="image"
                                                type="file" placeholder="foto" onchange="previewImage()">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Nama Folder</span>
                                                <input type="text" class="form-control" placeholder="Nama Folder"
                                                    aria-label="Nama Folder" aria-describedby="basic-addon1"
                                                    name="name" value="{{ $folder->name }}">
                                            </div>
                                            <input type="hidden" value="folder" name="type">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success col-3">Edit Folder</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </ul>
            </div>
            @if (count($files))
                <h4>File</h4>
            @endif

            {{-- File --}}
            <div class="row mt-3">
                <ul class="row" style="list-style-type: none">
                    @foreach ($files as $folder)
                        <li class="col-3 mb-3">
                            <div href="" class="card p-1">
                                <img src="{{ $folder->logo }}" class="card__image" alt="" />
                                <div class="card__overlay">
                                    <a href="/{{ $folder->name }}" class="text-decoration-none">
                                        <div class="card__header">
                                            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
                                                <path />
                                            </svg>
                                            <div class="card__header-text">
                                                <h3 class="card__title">{{ $folder->name }}</h3>
                                                <span class="card__status">
                                                    {{ $folder->created_at }}
                                                </span><br>
                                                <span class="mt-5">
                                                    oleh : {{ $folder->user->name }}
                                                </span><br>
                                                <div class="border bg-light text-center" id="buka">
                                                    Buka
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="d-flex justify-content-end" id="dot3">
                                        <div class="dropdown">
                                            <div class="" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-three-dots-vertical"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                </svg>
                                            </div>
                                            <ul class="dropdown-menu">

                                                @if (auth()->user()->role->name == $folder->role->name)
                                                    <li><a class="dropdown-item"
                                                            href="/file/delete/{{ $folder->id }}">Hapus
                                                            {{ csrf_field() }}</a></li>
                                                @endif
                                                <li><a class="dropdown-item"
                                                        href="/file/download/{{ $folder->path }}/{{ $folder->name }}">Download</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Modal Folder -->
        <form action="/folderOrFile" method="POST">
            @csrf
            <div class="modal fade" id="folder" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Folder</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Nama Folder</span>
                                <input type="text" class="form-control" placeholder="Nama Folder"
                                    aria-label="Nama Folder" aria-describedby="basic-addon1" name="name">
                            </div>
                            <input type="hidden" value="folder" name="type">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success col-3">Buat Folder</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Modal File -->
        <form action="/upload-file" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="file" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" placeholder="Nama Folder"
                                    aria-label="Nama Folder" aria-describedby="basic-addon1" name="name">
                            </div>
                            <input type="hidden" value="file" name="type">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success col-3">upload File</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
            document.getElementById('skala').innerHTML = "*Disarankan Skala 1:1";
        }

        function ajax(str) {
            if (str == "") {
                document.getElementById("show").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("show").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "/search/" + str, true);
                xmlhttp.send();
            }
        }
    </script>
@endsection
