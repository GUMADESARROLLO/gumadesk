/* -------------------------------------------------------------------------- */

/*                                    Utils                                   */

/* -------------------------------------------------------------------------- */

function abbrNum(number, decPlaces) {    
    decPlaces = Math.pow(10,decPlaces);
    var abbrev = [ " K", " M", " B", " T" ];
    for (var i=abbrev.length-1; i>=0; i--) {
        var size = Math.pow(10,(i+1)*3);
        if(size <= number) {
            number = Math.round(number*decPlaces/size)/decPlaces;
            if((number == 1000) && (i < abbrev.length - 1)) {
                number = 1;
                i++;
            }
            number += abbrev[i];
            break;
        }
    }

    return number;
}
function PrintRow(){
    Swal.fire('Aqui va la vainaPRo')
}
var getData = function getData(el, data) {
    try {
        return JSON.parse(el.dataset[camelize(data)]);
    } catch (e) {
        return el.dataset[camelize(data)];
    }
};
function soloNumeros(caracter, e, numeroVal) {
    var numero = numeroVal;
    if (String.fromCharCode(caracter) === "." && numero.length === 0) {
        e.preventDefault();
        swal.showValidationError('No se puede iniciar con un punto');
    } else if (numero.includes(".") && String.fromCharCode(caracter) === ".") {
        e.preventDefault();
        swal.showValidationError('No puede haber mas de dos puntos');
    } else {
        const soloNumeros = new RegExp("^[0-9]+$");
        if (!soloNumeros.test(String.fromCharCode(caracter)) && !(String.fromCharCode(caracter) === ".")) {
            e.preventDefault();
            swal.showValidationError(
                'No se pueden escribir letras, solo se permiten datos númericos'
            );
        }
    }
}
var intVal = function ( i ) {
    return typeof i === 'string' ?
    i.replace(/[^0-9.]/g, '')*1 :
    typeof i === 'number' ?
    i : 0;
};

var getGrays = function getGrays(dom) {
    return {
        white: getColor('white', dom),
        100: getColor('100', dom),
        200: getColor('200', dom),
        300: getColor('300', dom),
        400: getColor('400', dom),
        500: getColor('500', dom),
        600: getColor('600', dom),
        700: getColor('700', dom),
        800: getColor('800', dom),
        900: getColor('900', dom),
        1000: getColor('1000', dom),
        1100: getColor('1100', dom),
        black: getColor('black', dom)
    };
};


    /* -------------------------------------------------------------------------- */

    /*                          Grafica Pastel AporteMercado                      */

    /* -------------------------------------------------------------------------- */



    function Echarts_Pie_Aportes_Mercado(data1) {
    var ECHART_MOST_LEADS = '.echart-most-leads';
    var $echartMostLeads = document.querySelector(ECHART_MOST_LEADS);

    if ($echartMostLeads) {
        var userOptions = utils.getData($echartMostLeads, 'options');
        var chart = window.echarts.init($echartMostLeads);

        var getDefaultOptions = function getDefaultOptions() {
            return {
                color: [utils.getColors().primary, 
                    utils.getColors().info, 
                    utils.getColors().warning, 
                    utils.getColors().info // utils.getGrays()[300],
                ],
                tooltip: {
                trigger: 'item',
                padding: [7, 10],
                backgroundColor: utils.getGrays()['100'],
                borderColor: utils.getGrays()['300'],
                textStyle: {
                    color: utils.getColors().dark
                },
                borderWidth: 1,
                transitionDuration: 0,
                formatter: function formatter(params) {
                        return "<strong>".concat(params.data.name, ":</strong> ").concat(params.percent, "%");
                    }
                },
                position: function position(pos, params, dom, rect, size) {
                    return getPosition(pos, params, dom, rect, size);
                },
                legend: {
                show: false
                },
                series: [{
                type: 'pie',
                radius: ['100%', '67%'],
                avoidLabelOverlap: false,
                hoverAnimation: false,
                itemStyle: {
                    borderWidth: 2,
                    borderColor: utils.getColor('card-bg')
                },
                label: {
                    normal: {
                    show: false,
                    position: 'center',
                    textStyle: {
                        fontSize: '20',
                        fontWeight: '500',
                        color: utils.getGrays()['700']
                    }
                    },
                    emphasis: {
                    show: false
                    }
                },
                labelLine: {
                    normal: {
                    show: false
                    }
                },
                data: data1
                }]
            };
        };

        echartSetOption(chart, userOptions, getDefaultOptions);
    }
};


