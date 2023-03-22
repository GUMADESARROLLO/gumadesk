@extends('layouts.lyt_gumadesk')
@section('metodosjs')
@include('jsViews.js_promociones')
@endsection
@section('content')

<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main" id="top">
    <div class="container-fluid" data-layout="container">        
        <div class="content">            

            @include('layouts.nav_gumadesk')

            

            <div class="col-12">
              
              <div class="card h-100">
                
                <div class="card-header">
                  <div class="row flex-between-center">
                    <div class="col-4 col-sm-auto d-flex align-items-center">
                    <form class="row align-items-center g-3">
                      <div class="col-auto"><h6 class="text-700 mb-0"> </h6></div>
                      <div class="col-md-auto position-relative" style="display:none">
                        <span class="fas fa-calendar-alt text-primary position-absolute translate-middle-y ms-2 mt-3"> </span>
                        <input id="id_range_select" class="form-control form-control-sm datetimepicker ps-4" type="text" data-options='{"mode":"range","dateFormat":"Y-m-d","disableMobile":true}'/>
                      </div>
                      <div class="col-md-auto">
                          <div class="input-group" >

                              
                              
                              <div class="input-group-text bg-transparent">
                                  <span class="fa fa-search fs--1 text-600"></span>
                              </div>
                              
                              <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Buscar..." aria-label="search" id="id_txt_buscar" />
                            </div>
                        </div>
                    </form>                            
                    </div>
                    <div class="col-8 col-sm-auto text-end ">
                      <div class="row g-3 needs-validation" >
                      
                        <div class="col-md-auto" >
                          <div class="input-group" >
                          
                              <div class="input-group-text bg-transparent" id="id_btn_add_promocion">
                                  <span class="fas fa-plus fs--1 text-600"></span>
                              </div>
                          </div>
                        </div> 
                       

                       
                        
                        <div class="col-md-auto">
                          <select class="form-select form-select-sm"  id="frm_lab_row">                                          
                            <option selected="" value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="-1">*</option>
                          </select>
                        </div> 
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="card-body p-0 mb-2" >                  
                  <div class="p-0 px-car">
                    <div class="row flex-between-center border border-1 border-300 rounded-2">
                      <table id="table_promociones" class="table fs--1" >
                        <thead>
                         
                          <tr>                       
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-center" scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($Promociones as $p)
                          <tr>
                            <td>
                              <div class="d-flex align-items-center position-relative mt-2">
                                <div class="avatar avatar-xl ">
                                  <img class="rounded-circle" src="{{ asset('images/user/avatar-4.jpg') }}"   />
                                </div>
                                  <div class="flex-1 ms-3">
                                    <h6 class="mb-0 fw-semi-bold"><a href="#!" onclick="OpenModal({{$p}} )" >{{ $p->Titulo }}</a></h6>
                                    <p class="text-500 fs--2 mb-0">{{$p->id}} |  Items ({{count($p->Detalles)}})</p>
                                  </div>
                              </div>
                            </td>

                            

                            <td>
                            <div class="pe-4 border-sm-end border-200">
                                <h6 class="fs--2 text-600 mb-1">Inicia</h6>
                                <div class="d-flex align-items-center">
                                  
                                  <span class="badge rounded-pill bg-primary" onclick="DateChance(0,{{$p}})" >{{ date('D, M d, Y', strtotime($p->fecha_ini))  }}  <span class="ms-1 fas fa-pencil-alt"></span></span> </h5>
                                </div>
                              </div> 
                            </td>
                            
                            <td>
                              <div class="pe-4 border-sm-end border-200">
                                <h6 class="fs--2 text-600 mb-1">Termina</h6>
                                <div class="d-flex align-items-center">
                                  <h5 class="fs-0 text-900 mb-0 me-2" >
                                  <span class="badge rounded-pill bg-primary" onclick="DateChance(1,{{$p}})" >{{ date('D, M d, Y', strtotime($p->fecha_end))  }}  <span class="ms-1 fas fa-pencil-alt"></span></span> </h5>
                                </div>
                              </div> 
                            </td>

                            

                            <td>
                              <div class="pe-4 border-sm-end border-200">
                                <h6 class="fs--2 text-600 mb-1">Status.</h6>
                                <div class="d-flex align-items-center">
                                <span class="badge badge rounded-pill d-block p-2 {{ $p->Estado->Color }}">{{ $p->Estado->Nombre }}<span class="ms-1 {{ $p->Estado->Icon }}" data-fa-transform="shrink-2"></span></span>
                                </div>
                              </div>
                              
                            </td>
                            <td class="text-center">
                                <div class=" mt-2">
                                    <button class="btn p-0 ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" onclick="rmPromo({{$p->id}})" title="Delete"><span class="text-500 fas fa-trash-alt"></span></button>
                                </div>
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

           

            
          </div>

       
    </div>

    <div class="modal fade" id="modl_view_detalles_ruta" tabindex="-1" role="dialog" aria-labelledby="authentication-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-xl mt-6" role="document">
                <div class="modal-content border-0">
                <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                  <div class="position-relative z-index-1 light">
                      <div class="flex-1">
                          <h6 class="mb-0 fw-semi-bold">
                          <a class="stretched-link text-900 fw-semi-bold" href="#!" >
                              <div class="stretched-link text-white" id='id_lbl_nombre'>NOMBRE DE LA PROMOCION </div>
                          </a>
                          </h6>
                          <p class="text-white fs--2 mb-0"id='id_lbl_fechas'>00/00/0000 al 00/00/0000</p>
                          <span id="id_num_prom" style="display:none"></span>
                      </div>
                  </div>
                    <button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                        <div class="row">
                            <div class="row flex-between-center">
                                <div class="col-auto">
                                    <div class="d-flex align-items-center position-relative mt-0">
                                      <div class="avatar avatar-xl ">
                                        <img class="rounded-circle" src="{{ asset('images/user/avatar-4.jpg') }}"   />
                                      </div>
                                      <div class="flex-1 ms-3">
                                        <h6 class="mb-0 fw-semi-bold">
                                        <a class="stretched-link text-900 fw-semi-bold" href="#!" >
                                            <div class="stretched-link text-900" id='nombre_ruta_modal'>NOMBRE DE LA PROMOCION </div>
                                        </a>
                                        </h6>
                                        <p class="text-500 fs--2 mb-0"id='nombre_ruta_zona_modal'>00/00/0000 al 00/00/0000</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row g-sm-4">
                                    <div class="col-12 col-sm-auto">
                                        <div class="mb-3 pe-4 border-sm-end border-200">
                                            <h6 class="fs--2 text-600 mb-1">Meta Val</h6>
                                            <div class="d-flex align-items-center">
                                            <h5 class="fs-0 text-900 mb-0 me-2" id="id_ttMetaValor">C$ 0.00</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-auto">
                                        <div class="mb-3 pe-4 border-sm-end border-200">
                                            <h6 class="fs--2 text-600 mb-1">Venta</h6>
                                        <div class="d-flex align-items-center">
                                            <h5 class="fs-0 text-900 mb-0 me-2" id="id_ttVenta">C$ 0.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-auto">
                                    <div class="mb-3 pe-4 border-sm-end border-200">
                                        <h6 class="fs--2 text-600 mb-1">META UND</h6>
                                        <div class="d-flex align-items-center">
                                            <h5 class="fs-0 text-900 mb-0 me-2" id="id_ttMetaUND">0.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-auto">
                                <div class="mb-3 pe-0">
                                    <h6 class="fs--2 text-600 mb-1">VENTA UND</h6>
                                    <div class="d-flex align-items-center">
                                    <h5 class="fs-0 text-900 mb-0 me-2" id="id_ttVentaUND">0.00</h5>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row g-3">
                                
                                <div class="col-11">
                                    <div class="">                                        
                                        <select class="form-select form-select-sm js-choice"  size="1" id="id_item" name="organizerSingle" data-options='{"removeItemButton":true,"placeholder":true}'>                                
                                            @foreach ($Articulos as $Art)
                                                <option value="{{$Art->ARTICULO}}">{{$Art->ARTICULO}} | {{strtoupper($Art->DESCRIPCION)}}</option>
                                            @endforeach
                                        </select>                        
                                    </div>
                                </div>

                              
                                <div class="col-1 ">                                    
                                    <div class="position-relative light">
                                        <div class="d-flex flex-center position-absolute ">
                                            <button class="btn btn-primary" type="submit" id="id_save_item">+</button>
                                          </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-2">
                                    <label class="form-label" for="id_precio">C$. Precio</label>
                                    <input class="form-control" id="id_precio" type="number" placeholder="0.00" min="0" />
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="id_vinneta">C$. Viñeta</label>
                                    <input class="form-control" id="id_vinneta" type="number" placeholder="0.00" min="0" />
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="id_precio">Bonificado</label>
                                    <input class="form-control" id="id_bonificado" type="text" placeholder="0+0"/>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="id_meta_unidades">Meta Unidades</label>
                                    <input class="form-control" id="id_meta_unidades" type="number" placeholder="0" min="0" />
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="id_meta_valor">Meta Valor C$.</label>
                                    <input class="form-control" id="id_meta_valor" type="number" placeholder="0.00" min="0" />
                                </div>
                              </div>                    
                        </div>     
                        
                        <div class="mb-3 ">
                            <div class="table-responsive scrollbar">
                            <table class="table table-hover table-striped overflow-hidden" id="tbl_excel" style="width:100%" ></table> 
                            </div>
                        </div>
                    </div>
              
                </div>
            </div>
        </div>
