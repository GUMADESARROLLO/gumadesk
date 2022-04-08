@extends('layouts.lyt_gumadesk')
@section('content')
<main class="main" id="top">
    <div class="container" data-layout="container">      
        <div class="content">
        @include('layouts.nav_gumadesk')
            <div class="card mb-3" id="customersTable" data-list='{"valueNames":["name","email","phone","address","joined"],"page":10,"pagination":true}'>
            <div class="card-header">
                <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Categorias</h5>
                </div>
                <div class="col-8 col-sm-auto text-end ps-2">
                    <div class="d-none" id="table-customers-actions">
                    <div class="d-flex">
                        <select class="form-select form-select-sm" aria-label="Bulk actions">
                        <option value="Delete">Borrar</option>
                        </select>
                        <button class="btn btn-falcon-default btn-sm ms-2" type="button">Aplicar</button>
                    </div>
                    </div>
                    <div id="table-customers-replace-element">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addEventModal"> <span class="fas fa-plus me-2"></span>Nuevo</button>
                    </div>
                </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">
                        <thead class="bg-200 text-900">
                        <tr>
                            <th>
                            <div class="form-check fs-0 mb-0 d-flex align-items-center">
                                <input class="form-check-input" id="checkbox-bulk-customers-select" type="checkbox" data-bulk-select='{"body":"table-customers-body","actions":"table-customers-actions","replacedElement":"table-customers-replace-element"}' />
                            </div>
                            </th>
                            <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Categoria</th>
                            <th class="sort pe-1 align-middle white-space-nowrap" data-sort="email">SubCategoria</th>
                            <th class="sort pe-1 align-middle white-space-nowrap ps-5" data-sort="address" style="min-width: 200px;">Unidad</th>
                            <th class="sort pe-1 align-middle white-space-nowrap" data-sort="joined">Fecha</th>
                            <th class="align-middle no-sort"></th>
                        </tr>
                        </thead>
                        <tbody class="list" id="table-customers-body">

                            <?php
                                for ($i=1; $i <= 10; $i++) { 
                                    echo '<tr class="btn-reveal-trigger">
                                    <td class="align-middle py-2" style="width: 28px;">
                                    <div class="form-check fs-0 mb-0 d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox" id="customer-1" data-bulk-select-row="data-bulk-select-row" />
                                    </div>
                                    </td>
                                    <td class="name align-middle white-space-nowrap py-2"><a href="../../app/e-commerce/customer-details.html">
                                        <div class="d-flex d-flex align-items-center">
                                        <div class="flex-1">
                                            <h5 class="mb-0 fs--1">'.$i.' .- Nombre de Categoria</h5>
                                        </div>
                                        </div>
                                    </a></td>
                                    <td class="email align-middle py-2">Sub Categoria</td>
                                    <td class="address align-middle white-space-nowrap ps-5 py-2">
                                        <span class="badge badge rounded-pill d-block badge-soft-success">
                                            UNIMARK
                                            <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                        </span>
                                    </td>
                                    <td class="joined align-middle py-2">11/07/2017</td>
                                    <td class="align-middle white-space-nowrap py-2 text-end">
                                    <div class="dropdown font-sans-serif position-static">
                                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-1" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                                        <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-1">
                                        <div class="bg-white py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                                        </div>
                                    </div>
                                    </td>
                                </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="eventDetailsModal" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border"></div>
          </div>
        </div>
        <div class="modal fade" id="addEventModal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content border">
              <form id="addEventForm" autocomplete="off">
                <div class="modal-header px-card bg-light border-bottom-0">
                  <h5 class="modal-title">Crear Categoria</h5>
                  <button class="btn-close me-n1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-card">
                  <div class="mb-3">
                    <label class="fs-0" for="eventTitle">Nombre</label>
                    <input class="form-control" id="eventTitle" type="text" name="title" required="required" />
                  </div>
                  <div class="mb-3">
                    <label class="fs-0" for="eventLabel">Unidad</label>
                    <select class="form-select" id="eventLabel" name="label">
                      <option value="" selected="selected">None</option>
                      <option value="primary">UNIMARK</option>
                      <option value="danger">INNOVA</option>
                      <option value="success">GUMAPHARMA</option>                      
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="fs-0" for="eventLabel">Categoria Padre</label>
                    <select class="form-select" id="eventLabel" name="label">
                      <option value="" selected="selected">None</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="fs-0" for="eventLabel">Prioridad</label>
                    <select class="form-select" id="eventLabel" name="label">
                      <option value="" selected="selected">None</option>
                      
                    </select>
                  </div>             
                </div>
                <div class="card-footer d-flex justify-content-end align-items-center bg-light">
                  <button class="btn btn-primary px-4" type="submit">Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
            <div class="card-footer d-flex align-items-center justify-content-center">
                <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                <ul class="pagination mb-0"></ul>
                <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
            </div>
            </div>
            @include('layouts.footer_gumadesk')
        </div>
    </div>
</main>
@endsection('content')