/* -------------------------------------------------------------------------- */

/*                            TIPOS DE MERCADOS                               */

/* -------------------------------------------------------------------------- */


function Echarts_Bar_Ventas_Mercados(data) {

    var tooltipFormatter = function tooltipFormatter(params) {
        return "<div class=\"card\">\n                <div class=\"card-header bg-light py-2\">\n                  <h6 class=\"text-600 mb-0\">".concat(params[0].axisValue, "</h6>\n                </div>\n              <div class=\"card-body py-2\">\n                <h6 class=\"text-600 fw-normal\">\n                  <span class=\"fas fa-circle text-warning me-2\"></span>Optimo: \n                  <span class=\"fw-medium\">").concat(params[1].data, " %</span></h6>\n                <h6 class=\"text-600 mb-0 fw-normal\"> \n                  <span class=\"fas fa-circle text-primary me-2\"></span>% CUMPL X EJEC: \n                  <span class=\"fw-medium\">").concat(params[0].data, " %</span></h6>\n              </div>\n            </div>");
    };


    var getOptionSales = function getOptionSales(data1, data2, data3) {
        return function () {
            return {
                color: utils.getGrays().white,
                tooltip: {
                trigger: 'axis',
                padding: 0,
                backgroundColor: 'transparent',
                borderWidth: 0,
                transitionDuration: 0,
                position: function position(pos, params, dom, rect, size) {
                    return getPosition(pos, params, dom, rect, size);
                },
                
                axisPointer: {
                    type: 'none'
                },
                formatter: tooltipFormatter
                },
                xAxis: {
                    type: 'category',
                    data: data3,
                    axisLabel: {
                        color: utils.getGrays()['600'],
                    },
                axisLine: {
                    lineStyle: {
                    color: utils.getGrays()['300'],
                    type: 'dashed'
                    }
                },
                axisTick:false,
                boundaryGap: true
                },
                yAxis: {
                position: 'right',
                axisPointer: {
                    type: 'none'
                },
                axisTick: 'none',
                splitLine: {
                    show: false
                },
                axisLine: {
                    show: false
                },
                axisLabel: {
                    show: false
                }
                },
                
                series: [{
                    type: 'bar',
                    name: 'Revenue',
                    data: data1,
                    lineStyle: {
                        color: utils.getColor('primary')
                    },
                    label: {
                        show: true,
                        position: 'top',
                        formatter: '{c} %'
                    },
                    
                    itemStyle: {
                        barBorderRadius: [4, 4, 0, 0],
                        color: utils.getColor('primary'),
                        borderColor: utils.getGrays()['300'],
                        borderWidth: 1
                    },
                    emphasis: {
                        itemStyle: {
                        color: utils.getColor('primary')
                        }
                    }
                }, {
                type: 'line',
                name: 'Optimo',
                data: data2,
                symbol: 'circle',
                symbolSize: 6,
                animation: false,
                itemStyle: {
                    color: utils.getColor('warning')
                },
                
                lineStyle: {
                    type: 'dashed',
                    width: 2,
                    color: utils.getColor('warning')
                }
                }],
                grid: {
                right: 5,
                left: 5,
                bottom: '8%',
                top: '5%'
                }
            };
        };
    };

    var initChart = function initChart(el, options) {
        var userOptions = utils.getData(el, 'options');
        var chart = window.echarts.init(el);
        echartSetOption(chart, userOptions, options);
    };

    var chartKeys = ['Alacanse', 'ProyectoDos', 'CanalFarmacia'];
    chartKeys.forEach(function (key) {
        var el = document.querySelector(".echart-sale-".concat(key));
        el && initChart(el, getOptionSales(
        data.dataset[key][0], 
        data.dataset[key][1], 
        data.dataset[key][2]
        ));
    });
};


