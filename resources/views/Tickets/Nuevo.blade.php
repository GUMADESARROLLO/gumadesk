@extends('layouts.lyt_gumadesk')
@section('content')
<main class="main" id="top">
      <div class="container" data-layout="container">       
        <div class="content">          
        @include('layouts.nav_gumadesk')
          <form class="card">
            <div class="card-header bg-light">
              <h5 class="mb-0">Nueva Tickets</h5>
            </div>
            <div class="card-body p-0">
              <div class="border border-top-0 border-200">

                <div class="form-floating">
                  <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                    <option selected="">Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                  <label for="floatingSelect">Categoria del Ticket</label>
                </div>
              </div>
              <div class="border border-y-0 border-200">
                <div class="form-floating">
                  <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                    <option selected="">Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                  <label for="floatingSelect">Subs Categorias</label>
                </div>
              </div>
              <div class="min-vh-50">
                <textarea class="tinymce d-none" name="content"></textarea>
              </div>              
            </div>
            
          </form>

          <div class="card mb-3">
            <div class="card-body bg-light">
              <form class="dropzone dropzone-multiple p-0" id="dropzoneMultipleFileUpload" data-dropzone="data-dropzone" action="#!">
                <div class="fallback">
                  <input name="file" type="file" multiple="multiple" />
                </div>
                <div class="dz-message" data-dz-message="data-dz-message"> <img class="me-2" src="assets/img/icons/cloud-upload.svg" width="25" alt="" />/ AGREGUE UN ARCHIVO O SUELTE ARCHIVOS AQUI</div>
                <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                  <div class="d-flex media align-items-center mb-3 pb-3 border-bottom btn-reveal-trigger"><img class="dz-image" src="assets/img/icons/cloud-upload.svg" alt="..." data-dz-thumbnail="data-dz-thumbnail" />
                    <div class="flex-1 d-flex flex-between-center">
                      <div>
                        <h6 data-dz-name="data-dz-name"></h6>
                        <div class="d-flex align-items-center">
                          <p class="mb-0 fs--1 text-400 lh-1" data-dz-size="data-dz-size"></p>
                          <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                        </div>
                      </div>
                      <div class="dropdown font-sans-serif">
                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h"></span></button>
                        <div class="dropdown-menu dropdown-menu-end border py-2"><a class="dropdown-item" href="#!" data-dz-remove="data-dz-remove">Remover Archivo</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer border-top border-200 d-flex flex-between-center">
              <div class="d-flex align-items-center">
                <button class="btn btn-primary btn-sm px-5 me-2" type="submit">Enviar</button>                
              </div>
            </div>
          </div>
          
          
          @include('layouts.footer_gumadesk')
        </div>
      </div>
    </main>
@endsection
