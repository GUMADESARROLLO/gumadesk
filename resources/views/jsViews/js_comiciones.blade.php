<script type="text/javascript">
    var dta_table_header = [];
    // INICIALIZA Y ASIGNA LA FECHA EN EL DATEPICKER
    const RangerStartOfMonth  = moment().subtract(1,'days').format('YYYY-MM-DD');
    const RangerEndOfMonth    = moment().subtract(0, "days").format("YYYY-MM-DD");
    var lblRange              = RangerStartOfMonth + " to " + RangerEndOfMonth;      
    $('#id_range_select').val(lblRange);

    var Selectors = {        
        ADD_ITEM_RUTA: '#modl_view_detalles_ruta',
    };

    $("#id_btn_new").click(function(){
       
        $( "#frm_send" ).submit();
    })
    
    // INICIALIZA LA DATATABLE CON LOS VALORES POR DEFECTO 
    $("#table_comisiones").DataTable({
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
    $("#table_comisiones_length").hide();
    $("#table_comisiones_filter").hide();

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

    

    function OpenModal(Zona,Ruta,Nombre){

        
        
        var addMultiRow = document.querySelector(Selectors.ADD_ITEM_RUTA);
        var modal = new window.bootstrap.Modal(addMultiRow);
        modal.show();

        var ventaValor  = 0;
        var VentaUND    = 0;
        var MetaUND     = 0;
        var Item80      = 0;
        var Item20      = 0;
        var ItemC80     = 0;
        var ItemC20     = 0;

        var nMes        = $("#id_select_month").val();
        var nYer        = $("#id_select_year").val();   

        console.log()

        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                ruta    : Ruta,
                mes     : nMes,
                annio   : nYer
            },
            url: 'getHistoryItems', 
            async: false,
            dataType: "json",
            success: function(data){

                if (data.length > 0) {
                    dta_table_excel = [];

                    dta_table_header = [
                        {"title": "Index","data": "ROW_ID"}, 
                        {"title": "Articulo","data": "ARTICULO",
                            "render": function(data, type, row, meta) {
                            return `<div class="d-flex align-items-center position-relative ">
                                    <div class="flex-1">
                                        <h6 class="mb-0 fw-semi-bold">
                                            <a class="stretched-link text-900 fw-semi-bold" href="#!" >
                                                <div class="stretched-link text-900">`+ row.DESCRIPCION +`</div>
                                            </a>
                                        </h6>
                                        <p class="text-500 fs--2 mb-0">`+ row.ARTICULO +` </p>
                                    </div>
                                </div>`
                        }},
                        {"title": "SKU","data": "Lista"},                         
                        {"title": "META","data": "MetaUND","render": function(data, type, row, meta) {return data + ' UND'}},                         
                        {"title": "VENTA","data": "VentaUND","render": function(data, type, row, meta) {return data + ' UND'}}, 
                        {"title": "VENTAS","data": "VentaVAL","render": function(data, type, row, meta) {
                            return `<div class="pe-4">
                                <div class="d-flex align-items-center">
                                  <h5 class="fs-0 text-900 mb-0 me-2">C$ `+ row.VentaVAL +`</h5>
                                  <span class="badge rounded-pill badge-soft-primary">`+ row.Cumple +` %</span>
                                </div>
                              </div>`
                        }},
                        {"title": "CUMPLIO","data": "isCumpl","render": function(data, type, row, meta) {
                            var lbl = '';
                            if ( row.isCumpl == 'SI' ) {
                                lbl = '<span class="badge badge rounded-pill d-block p-2 badge-soft-primary">Cumplio<span class="ms-1 fas fa-dollar-sign" data-fa-transform="shrink-2"></span></span>'
                            } 
                            return lbl
                        }}, 
                    ]
                    
                    $.each(data,function(key, registro) {

                        ventaValor  += parseFloat(numeral(registro.VentaVAL).format('00.00'));
                        VentaUND    += parseFloat(registro.VentaUND.replace(/,/g, ''), 10); 
                        MetaUND     += parseFloat(registro.MetaUND.replace(/,/g, ''), 10);   

                        Item80      +=  (registro.Lista==80)? 1 : 0
                        Item20      +=  (registro.Lista==20)? 1 : 0

                        ItemC80     +=  (registro.Lista==80 && registro.VentaUND > '0.00')? 1 : 0
                        ItemC20     +=  (registro.Lista==20 && registro.VentaUND > '0.00')? 1 : 0
                        
                        dta_table_excel.push({ 
                            ROW_ID: registro.ROW_ID,
                            ARTICULO: registro.ARTICULO,
                            DESCRIPCION: registro.DESCRIPCION,

                            Venta: numeral(registro.Venta).format('0,0,00.00'),
                            Aporte: numeral(registro.Aporte).format('0,0,00.00'),
                            Lista: registro.Lista,
                            MetaUND: registro.MetaUND,
                            VentaUND: registro.VentaUND,
                            VentaVAL: numeral(registro.VentaVAL).format('0,0,00.00'),
                            Cumple: numeral(registro.Cumple).format('0,0,00.00') ,
                            isCumpl: registro.isCumpl

                        })

                    });

                    table_render('#tbl_excel',dta_table_excel,dta_table_header,false)

                    ventaValor = "C$ " +numeral(ventaValor).format('0,0,00.00') 
                    $("#ttVenta_Val").text(ventaValor)

                    VentaUND = numeral(VentaUND).format('0,0,00') 
                    $("#id_Venta_UND").text(VentaUND)

                    MetaUND = numeral(MetaUND).format('0,0,00') 
                    $("#id_Meta_UND").text(MetaUND)


                    $("#id_list_80").text(ItemC80 + " / " + Item80 )
                    $("#id_list_20").text(ItemC20 + " / " + Item20)

                    var v80 = (((ItemC80 / Item80 ) * 100) )
                    var v20 = (((ItemC20 / Item20 ) * 100) )

                    v80 = numeral(v80).format('0,0,00.00')
                    v20 = numeral(v20).format('0,0,00.00')

                    $("#id_prom_ls80").text(v80+" %")
                    $("#id_prom_ls20").text(v20+" %")

                    $("#nombre_ruta_modal").text(Nombre)
                    $("#nombre_ruta_zona_modal").text(Ruta + " | " + Zona)

                    


    
                }

                
            },
            error: function(data) {
            }
        });
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
