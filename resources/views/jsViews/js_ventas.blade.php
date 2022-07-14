<script type="text/javascript">
    var nMes   = $("#IdSelectMes option:selected").val();           
    var annio  = $("#IdSelectAnnio option:selected").val()
    CargarDatos(nMes,annio);
    var Selectors = {
        ADD_NUEVA_SOLCITUD: '#addNuevaSolicitud',        
        ADD_MULTI_ROW: '#addMultiRow',
        MODAL_COMMENT: '#IdmdlComment',
    };
    $("#id_btn_nueva_solicitud").click(function(){
    
        var addNuevaSolicitud = document.querySelector(Selectors.ADD_NUEVA_SOLCITUD);
        var modal = new window.bootstrap.Modal(addNuevaSolicitud);
        modal.show();

    });
    $("#id_add_multi_row").click(function(){

        var addMultiRow = document.querySelector(Selectors.ADD_MULTI_ROW);
        var modal = new window.bootstrap.Modal(addMultiRow);
        modal.show();

    });
    $("#id_send_filtros").click(function(){
        var var_nMes   = $("#IdSelectMes option:selected").val();           
        var var_annio  = $("#IdSelectAnnio option:selected").val()

        CargarDatos(var_nMes,var_annio)
    })
    function CargarDatos(nMes,annio){        
        var name_nMes   = $("#IdSelectMes option:selected").text();           
        $("#id_title_solicitudes").text(" Solicitudes al " + name_nMes + ' ' + annio)

        table_render_solicitud([])

        $.ajax({
            type: 'post',
            data: {
                mes      : nMes,
                annio   : annio,                
                _token  : "{{ csrf_token() }}" 
            },
            url: 'dtProyeccion', 
            async: false,
            dataType: "json",
            success: function(data){
                if (data[0]['data'].length > 0) {
                    table_render_solicitud(data[0]['data'])
                }

                
            },
            error: function(data) {
            }
        });
    }
    function table_render_solicitud(datos){

        var html_grid_product = '' ;
        var tt_Meta = 0;
        var tt_Real = 0;




        $.each(datos, function (ind, elem) { 

            var pReal    = parseFloat(isValue(elem.Ingreso,'0',true))
            var pMeta    = parseFloat(isValue(elem.proyect_mensual,'0',true))

            tt_Meta += pMeta;
            tt_Real += pReal;

            var pPorcent = numeral((parseFloat(pReal) / parseFloat(pMeta) ) * 100 ).format('0,0.00');

            pReal    = numeral(pReal).format('0,0.00')
            pMeta    = numeral(pMeta).format('0,0.00')



            html_grid_product +=    `<tr class="btn-reveal-trigger">
                            <td class="align-middle white-space-nowrap name">
                            <div class="d-flex align-items-center position-relative"><img class="rounded-1 border border-200" src="images/item-stock-03.png" width="60" alt="" />
                                <div class="flex-1 ms-3">
                                    <h6 class="mb-1 fw-semi-bold text-nowrap"><a class="text-900 stretched-link" href="#!">`+ elem.Descripcion +`</a></h6>
                                    <p class="fw-semi-bold mb-0 text-500">SKU: `+ elem.Articulos +`</p>
                                </div>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap email"> `+ pMeta +`</td>
                            <td class="align-middle white-space-nowrap product">0.00</td>
                            <td class="align-middle text-center fs-0 white-space-nowrap">
                            `+ pReal +`
                            </td>
                            <td class="align-middle text-end amount">$99</td>
                            <td class="align-middle text-end fs-0 white-space-nowrap">
                            <span class="badge badge rounded-pill badge-soft-success">`+ pReal +` %
                                <span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>
                                </span>
                            </td>
                            
                            <td class="align-middle text-end amount">$99</td>
                            </tr>`;


        }); 
        tt_Real_tns     = tt_Real / 1000 ;
        tt_Meta_tns     = tt_Meta / 1000 ;
        tt_Porcent_tns  = numeral((parseFloat(tt_Real_tns) / parseFloat(tt_Meta_tns) ) * 100 ).format('0,0.00');


        tt_Porcent      = numeral((parseFloat(tt_Real) / parseFloat(tt_Meta) ) * 100 ).format('0,0.00');
        tt_Real         = numeral(tt_Real).format('0,0.00')
        tt_Meta         = numeral(tt_Meta).format('0,0.00')

        tt_Real_tns     = numeral(tt_Real_tns).format('0,0.00')
        tt_Meta_tns     = numeral(tt_Meta_tns).format('0,0.00')

        $("#id_render_grid_html").html(html_grid_product)

        $("#id_tt_real").html(tt_Real)
        $("#id_tt_meta").html(tt_Meta)
        $("#id_tt_procent").html(tt_Porcent)


        $("#id_tt_real_tns").html(tt_Real_tns)
        $("#id_tt_meta_tns").html(tt_Meta_tns)
        $("#id_tt_procent_tns").html(tt_Porcent_tns)

            
    }
    $("#id_get_history").click(function(){
        var var_nMes   = $("#IdSelectMes option:selected").val();           
        var var_annio  = $("#IdSelectAnnio option:selected").val()
        //CargarDatos(var_nMes,var_annio)

        $.ajax({
            type: 'post',
            data: {
                mes      : nMes,
                annio   : annio,                
                _token  : "{{ csrf_token() }}" 
            },
            url: 'dtProyeccion', 
            async: false,
            dataType: "json",
            success: function(data){
                if (data[0]['data'].length > 0) {
                    var Transito = 0;
                    var Retenido = 0;
                    var In_parci= 0;
                    var In_Total= 0;

                    dta_table_excel = [];
                    $.each(data[0]['data'],function(key, registro) {

                        
                        dta_table_excel.push({ 
                            Articulos: registro.Articulos,
                            Descripcion: registro.Descripcion,
                            proyect_mensual: '0.00',
                        })

                    });

                    table_render_excel(dta_table_excel)

    
                }

                
            },
            error: function(data) {
            }
        });
    })
    function table_render_excel(datos){

table_excel =  $('#tbl_excel').DataTable({
    "data": datos,
    "destroy": true,
    "info": false,
    "bPaginate": true,
    "order": [
        [0, "asc"]
    ],
    "lengthMenu": [
        [10, -1],
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
    'columns': [
        {"title": "Articulo","data": "Articulos"},
        {"title": "Descripcion","data": "Descripcion"},                                
        {"title": "Proyeccion Mensual","data": "proyect_mensual","render": $.fn.dataTable.render.number(',', '.', 2)},

    ],
    "columnDefs": [
        {
            "className": "dt-center",
            "targets": [0]
        },
        {
            "className": "dt-right",
            "targets": [2]
        },
        
        {
            "className": "dt-left",
            "targets": [1]
        },
        
        {
            "visible": false,
            "searchable": false,
            "targets": []
        },
        {
            "width": "10%",
            "targets": []
        },
        {
            "width": "15%",
            "targets": []
        },
    ],
    "footerCallback": function(row, data, start, end, display) {
        
    },
});
$("#tbl_excel_length").hide();
$("#tbl_excel_filter").hide();
}
    function isValue(value, def, is_return) {
            if ( $.type(value) == 'null'
                || $.type(value) == 'undefined'
                || $.trim(value) == ''
                || ($.type(value) == 'number' && !$.isNumeric(value))
                || ($.type(value) == 'array' && value.length == 0)
                || ($.type(value) == 'object' && $.isEmptyObject(value)) ) {
                return ($.type(def) != 'undefined') ? def : false;
            } else {
                return ($.type(is_return) == 'boolean' && is_return === true ? value : true);
            }
        }

</script>
