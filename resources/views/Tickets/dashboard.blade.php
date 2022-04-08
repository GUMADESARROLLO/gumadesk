@extends('layouts.lyt_gumadesk')
@section('content')
    <main class="main" id="top">
      <div class="container" data-layout="container">
      @include('layouts.nav_gumadesk')
        <div class="content">
          <div class="row mb-3">
            <div class="col">
              <div class="card bg-100 shadow-none border">
                <div class="row gx-0 flex-between-center">
                  <div class="col-sm-auto d-flex align-items-center"><img class="ms-n2" src="images/theme_gumadesk/illustrations/crm-bar-chart.png" alt="" width="90" />
                    <div>
                      <h6 class="text-primary fs--1 mb-0">Bienvenido a </h6>
                      <h4 class="text-primary fw-bold mb-0">GUMA <span class="text-info fw-medium">DESK</span></h4>
                    </div><img class="ms-n4 d-md-none d-lg-block" src="images/theme_gumadesk/illustrations/crm-line-chart.png" alt="" width="150" />
                  </div>
                  <div class="col-md-auto p-3">
                    <form class="row align-items-center g-3">
                      <div class="col-auto">
                        <h6 class="text-700 mb-0">Mostrando datos para: </h6>
                      </div>
                      <div class="col-md-auto position-relative">
                        <input class="form-control form-control-sm datetimepicker ps-4" 
                        id="CRMDateRange" type="text" 
                        data-options="{&quot;mode&quot;:&quot;range&quot;,&quot;dateFormat&quot;:&quot;M d&quot;,&quot;disableMobile&quot;:true , &quot;defaultDate&quot;: [&quot;Apr 01&quot;, &quot;Apr 30&quot;] }" />
                        <span class="fas fa-calendar-alt text-primary position-absolute top-50 translate-middle-y ms-2"> </span>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-3 g-3">
            <div class="col-lg-12 col-xxl-9">
            <div class="col-lg-12">
                  <div class="row g-3 mb-3">

                    <div class="col-sm-3 col-md-3">
                      <div class="card overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card" style="background-image:url(images/theme_gumadesk/spot-illustrations/corner-1.png);"></div>                    
                        <div class="card-body position-relative">
                          <h6>Pendientes<span class="badge badge-soft-warning rounded-pill ms-2">-0.23%</span></h6>
                          <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning" data-countup='{"endValue":58.386,"decimalPlaces":2,"suffix":"k"}'>0</div><a class="fw-semi-bold fs--1 text-nowrap" href="../app/e-commerce/customers.html">See all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                      <div class="card overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card" style="background-image:url(images/theme_gumadesk/spot-illustrations/corner-2.png);"></div>
                        <div class="card-body position-relative">
                          <h6>Procesadas<span class="badge badge-soft-info rounded-pill ms-2">0.0%</span></h6>
                          <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-info" data-countup='{"endValue":23.434,"decimalPlaces":2,"suffix":"k"}'>0</div><a class="fw-semi-bold fs--1 text-nowrap" href="../app/e-commerce/orders/order-list.html">All orders<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                      <div class="card overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card" style="background-image:url(images/theme_gumadesk/spot-illustrations/corner-3.png);"></div>
                        <div class="card-body position-relative">
                          <h6>En Espera<span class="badge badge-soft-info rounded-pill ms-2">0.0%</span></h6>
                          <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-info" data-countup='{"endValue":23.434,"decimalPlaces":2,"suffix":"k"}'>0</div><a class="fw-semi-bold fs--1 text-nowrap" href="../app/e-commerce/orders/order-list.html">All orders<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                      <div class="card overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card" style="background-image:url(images/theme_gumadesk/spot-illustrations/corner-4.png);"></div>
                        <div class="card-body position-relative">
                          <h6>Completadas<span class="badge badge-soft-info rounded-pill ms-2">0.0%</span></h6>
                          <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-info" data-countup='{"endValue":23.434,"decimalPlaces":2,"suffix":"k"}'>0</div><a class="fw-semi-bold fs--1 text-nowrap" href="../app/e-commerce/orders/order-list.html">All orders<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

              <div class="card mb-3 mt-3" id="ordersTable" data-list='{"valueNames":["order","date","address","status","amount"],"page":10,"pagination":true}'>
            <div class="card-header">
              <div class="row ">
                    <div class="col-sm-8"><h5 class="mb-0" id="followers">Mis Tickets</h5></div>
                    <div class="col-sm-4">
                        <div class="d-none " id="orders-bulk-actions">
                          <div class="d-flex">
                              <select class="form-select form-select-sm ms-2" aria-label="Bulk actions">
                                <option value="Delete">Eliminar</option>
                              </select>
                              <button class="btn btn-falcon-default btn-sm ms-2" type="button">Aplicar</button>
                            </div>
                        </div>
                        <div class="input-group" id="orders-actions">
                          <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Buscar..." aria-label="search" />
                          <div class="input-group-text bg-transparent"><span class="fa fa-search fs--1 text-600"></span></div>                            
                          <button id="id_new_ticket" class="btn btn-falcon-default btn-sm ms-2" type="button">
                              <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                              <span class="d-none d-sm-inline-block ms-1">Crear</span>
                            </button>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive scrollbar">
                <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">
                  <thead class="bg-200 text-900">
                    <tr>
                      <th>
                        <div class="form-check fs-0 mb-0 d-flex align-items-center">
                          <input class="form-check-input" id="checkbox-bulk-customers-select" type="checkbox" data-bulk-select='{"body":"table-orders-body","actions":"orders-bulk-actions","replacedElement":"orders-actions"}' />
                        </div>
                      </th>
                      <th class="sort pe-1 align-middle white-space-nowrap" data-sort="order">Tickets</th>
                      <th class="sort pe-1 align-middle white-space-nowrap pe-7" data-sort="date">Asunto</th>
                      <th class="sort pe-1 align-middle white-space-nowrap" data-sort="address" >Fecha</th>
                      <th class="sort pe-1 align-middle white-space-nowrap" data-sort="prio" >Prioridad</th>
                      <th class="sort pe-1 align-middle white-space-nowrap text-center" data-sort="status">Status</th>                      
                      <th class="no-sort"></th>
                    </tr>
                  </thead>
                  <tbody class="list" id="table-orders-body">
                    <tr class="btn-reveal-trigger">
                      <td class="align-middle" style="width: 28px;">
                        <div class="form-check fs-0 mb-0 d-flex align-items-center">
                          <input class="form-check-input" type="checkbox" id="checkbox-0" data-bulk-select-row="data-bulk-select-row" />
                        </div>
                      </td>
                      <td class="order py-2 align-middle white-space-nowrap"><a href="TicketDetalles"> <strong>#181</strong></a> by <strong>Ricky Antony</strong><br /><a href="mailto:ricky@example.com">ricky@example.com</a></td>
                      <td class="address py-2 align-middle white-space-nowrap">Nombre Categoria
                        <p class="mb-0 text-500">Sub Categoria</p>
                      </td>
                      <td class="date py-2 align-middle">30/04/2019</td>
                      <td class="date py-2 align-middle">Prioridad</td>
                      <td class="status py-2 align-middle text-center fs-0 white-space-nowrap"><span class="badge badge rounded-pill d-block badge-soft-success">Completado<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                      </td>            
                                
                      <td class="py-2 align-middle white-space-nowrap text-end">
                        <div class="dropdown font-sans-serif position-static">
                          <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="order-dropdown-0" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                          <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-0">
                            <div class="bg-white py-2">
                              <a class="dropdown-item" href="#!">Completado</a>
                              <a class="dropdown-item" href="#!">Procesando</a>
                              <a class="dropdown-item" href="#!">En Espera</a>
                              <a class="dropdown-item" href="#!">Pendiente</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Eliminar</a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr class="btn-reveal-trigger">
                      <td class="align-middle" style="width: 28px;">
                        <div class="form-check fs-0 mb-0 d-flex align-items-center">
                          <input class="form-check-input" type="checkbox" id="checkbox-1" data-bulk-select-row="data-bulk-select-row" />
                        </div>
                      </td>
                      <td class="order py-2 align-middle white-space-nowrap"><a href="../../../app/e-commerce/orders/order-details.html"> <strong>#182</strong></a> by <strong>Kin Rossow</strong><br /><a href="mailto:kin@example.com">kin@example.com</a></td>
                      <td class="address py-2 align-middle white-space-nowrap">Nombre Categoria
                        <p class="mb-0 text-500">Sub Categoria</p>
                      </td>
                      <td class="date py-2 align-middle">30/04/2019</td>
                      <td class="date py-2 align-middle">Prioridad</td>
                      <td class="status py-2 align-middle text-center fs-0 white-space-nowrap"><span class="badge badge rounded-pill d-block badge-soft-primary">Procesando<span class="ms-1 fas fa-redo" data-fa-transform="shrink-2"></span></span>
                      </td>                      
                      <td class="py-2 align-middle white-space-nowrap text-end">
                        <div class="dropdown font-sans-serif position-static">
                          <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="order-dropdown-1" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                          <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-1">
                            <div class="bg-white py-2">
                              <a class="dropdown-item" href="#!">Completado</a>
                              <a class="dropdown-item" href="#!">Procesando</a>
                              <a class="dropdown-item" href="#!">En Espera</a>
                              <a class="dropdown-item" href="#!">Pendiente</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Eliminar</a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr class="btn-reveal-trigger">
                      <td class="align-middle" style="width: 28px;">
                        <div class="form-check fs-0 mb-0 d-flex align-items-center">
                          <input class="form-check-input" type="checkbox" id="checkbox-2" data-bulk-select-row="data-bulk-select-row" />
                        </div>
                      </td>
                      <td class="order py-2 align-middle white-space-nowrap"><a href="../../../app/e-commerce/orders/order-details.html"> <strong>#183</strong></a> by <strong>Merry Diana</strong><br /><a href="mailto:merry@example.com">merry@example.com</a></td>
                      <td class="address py-2 align-middle white-space-nowrap">Nombre Categoria
                        <p class="mb-0 text-500">Sub Categoria</p>
                      </td>
                      <td class="date py-2 align-middle">30/04/2019</td>
                      <td class="date py-2 align-middle">Prioridad</td>
                      <td class="status py-2 align-middle text-center fs-0 white-space-nowrap"><span class="badge badge rounded-pill d-block badge-soft-secondary">En espera<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>
                      </td>                      
                      <td class="py-2 align-middle white-space-nowrap text-end">
                        <div class="dropdown font-sans-serif position-static">
                          <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="order-dropdown-2" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                          <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-2">
                            <div class="bg-white py-2">
                              <a class="dropdown-item" href="#!">Completado</a>
                              <a class="dropdown-item" href="#!">Procesando</a>
                              <a class="dropdown-item" href="#!">En Espera</a>
                              <a class="dropdown-item" href="#!">Pendiente</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Eliminar</a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr class="btn-reveal-trigger">
                      <td class="align-middle" style="width: 28px;">
                        <div class="form-check fs-0 mb-0 d-flex align-items-center">
                          <input class="form-check-input" type="checkbox" id="checkbox-3" data-bulk-select-row="data-bulk-select-row" />
                        </div>
                      </td>
                      <td class="order py-2 align-middle white-space-nowrap"><a href="../../../app/e-commerce/orders/order-details.html"> <strong>#184</strong></a> by <strong>Bucky Robert</strong><br /><a href="mailto:bucky@example.com">bucky@example.com</a></td>
                      
                      <td class="address py-2 align-middle white-space-nowrap">Nombre Categoria
                        <p class="mb-0 text-500">Sub Categoria</p>
                      </td>
                      <td class="date py-2 align-middle">30/04/2019</td>
                      <td class="date py-2 align-middle">Prioridad</td>
                      <td class="status py-2 align-middle text-center fs-0 white-space-nowrap"><span class="badge badge rounded-pill d-block badge-soft-warning">Pendiente<span class="ms-1 fas fa-stream" data-fa-transform="shrink-2"></span></span>
                      </td>                      
                      <td class="py-2 align-middle white-space-nowrap text-end">
                        <div class="dropdown font-sans-serif position-static">
                          <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="order-dropdown-3" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                          <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-3">
                            <div class="bg-white py-2">
                              <a class="dropdown-item" href="#!">Completado</a>
                              <a class="dropdown-item" href="#!">Procesando</a>
                              <a class="dropdown-item" href="#!">En Espera</a>
                              <a class="dropdown-item" href="#!">Pendiente</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Eliminar</a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr class="btn-reveal-trigger">
                      <td class="align-middle" style="width: 28px;">
                        <div class="form-check fs-0 mb-0 d-flex align-items-center">
                          <input class="form-check-input" type="checkbox" id="checkbox-0" data-bulk-select-row="data-bulk-select-row" />
                        </div>
                      </td>
                      <td class="order py-2 align-middle white-space-nowrap"><a href="TicketDetalles"> <strong>#181</strong></a> by <strong>Ricky Antony</strong><br /><a href="mailto:ricky@example.com">ricky@example.com</a></td>
                      <td class="address py-2 align-middle white-space-nowrap">Nombre Categoria
                        <p class="mb-0 text-500">Sub Categoria</p>
                      </td>
                      <td class="date py-2 align-middle">30/04/2019</td>
                      <td class="date py-2 align-middle">Prioridad</td>
                      <td class="status py-2 align-middle text-center fs-0 white-space-nowrap"><span class="badge badge rounded-pill d-block badge-soft-success">Completado<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                      </td>                      
                      <td class="py-2 align-middle white-space-nowrap text-end">
                        <div class="dropdown font-sans-serif position-static">
                          <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="order-dropdown-0" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                          <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-0">
                            <div class="bg-white py-2">
                              <a class="dropdown-item" href="#!">Completado</a>
                              <a class="dropdown-item" href="#!">Procesando</a>
                              <a class="dropdown-item" href="#!">En Espera</a>
                              <a class="dropdown-item" href="#!">Pendiente</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Eliminar</a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card-footer">
              <div class="d-flex align-items-center justify-content-center">
                <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                <ul class="pagination mb-0"></ul>
                <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> ---            </span></button>
              </div>
            </div>
          </div>
            </div>
            <div class="col-xxl-3">
              <div class="card">
                <div class="card-header d-flex flex-between-center py-2 border-bottom">
                  <h6 class="mb-0">Solicitudes</h6>
                  <div class="dropdown font-sans-serif btn-reveal-trigger">
                    <button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" id="dropdown-most-leads" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--2"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-most-leads"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                      <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                    </div>
                  </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                  <div class="row align-items-center">
                    <div class="col-md-5 col-xxl-12 mb-xxl-1">
                      <div class="position-relative">
                        <!-- Find the JS file for the following chart at: src/js/charts/echarts/most-leads.js-->
                        <!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js-->
                        <div class="echart-most-leads my-2" data-echart-responsive="true"></div>
                        <div class="position-absolute top-50 start-50 translate-middle text-center">
                          <p class="fs--1 mb-0 text-400 font-sans-serif fw-medium">Total</p>
                          <p class="fs-3 mb-0 font-sans-serif fw-medium mt-n2">15.6k</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-xxl-12 col-md-7">
                      <hr class="mx-ncard mb-0 d-md-none d-xxl-block" />
                      <div class="d-flex flex-between-center border-bottom py-3 pt-md-0 pt-xxl-3">
                        <div class="d-flex"><img class="me-2" src="images/theme_gumadesk/crm/email.svg " width="16" height="16" alt="..." />
                          <h6 class="text-700 mb-0">Categoria 01 </h6>
                        </div>
                        <p class="fs--1 text-500 mb-0 fw-semi-bold">5200 vs 1052</p>
                        <h6 class="text-700 mb-0">12%</h6>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-3">
                        <div class="d-flex"><img class="me-2" src="images/theme_gumadesk/crm/social.svg " width="16" height="16" alt="..." />
                          <h6 class="text-700 mb-0">Categoria 02 </h6>
                        </div>
                        <p class="fs--1 text-500 mb-0 fw-semi-bold">5623 vs 4929</p>
                        <h6 class="text-700 mb-0">25%</h6>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-3">
                        <div class="d-flex"><img class="me-2" src="images/theme_gumadesk/crm/call.svg " width="16" height="16" alt="..." />
                          <h6 class="text-700 mb-0">Categoria 03 </h6>
                        </div>
                        <p class="fs--1 text-500 mb-0 fw-semi-bold">2535 vs 1486</p>
                        <h6 class="text-700 mb-0">63%</h6>
                      </div>
                      <div class="d-flex flex-between-center border-bottom py-3 border-bottom-0 pb-0">
                        <div class="d-flex"><img class="me-2" src="images/theme_gumadesk/crm/other.svg " width="16" height="16" alt="..." />
                          <h6 class="text-700 mb-0">Other </h6>
                        </div>
                        <p class="fs--1 text-500 mb-0 fw-semi-bold">256 vs 189</p>
                        <h6 class="text-700 mb-0">53%</h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-light p-0"><a class="btn btn-sm btn-link d-block py-2" href="#!">Todas<span class="fas fa-chevron-right ms-1 fs--2"></span></a></div>
              </div>
            </div>
          </div>
          @include('layouts.footer_gumadesk')
        </div>
      </div>
    </main>
@endsection
