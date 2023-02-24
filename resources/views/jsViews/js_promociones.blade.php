<script type="text/javascript">
    var dta_table_header = [];
    // INICIALIZA Y ASIGNA LA FECHA EN EL DATEPICKER
    const RangerStartOfMonth  = moment().subtract(1,'days').format('YYYY-MM-DD');
    const RangerEndOfMonth    = moment().subtract(0, "days").format("YYYY-MM-DD");
    var lblRange              = RangerStartOfMonth + " to " + RangerEndOfMonth;      
    $('#id_range_select').val(lblRange);

    var Selectors = {        
        ADD_ITEM_RUTA: '#modl_view_detalles_ruta',
        ADD_PROMOCION: '#modl_add_promocion',
    };

    $("#id_btn_add_promocion").click(function(){
        AddPromocion()
    })
    
    // INICIALIZA LA DATATABLE CON LOS VALORES POR DEFECTO 
    $("#table_promociones").DataTable({
        "destroy": true,
        "info": false,
        "bPaginate": true,
        "lengthMenu": [
            [10 -1],
            [10, "Todo"]
        ],
        "language": {
            "zeroRecords": "NO HAY COINCIDENCIAS",
            "paginate": {
                "first": "Primera",
                "last": "Última ",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "MOSTRAR _MENU_",
            "emptyTable": "-",
            "search": "BUSCAR"
        },
    });

    $("#btn_nota_credito").click(function(){
        window.location.replace('NotasCredito')
    })

    //OCULTA DE LA PANTALLA EL FILTRO DE PAGINADO Y FORM DE BUSQUEDA
    $("#table_promociones_length").hide();
    $("#table_promociones_filter").hide();

    //NUMERO DE REGISTROS MOSTRADOS EN PANTALLA
    $( "#frm_lab_row").change(function() {
        var table = $('#table_comisiones').DataTable();
        table.page.len(this.value).draw();
    });

    //HABILITA LA BUSQUEDA DENTRO DE LA TABLA
    $('#id_txt_buscar').on('keyup', function() {        
        var vTablePedido = $('#table_comisiones').DataTable();
        vTablePedido.search(this.value).draw();
    });

    $('#id_searh_table_Excel').on('keyup', function() {        
        var vTablePedido = $('#tbl_excel').DataTable();
        vTablePedido.search(this.value).draw();
    });

    
    function AddPromocion(){
        var CodeRuta    = $("#select_vendedor").val();
        $("#IdRutaCode").val(CodeRuta)

        var addMultiRow = document.querySelector(Selectors.ADD_PROMOCION);
        var modal = new window.bootstrap.Modal(addMultiRow);
        modal.show();
    }
    function OpenModal(Obj){
        
        data_array = Obj
        dta_table_header = [
            {"title": "Index","data": "id"},
            {"title": '<h6 class="fs--2 text-600 mb-1">Articulo.</h6>',"data": "Articulo",
                "render": function(data, type, row, meta) {
                return `<div class="d-flex align-items-center position-relative">                                        
                            <div class="flex-1 ">
                                <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900 fw-semi-bold" href="#!" ><div class="stretched-link text-900">`+ row.Descripcion +`</div></a></h6>
                                <p class="text-500 fs--2 mb-0">`+ row.Articulo +`  </p>
                            </div>
                        </div>`
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Precio C$.</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">                                    
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">`+ row.Precio +` </h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Nueva Bonif.</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">                                    
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">`+ row.NuevaBonificacion +` </h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Viñeta C$.</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">`+ row.ValorVinneta +` </h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Val. Prom C$.</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">0.00 </h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Val. Meta C$.</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">`+ row.ValMeta +` </h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Venta C$.</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">0.00 </h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Cump %</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                    <span class="badge rounded-pill badge-soft-primary">99.99%</span>
                                    </div>
                                </div>`
            }},
            
            {"title": '<h6 class="fs--2 text-600 mb-1">Und. Prom.</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">100</h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Meta UND</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">`+ row.MetaUnd +` </h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Venta Und.</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">100 </h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Cump %</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                    <span class="badge rounded-pill badge-soft-primary">99.99%</span>
                                    </div>
                                </div>`
            }},
        ]
        table_render('#tbl_excel',data_array,dta_table_header,false)

        var addMultiRow = document.querySelector(Selectors.ADD_ITEM_RUTA);
        var modal = new window.bootstrap.Modal(addMultiRow);
        modal.show();
    }

    function table_render(Table,datos,Header,Filter){

        $(Table).DataTable({
            "data": datos,
            "destroy": true,
            "info": false,
            "bPaginate": true,
            "order": [
                [0, "asc"]
            ],
            "lengthMenu": [
                [5, -1],
                [5, "Todo"]
            ],
            "language": {
                "zeroRecords": "NO HAY COINCIDENCIAS",
                "paginate": {
                    "first": "Primera",
                    "last": "Última ",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "lengthMenu": "MOSTRAR _MENU_",
                "emptyTable": "-",
                "search": "BUSCAR"
            },
            'columns': Header,
            "columnDefs": [
                {
                    "visible": false,
                    "searchable": false,
                    "targets": [0]
                },
            ],
            "createdRow": function( row, data, dataIndex ) {
            if ( data.VentaUND > '0.00') {        
                $(row).addClass('table-success');
                    }

            },
            rowCallback: function( row, data, index ) {
                if ( data.Index < 0 ) {
                    $(row).addClass('table-danger');
                } 
            }
        });
        if(!Filter){
            $(Table+"_length").hide();
            $(Table+"_filter").hide();
        }

    }

    if ( $("#id_spinner_load").hasClass('visible') ) {
            $("#id_spinner_load").removeClass('visible');
            $("#id_spinner_load").addClass('invisible');
        }
    
</script>
