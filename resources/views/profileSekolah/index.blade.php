@extends('layout.admin')
@section('body')
       <ul class="cards ">
        <li class="col-3">
          <div href="" class="card">
            <img src="https://www.seekpng.com/png/detail/12-127264_yellow-folder-png-clipart-transparent-download-open-folder.png" class="card__image" alt="" />
            <div class="card__overlay">
            <a href="" class="text-decoration-none">        
              <div class="card__header">
                <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                 
                <div class="card__header-text">
                  <h3 class="card__title">Nama Folder</h3>
                  <span class="card__status">
                  3 hours ago
                  </span><br>
                  <span class="card__status">
                  dibuat oleh : bagas Wibisono
                  </span><br>
                  <span class="card__status">
                  dibuat Pada 21 agustus 2022
                  </span>
                  <div class="border bg-light text-center" id="buka">
                  Buka
                  </div>
                </div>
              </div>
            </a>
            <div class="d-flex justify-content-end" id="dot3">
                <div class="dropdown">
                        <div class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Ganti Nama</a></li>
                            <li><a class="dropdown-item" href="#">Ganti Gambar</a></li>
                            <li><a class="dropdown-item" href="#">Hapus Folder</a></li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
           
        </li>
      </ul>
@endsection