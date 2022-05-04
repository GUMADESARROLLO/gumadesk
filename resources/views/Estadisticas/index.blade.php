@extends('layouts.lyt_gumadesk')
@section('content')
<main class="main" id="top">
      <div class="container-fluid" data-layout="container">
    @include('layouts.nav_gumadesk')
    <div class="content">
    <div class="row g-3 col-md-12 col-xxl-12 mb-3">          
        <div class="col-md-6 col-xxl-3">
          <div class="card h-md-100 ecommerce-card-min-width">
            <div class="card-header pb-0">
              <h6 class="mb-0 mt-2 d-flex align-items-center">Ventas
                <span class="ms-1 text-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Muestra ventas totales de todos los segmentos y meta de venta con  su respectivo porcentaje de cumplimiento">
                  <span class="far fa-question-circle" data-fa-transform="shrink-1"></span>
                </span>
              </h6>
            </div>
            <div class="card-body d-flex flex-column justify-content-end">
              <div class="row">
                <div class="col">
                  <p class="font-sans-serif lh-1 mb-1 fs-4" id="id_tt_real_real">C$ 0.00</p>
                  <div class="d-flex align-items-center">
                    <h6 class="fs--1 text-500 mb-0" id="id_tt_real_cuota"> C$ 00.00 </h6>
                    <h6 class="fs--2 ps-3 mb-0 text-primary" ><span class="badge badge-soft-success rounded-pill fs--2" id="id_tt_cumplimiento">0.0%</span></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>            
        <div class="col-md-6 col-xxl-2">
          
          <div class="card h-md-100">
          
            <div class="card-header pb-0">
              <h6 class="mb-0 mt-2 d-flex align-items-center">Clientes
                <span class="ms-1 text-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Calculo de numero de Clientes unicos que sean facturado junto a la meta de clientes de facturacion y cumplimiento ">
                  <span class="far fa-question-circle" data-fa-transform="shrink-1"></span>
                </span>
              </h6>
            </div>
            
            <div class="card-body d-flex flex-column justify-content-end ">
              <div class="row justify-content-between ">
              <div class="row g-5 g-sm-0">
                <div class="col-md-4 col-sm-12 ">
                  <div class="border-sm-end border-300">
                    <div class="text-center">
                      <h6 class="fs--2 text-600 mb-1">FACT.</h6>
                      <h3 class="fw-normal text-700" id="id_tt_resumen_cliente">00</h3>
                    </div>
                    
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="border-sm-end border-300">
                    <div class="text-center">
                      <h6 class="fs--2 text-600 mb-1">META</h6>
                      <h3 class="fw-normal text-700" id="id_tt_resumen_cliente_meta" > 00</h3>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                  <div>
                    <div class="text-center">
                      <h6 class="fs--2 text-600 mb-1">% CUMPL</h6>                          
                      
                      <h4 class="fs-3 fw-normal text-primary" id="id_tt_resumen_cliente_pro">00 %</h4>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="col-md-6 col-xxl-3">
          <div class="card h-md-100">
            <div class="card-header pb-0">
              <h6 class="mb-0 mt-2 d-flex align-items-center">Dias Hábiles 
                <span class="ms-1 text-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Muestra el procentaje de facturacion a la fecha juntos a los dias Habiles para facturar">
                  <span class="far fa-question-circle" data-fa-transform="shrink-1"></span>
                </span>
              </h6>
            </div>
            <div class="card-body d-flex flex-column justify-content-end">
              <div class="row justify-content-between">
              <div class="row g-5 g-sm-0">
                <div class="col-sm-4">
                  <div class="border-sm-end border-300">
                    <div class="text-center">
                      <h6 class="text-700">HABILES</h6>
                      <h3 class="fw-normal text-700" id="id_dias_habiles">00</h3>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="border-sm-end border-300">
                    <div class="text-center">
                      <h6 class="text-700">FACT.</h6>
                      <h3 class="fw-normal text-700" id="id_dias_facturados" > 00 </h3>
                    </div>
                    </div>
                </div>
                <div class="col-sm-4">
                  <div>
                    <div class="text-center">
                      <h6 class="text-700">% CUMPL</h6>         
                      <h4 class="fs-3 fw-normal text-primary" id="id_dias_porcent">00 % </h4>                                           
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>            
        <div class="col-md-6 col-xxl-4">
          <div class="card h-md-100">
            <div class="card-header pb-0">

            <div class="d-flex  ">
              <div class="me-auto justify-content-end">Periodo: </div>
              <div class="">
                <span class="fas fa-calendar-alt text-primary position-absolute translate-middle-y ms-2 mt-3"> </span>
                <input id="id_range_select" class="form-control form-control-sm datetimepicker ps-4" type="text" data-options='{"mode":"range","dateFormat":"Y-m-d","disableMobile":true}'/>
                
              </div>
            </div>               
            </div>
            <div class="card-body d-flex flex-column justify-content-end">
              <div class="row justify-content-between">
              <div class="row g-5 g-sm-0">
                <div class="col-sm-3">
                  <div class="border-sm-end border-300">
                    <div class="text-center">
                      <span class="text-700" >C$ </span>
                      <h4 class="fw-normal text-700" id="id_tt_resumen_lbl_isToday_val">00.00</h4>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="border-sm-end border-300">
                    <div class="text-center">
                      <h6 class="text-700">TENDENCIA</h6>
                      <h3 class="fw-normal text-700" id="id_tt_resumen_tendencia">00.00</h3>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="border-sm-end border-300">
                    <div class="text-center">
                      <h6 class="text-700">DS</h6>
                      <h3 class="fw-normal text-700" id="id_tt_resumen_DS" > 00.00</h3>
                    </div>
                    </div>
                </div>
                <div class="col-sm-3">
                  <div>
                    <div class="text-center">
                      <h6 class="text-700">SKU</h6>                          
                      <h4 class="fs-3 fw-normal text-primary" id="id_tt_resumen_SKU">00 </h4>                                           
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>            
      </div>
      <div class="row mb-3 g-3">
        
        <div class="col-md-12 col-xxl-9">
     
          <div class="card">
            <div class="card-header d-flex flex-between-center ps-0 py-0 border-bottom">
              <ul class="nav nav-tabs border-0 flex-nowrap tab-active-caret" id="crm-revenue-chart-tab" role="tablist" data-tab-has-echarts="data-tab-has-echarts">
                <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0 active" id="crm-deals-tab" data-bs-toggle="tab" href="#crm-deals" role="tab" aria-controls="crm-deals" aria-selected="false">CANAL FARMACIA</a></li>  
                @if( Session::get('rol')[0] == '1' )
                <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-revenue-tab" data-bs-toggle="tab" href="#crm-revenue" role="tab" aria-controls="crm-revenue" aria-selected="true">ALCANCE POR CANAL</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link py-3 mb-0" id="crm-users-tab" data-bs-toggle="tab" href="#crm-users" role="tab" aria-controls="crm-users" aria-selected="false">PY 1: Lic. ESPERANZA C.</a></li>
                @endif
              </ul>
            </div>
            <div class="card-body">
              <div class="row g-1">                   
                <div class="col-xxl-12">
                  <div class="tab-content">
                    <div class="tab-pane" id="crm-revenue" role="tabpanel" aria-labelledby="crm-revenue-tab">
                      <div class="echart-sale-Alacanse" data-echart-responsive="true" data-echart-tab="data-echart-tab" style="height:320px;"></div>
                    </div>
                    <div class="tab-pane" id="crm-users" role="tabpanel" aria-labelledby="crm-users-tab">
                      <div class="echart-sale-ProyectoDos" data-echart-responsive="true" data-echart-tab="data-echart-tab" style="height:320px;"></div>
                    </div>
                    <div class="tab-pane active" id="crm-deals" role="tabpanel" aria-labelledby="crm-deals-tab">
                      <div class="echart-sale-CanalFarmacia" data-echart-responsive="true" data-echart-tab="data-echart-tab" style="height:320px;"></div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xxl-3">
          <div class="card">
            <div class="card-header d-flex flex-between-center ps-0 py-0 border-bottom border">
              <ul class="nav nav-tabs border-0 flex-nowrap tab-active-caret" id="crm-revenue-chart-tab" role="tablist" data-tab-has-echarts="data-tab-has-echarts">
                <li class="nav-item" role="presentation">
                  <a class="nav-link py-3 mb-0 active" id="id_aportes_tab" data-bs-toggle="tab" href="#id_aportes" role="tab" aria-controls="id_aportes" aria-selected="false">APORTE <br>% POR CANAL</a>
                </li>
                @if( Session::get('rol')[0] == '1' )
                <li class="nav-item" role="presentation">
                  <a class="nav-link py-3 mb-0" id="resu_farmacia_tab" data-bs-toggle="tab" href="#resu_farmacia" role="tab" aria-controls="resu_farmacia" aria-selected="false">RESUMEN <br>FARMACIA</a>
                </li> 
                <li class="nav-item" role="presentation">
                  <a class="nav-link py-3 mb-0" id="resu_pro02_tab" data-bs-toggle="tab" href="#resu_pro02" role="tab" aria-controls="resu_pro02" aria-selected="false">RESUMEN <br>PY 1 C.</a>
                </li>  
                @endif                  
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane active" id="id_aportes" role="tabpanel" aria-labelledby="id_aportes_tab">  
              <div class="card">
                
            <div class="card-body d-flex flex-column justify-content-between">
              <div class="row align-items-center">

                <div class="col-md-12 col-xxl-12 mb-xxl-1 ">
                  <div class="position-relative">
                    <div class="echart-most-leads my-2" data-echart-responsive="true"></div>
                    <div class="position-absolute top-50 start-50 translate-middle text-center">
                      <p class="fs--1 mb-0 text-400 font-sans-serif fw-medium">Total</p>
                      <p class="fs-3 mb-0 font-sans-serif fw-medium mt-n2" id="id_val_pie"> 00.0 </p>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-xxl-12 mb-xxl-1  ">
                  <hr class="mx-ncard mb-0 d-md-none d-xxl-block" />
                  @if( Session::get('rol')[0] == '1' )
                  <div class="d-flex flex-between-center border-bottom py-3 pt-md-0 pt-xxl-3">
                    <div class="d-flex">
                      <h6 class="text-700 mb-0">FARMACIA </h6>
                    </div>
                    <p class="fs--1 text-500 mb-0 fw-semi-bold" id="id_pie_tt_farmacia" > C$ 0.00 </p>
                    <h6 class="text-700 mb-0" > <div class="d-flex align-items-center"><span class="fas fa-circle fs--2 me-2 text-primary"></span> <span id="id_tt_pie_aporte_farmacia" > 00 %</span></h6>
                  </div>
                  
                  <div class="d-flex flex-between-center border-bottom py-3">
                    <div class="d-flex">
                      <h6 class="text-700 mb-0">INST. PRIVADA </h6>
                    </div>
                    <p class="fs--1 text-500 mb-0 fw-semi-bold" id="id_tt_only_inst_priva_val"> C$ 00.00 </p>
                    <h6 class="text-700 mb-0" > <div class="d-flex align-items-center"><span class="fas fa-circle fs--2 me-2 text-warning "></span> <span id="id_tt_only_inst_priva" > 00 %</span></h6>
                  </div>
                  <div class="d-flex flex-between-center border-bottom py-3">
                    <div class="d-flex">
                      <h6 class="text-700 mb-0">MAYORISTA </h6>
                    </div>
                    <p class="fs--1 text-500 mb-0 fw-semi-bold" id="id_tt_only_mayorista"> C$ 00.00 </p>
                    <h6 class="text-700 mb-0" > <div class="d-flex align-items-center"><span class="fas fa-circle fs--2 me-2 text-info  "></span> <span id="id_tt_pie_mayorista" > 00 %</span> </h6>
                  </div>
                  <div class="d-flex flex-between-center border-bottom py-3 border-bottom-0 pb-0">
                    <div class="d-flex">
                      <h6 class="text-700 mb-0">VENTA GERENCIA </h6>
                    </div>
                    <p class="fs--1 text-500 mb-0 fw-semi-bold" id = "id_tt_only_venta_gerencia"> C$ 00.00 </p>
                    <h6 class="text-700 mb-0" > <div class="d-flex align-items-center"><span class="fas fa-circle fs--2 me-2 text-secondary "></span> <span id="id_tt_pie_aporte_gerencia" > 00 %</span> </h6>
                  </div>
                  @endif
                </div>                    

              </div>                  
            </div>  
            <div class="card-footer bg-light p-0"><a class="btn btn-sm btn-link d-block py-2" href="#!">TOTAL : <span id="id_tt_final_pie" > C$ 00.00</span> </a></div>                            
          </div>

              </div>
              <div class="tab-pane" id="resu_farmacia" role="tabpanel" aria-labelledby="resu_farmacia_tab">  
                <div class="card-body d-flex flex-column justify-content-between">
                  <div class="row align-items-center">
                    <div class="col-md-12 col-xxl-12 mb-xxl-1  ">
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">CUOTA </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id="id_tt_farmacia" > C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">VENTA</h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id="id_tt_VentaFarmacia"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">% CUMPL X EJEC </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id="id_tt_promo"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">OPTIMO </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_optimo"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">CLIENTES </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_cliente"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">META DE CLIENTES </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_cliente_meta"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">% COBERTURA </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_cliente_optimo"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">TENDENCIA </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_tendencia"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">DS </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_ds"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">SKU </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_sku"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0" id="id_tt_lbl_isToday">00-MES </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_isToday"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">EJEC </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_eject"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">SAC </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_sac"> C$ 00.00 </p>
                      </div>
                    </div>                    

                  </div>                  
                </div>                         
              </div>
              <div class="tab-pane " id="resu_pro02" role="tabpanel" aria-labelledby="resu_pro02_tab"> 
                <div class="card-body d-flex flex-column justify-content-between">
                  <div class="row align-items-center">
                    <div class="col-md-12 col-xxl-12 mb-xxl-1  ">
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">CUOTA </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id="id_tt_VentaFarmacia_Pro02" > C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">VENTA</h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id="id_tt_farmacia_Pro02"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">% CUMPL X EJEC </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id="id_tt_promo_pro02"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">OPTIMO </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_lbl_optimo_pro02"> C$ 00.00 </p>
                      </div>

                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">CLIENTES </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_cliente_pro02"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">META DE CLIENTES </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_cliente_meta_pro02"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">% COBERTURA </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_cliente_optimo_pro02"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">TENDENCIA </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_tendencia_pro02"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">DS </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_ds_pro02"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">SKU </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_sku_pro02"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0" id="id_tt_eject_pro02_lbl">00-MES </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = "id_tt_eject_pro02"> C$ 00.00 </p>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-1">
                        <div class="d-flex">
                          <h6 class="text-700 mb-0">EJEC </h6>
                        </div>
                        <p class="fs--4 text-800 mb-0 fw-semi-bold" id = ""> C$ 00.00 </p>
                      </div>
                    </div>                    

              </div>                  
            </div>                        
            </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-xxl-12">
          <div class="card overflow-hidden">                
            <div class="card-body p-0">
              <div class="table-responsive scrollbar">
              <table class="table" id="id_table">
                  <thead class="" >
                    <tr class="" id='id_table_header'><th>Name</th></tr>                        
                  </thead>
                  <tbody id='id_table_body'>
                  
                  </tbody>                      
                </table>
                
              </div>
            </div>
          </div>
        </div>
        
        @if( Session::get('rol')[0] == '1' )
        <div class="col-md-12 col-xxl-12">
          <div class="card overflow-hidden">                
            <div class="card-body p-0">
            <div class="table-responsive scrollbar">
              <table class="table" id="id_table_proyecto_02">
                  <thead class="bg-light" >
                    <tr class="text-900" id='id_table_header_proyecto_02'><th>Name</th></tr>                        
                  </thead>
                  <tbody id='id_table_body_proyecto_02'>
                  
                  </tbody>                      
                </table>
                
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
      @include('layouts.footer_gumadesk')
    </div>
  </div>
</main>
@endsection
