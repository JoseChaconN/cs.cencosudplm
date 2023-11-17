
function select_tienda() {
	$('#selectTiendaModal').modal('show');
}
jQuery(document).ready(function(){ 
	$('.dataTable').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },        
    });
    $('.selectChange').trigger('change');
    $('.inputDecimal').inputmask({
	    alias: 'numeric',
	    groupSeparator: '',
	    autoGroup: true,
	    digits: 2,
	    radixPoint: '.',
	    allowMinus: false,
	    rightAlign: false,
	    oncleared: function() {
	        $(this).val('');
	    }
	});
	$('.inputInt').inputmask({
	    alias: 'numeric',
	    groupSeparator: '',
	    autoGroup: true,
	    digits: 0,
	    radixPoint: '.',
	    allowMinus: false,
	    rightAlign: false,
	    oncleared: function() {
	        $(this).val('');
	    }
	});
	$('.inputRut').inputmask({
	    mask: '9{1,2}.9{3}.9{3}-(9|k|K)',
	    casing: 'upper',
	    clearIncomplete: true,
	    numericInput: true,
	    positionCaretOnClick: 'none'
	});
});
