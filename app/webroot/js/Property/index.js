$('#price').slider({
	formatter: function(value) {
		return '$' + value + ' 000';
	}
});