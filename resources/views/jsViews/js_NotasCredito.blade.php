<script type="text/javascript">


$("#tbl_credito_length").hide();
$("#tbl_credito_filter").hide();
$.fn.enterKey = function (fnc) {
    return this.each(function () {
        $(this).keypress(function (ev) {
            var keycode = (ev.keyCode ? ev.keyCode : ev.which);
            if (keycode == '13') {
                fnc.call(this, ev);
            }
        })
    })
}
$("#id_txt_buscar").enterKey(function () {
   
    if ( $("#id_spinner_load").hasClass('invisible') ) {
        $("#id_spinner_load").removeClass('invisible');
        $("#id_spinner_load").addClass('visible');
    }
    getFacturasRuta(this.value)
})

$("#id_btn_search_history").click(function(){
    var mes = $('#id_select_mes').val();
    var anno = $('#id_select_year').val();
    var ruta = $('#select_vendedor').val();

    

    if ( $("#id_spinner_load").hasClass('invisible') ) {
        $("#id_spinner_load").removeClass('invisible');
        $("#id_spinner_load").addClass('visible');
    }
    getNotaCredito(mes,anno,ruta);
})


function getFacturasRuta(Factura){


    $.ajax({
            url: "getFacturasCreditos",
            type: 'get',
            data: {
                Factura      : Factura
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

                            return `<div class="row">

                              <div class="col-md-12 h-100">
                                <div class="d-flex btn-reveal-trigger">                                
                                  <div class="flex-1 position-relative">
                                    <div class="border border-1 border-300 rounded-2 p-3 ask-analytics-item position-relative mb-3">
                                      <div class="d-flex align-items-center">
                                        
                                        <div class="row justify-content-between">
                                            <div class="col-12 col-sm-auto">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-2xl status-online">
                                                        <img class="rounded-circle" src="{{ asset('images/item.png') }}" alt="" />
                                                    </div>
                                                    <div class="flex-1 align-self-center ms-2">
                                                        <p class="mb-1 lh-1"><a id="exp_more" class="fw-semi-bold exp_more" href="#!">`+ row.CLIENTE_CODIGO +` :  `+ row.Nombre_Cliente +`</a> </p>
                                                        <p class="mb-0 fs--1"> `+ row.FACTURA +` &bull; `+ row.VENDEDOR +` &bull; `+ row.Nombre_Vendedor +` &bull; <span class="fas fa-boxes"></span>
                                                            <span class="badge rounded-pill ms-3 badge-soft-success"><span class="fas fa-check"></span> C$ `+ numeral(row.Monto).format('0,00.00') +` </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-auto">
                                                <div class="mb-3 pe-4">
                                                    <h6 class="fs--2 text-600 mb-1">Fecha de Facturacion</h6>
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="fs-0 text-900 mb-0 me-2">`+ moment(row.Fecha_de_factura).format("D MMM, YYYY") +` <span class="ms-1 fas fa-calendar-alt"></span></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-auto">
                                                <div class="mb-3 pe-4 ">
                                                    <h6 class="fs--2 text-600 mb-1">Vendedor Actual </h6>
                                                <div class="d-flex align-items-center">
                                                    <h5 class="fs-0 text-900 mb-0 me-2">`+ row.VEND_ACTUAL +`</h5>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                        
                                      
                                      </div> 
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>`

                       


                        }}    
                        
                    ],
                })
                //OCULTA DE LA PANTALLA EL FILTRO DE PAGINADO Y FORM DE BUSQUEDA
                $("#tbl_facturas_length").hide();
                $("#tbl_facturas_filter").hide();
            }
    });

    
        
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
                "lengthMenu": [[-1], ["Todo"]],
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
                if(item['TIPO'] == 80 || item['TIPO'] == 'SKU_80'){
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

                tbody += `<tr>
                                <td class="align-middle text-center">` +item['LINEA']+ `</td>
                                <td class="align-middle">
                                    <a class="text-dark" href="#!" onClick="modalNota('fact','` +item['ARTICULO'] + `')"><h6 class="mb-0 text-nowrap" > `  +item['DESCRIPCION'].toUpperCase()  + `</h6></a>
                                    <p class="mb-0">` +item['ARTICULO'] + `</p>
                                </td>
                                <td class="align-middle text-center">` +numeral(item['CANTIDAD']).format('0,0')+ `</td>
                                <td class="align-middle text-center">` +numeral(item['PRECIO_UNITARIO']).format('0,0.00') + `</td>
                                <td class="align-middle text-end">C$ ` +numeral(item['PRECIO_TOTAL']).format('0,0.00') + `</td>
                            </tr>`

            });
            
       

                var template =`
                    <div class="card">
                        <div class="card-body">                            
                            <div class="table-responsive scrollbar">
                                <table class="table table-striped border-bottom">
                                    <thead class="light">
                                        <tr class="bg-primary text-white dark__bg-1000">
                                            <th class="border-0 text-center"></th>
                                            <th class="border-0">ARTICULO (  ` + data.length +`  ) </th>
                                            <th class="border-0 text-center">CANTIDAD</th>
                                            <th class="border-0 text-center">PRECIO</th>
                                            <th class="border-0 text-end">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ` + tbody + `                                    
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                        <div class="card-footer bg-light">
                            <p class="fs--1 mb-0"><strong>Nota: </strong>---</p>
                        </div>
                    </div>`

            callback(template).show();
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

    var ruta = 'F00';
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