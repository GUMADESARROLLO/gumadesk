@extends('layouts.lyt_gumadesk')
@section('metodosjs')
@include('jsViews.js_comiciones')
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
                    <form id="frm_send" action="ComicionesConsulta">  
                    <div class="row g-3 needs-validation" >
                      
                        <div class="col-md-auto">
                          <select class="form-select form-select-sm" name='name_month' aria-label=".form-select-sm example" id="id_select_month">
                            
                          @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $i == date('m') ? 'selected' : '' }}>{{ Carbon\Carbon::createFromFormat('m', $i)->monthName }}</option>
                          @endfor
                          </select>
                        </div>
                        <div class="col-md-auto">
                          <div class="input-group" >
                            <select class="form-select form-select-sm" name='name_year' aria-label=".form-select-sm example" id="id_select_year">
                                @foreach (range(date('Y'),date('Y')-1) as $year)
                                  <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach  
                            </select>
                              <div class="input-group-text bg-transparent" id="id_btn_new">
                                  <span class="fas fa-history fs--1 text-600"></span>
                              </div>
                              <div class="input-group-text bg-transparent" id="btn_nota_credito">
                                  <span class="far fa-calendar-minus fs--1 text-600"></span>
                              </div>
                          </div>
                        </div>                         
                        <div class="col-md-auto">
                          <select class="form-select form-select-sm"  id="frm_lab_row">    
                            <option selected="" value="10">10</option>
                            <option value="20">20</option>
                            <option value="-1">*</option>
                          </select>
                        </div> 
                        
                      </div>
                      </form>
                    </div>
                  </div>
                </div> 
                <div class="card-body p-0 mb-2" >                  
                  <div class="p-0 px-car">
                    <div class="row flex-between-center border border-1 border-300 rounded-2">
                      <table id="table_comisiones" class="table fs--1" >
                        <thead>
                          <tr>
                            <th colspan="2">VENDEDOR</th>
                            <th colspan="2">COMISIÓN DE VENTA</th>
                            <th colspan="4">TOTAL BONOS Y COMISIONES</th>
                            <th>TOTAL BONOS Y COMISIONES</th>
                            <th>TOTAL</th>
                            
                          </tr>
                          <tr>                       
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($Comision as $cms)
                          <tr>

                            <td>
                              <div class="d-flex align-items-center position-relative mt-2">
                                <div class="avatar avatar-xl ">
                                  <img class="rounded-circle" src="{{ asset('images/user/avatar-4.jpg') }}"   />
                                </div>
                                  <div class="flex-1 ms-3">
                                    <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900 fw-semi-bold" href="#!" onclick="OpenModal('{{ strtoupper($cms['ZONA']) }}','{{ strtoupper($cms['VENDEDOR']) }}','{{ strtoupper($cms['NOMBRE']) }}')" ><div class="stretched-link text-900">{{ strtoupper($cms['NOMBRE']) }}</div></a></h6>
                                    <p class="text-500 fs--2 mb-0">{{ strtoupper($cms['VENDEDOR']) }} | {{ strtoupper($cms['ZONA']) }} </p>
                                  </div>
                              </div>
                            </td>

                            <td>
                            <div class="pe-4 border-sm-end border-200">
                                <h6 class="fs--2 text-600 mb-1">Basico</h6>
                                <div class="d-flex align-items-center">
                                  <h5 class="fs-0 text-900 mb-0 me-2">C$ {{ number_format(strtoupper($cms['BASICO']),0) }} </h5>
                                </div>
                              </div> 
                            </td>
                            
                            <td>
                              <div class="pe-4 border-sm-end border-200">
                                <h6 class="fs--2 text-600 mb-1">Ventas Val.</h6>
                                <div class="d-flex align-items-center">
                                  <h5 class="fs-0 text-900 mb-0 me-2">C$ {{ number_format(strtoupper($cms['DATARESULT']['Comision_de_venta']['Total'][1]),2) }} </h5>
                                </div>
                              </div> 
                            </td>

                            <td>
                              <div class="pe-4 border-sm-end border-200">
                                <h6 class="fs--2 text-600 mb-1">Comisión</h6>
                                <div class="dropdown font-sans-serif btn-reveal-trigger">
                                  <button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" id="dropdown-total-sales" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                    <div class="d-flex align-items-center">
                                      <h5 class="fs-0 text-900 mb-0 me-2">C$ {{ number_format(strtoupper($cms['DATARESULT']['Comision_de_venta']['Total'][3]),2) }}</h5>
                                     
                                    </div>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-total-sales">
                                    
                                  <table class="table" >                                  
                                    <thead class="bg-200 text-900">
                                      <tr>
                                        <th class="">CLASIF</th>
                                        <th class="">SKU</th>
                                        <th class="">Val. C$.</th>
                                        <th class="">Fct.%</th>
                                        <th class="">N. Crédito</th>
                                        <th class="">Comision</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="border-200">
                                        <td class="align-middle">
                                          <h6 class="mb-0 text-nowrap">SKU_80</h6>
                                        </td>
                                        <td class="align-middle text-center">{{ strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista80'][0]) }}</td>
                                        <td class="align-middle text-end "> {{ number_format(strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista80'][1]),2) }} </td>
                                        <td class="align-middle text-end"> {{ strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista80'][2]) }} %</td>  
                                        <td class="align-middle text-end">C$ {{ number_format(strtoupper($cms['DATARESULT']['NotaCredito_val80']),2) }} </td>                                        
                                        <td class="align-middle text-end ">{{ number_format(strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista80'][3]),2) }} </td>
                                      </tr>
                                      
                                      <tr class="border-200">
                                        <td class="align-middle">
                                          <h6 class="mb-0 text-nowrap">SKU_20_A</h6>
                                        </td>
                                        <td class="align-middle text-center">{{ strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista20A'][0]) }}</td>
                                        <td class="align-middle text-end">{{ number_format(strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista20A'][1]),2) }} </td>
                                        <td class="align-middle text-end"> {{ strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista20A'][2]) }} %</td> 
                                        <td class="align-middle text-end"> {{ number_format(strtoupper($cms['DATARESULT']['NotaCredito_val20']),2)  }} %</td>
                                        <td class="align-middle text-end">{{ number_format(strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista20A'][3]),2) }} </td>
                                      </tr>

                                      <tr class="border-200">
                                        <td class="align-middle">
                                          <h6 class="mb-0 text-nowrap">SKU_20_B</h6>
                                        </td>
                                        <td class="align-middle text-center">{{ strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista20B'][0]) }}</td>
                                        <td class="align-middle text-end">{{ number_format(strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista20B'][1]),2) }} </td>
                                        <td class="align-middle text-end"> {{ strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista20B'][2]) }} %</td>
                                        <td class="align-middle text-end">C$  - </td>                                          
                                        <td class="align-middle text-end">{{ number_format(strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista20B'][3]),2) }} </td>
                                      </tr>

                                      <tr class="border-200">
                                        <td class="align-middle">
                                          <h6 class="mb-0 text-nowrap">SKU_20_C</h6>
                                        </td>
                                        <td class="align-middle text-center">{{ strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista20C'][0]) }}</td>
                                        <td class="align-middle text-end">{{ number_format(strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista20C'][1]),2) }} </td>
                                        <td class="align-middle text-end"> {{ strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista20C'][2]) }} %</td>
                                        <td class="align-middle text-end">C$  - </td>                                          
                                        <td class="align-middle text-end">{{ number_format(strtoupper($cms['DATARESULT']['Comision_de_venta']['Lista20C'][3]),2) }} </td>
                                      </tr>
                                      
                                      
                                      <tr class="border-200">
                                        <td class="align-middle">
                                          <h6 class="mb-0 text-nowrap">TOTAL </h6>
                                        </td>
                                        <td class="align-middle text-center">{{ strtoupper($cms['DATARESULT']['Comision_de_venta']['Total'][0]) }}</td>
                                        <td class="align-middle text-end">{{ number_format(strtoupper($cms['DATARESULT']['Comision_de_venta']['Total'][1]),2) }} </td>
                                        <td class="align-middle text-end">- </td>    
                                        <td class="align-middle text-end">C$ {{ number_format(strtoupper($cms['DATARESULT']['NotaCredito_total']),2)  }} </td>
                                        <td class="align-middle text-end">{{ number_format(strtoupper($cms['DATARESULT']['Comision_de_venta']['Total'][3]),2) }} </td>
                                      </tr>

                                    </tbody>
                                  </table>

                                  
                                  </div>
                                </div>
                                
                              </div>
                            </td>

                            <td>
                              <div class="pe-4 border-sm-end border-200">
                                <h6 class="fs--2 text-600 mb-1">Prom.</h6>
                                <div class="d-flex align-items-center">
                                  <h5 class="fs-0 text-900 mb-0 me-2">{{ strtoupper($cms['DATARESULT']['Totales_finales'][4]) }}</h5>
                                </div>
                              </div>
                            </td>

                            <td>
                              <div class="pe-4 border-sm-end border-200">
                                <h6 class="fs--2 text-600 mb-1">Meta.</h6>
                                <div class="d-flex align-items-center">
                                  <h5 class="fs-0 text-900 mb-0 me-2">{{ strtoupper($cms['DATARESULT']['Totales_finales'][5]) }}</h5>
                                </div>
                              </div>
                            </td>

                            <td>
                              <div class="pe-4 border-sm-end border-200">
                                <h6 class="fs--2 text-600 mb-1">Fact.</h6>
                                <div class="d-flex align-items-center">
                                  <h5 class="fs-0 text-900 mb-0 me-2">{{ strtoupper($cms['DATARESULT']['Totales_finales'][6]) }}</h5>
                                </div>
                              </div>
                            </td>

                            <td>
                              <div class="pe-4 border-sm-end border-200">
                                <h6 class="fs--2 text-600 mb-1">Bono.Cobertura</h6>
                                <div class="d-flex align-items-center">
                                  <h5 class="fs-0 text-900 mb-0 me-2">C$ {{ number_format(strtoupper($cms['DATARESULT']['Totales_finales'][0]),2) }}</h5>
                                  <span class="badge rounded-pill badge-soft-primary">{{ strtoupper($cms['DATARESULT']['Totales_finales'][3]) }}%</span>
                                </div>
                              </div>  
                            </td>

                           

                            <td>
                              <div class="pe-4 border-sm-end border-200" >
                                <h6 class="fs--2 text-600 mb-1">Comisión + Bono</h6>
                                <div class="d-flex align-items-center">
                                  <h5 class="fs-0 text-900 mb-0 me-2">C$ {{ number_format(strtoupper($cms['DATARESULT']['Totales_finales'][1]),2) }}</h5>
                                </div>
                              </div>
                            </td>

                            <td>
                              <div class="">
                                <h6 class="fs--2 text-600 mb-1">Total Comp.</h6>
                                <div class="d-flex align-items-center">
                                  <h5 class="fs-0 text-900 mb-0 me-2">C$ {{ number_format(strtoupper($cms['DATARESULT']['Total_Compensacion']),2) }}</h5>                                  
                                </div>
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

          <div class="modal fade" id="modl_view_detalles_ruta" tabindex="-1" role="dialog" aria-labelledby="authentication-modal-label" aria-hidden="true">
          <div class="modal-dialog modal-xl mt-6" role="document">
            <div class="modal-content border-0">
              <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                <div class="position-relative z-index-1 light">
                  <p class="fs--1 mb-0 text-white">Listado de Articulos que Confirman el 80 / 20 de la ruta</p>
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
                                <div class="stretched-link text-900" id='nombre_ruta_modal'>NOMBRE DEL VENDEDOR</div>
                              </a>
                            </h6>
                            <p class="text-500 fs--2 mb-0"id='nombre_ruta_zona_modal'>F00 | ZONA DE LA RUTA</p>
                          </div>
                      </div>
                    </div>
                    <div class="col-auto mt-2">
                      <div class="row g-sm-4">
                      <div class="col-12 col-sm-auto">
                          <div class="mb-3 pe-4 border-sm-end border-200">
                            <h6 class="fs--2 text-600 mb-1">SKUS 80%</h6>
                            <div class="d-flex align-items-center">
                              <h5 class="fs-0 text-900 mb-0 me-2" id="id_list_80">0</h5><span class="badge rounded-pill badge-soft-primary" id="id_prom_ls80"> 80 %</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-auto">
                          <div class="mb-3 pe-4 border-sm-end border-200">
                            <h6 class="fs--2 text-600 mb-1">SKUS 20%</h6>
                            <div class="d-flex align-items-center">
                              <h5 class="fs-0 text-900 mb-0 me-2" id="id_list_20">0</h5><span class="badge rounded-pill badge-soft-primary" id="id_prom_ls20" >20 %</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-auto">
                          <div class="mb-3 pe-4 border-sm-end border-200">
                            <h6 class="fs--2 text-600 mb-1">META UND</h6>
                            <div class="d-flex align-items-center">
                              <h5 class="fs-0 text-900 mb-0 me-2" id="id_Meta_UND">0</h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-auto">
                          <div class="mb-3 pe-4 border-sm-end border-200">
                            <h6 class="fs--2 text-600 mb-1">VENTA UND</h6>
                            <div class="d-flex align-items-center">
                              <h5 class="fs-0 text-900 mb-0 me-2" id="id_Venta_UND">0</h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-auto">
                          <div class="mb-3 pe-0">
                            <h6 class="fs--2 text-600 mb-1">VENTA VALOR</h6>
                            <div class="d-flex align-items-center">
                              <h5 class="fs-0 text-900 mb-0 me-2" id="ttVenta_Val">C$256,489</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-12 ">
                      <div class="input-group">
                        <input class="form-control  shadow-none search" type="search"  id="id_searh_table_Excel" placeholder="Ingrese informacion a buscar." aria-label="search" />
                        <div class="input-group-text bg-transparent">
                            <span class="fa fa-search fs--1 text-600"></span>
                        </div>                          
                      </div>
                    </div>
                  </div>

                  <div class="mb-3 mt-3">
                    <table class="table table-hover table-striped overflow-hidden" id="tbl_excel" style="width:100%" ></table> 
                  </div>
                  
              </div>
            </div>
          </div>
        </div>
      
    </div>
</main>
@endsection('content')