$('#id_table').DataTable({
    "destroy" : true,
    "info":    false,
    "lengthMenu": [[10,-1], [10,"Todo"]],
    "language": {
        "zeroRecords": "NO HAY COINCIDENCIAS",
        "paginate": {
            "first":      "Primera",
            "last":       "Última ",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "lengthMenu": "MOSTRAR _MENU_",
        "emptyTable": "....",
        "search":     "BUSCAR"
    },
});

$('#id_table_proyecto_02').DataTable({   
    "destroy" : true,
    "info":    false,
    "lengthMenu": [[10,-1], [10,"Todo"]],
    "language": {
        "zeroRecords": "NO HAY COINCIDENCIAS",
        "paginate": {
            "first":      "Primera",
            "last":       "Última ",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "lengthMenu": "MOSTRAR _MENU_",
        "emptyTable": "....",
        "search":     "BUSCAR"
    },
});




const CAMPOS = ["","NOMBRE","CODIGO", "ZONA", "META","VENTA","% CUMPL X EJEC","OPTIMO", "CLIENTES", "METAS CLIENTES","% COBERTURA","TENDENCIA","DS (Ticket Promedio)", "SKU Facturado", "FECHA_ACTUAL", "VENTA ACUMULADO EJECUTIVO", "VENTA ACUMULADO SAC"];
const CAMPOS_PRO02 = ["","NOMBRE","CODIGO", "ZONA", "META","VENTA","% CUMPL X EJEC","OPTIMO", "CLIENTES", "METAS CLIENTES","% COBERTURA","TENDENCIA","DS (Ticket Promedio)", "SKU Facturado", "FECHA_ACTUAL"];

const startOfMonth = moment().startOf('month').format('YYYY-MM-DD');
const endOfMonth   = moment().subtract(0, "days").format("YYYY-MM-DD");

var labelRange = startOfMonth + " to " + endOfMonth;

$('#id_range_select').val(labelRange);

request_api(startOfMonth,endOfMonth);


$('#id_range_select').change(function () {
    Fechas = $(this).val().split("to");
    if(Object.keys(Fechas).length >= 2 ){
        request_api(Fechas[0],Fechas[1]);
    } 
});

async function request_api( D1,D2 ) {
    try {
        
        if ( $("#id_spinner_load").hasClass('invisible') ) {
            $("#id_spinner_load").removeClass('invisible');
            $("#id_spinner_load").addClass('visible');
        }

        const response = await $.getJSON(`api/${D1}/${D2}`);

        calc_dashboard(response);

    } catch (error) {
        console.error("Error al obtener los datos:", error);
    }
}


function calc_dashboard(json) {
    var table_header    = '';
    var table_headerPro02    = '';

    var table_column    = '';
    var table_column_Pro02    = '';
    var row_codigo      = [];
    var row_proyect02   = [];

    var tt_CuotaFarmacia = 0;
    var tt_VentaFarmacia = 0;
    var tt_prom = 0;
    var tt_optimo = 0;

    var tt_Clientes = 0;
    var tt_Clientes_meta = 0;
    var tt_Clientes_opti = 0;

    var tt_tendencia = 0
    var tt_diasHabiles = 0
    var tt_diasFactura = 0

    var tt_ds = 0
    var tt_sku = 0

    var isToday ='';

    var tt_isToday = 0
    var tt_eject = 0
    var tt_sac = 0


    var tt_CuotaFarmacia_Pro02 = 0;
    var tt_VentaFarmacia_Pro02 = 0;
    var tt_prom_Pro02= 0;

    var tt_Clientes_Pro02 = 0;
    var tt_Clientes_meta_Pro02 = 0;
    var tt_Clientes_opti_Pro02 = 0;

    var tt_tendencia_pro02 = 0;

    var tt_ds_pro02 = 0

    var tt_sku_pro02 = 0

    var tt_eject_pro02 = 0

    var tt_real_cuota   = 0
    var tt_real_real    = 0
    var tt_cumplimiento    = 0

    var tt_resumen_cliente = 0
    var tt_resumen_cliente_meta = 0
    var tt_resumen_cliente_pro = 0
    var tt_resumen_tendencia = 0
    var tt_resumen_DS = 0
    var tt_resumen_SKU = 0;
    var tt_resumen_isToday_val = 0;
    var tt_only_inst_priva = 0;
    var tt_only_mayorista= 0;
    var tt_only_venta_gerencia= 0;

    var tt_bar_privado = 0;
    var tt_bar_mayorista = 0;

    
    var vIDUser     = $('#id_user').text();
    var ttTituloMod = (vIDUser == 16) ? "PROYECTO FERNANDO" : "PROYECTO 1. LIC. ESPERANZA";



        var dta_aportes_mercados = []
        var dta_ventas_mercados = {
            dataset: {
                CanalFarmacia: [
                    [], 
                    [],
                    []
                ],
                ProyectoDos: [
                    [], 
                    [],
                    ["F02","MAYORISTA"]
                ],
                Alacanse: [
                    [], 
                    [],
                    ["FARMACIA","INST. PRIVADA","MAYORISTA"]
                ],
            }
        };

    

        table_header += '<th colspan="16" class="bg-linkedin text-100"> FERNANDO</th>';   
        table_headerPro02 += '<th colspan="5" class="bg-linkedin text-100"> '+ttTituloMod+'</th>';   

        $.each(json, function(i, item) {
            if(jQuery.type(item.VENDEDOR) !== "undefined"){
    
                tt_optimo = json.Dias_porcent
                tt_diasHabiles = json.Dias_Habiles
                tt_diasFactura = json.Dias_Facturados
    
                tt_resumen_SKU = json.SKU_TODOS
                tt_sku = json.SKU_Farmacia;
                tt_sku_pro02 = json.SKU_Proyect02
    
    
                $('#id_dias_habiles').html(tt_diasHabiles);
                $('#id_dias_facturados').html(tt_diasFactura );
                $('#id_dias_porcent').html(tt_optimo);
    
                //isToday  = moment(D2).format("DD-MMMM");
                isToday  = "Venta del Dia"
                
                CAMPOS[CAMPOS.indexOf(CAMPOS[14])] = isToday ;
    
                if (item.VENDEDOR != 'F02' && item.VENDEDOR != 'F15' && item.VENDEDOR != 'F04' && item.VENDEDOR != 'F18') {            
                    
                    row_codigo[0]    += '<td><div class="flex-1 ms-3"><h6 class="mb-1 fw-semi-bold text-nowrap">'+item.NOMBRE_SAC+'</h6></div></td>';
                    //row_codigo[1]    += '<td class="bg-soft-primary"> <div class="flex-1 ms-3"><h6 class="mb-1 fw-semi-bold text-nowrap">'+item.NOMBRE+'</h6><span class="material-icons text-secondary fs-2" onclick="PrintRow()">email</span></div></td>';
                    row_codigo[1]    += '<td class="bg-soft-primary"> <div class="flex-1 ms-3"><h6 class="mb-1 fw-semi-bold text-nowrap">'+item.NOMBRE+'</h6></div></td>';
                    
                    row_codigo[2]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0 " >'+item.VENDEDOR+'</label></td>';
                    row_codigo[3]    += '<td class="bg-soft-primary"><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.RUTA_ZONA+'</label></td>';                    
                    row_codigo[4]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.META_RUTA+'</label></td>';
                    row_codigo[5]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.MesActual+'</label></td>';
    
                    row_codigo[6]    += '<td><span class="badge rounded-pill ms-3 badge-soft-warning ">'+item.RUTA_CUMPLI+'</span></td>';
                    row_codigo[7]    += '<td><span class="badge rounded-pill ms-3 badge-soft-primary ">'+json.Dias_porcent+'</span></td>';
    
                    
                    row_codigo[8]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.CLIENTE+'</label></td>';
                    row_codigo[9]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.META_CLIENTE+'</label></td>';
                    row_codigo[10]    += '<td><span class="badge rounded-pill ms-3 badge-soft-warning ">'+item.CLIENTE_COBERTURA+'</span></td>';
                    row_codigo[11]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.TENDENCIA+'</label></td>';
                    row_codigo[12]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.DS+'</label></td>';
                    row_codigo[13]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.SKU+'</label></td>';
                    row_codigo[14]    += '<td class="bg-soft-success"><label class="-label ps-2 fs--2 text-600 mb-0 " >'+item.DiaActual+'</label></td>';
                    row_codigo[15]    += '<td class="bg-soft-primary"><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.EJEC+'</label></td>';
                    row_codigo[16]    += '<td class="bg-soft-success"><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.SAC+'</label></td>';
    
                    dta_ventas_mercados.dataset['CanalFarmacia'][0].push(intVal(item.RUTA_CUMPLI))
                    dta_ventas_mercados.dataset['CanalFarmacia'][1].push(intVal(json.Dias_porcent))
                    dta_ventas_mercados.dataset['CanalFarmacia'][2].push(item.VENDEDOR )


    
                    tt_CuotaFarmacia += intVal(item.META_RUTA);
                    tt_VentaFarmacia += intVal(item.MesActual);
                    tt_Clientes += intVal(item.CLIENTE);
                    tt_Clientes_meta += intVal(item.META_CLIENTE);
                    tt_isToday += intVal(item.DiaActual);
                    tt_eject += intVal(item.EJEC);
                    tt_sac += intVal(item.SAC);
    
    
    
                    
                }else{
                    row_proyect02[0]    += '<td><div class="flex-1 ms-3"><h6 class="mb-1 fw-semi-bold text-nowrap">'+item.NOMBRE_SAC+'</h6></div></td>';
                    row_proyect02[1]    += '<td class="bg-soft-primary"><div class="flex-1 ms-3"><h6 class="mb-1 fw-semi-bold text-nowrap">'+item.NOMBRE+'</h6></div></td>';
                    
                    row_proyect02[2]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.VENDEDOR+'</label></td>';
                    row_proyect02[3]    += '<td class="bg-soft-primary"><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.RUTA_ZONA+'</label></td>';                    
                    row_proyect02[4]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.META_RUTA+'</label></td>';
                    row_proyect02[5]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.MesActual+'</label></td>';
    
                    row_proyect02[6]    += '<td><span class="badge rounded-pill ms-3 badge-soft-warning ">'+item.RUTA_CUMPLI+'</span></td>';
    
                    
                    row_proyect02[7]    += '<td><span class="badge rounded-pill ms-3 badge-soft-primary ">'+json.Dias_porcent+'</span></td>';
                    row_proyect02[8]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.CLIENTE+'</label></td>';
                    row_proyect02[9]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.META_CLIENTE+'</label></td>';
                    row_proyect02[10]    += '<td><span class="badge rounded-pill ms-3 badge-soft-warning ">'+item.CLIENTE_COBERTURA+'</span></td>';
                    row_proyect02[11]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.TENDENCIA+'</label></td>';
                    row_proyect02[12]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.DS+'</label></td>';
                    row_proyect02[13]    += '<td><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.SKU+'</label></td>';
                    row_proyect02[14]    += '<td class="bg-soft-success"><label class="-label ps-2 fs--2 text-600 mb-0" >'+item.DiaActual+'</label></td>';
    
                    if(item.VENDEDOR != "F15"){
                        tt_CuotaFarmacia_Pro02 += intVal(item.META_RUTA);
                        tt_VentaFarmacia_Pro02 += intVal(item.MesActual);
                        
                        tt_Clientes_Pro02 += intVal(item.CLIENTE);
                        tt_Clientes_meta_Pro02 += intVal(item.META_CLIENTE);
    
                        tt_eject_pro02 += intVal(item.DiaActual);
                    }
                    
                }
    
                if(item.VENDEDOR == "F02"){
                    tt_only_inst_priva += intVal(item.MesActual);
                    tt_bar_privado += intVal(item.RUTA_CUMPLI);
    
                }
    
                if(item.VENDEDOR == "F04"){
                    tt_only_mayorista += intVal(item.MesActual);
                    tt_bar_mayorista += intVal(item.RUTA_CUMPLI);
                }
    
                if(item.VENDEDOR == "F15"){
                    tt_only_venta_gerencia += intVal(item.MesActual);
                }
           
    
                
                
                
                tt_real_cuota += intVal(item.META_RUTA);
                tt_real_real += intVal(item.MesActual);
    
                tt_resumen_cliente += intVal(item.CLIENTE);
                tt_resumen_cliente_meta += intVal(item.META_CLIENTE);
    
                tt_resumen_isToday_val += intVal(item.DiaActual);
                
    
    
            }
    
        });

       
    
    
        $.each(CAMPOS, function(i, item) {
            table_column += '<tr class="border-bottom border-200">'+
                    '<td><div class="flex-1 ms-3"><h6 class="mb-1 fw-semi-bold text-nowrap">'+CAMPOS[i]+'</h6></div></td>'+   
                    row_codigo[i]
                '</tr>';
        });
    
        $.each(CAMPOS_PRO02, function(i, item) {
            table_column_Pro02 += '<tr class="border-bottom border-200">'+
                    '<td><div class="flex-1 ms-3"><h6 class="mb-1 fw-semi-bold text-nowrap">'+CAMPOS[i]+'</h6></div></td>'+   
                    row_proyect02[i]
                '</tr>';
        });

   

        $( "#id_dias_habiles" ).on( "click", function() {
            Swal.fire({
            title: 'Dias Facturados',
            text: "Ingrese la cantidad",
            input: 'text',
            inputPlaceholder: 'Digite la cantidad',
            target: document.getElementById('mdlMatPrima'),
            inputAttributes: {
                id: 'cantidad',
                required: 'true',
                onkeypress: 'soloNumeros(event.keyCode, event, $(this).val())'
            },
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            showLoaderOnConfirm: true,
            inputValue: 0,
            inputValidator: (value) => {
                if (!value) {
                    return 'Digita la cantidad por favor';
                }
                value = value.replace(/[',]+/g, '');
                if (isNaN(value)) {
                    return 'Formato incorrecto';
                } else {
                    $.ajax({
                        url: "ActualizarDiaHabiles/"+value,
                        type: 'get',
                        async: true,
                        success: function(response) {
                            Swal.fire("Exito!", "Guardado exitosamente", "success");
                        },
                        error: function(response) {
                            Swal.fire("Oops", "No se ha podido guardar!", "error");
                        }
                    }).done(function(data) {
                        RangeStat(startOfMonth,endOfMonth)
                    });
                }
            }
        })
        });
        /* -------------------------------------------------------------------------- */
        /*                           INICIO RESUMEN FARMACIA                          */
        /* -------------------------------------------------------------------------- */
    
        $('#id_table_header').html(table_header);
        $('#id_table_body').html(table_column);
    
        $("#id_table_length").hide();
        $("#id_table_filter").hide();
        $("#id_table_paginate").hide();
        
        $('#id_tt_farmacia').html("C$ " + numeral(tt_CuotaFarmacia).format('0,0.00'));
        $('#id_tt_VentaFarmacia').html("C$ " + numeral(tt_VentaFarmacia).format('0,0.00'));
    
        tt_prom = (tt_VentaFarmacia / tt_CuotaFarmacia) * 100;
        $('#id_tt_promo').html(numeral(tt_prom).format('0.00') + " %");
        $('#id_tt_optimo').html(tt_optimo );
        $('#id_tt_lbl_optimo').html(tt_optimo);
    
    
        tt_Clientes_opti = numeral((tt_Clientes / tt_Clientes_meta ) * 100).format('0,00');
        $('#id_tt_cliente').html(tt_Clientes);
        $('#id_tt_cliente_meta').html(tt_Clientes_meta);
        $('#id_tt_cliente_optimo').html(tt_Clientes_opti + " %");
    
        tt_tendencia = numeral((tt_prom / tt_diasHabiles) * tt_diasFactura).format('0,00');   
    
        $('#id_tt_tendencia').html(tt_tendencia + " %");
    
        tt_ds = numeral((tt_VentaFarmacia / tt_Clientes)).format('0,0,00');    
        $('#id_tt_ds').html(tt_ds );
    
      
    
        $('#id_tt_sku').html(tt_sku);
    
        $('#id_tt_lbl_isToday').html(isToday+ " C$.");
    
        $('#id_tt_isToday').html(numeral(tt_isToday).format('0,0.00'));
        $('#id_tt_eject').html(numeral(tt_eject).format('0,0.00'));
        $('#id_tt_sac').html(numeral(tt_sac).format('0,0.00'));
    
    
        /* -------------------------------------------------------------------------- */
        /*                             FIN RESUMEN FARMACIA                           */
        /* -------------------------------------------------------------------------- */
    
        /* -------------------------------------------------------------------------- */
        /*                           INICIO RESUMEN PROECT02                          */
        /* -------------------------------------------------------------------------- */
    
    
        
        $('#id_table_header_proyecto_02').html(table_headerPro02);
        $('#id_table_body_proyecto_02').html(table_column_Pro02);
       
        $("#id_table_proyecto_02_length").hide();
        $("#id_table_proyecto_02_filter").hide();
        $("#id_table_proyecto_02_paginate").hide();
    
    
        
        $('#id_tt_farmacia_Pro02').html("C$ " + numeral(tt_VentaFarmacia_Pro02).format('0,0.00'));
        $('#id_tt_VentaFarmacia_Pro02').html("C$ " + numeral(tt_CuotaFarmacia_Pro02).format('0,0.00'));
    
        tt_prom_Pro02 = (tt_VentaFarmacia_Pro02 / tt_CuotaFarmacia_Pro02) * 100;
        $('#id_tt_promo_pro02').html(numeral(tt_prom_Pro02).format('0') + " %");
    
        $('#id_tt_optimo_pro02').html(tt_optimo);
        $('#id_tt_lbl_optimo_pro02').html(tt_optimo);
    
        tt_Clientes_opti_Pro02 = numeral((tt_Clientes_Pro02 / tt_Clientes_meta_Pro02 ) * 100).format('0,00');
        $('#id_tt_cliente_pro02').html(tt_Clientes_Pro02);
        $('#id_tt_cliente_meta_pro02').html(tt_Clientes_meta_Pro02);
        $('#id_tt_cliente_optimo_pro02').html(tt_Clientes_opti_Pro02 + " %");
    
        tt_tendencia_pro02 = numeral((tt_prom_Pro02 / tt_diasHabiles) * tt_diasFactura).format('0,00');   
        $('#id_tt_tendencia_pro02').html(tt_tendencia_pro02 + " % ");
    
        tt_ds_pro02 = numeral((tt_VentaFarmacia_Pro02 / tt_Clientes_Pro02)).format('0,0,00');    
        $('#id_tt_ds_pro02').html(tt_ds_pro02 );
    
      
        $('#id_tt_sku_pro02').html(tt_sku_pro02);
    
        $('#id_tt_eject_pro02').html("C$ " + numeral(tt_eject_pro02).format('0,0.00'));
        $('#id_tt_eject_pro02_lbl').html(isToday);
    
        
        
        
        /* -------------------------------------------------------------------------- */
        /*                            FIN RESUMEN PROECT02                            */
        /* -------------------------------------------------------------------------- */
    
        tt_cumplimiento = (tt_real_real / tt_real_cuota) * 100;
        $('#id_tt_real_cuota').html("C$ " + numeral(tt_real_cuota).format('0,0.00'));
        $('#id_tt_real_real').html("C$ " + numeral(tt_real_real).format('0,0.00'));
        $('#id_tt_cumplimiento').html(numeral(tt_cumplimiento).format('0,0') + "  % ");
    
        tt_resumen_cliente_pro = numeral((tt_resumen_cliente / tt_resumen_cliente_meta ) * 100).format('0,00');
        $('#id_tt_resumen_cliente').html(tt_resumen_cliente);
        $('#id_tt_resumen_cliente_meta').html(tt_resumen_cliente_meta);
        $('#id_tt_resumen_cliente_pro').html(tt_resumen_cliente_pro + " %");
    
        tt_resumen_tendencia = numeral((tt_cumplimiento / tt_diasHabiles) * tt_diasFactura).format('0,00');   
    
        $('#id_tt_resumen_tendencia').html(numeral(tt_resumen_tendencia).format('0,0') + "  % ");
    
        tt_resumen_DS = numeral((tt_real_real / tt_resumen_cliente)).format('0,0,00');    
        
        $('#id_tt_resumen_DS').html(numeral(tt_resumen_DS).format('0,0'));
    
        $('#id_tt_resumen_SKU').html(numeral(tt_resumen_SKU).format('0,0'));
        $('#id_tt_resumen_lbl_isToday').html("Corte: " + isToday );
    
        $('#id_tt_resumen_lbl_isToday_val').html("C$ " + numeral(tt_resumen_isToday_val).format('0,0'));
    
    
    
        
    
        tt_pie_aporte_farmacia      = ( tt_VentaFarmacia * 100 ) / tt_real_real;
        tt_pie_aporte_inst_privada  = ( tt_only_inst_priva * 100 ) / tt_real_real;
        tt_pie_aporte_mayorista     = ( tt_only_mayorista * 100 ) / tt_real_real;
        tt_pie_aporte_gerencia      = ( tt_only_venta_gerencia * 100 ) / tt_real_real;
    
        
        $('#id_pie_tt_farmacia').html("C$ " + numeral(tt_VentaFarmacia).format('0,0.00'));
        $('#id_tt_pie_aporte_farmacia').html(numeral(tt_pie_aporte_farmacia).format('0,00') + " %");
    
    
        $('#id_tt_only_inst_priva_val').html("C$ " + numeral(tt_only_inst_priva).format('0,0.00'));
        $('#id_tt_only_inst_priva').html(numeral(tt_pie_aporte_inst_privada).format('0,00') + " %");
    
        $('#id_tt_only_mayorista').html("C$ " + numeral(tt_only_mayorista).format('0,0.00'));
        $('#id_tt_pie_mayorista').html(numeral(tt_pie_aporte_mayorista).format('0,00') + " %");
    
        $('#id_tt_only_venta_gerencia').html("C$ " + numeral(tt_only_venta_gerencia).format('0,0.00'));
        $('#id_tt_pie_aporte_gerencia').html(numeral(tt_pie_aporte_gerencia).format('0,00') + " %");
    
    
        tt_final_pie = tt_VentaFarmacia + tt_only_inst_priva + tt_only_mayorista + tt_only_venta_gerencia;
        $('#id_tt_final_pie').html("C$ " + numeral(tt_final_pie).format('0,0.00'));
        $('#id_val_pie').html(abbrNum(tt_final_pie,2));
        
    
        dta_ventas_mercados.dataset['Alacanse'][0].push(
            numeral(tt_prom).format('0,0'),
            numeral(tt_bar_privado).format('0,0'),
            numeral(tt_bar_mayorista).format('0,0')        
            
            )
        dta_ventas_mercados.dataset['Alacanse'][1].push(intVal(tt_optimo),intVal(tt_optimo),intVal(tt_optimo))
    
    
        dta_ventas_mercados.dataset['ProyectoDos'][0].push(tt_bar_privado,tt_bar_mayorista)
        dta_ventas_mercados.dataset['ProyectoDos'][1].push(intVal(tt_optimo),intVal(tt_optimo),intVal(tt_optimo))
    
    
    
        dta_aportes_mercados.push(
            {value: tt_pie_aporte_farmacia,name: 'FARMACIA'}, 
            {value: tt_pie_aporte_inst_privada,name: 'INST. PRIVADA '}, 
            {value: tt_pie_aporte_mayorista,name: 'MAYORISTA '},
            {value: tt_pie_aporte_gerencia,name: 'VENTA GERENCIA '}
        )
        
    
        Echarts_Bar_Ventas_Mercados(dta_ventas_mercados)
        Echarts_Pie_Aportes_Mercado(dta_aportes_mercados)
    
    
        if ( $("#id_spinner_load").hasClass('visible') ) {
            $("#id_spinner_load").removeClass('visible');
            $("#id_spinner_load").addClass('invisible');
        }
    
    
}




