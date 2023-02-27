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

    $("#id_save_item").click(function(){
        var Articulos       = $("#id_item").val();
        var Periodo         = $("#id_periodo").val();
        var Precio          = $("#id_precio").val();
        var Vinneta         = $("#id_vinneta").val();
        var Bonificado      = $("#id_bonificado").val();
        var MetaUnidades    = $("#id_meta_unidades").val();
        var MetaValor       = $("#id_meta_valor").val();
        var IdPromo         = $("#id_num_prom").text();

       

        if (Articulos =='' || Periodo =='' || Precio == '' || Bonificado == ''|| MetaUnidades == '' || MetaValor == ''|| Vinneta == '') {
      
            Swal.fire({
                title: 'Tiene Información pendiente',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {                 
                
            })    
        }else{
            $.ajax({
                url: "SaveDetalles",
                type: 'GET',
                data: {
                    IdPromo         : IdPromo,
                    Articulos       : Articulos,
                    Periodo         : Periodo,
                    Precio          : Precio,
                    Vinneta         : Vinneta,
                    Bonificado      : Bonificado,
                    MetaUnidades    : MetaUnidades,
                    MetaValor       : MetaValor
                },
                async: true,
                success: function(response) {
                    
                    Swal.fire({
                        title: 'Articuloa guardado',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {   
                        getDetalles(IdPromo)
                    })
                }
            })
        }

      
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
    function OpenModal(Promo){
        var addMultiRow = document.querySelector(Selectors.ADD_ITEM_RUTA);
        var modal = new window.bootstrap.Modal(addMultiRow);
        modal.show();

        
        $('#id_num_prom').html(Promo.id);
        $('#id_lbl_nombre').html(Promo.Titulo);
        
        $('#nombre_ruta_modal').html(Promo.vendor.NOMBRE);        
        $('#nombre_ruta_zona_modal').html(Promo.vendor.VENDEDOR + " | " + Promo.zona.Zona);
        $('#id_lbl_fechas').html("Valido desde " + Promo.fecha_ini + " al " + Promo.fecha_end);
        
        //BluidTable(Detalles)
        getDetalles(Promo.id)
    }
    function getDetalles(IdPromo) {
        $.ajax({
                url: "getDetalles",
                type: 'GET',
                data: {
                    IdPromo         : IdPromo
                },
                async: true,
                success: function(response) {
                    BluidTable(response)
                }
            })
    }
    function DateChance(nTitulo,Obj){
        let flatpickrInstance
        let lblTitulos      = ['Fecha Inicio','Fecha Termina']
        var now             = (nTitulo == 0)? Obj.fecha_ini : Obj.fecha_end

        
        Swal.fire({
            title: lblTitulos[nTitulo],
            html: '<input class="form-control " id="id_frm" placeholder="0000/00/00" value="'+now+'" >',
            
            stopKeydownPropagation: false,
                preConfirm: (value) => {

                    var dtDate = moment(flatpickrInstance.selectedDates[0]).format(FormatDate);
                    sData = {
                        id      : Obj.id,
                        valor   : dtDate,
                        Campo   : nTitulo,
                        _token  : "{{ csrf_token() }}" 
                    }
                    UpdateFechas(sData)

                },
                willOpen: () => {
                    flatpickrInstance = flatpickr(Swal.getPopup().querySelector('#id_frm'))
                }
        })
    }
    function UpdateFechas(dtInfo){
        $.ajax({
            url: "./updtFechas",
            type: 'post',
            data: dtInfo,
            async: true,
            success: function(response) {
                if(response.original){
                    Swal.fire({
                        title: 'Informacion Actualizada',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                            }
                        })

                }
                
            },
            error: function(response) {
                Swal.fire("Oops", "No se ha podido guardar!", "error");
            }
        }).done(function(data) {
            //CargarDatos(nMes,annio);
        });
    }

    function BluidTable(Obj) {
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
                                        <h5 class="fs-0 text-900 mb-0 me-2">`+ numeral(row.Precio).format('0,0,00.00')  +` </h5>
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
                                        <h5 class="fs-0 text-900 mb-0 me-2">`+  numeral(row.ValorVinneta).format('0,0,00.00')  +` </h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Val. Prom C$.</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">`+ numeral(row.Promedio_VAL).format('0,0,00.00') +`</h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Val. Meta C$.</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">`+  numeral(row.ValMeta).format('0,0,00.00') +` </h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Venta C$.</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">`+  numeral(row.Venta).format('0,0,00.00') +` </h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Cump %</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                    <span class="badge rounded-pill badge-soft-primary">`+  numeral(row.PromVenta).format('0,0,00.00') +`%</span>
                                    </div>
                                </div>`
            }},
            
            {"title": '<h6 class="fs--2 text-600 mb-1">Und. Prom.</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                        <h5 class="fs-0 text-900 mb-0 me-2">`+ row.Promedio_UND +`</h5>
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
                                        <h5 class="fs-0 text-900 mb-0 me-2"> `+ row.VentaUND +` </h5>
                                    </div>
                                </div> `
            }},
            {"title": '<h6 class="fs--2 text-600 mb-1">Cump %</h6>',"data": "",
                "render": function(data, type, row, meta) {
                return `<div class="pe-4 border-sm-end border-200">
                                    <div class="d-flex align-items-center">
                                    <span class="badge rounded-pill badge-soft-primary">`+ row.PromVentaUND +` %</span>
                                    </div>
                                </div>`
            }},
            {"title": '',"data": "",
                "render": function(data, type, row, meta) {
                return ` <div class="pe-4 border-sm-end border-200">
                            <button class="btn p-0 ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" onclick="RemoveOrden(`+ row.id +`,`+ row.id_promocion +`)" title="Delete"><span class="text-500 fas fa-trash-alt"></span></button>
                        </div>`
            }},

            
        ]
        table_render('#tbl_excel',data_array,dta_table_header,false)
    }

    function table_render(Table,datos,Header,Filter){
        
        var txt_ttMetaValor = 0 ;
        var txt_ttVenta     = 0 ;
        var txt_ttMetaUND   = 0 ;
        var txt_ttVentaUND  = 0 ;

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
                { "width":"150%", "targets": [ 1 ] }
            ],
            "createdRow": function( row, data, dataIndex ) {    
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[^0-9.]/g, '')*1 :
                    typeof i === 'number' ?
                    i : 0;
                };
                txt_ttMetaValor += intVal(data.ValMeta)
                txt_ttVenta += intVal(data.MetaUnd)
                txt_ttMetaUND += intVal(data.MetaUnd)
                txt_ttVentaUND += intVal(data.MetaUnd)
                

              
            },
            rowCallback: function( row, data, index ) {
                if ( data.Index < 0 ) {
                    $(row).addClass('table-danger');
                } 
            }
        });
        $('#id_ttMetaValor').text("C$ " + numeral(txt_ttMetaValor).format('0,0.00'));
        $('#id_ttVenta').text("C$ " + numeral(txt_ttVenta).format('0,0.00'));
        $('#id_ttMetaUND').text("C$ " + numeral(txt_ttMetaUND).format('0,0.00'));
        $('#id_ttVentaUND').text("C$ " + numeral(txt_ttVentaUND).format('0,0.00'));
        if(!Filter){
            $(Table+"_length").hide();
            $(Table+"_filter").hide();
        }

    }

    function RemoveOrden(id,IdPromocion){
        Swal.fire({
            title: '¿Estas Seguro de borrar el Comentario?',
            text: "¡Esta acción no podrá ser revertida!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            target:"",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                $.ajax({
                    url: "DeleteItems",
                    type: 'post',
                    data: {
                        id      : id,
                        _token  : "{{ csrf_token() }}" 
                    },
                    async: true,
                    success: function(response) {
                        getDetalles(IdPromocion)
                    },
                    error: function(response) {
                    }
                }).done(function(data) {
                    
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    }

    function rmPromo(id){
        Swal.fire({
            title: '¿Estas Seguro de borrar el Comentario?',
            text: "¡Esta acción no podrá ser revertida!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            target:"",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                $.ajax({
                    url: "rmPromocion",
                    type: 'post',
                    data: {
                        id      : id,
                        _token  : "{{ csrf_token() }}" 
                    },
                    async: true,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(response) {
                    }
                }).done(function(data) {
                    
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    }

    if ( $("#id_spinner_load").hasClass('visible') ) {
            $("#id_spinner_load").removeClass('visible');
            $("#id_spinner_load").addClass('invisible');
        }
    
</script>
