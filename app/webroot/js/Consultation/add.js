/*$('.zhenduan').tagsinput({
  typeahead: {
    source: ['头痛', '头晕', 'Sydney', 'Beijing', 'Cairo']
  }
});

$('.zhengxing').tagsinput({
  typeahead: {
    source: ['头疼', 'Washington', 'Sydney', 'Beijing', 'Cairo']
  }
});
*/

$.get('../zhenduans/lists',null, function(data){
	//document.getElementById('ConsultationPrescription').value = data;
	$('#ConsultationZhenduan').typeahead({
		source: data,
		items: 10
	});
},'json');

$.get('../zhengxings/lists',null, function(data){
	//document.getElementById('ConsultationPrescription').value = data;
	$('#ConsultationZhengxing').typeahead({
		source: data,
		items: 10
	});
},'json');

$.get('../zhenduans/lists',null, function(data){
	//document.getElementById('ConsultationPrescription').value = data;
	$('#ConsultationPrescription').typeahead({
		source: data,
		items: 10
	});
},'json');