</main>

        <div class="modal fade" id="modl_add_promocion" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content border">
              <form autocomplete="off" action="SavePromo">
                <div class="modal-header px-card bg-light border-bottom-0">
                  <h5 class="modal-title">Nueva Promocion</h5>
                  <button class="btn-close me-n1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-card">
                  
                  <div class="mb-3">
                    <label class="fs-0" for="eventTitle">Titulo</label>
                    <input class="form-control" id="eventTitle" type="text" name="PromoName" required="required" />
                  </div>
                  <div class="mb-3">
                    <label class="fs-0" for="eventStartDate">Fecha de Inicio</label>
                    <input class="form-control datetimepicker" id="eventStartDate" type="text" required="required" name="PromoIni" placeholder="yyyy/mm/dd" data-options='{"static":"true","enableTime":"false","dateFormat":"Y-m-d"}' />
                  </div>
                  <div class="mb-3">
                    <label class="fs-0" for="eventEndDate">Fecha que termina</label>
                    <input class="form-control datetimepicker" id="eventEndDate" type="text" name="PromoEnd" placeholder="yyyy/mm/dd" data-options='{"static":"true","enableTime":"false","dateFormat":"Y-m-d"}' />
                  </div>
                  
                </div>
                <div class="card-footer d-flex justify-content-end align-items-center bg-light">
                    <button class="btn btn-primary px-4" type="submit">Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
@endsection('content')