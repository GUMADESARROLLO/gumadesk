<script type="text/javascript">

$('#id_txt_buscar').on('keyup', function() {        
    var vTableFacturas = $('#tbl_facturas').DataTable();
    vTableFacturas.search(this.value).draw();
});

$("#tbl_credito_length").hide();
$("#tbl_credito_filter").hide();


$("#id_btn_search_history").click(function(){
    if ( $("#id_spinner_load").hasClass('invisible') ) {
        $("#id_spinner_load").removeClass('invisible');
        $("#id_spinner_load").addClass('visible');
    }
    getFacturasRuta()
})
function getFacturasRuta(){

    var mes = $('#id_select_mes').val();
    var anno = $('#id_select_year').val();
    var ruta = $('#select_vendedor').val();

    $.ajax({
            url: "getFacturasCreditos",
            type: 'get',
            data: {
                mes      : mes,
                anno     : anno,
                ruta     : ruta
            },
            async: false,
            success: function(response) {
                $('#tbl_facturas').DataTable({
                    "data":response,
                    "destroy" : true,
                    "info":    false,
                    "lengthMenu": [[5,10,-1], [5,10,"Todo"]],
                    "language": {
                        "zeroRecords": "NO HAY COINCIDENCIAS",
                        "paginate": {
                            "first":      "Primera",
                            "last":       "Última ",
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },
                        "lengthMenu": "MOSTRAR _MENU_",
                        "emptyTable": "NO HAY COINCIDENCIAS",
                        "search":     "BUSCAR"
                    },
                    "footerCallback": function ( row, data, start, end, display ) {
                        if ( $("#id_spinner_load").hasClass('visible') ) {
                            $("#id_spinner_load").removeClass('visible');
                            $("#id_spinner_load").addClass('invisible');
                        }
                    },
                    'columns': [
                        {    "data": "VENDEDOR", "render": function(data, type, row, meta) {

                            return  `<td class="align-middle ps-0 text-nowrap">
                                        <div class="d-flex position-relative align-items-center">
                                        <div class="flex-1">
                                            <a id="exp_more" class="stretched-link exp_more" href="#!">
                                                <h6 class="mb-0">FCT. `+row.FACTURA+` </h6>
                                            </a>
                                        <h7 class="mb-0">`+row.CLIENTE_CODIGO+` - `+row.Nombre_Cliente+`</h7>
                                        </div>
                                    </div></td>`

                        }},        
                        {   "data": "FACTURA", "render": function(data, type, row, meta) {
                            return  `<td class="align-middle px-4 text-end text-nowrap" style="width:1%;">
                                    <h6 class="mb-0">C$`+numeral(row.Monto).format('0,0.00')+` NIO</h6>
                                    <p class="fs--2 mb-0">`+moment(row.Fecha_de_factura).format("D MMM, YYYY")+`</p>
                                </td>`

                        } },    
                        
                    ],
                })
                //OCULTA DE LA PANTALLA EL FILTRO DE PAGINADO Y FORM DE BUSQUEDA
                $("#tbl_facturas_length").hide();
                $("#tbl_facturas_filter").hide();
            }
    });

    getNotaCredito(mes,anno,ruta);
        
}

