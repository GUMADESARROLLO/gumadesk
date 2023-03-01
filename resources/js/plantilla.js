/*=============================================
SideBar Menu
=============================================*/

$('.sidebar-menu').tree()

/*=============================================
Data Table
=============================================*/

$(".tablas").DataTable({

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

});

/*=============================================
 //iCheck for checkbox and radio inputs
=============================================*/
/*
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
})

/*=============================================
 //input Mask
=============================================*/

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()