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
            
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-bottom">
                <div class="row flex-between-center">
                  <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0" >Articulos para la RUTA: F00</h5> 
                  </div>
                  <div class="col-8 col-sm-auto ms-auto text-end ps-0">
                  <div id="orders-actions">

                  

                  <div class="btn btn-sm">
                      <select class="form-select" id="IdSelectRuta">
                        @foreach ($Vendedores as $vendedor)
                          <option value="{{$vendedor->VENDEDOR}}">{{$vendedor->VENDEDOR}} | {{strtoupper($vendedor->NOMBRE)}}</option>
                        @endforeach
                      </select>
                  </div>

                    
                    <button class="btn btn-falcon-default btn-sm" type="button" id="id_table_articulos_ruta">
                      <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>                      
                    </button>
                  </div>
                </div>
                      
                    </div>
                </div>
                <div class="card-body pt-0">
                  <div class="tab-content">
                    <div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-6fa4c848-cf7f-4ed7-bab0-9326a3ce9502" id="dom-6fa4c848-cf7f-4ed7-bab0-9326a3ce9502">
                      <div class="table-responsive scrollbar">
                        <table class="table" id="id_table_articulos">
                          
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane code-tab-pane" role="tabpanel" aria-labelledby="tab-dom-1588a2c2-ec0c-4296-a6aa-f7f6131ac1fc" id="dom-1588a2c2-ec0c-4296-a6aa-f7f6131ac1fc">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card z-index-1">
                <div class="card-header border-bottom">
                <div class="row flex-between-center">
                
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                  <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0" >ARTICULOS CON VIÑETAS</h5> 
                </div>
              <div class="col-8 col-sm-auto ms-auto text-end ps-0">
                <div id="orders-actions">

                <div class="btn btn-sm ">
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
                </div>
                <div class="btn btn-sm">
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
                </div>

                  <button class="btn btn-falcon-default btn-sm" type="button" id="id_send_filtros">
                    <span class="fas fa-filter" data-fa-transform="shrink-3 down-2"></span>                      
                  </button>
                  
                  <button class="btn btn-falcon-default btn-sm" type="button" id="id_add_item_vinneta">
                    <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>                      
                  </button>
                </div>
              </div>
            </div>
                </div>
                <div class="card-body pt-0">
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
                  <h5 class="mb-0" id="followers">Rutas <span class="d-none d-sm-inline-block">(0)</span></h5>
                </div>
                
              </div>
            </div>
            <div class="card-body bg-light px-1 py-0">
              
              <div class="row g-0 text-center fs--1">
              @foreach ($Vendedores as $vendedor)
                          
                        
               
                <div class="kanban-items-container scrollbar col-6 col-md-4 col-lg-3 col-xxl-2">
                  <div class="kanban-item">
                    <div class="card kanban-item-card hover-actions-trigger">
                      <div class="card-body">                      
                        <div class="mb-2">
                        <div class="d-flex align-items-start position-relative">
                          <div class="avatar avatar-2xl status-online">
                            <img class="rounded-circle" src="images/avatar.png" alt="" />

                          </div>
                          <div class="flex-1 ms-3">
                            <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900" href="#!" onClick="mdlAsignar()">{{$vendedor->NOMBRE}}</a></h6>
                            <p class="text-500 fs--2 mb-0">{{$vendedor->VENDEDOR}}</p>
                          </div>
                        </div>
                        </div>
                        <div class="kanban-item-footer cursor-default">
                          <div class="text-500 z-index-2"><span class="me-2" data-bs-toggle="tooltip" title="You're assigned in this card"><span class="fas fa-eye"></span></span><span class="me-2" data-bs-toggle="tooltip" title="Checklist"><span class="fas fa-check me-1"></span><span>5/5</span></span>
                          </div>
                          <div class="z-index-2">
                            <div class="avatar avatar-l align-top ms-n2" data-bs-toggle="tooltip" title="Sophie">
                              <img class="rounded-circle" src="images/avatar.png" alt="" />

                            </div>
                            <div class="avatar avatar-l align-top ms-n2" data-bs-toggle="tooltip" title="Antony">
                              <img class="rounded-circle" src="images/avatar.png" alt="" />

                            </div>
                            <div class="avatar avatar-l align-top ms-n2" data-bs-toggle="tooltip" title="Emma">
                              <img class="rounded-circle" src="images/avatar.png" alt="" />

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
            

       
        <div class="modal fade" id="modl_add_articulo" tabindex="-1" role="dialog" aria-labelledby="authentication-modal-label" aria-hidden="true">
          <div class="modal-dialog modal-xl mt-6" role="document">
            <div class="modal-content border-0">
              <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                <div class="position-relative z-index-1 light">
                  <h4 class="mb-0 text-white" id="id_titulo_modal">Multiples Filas</h4>
                  <p class="fs--1 mb-0 text-white">Puede descar el formato para carga la información dando click <a href="{{ asset('Formatos/Plantilla-Articulos-Rutas.xlsx') }}" class="text-white" >Aqui </a></p>
                </div>
                <button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body py-4 px-5 ">
                <div class="row">
                  <div class="col-md-7">
                    <input class="form-control" id="upload" type=file  name="files[]"/>
                  </div>
                  <div class="col-md-5">
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