function getNotaCredito(mes, anno, ruta){
    var t80 = t20 = 0;

    $.ajax({
        url: "getNotasCreditos",
        type: 'get',
        data: {
            mes      : mes,
            anno     : anno,
            ruta     : ruta
        },
        async: false,
        success: function(response) {
            $('#tbl_credito').DataTable({
                "data":response,
                "destroy" : true,
                "info":    false,
                "lengthMenu": [[5,10,-1], [5,10,"Todo"]],
                "language": {
                    "zeroRecords": "NO HAY COINCIDENCIAS",
                    "paginate": {
                        "first":      "Primera",
                        "last":       "Última ",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    },
                    "lengthMenu": "MOSTRAR _MENU_",
                    "emptyTable": "NO HAY COINCIDENCIAS",
                    "search":     "BUSCAR"
                },
                'columns': [
                    {    "data": "RUTA", "render": function(data, type, row, meta) {

                        return  `<td class="align-middle ps-0 text-nowrap">
                                    <div class="d-flex position-relative align-items-center">
                                        <div class="flex-1"><a class="stretched-link" href="#!">
                                            <h6 class="mb-0">FCT. `+row.FACTURA+` </h6>
                                        </a>
                                        <h7 class="mb-0"><b>SKU `+row.TIPO+`:</b> `+row.ARTICULO+` </h7>
                                        </div>
                                    </div>
                                </td>`

                    }},        
                    {   "data": "NOTACREDITO", "render": function(data, type, row, meta) {
                        const fecha = new Date(row.Fecha_de_factura);
                        return  `<td class="align-middle px-4" style="width:1%;"><span class="badge fs--1 w-100 badge-soft-success">`+row.NOTACREDITO+` </span></td>`

                    } },    
                    {   "data": "FACTURA", "render": function(data, type, row, meta) {
                        return  `<td class="align-middle px-4 text-end text-nowrap" style="width:1%;">
                                <h6 class="mb-0">C$`+numeral(row.VALOR).format('0,0.00')+` NIO</h6>
                                <p class="fs--2 mb-0">`+moment(row.FECHAA).format("D MMM, YYYY")+`</p>
                            </td>`

                    } },
                    {   "data": "NOTACREDITO", "render": function(data, type, row, meta) {
                        return  `<td class="align-middle ps-4 pe-1" style="width: 130px; min-width: 100px;">
                                <div class="btn icon-item icon-item-sm border rounded-3 shadow-none me-2" onClick="ElimiarNotaCredito('`+row.ARTICULO+`','`+row.NOTACREDITO+`')"><span class="fas fa-window-close text-primary"></span></div>
                                </td>`
                    } },
                    
                ],
            })

            $.each( response, function( key, item ) {
                if(item['TIPO'] == 80){
                    t80 += Number(item['VALOR']);
                }else{
                    t20 += Number(item['VALOR']);
                }
            });

            $('#tipo80').html('C$ '+numeral(t80).format('0,0.00'));
            $('#tipo20').html('C$ '+numeral(t20).format('0,0.00'));
            //OCULTA DE LA PANTALLA EL FILTRO DE PAGINADO Y FORM DE BUSQUEDA
            $("#tbl_credito_length").hide();
            $("#tbl_credito_filter").hide();


        }
    });
}

$(document).on('click', '#exp_more', function(ef) {
    var table = $('#tbl_facturas').DataTable();
    var tr = $(this).closest('tr');
    var row = table.row(tr);
    var data = table.row($(this).parents('tr')).data();

    if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass('shown');
    } else {
        //VALIDA SI EN LA TABLA HAY TABLAS SECUNDARIAS ABIERTAS
        table.rows().eq(0).each( function ( idx ) {
            var row = table.row( idx );

            if ( row.child.isShown() ) {
                row.child.hide();

                var c_1 = $(".expan_more");
                c_1.text('expand_more');
                c_1.css({
                    background: '#e2e2e2',
                    color: '#007bff',
                });
            }
        } );

        format(row.child,data.FACTURA);
        tr.addClass('shown');
        
    }

    

});

