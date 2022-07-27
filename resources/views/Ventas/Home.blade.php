@extends('layouts.lyt_gumadesk')
@section('metodosjs')
@include('jsViews.js_ventas');
<style>
  

    .dataTables_paginate {
        display: flex;
        align-items: center;
        padding-top: 20px;

    }
    .notification-body {
      width: 100% !important;
    }
    .dataTables_paginate a {
        padding: 0 10px;
        margin-inline: 5px;
    }

    .dataTables_wrapper .dataTables_paginate {
      font-size: .8rem;      
    }

    .dt-center {
      text-align: center;
    }

    .dt-right {
      text-align: right;
    }

    .dt-left {
      text-align: left;
    }
    .custom {
        min-width: 70%;
        min-height: 100%;
    }

    .custom_detail {
        min-width: 80%;
        min-height: 100%;
    }

    u.dotted {
        border-bottom: 1px dashed red;
        text-decoration: none;
    }

    .dBorder {
        border: 1px solid #ccc !important;
    }

    .text-primary {
        color: #4e73df !important;
    }

    .text-success {
        color: #1cc88a !important;
    }

    .text-info {
        color: #36b9cc !important;
    }

    .text-warning {
        color: #f6c23e !important;
    }

    .border-left-primary {
        border-left: .25rem solid #4e73df !important;
    }

    .border-left-success {
        border-left: .25rem solid #1cc88a !important;
    }

    .border-left-info {
        border-left: .25rem solid #36b9cc !important;
    }

    .border-left-warning {
        border-left: .25rem solid #f6c23e !important;
    }

    .color-focus {
        color: #0894ff !important;
    }

    .nav-tabs>.nav-item {
        padding-left: 3.25rem;
    }

    @media (min-width: 768px) {
        .nav-tabs .nav-item {
            padding-left: 1.5rem;
        }
    }

    @media (min-width: 992px) {
        .nav-tabs .nav-item {
            padding-left: 1.75rem;
        }
    }

    @media (min-width: 1200px) {
        .nav-tabs .nav-item {
            padding-left: 2.25rem;
        }
    }

    .swal2-shown {
        padding-right: 0px !important;
    }
