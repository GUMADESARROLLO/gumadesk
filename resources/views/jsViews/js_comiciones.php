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

    
    
    // INICIALIZA LA DATATABLE CON LOS VALORES POR DEFECTO 
    $("#table_comisiones").DataTable({
        "destroy": true,
        "info": false,
        "bPaginate": true,
        "lengthMenu": [
            [7 -1],
            [7, "Todo"]
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

    

    function OpenModal(Ruta){
        
        var addMultiRow = document.querySelector(Selectors.ADD_ITEM_RUTA);
        var modal = new window.bootstrap.Modal(addMultiRow);
        modal.show();

        var ventaValor  = 0;
        var VentaUND    = 0;
        var MetaUND     = 0;
        var Item80      = 0;
        var Item20      = 0;

        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                ruta    : Ruta,
                mes     : 1,
                annio   : 2023
            },
            url: 'getHistoryItems', 
            async: false,
            dataType: "json",
            success: function(data){

                if (data.length > 0) {
                    dta_table_excel = [];

                    dta_table_header = [
                        {"title": "Index","data": "ROW_ID"}, 
                        {"title": "Articulo","data": "ARTICULO"},
                        {"title": "Descrip.","data": "DESCRIPCION"},                        
                        {"title": "P.UNIT","data": "Venta"},                         
                        {"title": "APORTE","data": "Aporte"},          
                        {"title": "SKU","data": "Lista"},                         
                        {"title": "META UND","data": "MetaUND"},                         
                        {"title": "VENTA UND","data": "VentaUND"},
                        {"title": "VENTA VAL","data": "VentaVAL"},                         
                        {"title": "CUM%","data": "Cumple"},                         
                        {"title": "CUM META","data": "isCumpl"} 
                    ]
                    
                    $.each(data,function(key, registro) {

                        
                        ventaValor  += parseFloat(registro.VentaVAL.replace(/,/g, ''), 10);
                        VentaUND    += parseFloat(registro.VentaUND.replace(/,/g, ''), 10); 
                        MetaUND     += parseFloat(registro.MetaUND.replace(/,/g, ''), 10);   
                        Item80      +=  (registro.Lista==80)? 1 : 0
                        Item20      +=  (registro.Lista==20)? 1 : 0
                        
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


                    $("#id_list_80").text(Item80)
                    $("#id_list_20").text(Item20)


    
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
    
</script>
