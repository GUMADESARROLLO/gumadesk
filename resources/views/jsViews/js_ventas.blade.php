<script type="text/javascript">
    var nMes   = $("#IdSelectMes option:selected").val();           
    var annio  = $("#IdSelectAnnio option:selected").val()
    var dta_table_header = [];
    var dta_table_excel = []
    CargarDatos(nMes,annio);
    var Selectors = {        
        ADD_ITEM_RUTA: '#modl_add_articulo',
        
    };
    
    $("#id_table_articulos_ruta").click(function(){

        var addMultiRow = document.querySelector(Selectors.ADD_ITEM_RUTA);
        var modal = new window.bootstrap.Modal(addMultiRow);
        modal.show();

        $("#id_titulo_modal").text("Articulos para Rutas")

    });

    $("#id_add_item_vinneta").click(function(){

        var addMultiRow = document.querySelector(Selectors.ADD_ITEM_RUTA);
        var modal = new window.bootstrap.Modal(addMultiRow);
        modal.show();

        $("#id_titulo_modal").text("Articulos para Viñeta")

    });
    $("#id_send_filtros").click(function(){
        var var_nMes   = $("#IdSelectMes option:selected").val();           
        var var_annio  = $("#IdSelectAnnio option:selected").val()

        CargarDatos(var_nMes,var_annio)
    })

    

    function CargarDatos(nMes,annio){                 

        /*dta_table_header = [
                {"title": "Articulo","data": "Articulos"},
                {"title": "Descripcion","data": "Descripcion"},                                
                {"title": "Proyeccion Mensual","data": "proyect_mensual","render": $.fn.dataTable.render.number(',', '.', 2)},]*/

 
        table_render(
            "#id_table_articulos",
            [],
            [
                {"title": "ARTICULO"},
                {"title": "DESCRIPCION"}
            ]
        )

        table_render(
            "#id_table_articulos_vinneta",
            [],
            [
                {"title": "ARTICULO"},
                {"title": "DESCRIPCION"},
                {"title": "VALOR"}
            ]
        )

 

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
                    table_render(
                        'id_table_articulos',
                        data[0]['data'],
                        dta_table_header
                        )
                }

                
            },
            error: function(data) {
            }
        });
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

        table_excel =  $(Table).DataTable({
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
        });
        $(Table+"_length").hide();
        $(Table+"_filter").hide();
    }
    $('#upload').on("change", function(e){ 
        handleFileSelect(e)
    });

    $('#IdSelectRuta').on("change", function(e){ 
        table_render(
            "#id_table_articulos",
            [],
            [
                {"title": "ARTICULO"},
                {"title": "DESCRIPCION"}
            ]
        )
    });
   
    var ExcelToJSON = function() {

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
                isError = false
                error_txt = ''
                Error_descripcion = ''
                $.each(objJson,function(key, objJson) {

                    var varCodigo  = isValue(objJson.Codigo,'N/D',true)
                    var varDescripcion  = isValue(objJson.RUTA,'N/D',true)
                    var varProyeccion_Mensual  = isValue(objJson.LISTA,'0',true)

                    if(varCodigo == 'N/D'){
                        isError=true
                        error_txt = varCodigo
                        Error_descripcion = varDescripcion
                        dta_table_excel = [];
                    }
                    
                    dta_table_excel.push({ 
                        Articulos: varCodigo,
                        Ruta: varDescripcion,
                        Lista: varProyeccion_Mensual,
                    })


                });
                if(isError){
                    Swal.fire(Error_descripcion, "Error en columna Codigo : " + error_txt, "error");
                    dta_table_excel = [];
                }


                dta_table_header = [
                {"title": "Articulo","data": "Articulos"},
                {"title": "Ruta","data": "Ruta"},                                
                {"title": "Lista","data": "Lista"}, ]                
                table_render('#tbl_excel',dta_table_excel,dta_table_header)
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
        if(dta_table_excel.length > 0){
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
                /*$.ajax({
                    url: "guardar_excel_proyecciones",
                    data: {
                        mes     : slct_mes,
                        annio   : slct_annio,
                        datos   : dta_table_excel,
                        _token  : "{{ csrf_token() }}" 
                    },
                    type: 'post',
                    async: true,
                    success: function(response) {
                        Swal.fire("Exito!", "Guardado exitosamente", "success");
                    },
                    error: function(response) {
                        Swal.fire("Oops", "No se ha podido guardar!", "error");
                    }
                    }).done(function(data) {
                        CargarDatos(nMes,annio);
                    });*/
                },
            allowOutsideClick: () => !Swal.isLoading()
        });

            
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No hay datos para cargar!!!...',
                
            })
        }
    })

    function mdlAsignar(){
        Swal.fire(
            'Listo!',
            'Aqui tiene que asignar que ruta se va a trabajar',
            'success'
        )
    }
</script>
