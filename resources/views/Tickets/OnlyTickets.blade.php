@extends('layouts.lyt_gumadesk')
@section('content')
    <main class="main" id="top">
      <div class="container" data-layout="container">
      @include('layouts.nav_gumadesk')
        <div class="content">
          
          <div class="row mb-3 g-3">
            <div class="col-lg-12 col-xxl-12">
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
              
              <div class="card-header bg-light">
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
                          <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search for a page" aria-label="search" />
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
                      <th class="sort pe-1 align-middle white-space-nowrap pe-7" data-sort="date">Fecha</th>
                      <th class="sort pe-1 align-middle white-space-nowrap" data-sort="address" >Asunto</th>
                      <th class="sort pe-1 align-middle white-space-nowrap text-center" data-sort="status">Status</th>
                      <th class="sort pe-1 align-middle white-space-nowrap text-center" data-sort="prioridad">Prioridad</th>
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
                      <td class="order py-2 align-middle white-space-nowrap"><a href="TicketDetalles"> <strong>#181</strong></a> </td>
                      <td class="date py-2 align-middle">20/04/2019</td>
                      <td class="address py-2 align-middle white-space-nowrap">Nombre Categoria
                        <p class="mb-0 text-500">Sub Categoria</p>
                      </td>
                      
                      <td class="status py-2 align-middle text-center fs-0 white-space-nowrap"><span class="badge badge rounded-pill d-block badge-soft-success">Completado<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                      </td>
                      <td class="date py-2 align-middle">Prioridad</td>
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
                      <td class="order py-2 align-middle white-space-nowrap"><a href="../../../app/e-commerce/orders/order-details.html"> <strong>#182</strong></a> </td>
                      <td class="date py-2 align-middle">20/04/2019</td>
                      <td class="address py-2 align-middle white-space-nowrap">Nombre Categoria
                        <p class="mb-0 text-500">Sub Categoria</p>
                      </td>
                      <td class="status py-2 align-middle text-center fs-0 white-space-nowrap"><span class="badge badge rounded-pill d-block badge-soft-primary">Procesando<span class="ms-1 fas fa-redo" data-fa-transform="shrink-2"></span></span>
                      </td>
                      <td class="date py-2 align-middle">Prioridad</td>
                      
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
                      <td class="order py-2 align-middle white-space-nowrap"><a href="../../../app/e-commerce/orders/order-details.html"> <strong>#183</strong></a></td>
                      <td class="date py-2 align-middle">30/04/2019</td>
                      <td class="address py-2 align-middle white-space-nowrap">Nombre Categoria
                        <p class="mb-0 text-500">Sub Categoria</p>
                      </td>
                      <td class="status py-2 align-middle text-center fs-0 white-space-nowrap"><span class="badge badge rounded-pill d-block badge-soft-secondary">En espera<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>
                      </td>
                      <td class="date py-2 align-middle">Prioridad</td>
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
                      
                      <td class="order py-2 align-middle white-space-nowrap"><a href="../../../app/e-commerce/orders/order-details.html"> <strong>#184</strong></a> </td>
                      <td class="date py-2 align-middle">30/04/2019</td>
                      <td class="address py-2 align-middle white-space-nowrap">Nombre Categoria
                        <p class="mb-0 text-500">Sub Categoria</p>
                      </td>
                      <td class="status py-2 align-middle text-center fs-0 white-space-nowrap"><span class="badge badge rounded-pill d-block badge-soft-warning">Pendiente<span class="ms-1 fas fa-stream" data-fa-transform="shrink-2"></span></span>
                      </td>
                      <td class="date py-2 align-middle">Prioridad</td>
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
                      <td class="order py-2 align-middle white-space-nowrap"><a href="TicketDetalles"> <strong>#181</strong></a> </td>
                      <td class="date py-2 align-middle">20/04/2019</td>
                      <td class="address py-2 align-middle white-space-nowrap">Nombre Categoria
                        <p class="mb-0 text-500">Sub Categoria</p>
                      </td>
                      <td class="status py-2 align-middle text-center fs-0 white-space-nowrap"><span class="badge badge rounded-pill d-block badge-soft-success">Completado<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                      </td>
                      <td class="date py-2 align-middle">Prioridad</td>
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
            
          </div>
          @include('layouts.footer_gumadesk')
        </div>
      </div>
    </main>
@endsection