function format ( callback, fact) {

    var thead = tbody = '';            
    thead =`<table class="table table-bordered mb-0 fs--1 table-sm">
                <thead class="text-center">
                    <tr class="bg-primary text-light">
                        <th class="center" >ARTICULO</th>
                        <th class="center" >CANTIDAD</th>
                        <th class="center" >PRECIO UNIT.</th>
                        <th class="center" >VALOR</th>
                        
                    </tr>
                </thead>
                <tbody>`;
                
    $.ajax({
        type: "GET",
        url: "getDetallesFactura",
        data:{
            factura: fact
        },
        success: function ( data ) {
            $.each(data, function (i, item) {

                tbody +='<tr>'+
                            '<td class="text-left"><a class="text-dark" href="#!" onClick="modalNota(`'+fact+'`,`'+item['ARTICULO']+'`)">'+ item['ARTICULO'] + ' | ' + item['DESCRIPCION'].toUpperCase() + '</a></td>'+
                            '<td class="text-center">' + numeral(item['CANTIDAD']).format('0,0') + '</td>'+                            
                            '<td class="text-right">c$ ' + numeral(item['PRECIO_UNITARIO']).format('0,0.00')  + '</td>'+
                            '<td class="text-right">c$ ' + numeral(item['PRECIO_TOTAL']).format('0,0.00')  + '</td>'+
                        '</tr>';
            });
            tbody += `</tbody></table>`;
            
            temp = `
                <div style="
                margin: 0 auto;
                height: auto;
                width:100%;>
                <pre dir="ltr" style="margin: 0px;padding:6px;">
                    `+thead+tbody+`
                </pre>
                </div>`;

            callback(temp).show();
        }

    });
}

function modalNota(fact, articulo){
   $('#mCredit').val('');
   $('#nuevoValor').val('');
   $('#nuevaFecha').val('');
   $('#mFact').html('FACT. ' + fact);
   $('#mFact').attr('cFact', fact);
   $('#mArt').html(articulo);
   $('#modalC').modal('show');
   //$('#mValor').html('C$'+valor);
}

$("#guardarNCredito").click( function(){

    var ruta = $('#select_vendedor').val();
    var notaC = $('#mCredit').val();
    var fact = $('#mFact').attr('cFact');
    var articulo =  $('#mArt').html();
    var valor = $('#nuevoValor').val();
    var mes = $('#id_select_mes').val();
    var anno = $('#id_select_year').val();
    var fecha = $('#nuevaFecha').val();
    var modal = $('#modalC').modal();
   
    if (notaC =='' || valor == '' || fecha == '') {
        alert(" Tiene Información pendiente ")        
    }else{
        $.ajax({
            url: "postNuevoNotaCredito",
            type: 'GET',
            data: {
                ruta        : ruta,
                notaC       : notaC,
                factura     : fact,
                articulo    : articulo,
                valor       : valor,
                mes         : mes,
                anno        : anno,
                fecha       : fecha
            },
            async: true,
            success: function(response) {
                if(response == 'ok'){
                    $('main').removeClass('modal-open'); 
                    Swal.fire({
                        title: 'Nota de credito guardada',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {                    
                        $('#modalC').modal('hide');
                        getNotaCredito(mes,anno,ruta);
                        
                    })
                }else if(response == 'no'){
                    Swal.fire({
                        title: 'El articulo no existe en la lista 80/20',
                        icon: 'info',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {                    
                        
                    })
                }else if(response == 'si'){
                    Swal.fire({
                        title: 'Ya existe una nota de credito para este articulo',
                        icon: 'info',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {                    
                        
                    })
                }
            }
        })
    }
        
})

$("#closeM").click( function(){
    $('#modalC').modal('hide');
})

function ElimiarNotaCredito(articulo, nota){
    var ruta = $('#select_vendedor').val();
    var mes = $('#id_select_mes').val();
    var anno = $('#id_select_year').val();

    Swal.fire({
        title: '¿Estas Seguro de eliminar la nota de credito?',
        text: "N/C: "+nota,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        target:"",
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: "deleteNotaCredito",
                type: 'get',
                data: {
                    articulo      : articulo,
                    nota          : nota
                },
                async: true,
                success: function(response) {
                    if(response == 1){
                    Swal.fire({
                    title: 'Nota de credito eliminada',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        getNotaCredito(mes,anno,ruta);
                    })
                }
                },
                error: function(response) {
                }
            }).done(function(data) {
                
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
}
</script>