@extends('layouts.lyt_gumadesk')
@section('content')
<main class="main" id="top">
      <div class="container" data-layout="container">  
        <div class="content">
        @include('layouts.nav_gumadesk')
          
          <div class="card mb-3">
                <div class="card-header bg-light">
                  <div class="row justify-content-between">
                    <div class="col">
                      <div class="d-flex">
                        <div class="avatar avatar-2xl">
                          <img class="rounded-circle" src="{{ asset('images/user/avatar-4.jpg') }}" alt="" />
                        </div>
                        <div class="flex-1 align-self-center ms-2">
                          <p class="mb-1 lh-1"><a class="fw-semi-bold" href="../../pages/user/profile.html">Nombre Usuario </a> &bull; Ticket # <a href="#!">2737</a></p>
                          <p class="mb-0 fs--1">April 21, 2019, &bull; 5:33 PM &bull; <span class="fas fa-users"></span></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <div class="dropdown font-sans-serif">
                      <div class="badge rounded-pill badge-soft-success fs--2">Completado<span class="fas fa-check ms-1" data-fa-transform="shrink-2"></span></div>
                        <button class="btn btn-sm dropdown-toggle p-1 dropdown-caret-none" type="button" id="post-article-action" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-3" aria-labelledby="post-article-action">
                          <a class="dropdown-item" href="#!">Completado</a>
                          <a class="dropdown-item" href="#!">Procesando</a>
                          <a class="dropdown-item" href="#!">En espera</a>
                          <a class="dropdown-item" href="#!">Pendiente</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item text-danger" href="#!">Cerrar </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
                Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
                Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.
                Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>
               
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
                Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
                Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.
                Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>
               
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
                Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
                Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.
                Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>
                </div>
                <div class="card-footer bg-light pt-0">
                
                  <div class="row g-0 fw-semi-bold text-center py-2 fs--1">
                    <div class="col-auto"><a class="rounded-2 d-flex align-items-center me-3" href="#!"><img src="images/theme_gumadesk/spot-illustrations/attachment.png" width="20" alt="" /><span class="ms-1">Adjuntos</span></a></div>
                    
                  </div>
                
                  <form class="d-flex align-items-center border-top border-200 pt-3">
                    <div class="avatar avatar-xl">
                      <img class="rounded-circle" src="{{ asset('images/user/avatar-4.jpg') }}" alt="" />

                    </div>
                    <input class="form-control rounded-pill ms-2 fs--1" type="text" placeholder="Write a comment..." />
                  </form>
                  <div class="d-flex mt-3">
                    <div class="avatar avatar-xl">
                      <img class="rounded-circle" src="{{ asset('images/user/avatar-4.jpg') }}" alt="" />

                    </div>
                    <div class="flex-1 ms-2 fs--1">
                      <p class="mb-1 bg-200 rounded-3 p-2"><a class="fw-semi-bold" href="../../pages/user/profile.html">Administrador</a>                       
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
                        Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
                        Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.
                        Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.
                      </p>
                      <div class="px-2"> 3hrs </div>
                    </div>
                  </div>
                  <div class="d-flex mt-3">
                    <div class="avatar avatar-xl">
                      <img class="rounded-circle" src="{{ asset('images/user/avatar-4.jpg') }}" alt="" />

                    </div>
                    <div class="flex-1 ms-2 fs--1">
                      <p class="mb-1 bg-200 rounded-3 p-2"><a class="fw-semi-bold" href="../../pages/user/profile.html">Nombre Usuario </a> 
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
                        Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.
                        Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.
                        Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.
                      🏆</p>
                      <div class="px-2"> 3hrs </div>
                    </div>
                  </div>
                </div>
              </div>
          @include('layouts.footer_gumadesk')
        </div>
      </div>
    </main>

   
@endsection
