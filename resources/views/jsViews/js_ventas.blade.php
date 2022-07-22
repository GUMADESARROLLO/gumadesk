<script type="text/javascript">
    var nMes   = $("#IdSelectMes option:selected").val();           
    var annio  = $("#IdSelectAnnio option:selected").val()
    var dta_table_header = [];
    var dta_table_excel = []
    var dta_master_articulo = []
    var isError = false
    //getDataTable(nMes,annio);
    var Selectors = {        
        ADD_ITEM_RUTA: '#modl_add_articulo',
        
    };

    $.ajax({
        type: 'get',        
        url: 'getArticulos', 
        async: false,
        dataType: "json",
        success: function(item){

            $.each(item,function(key, registro) {

                dta_master_articulo.push({ 
                        ARTICULO: registro.ARTICULO,
                        DESCRIPCION: registro.DESCRIPCION,
                    })
            });

            getDataTableArticulos();

            
        },
        error: function(data) {
        }
    });
    

  

    $("#id_table_articulos_ruta").click(function(){

        $("#id_mdl_insert").html("item_ruta");

        var var_nombre   = $("#IdSelectRuta option:selected").text();  

        var addMultiRow = document.querySelector(Selectors.ADD_ITEM_RUTA);
        var modal = new window.bootstrap.Modal(addMultiRow);
        modal.show();

        $("#id_titulo_modal").text("Articulos para Rutas " )
        
    });
    
    $("#id_add_item_vinneta").click(function(){

        $("#id_mdl_insert").html("item_vinneta");

        var addMultiRow = document.querySelector(Selectors.ADD_ITEM_RUTA);
        var modal = new window.bootstrap.Modal(addMultiRow);
        modal.show();

        $("#id_titulo_modal").text("Articulos para Viñeta")

    });
    $("#id_send_filtros").click(function(){
        var var_nMes   = $("#IdSelectMes option:selected").val();           
        var var_annio  = $("#IdSelectAnnio option:selected").val()

        //CargarDatos(var_nMes,var_annio)
    })

    

    function getDataTableArticulos(){    
        var var_ruta   = $("#IdSelectRuta option:selected").val();  
        
        var var_nMes   = $("#IdSelectMes option:selected").val();           
        var var_annio  = $("#IdSelectAnnio option:selected").val()

        var dta_table  = [];
      
        dta_table_header_ARTI = [
                {"title": "Index","data": "Index"}, 
                {"title": "Articulo","data": "Articulos",
                "render": function(data, type, row, meta) {

                    var color_badge = (row.Lista >= 80 )? 'badge-soft-success' : 'badge-soft-warning'


                    return  ` <div class="d-flex hover-actions-trigger align-items-center">
                    <div class="file-thumbnail"><img class="border h-100 w-100 fit-cover rounded-2" src="images/item.png" alt="" /> </div>
                        <div class="ms-3 flex-shrink-1 flex-grow-1">
                        <h6 class="mb-1"><a class="stretched-link text-900 fw-semi-bold" href="#!">`+ row.Descrip.toUpperCase() +`</a></h6>
                        <div class="fs--1"><span class="fw-semi-bold">SKU: `+ row.Articulos +`</span><span class="fw-medium text-600 ms-2"> <span class="badge `+color_badge+` rounded-pill fs--2">`+ row.Lista +` %</span></span></div>
                        <div class="hover-actions end-0 top-50 translate-middle-y"><a class="btn btn-light border-300 btn-sm me-1 text-600" data-bs-toggle="tooltip" data-bs-placement="top" title="Download" href="assets/img/icons/cloud-download.svg" download="download"><img src="assets/img/icons/cloud-download.svg" alt="" width="15" /></a>
                            <button class="btn btn-light border-300 btn-sm me-1 text-600 shadow-none" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><img src="assets/img/icons/edit-alt.svg" alt="" width="15" /></button>
                        </div>
                        </div>
                    </div>`


                               
                }},
                ]   
        $.ajax({
            type: 'post',
            data: {
                ruta        : var_ruta,  
                nMes        : var_nMes,   
                annio       : var_annio,          
                _token      : "{{ csrf_token() }}" 
            },
            url: 'dtProyeccion', 
            async: false,
            dataType: "json",
            success: function(data){

                var itm_top     = 0;
                var itm_no_top  = 0;

                $.each(data[0]['lstArticulo'],function(key, registro) {      
                    var index       = dta_master_articulo.map(function (itm) { return itm.ARTICULO; }).indexOf(registro.Articulo);                    
                    var varDescri   = (index < 0) ? 'ND' : dta_master_articulo[index].DESCRIPCION   

                    

                    dta_table.push({ 
                        Articulos: registro.Articulo,
                        Descrip : varDescri,
                        Lista: registro.Lista,
                        Index: registro.id
                    })
                    

                    if (registro.Lista >= 80 ) {
                        itm_top++
                    } else {
                        itm_no_top++
                    }

                });
                $("#id_table_articulos_count").text(data[0]['lstArticulo'].length)
                $("#id_table_articulos_top").text(itm_top)
                $("#id_table_articulos_nTop").text(itm_no_top)


                table_render('#id_table_articulos',dta_table,dta_table_header_ARTI)

                dta_table  = []

                $.each(data[0]['lstVinneta'],function(key, reg) {  
                    
                    var index       = dta_master_articulo.map(function (itm) { return itm.ARTICULO; }).indexOf(reg.Articulo);                    
                    var varDescri   = (index < 0) ? 'ND' : dta_master_articulo[index].DESCRIPCION   

                    dta_table.push({ 
                        Index       : reg.ARTICULO,
                        ARTICULO    : reg.ARTICULO,
                        Descrip     : varDescri,
                        VALOR       : reg.VALOR
                    })
                });
                table_render('#id_table_articulos_vinneta',dta_table, [
                {"title": "Index","data": "Index"},
                {"title": "Articulo","data": "ARTICULO"},
                {"title": "Descripcion","data": "Descrip"},                                        
                {"title": "Valor","data": "VALOR"},
                ] )

                
            },
            error: function(data) {
            }
        });
    }

    function CargarDatos(nMes,annio){    
        

 

        table_render(
            "#id_table_articulos_vinneta",
            [],
            [
                {"title": "ARTICULO"},
                {"title": "DESCRIPCION"},
                {"title": "VALOR"}
            ]
        )

 

       
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

                    table_render(
                        '#tbl_excel',
                        dta_table_excel,
                        dta_table_header
                        )

    
                }

                
            },
            error: function(data) {
            }
        });
    })
    function table_render(Table,datos,Header){

        $(Table).DataTable({
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
        $(Table+"_length").hide();
        $(Table+"_filter").hide();
    }
    $('#upload').on("change", function(e){ 
        handleFileSelect(e)
    });

    $('#IdSelectRuta').on("change", function(e){ 
        getDataTableArticulos()
    });
   
    var ExcelToJSON = function() {

        var mdl        = $("#id_mdl_insert").text();        
        var var_nMes   = $("#IdSelectMes option:selected").val();           
        var var_annio  = $("#IdSelectAnnio option:selected").val()
        
        this.parseExcel = function(file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {type: 'binary'});
            workbook.SheetNames.forEach(function(sheetName) {
                var XL_row_object   = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object     = JSON.stringify(XL_row_object);
                var objJson         = JSON.parse(json_object)

                dta_table_excel = [];
                isError=false

                $.each(objJson,function(key, objJson) {

                    var varCodigo   = isValue(objJson.Codigo,'N/D',true)
                    var index       = dta_master_articulo.map(function (itm) { return itm.ARTICULO; }).indexOf(varCodigo);                    
                    var varDescri   = (index < 0) ? 'ND' : dta_master_articulo[index].DESCRIPCION
                    var varRuta     = isValue(objJson.RUTA,'N/D',true)
                    var varLista    = isValue(objJson.LISTA,'0',true)
                    var valor       = isValue(objJson.VALOR,'0',true)


                    if(index < 0){
                        isError=true
                    }
                    
                  
                    if(mdl==="item_vinneta"){
                        dta_table_excel.push({ 
                            Articulos: varCodigo,
                            Descrip : varDescri,
                            Index: index,
                            Valor: numeral(valor).format('0,0'),
                            Fecha : var_nMes + " / " + var_annio,
                            nMes: var_nMes,
                            annio: var_annio,
                        })
                    }else{
                        dta_table_excel.push({ 
                            Articulos: varCodigo,
                            Descrip : varDescri,
                            Ruta: varRuta,
                            Lista: varLista,
                            Index: index,
                            Valor: valor,
                        })
                    }

                });
                
                if(isError){
                    Swal.fire("Codigo de Articulo No encontrado", "Existen articulos sin Definicion de Codigo ", "error");
                }

                if(mdl==="item_vinneta"){
                    dta_table_header_vinneta = [
                    {"title": "Index","data": "Index"}, 
                    {"title": "Articulo","data": "Articulos"},
                    {"title": "Descripcion","data": "Descrip"},
                    {"title": "Valor","data": "Valor"},
                    {"title": "Fecha","data": "Fecha"}
                    ]
                    table_render('#tbl_excel',dta_table_excel,dta_table_header_vinneta)
                }else{
                    dta_table_header_listas = [
                    {"title": "Index","data": "Index"}, 
                    {"title": "Articulo","data": "Articulos"},
                    {"title": "Descripcion","data": "Descrip"},
                    {"title": "Ruta","data": "Ruta"},                                
                    {"title": "Lista","data": "Lista"},
                    ]
                    table_render('#tbl_excel',dta_table_excel,dta_table_header_listas)
                }

                
            })
        };

        reader.onerror = function(ex) {

        };

        reader.readAsBinaryString(file);

        };
    };
    function handleFileSelect(evt) {    
        var files = evt.target.files;
        var xl2json = new ExcelToJSON();
        xl2json.parseExcel(files[0]);
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
    $("#id_send_data_excel").click(function(){
        var mdl = $("#id_mdl_insert").text();  
        
        if(!isError){
            Swal.fire({
            title: '¿Estas Seguro de cargar  ?',
            text: "¡Se cargara la informacion previamente visualizada!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            target: document.getElementById('mdlMatPrima'),
            showLoaderOnConfirm: true,
            preConfirm: () => {
                $.ajax({
                    url: "GuardarListas",
                    data: {
                        datos   : dta_table_excel,
                        mdl     : mdl,
                        _token  : "{{ csrf_token() }}" 
                    },
                    type: 'post',
                    async: true,
                    success: function(response) {
                        if(response.original){
                            Swal.fire({
                                title: 'Articulos Ingresados Correctamente ' ,
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
                        //Swal.fire("Oops", "No se ha podido guardar!", "error");
                    }
                    }).done(function(data) {
                        //CargarDatos(nMes,annio);
                    });
                },
            allowOutsideClick: () => !Swal.isLoading()
        });

            
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Existen articulos sin Definicion de Codigo ",
                
            })
        }
    })

    function mdlAsignar(Ruta){
        var options = {};
        $.ajax({
            type: 'get',          
            url: 'getVendedor', 
            async: false,
            dataType: "json",
            success: function(data){
                $.map(data,function(o) {
                    options[o.VENDEDOR] = o.VENDEDOR;
                });

                Swal.fire({
                    title: 'Nueva lista de Articulos Para ' + Ruta,
                    input: 'select',
                    inputOptions:options,
                    inputPlaceholder: 'Seleccione la Ruta',
                    showCancelButton: true,
                    confirmButtonText: 'OK'
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            
                            var isEmpy = isValue(result.value,'N/D',true)

                            if(isEmpy !='N/D'){

                                $.ajax({
                                url: "GuardarAsignacion",
                                data: {
                                    Ruta    : Ruta,
                                    Asign   : result.value,
                                    _token  : "{{ csrf_token() }}" 
                                },
                                type: 'post',
                                async: true,
                                success: function(response) {
                                    if(response.original){
                                        Swal.fire({
                                            title: 'Todo Correcto' ,
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
                                    //Swal.fire("Oops", "No se ha podido guardar!", "error");
                                }
                                }).done(function(data) {
                                    //CargarDatos(nMes,annio);
                                });

                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: "Campo no puede ir Vacio",
                                    
                                })

                            }
                            //location.reload();
                        }
                    })
            },
            error: function(data) {
            }
        });       
    }

    var search_tbl = $("#id_table_articulos").DataTable()
    $('#id_search_articulo_ruta').on('keyup', function() {
        search_tbl.search(this.value).draw();
    });

</script>