</style>
@endsection
@section('content')
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container-fluid" data-layout="container">
      
        <div class="content">
          
          
          @include('layouts.nav_gumadesk')

          <div class="row g-3 mb-3">
            
            <div class="col-lg-12" >
              <div class="card">
              <div class="card-header">
                  <div class="row flex-between-center ">
                    <div class="col-auto col-sm-6 col-lg-7">
                      <div class="d-flex">
                        <div class="row g-sm-4">
                        <div class="col-12 col-sm-auto">
                          <div class="pe-4 border-sm-end border-200">
                            <h6 class="fs--2 text-600 mb-1">Total Articulos</h6>
                            <div class="d-flex align-items-center">
                              <h5 class="fs-0 text-900 mb-0 me-2" id="id_table_articulos_count"> 0 </h5><span class="badge rounded-pill badge-soft-primary"><span class="fas fa-caret-up"></span> 100 %</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-auto">
                          <div class="pe-4 border-sm-end border-200">
                            <h6 class="fs--2 text-600 mb-1">Articulos TOP</h6>
                            <div class="d-flex align-items-center">
                              <h5 class="fs-0 text-900 mb-0 me-2" id="id_table_articulos_top"> 0 </h5><span class="badge rounded-pill badge-soft-success"> 80 %</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-auto">
                          <div class="pe-0">
                            <h6 class="fs--2 text-600 mb-1">Articulos Otros</h6>
                            <div class="d-flex align-items-center">
                              <h5 class="fs-0 text-900 mb-0 me-2" id="id_table_articulos_nTop"> 0 </h5><span class="badge rounded-pill badge-soft-warning"> 20 %</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>
                    <div class="col-auto col-sm-6 col-lg-5">

                      <div class="input-group"> 
                        <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Buscar..." aria-label="search" id="id_search_articulo_ruta" />
                        <div class="input-group-text bg-transparent"><span class="fa fa-search fs--1 text-600"></span></div>
                        
                        <select class="form-select form-select-sm pe-4" id="IdSelectRuta">
                          @foreach ($Vendedores as $vendedor)
                            <option value="{{$vendedor['VENDEDOR']}}">{{$vendedor['VENDEDOR']}} | {{strtoupper($vendedor['NOMBRE'])}}</option>
                          @endforeach
                        </select>
                        <div class="input-group-text bg-transparent" id="id_table_articulos_ruta">
                          <span class="fa fa-upload fs--1 text-600" ></span>
                        </div>
                        <div class="input-group-text bg-transparent" id="id_table_articulos_add">
                          <span class="fa fa-plus fs--1 text-600" ></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-0 mt-3">
                  <div class="tab-content">
                    <div class="tab-pane preview-tab-pane active" >
                      <div class="table-responsive scrollbar">
                        <table class="table" id="id_table_articulos">
                          
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane code-tab-pane" >
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6"  style="display:none">
              <div class="card z-index-1">
              <div class="card-header">
                  <div class="row flex-between-center ">
                    <div class="col-auto col-sm-6 col-lg-5">
                      <h1 class="fs-0 text-900">ARTICULOS CON VIÑETAS</h1>
                      <div class="d-flex">
                        <h4 class="text-primary mb-0">$165.50</h4>
                        <div class="ms-3"><span class="badge rounded-pill badge-soft-primary"><span class="fas fa-caret-up"></span> 5%</span></div>
                      </div>
                    </div>
                    <div class="col-auto col-sm-6 col-lg-7 mt-3">
                      <div>
                        <form>
                          <div class="input-group">
                            <select class="form-select" id="IdSelectMes">
                                <?php                        
                                    $mes = date("m");

                                    $meses = array('none','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

                                    for ($i= 1; $i <= 12 ; $i++) {
                                      if ($i==$mes) {
                                          echo'<option selected value="'.$i.'">'.$meses[$i].'</option>';
                                      }else {
                                          echo'<option value="'.$i.'">'.$meses[$i].'</option>';
                                      }
                                    }
                                ?>
                            </select>
                            <select class="form-select" id="IdSelectAnnio">
                              <?php
                                  $year = date("Y");
                                  for ($i= 2020; $i <= $year ; $i++) {
                                      if ($i==$year) {
                                          echo'<option selected value="'.$i.'">'.$i.'</option>';
                                      }else {
                                          echo'<option value="'.$i.'">'.$i.'</option>';
                                      }
                                  }
                              ?>
                            </select>
                            <div class="input-group-text bg-transparent"  id="id_send_filtros">
                              <span class="fa fa-filter fs--1 text-600"></span>
                            </div>
                            <div class="input-group-text bg-transparent" id="id_add_item_vinneta">
                              <span class="fa fa-plus fs--1 text-600"></span>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-0 ">
                  <div class="tab-content">
                    <div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-f81ca2e4-6ec3-4ee6-b1d2-d931b9d71eac" id="dom-f81ca2e4-6ec3-4ee6-b1d2-d931b9d71eac">
                      <div class="table-responsive scrollbar">
                        <table class="table table-striped overflow-hidden" id="id_table_articulos_vinneta">
                         
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane code-tab-pane" role="tabpanel" aria-labelledby="tab-dom-0187137a-3aed-4b9d-972f-0a3c4ff9a5bb" id="dom-0187137a-3aed-4b9d-972f-0a3c4ff9a5bb">
                      
                    </div>
                  </div>                  
                </div>                
              </div>
            
            </div>

            <div class="content">
          
          <div class="card">
            <div class="card-header bg-light">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="mb-0" id="followers">Rutas <span class="d-none d-sm-inline-block">( {{count($Vendedores)}} )</span></h5>
                </div>
                
              </div>
            </div>
            <div class="card-body bg-light px-1 py-0">
              
              <div class="row g-0 text-center fs--1">
              @foreach ($Vendedores as $vendedor)

              
                <div class="kanban-items-container scrollbar col-12 col-md-4 col-lg-3 col-xxl-3">
                  <div class="kanban-item">
                    <div class="card kanban-item-card hover-actions-trigger">
                      <div class="card-body">                      
                        <div class="mb-2">
                        <div class="d-flex align-items-start position-relative">
                          <div class="avatar avatar-2xl status-online">
                            <img class="rounded-circle" src="images/avatar.png" alt="" />

                          </div>
                          <div class="flex-1 ms-3">
                            <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900" href="#!" onClick="mdlAsignar('{{$vendedor['VENDEDOR']}}')"> {{$vendedor['VENDEDOR']}} | {{$vendedor['NOMBRE']}}</a></h6>
                            
                          </div>
                        </div>
                        </div>
                        <div class="kanban-item-footer cursor-default">

                        
                          <div class="col-12 ">
                            <div class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="#!">
                              <span class="fas fa-file-alt text-primary" data-fa-transform="grow-4"></span>
                              <span class="ms-2">Lista de Articulos {{$vendedor['ASIGNADA']}}</span>
                            </div>
                           

                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                </div>
                
                @endforeach
              </div>
            </div>
          </div>
        </div>

              
              
            </div>
          @include('layouts.footer_gumadesk')
        </div>


        <div class="modal fade" id="modl_add_articulo_tolist" tabindex="-1" role="dialog" aria-labelledby="authentication-modal-label" aria-hidden="true">
          <div class="modal-dialog modal-xl mt-6" role="document">
            <div class="modal-content border-0">
              <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                <div class="position-relative z-index-1 light">
                  <h4 class="mb-0 text-white" id="id_titulo_modal"> - - -</h4>
                  <p class="fs--1 mb-0 text-white">Muestra los articulos que no tiene en su lista</p>
                  <p class="fs--1 mb-0 text-white" style="display:none" id="id_ruta_add"> F00 </p>
                </div>
                <button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body py-4 px-5 ">
                
                <div class="mb-3">
                  <label class="form-label" for="basic-form-name">Listas</label>
                  <select class="form-control" id="id_list_add_arti">
                      <option value="80"> 80 % </option>
                      <option value="20"> 20 % </option>
                    <select>
                </div>
                  
                  

                  <div class="mb-3 mt-3">
                    

                      <div class="notification" href="#!">                        
                        <div class="notification-body">
                          <table class="table table-hover table-striped overflow-hidden" id="id_articulos_withoutlist" ></table>  
                        </div>
                      </div>


                    
                  </div>
                              
                  <div class="mb-3">
                    <button class="btn btn-primary d-block w-100 mt-3" id="" type="submit" name="submit">Aplicar</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
            

       
        <div class="modal fade" id="modl_add_articulo" tabindex="-1" role="dialog" aria-labelledby="authentication-modal-label" aria-hidden="true">
          <div class="modal-dialog modal-xl mt-6" role="document">
            <div class="modal-content border-0">
              <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                <div class="position-relative z-index-1 light">
                  <h4 class="mb-0 text-white" id="id_titulo_modal"> - - -</h4>
                  <p class="fs--1 mb-0 text-white">Puede descar el formato para carga la información dando click <a href="{{ asset('Formatos/Plantilla-Articulos-Rutas.xlsx') }}" class="text-white" >Aqui </a></p>
                  <span class="text-white" id="id_mdl_insert"> - </span>
                </div>
                <button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body py-4 px-5 ">
                <div class="row">
                  <div class="col-md-7">
                    <input class="form-control" id="upload" type=file  name="files[]"/>
                  </div>
                  <div class="col-md-5 ">
                        <div class="input-group">
                          <input class="form-control  shadow-none search" type="search"  id="id_searh_table_Excel" placeholder="Ingrese informacion a buscar." aria-label="search" />
                          <div class="input-group-text bg-transparent">
                            <span class="fa fa-search fs--1 text-600"></span>
                          </div>
                          <div class="input-group-text bg-transparent" id="id_get_history">
                            <span class="fa fa-history fs--1 text-600"></span>
                          </div>
                        </div>
                    </div>
                </div>
                  
                  

                  <div class="mb-3 mt-3">
                    

                      <div class="notification" href="#!">                        
                        <div class="notification-body">
                          <table class="table table-hover table-striped overflow-hidden" id="tbl_excel" ></table>  
                        </div>
                      </div>


                    
                  </div>
                              
                  <div class="mb-3">
                    <button class="btn btn-primary d-block w-100 mt-3" id="id_send_data_excel" type="submit" name="submit">Cargar</button>
                  </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </main>
    
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

@endsection('content')