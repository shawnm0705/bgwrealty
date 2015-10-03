// Data Table
$.extend( $.fn.dataTable.defaults, {
    "pageLength": 15,
    "aaSorting": [],
    "language": {
      "search": "查找",
      "infoFiltered": "（从 _MAX_ 条记录中查找）",
      "zeroRecords": "无记录",
      "emptyTable": "无记录",
      "infoEmpty": "无记录",
      "lengthMenu": '显示 <select>'+
        '<option value="15">15</option>'+
        '<option value="30">30</option>'+
        '<option value="50">50</option>'+
        '</select> 条记录',
      "info": "当前第 _PAGE_ 页，共 _PAGES_ 页，共 _MAX_ 条记录",
      "paginate": {
	      "first": "首页",
	      "last": "尾页",
	      "next": "下一页",
	      "previous": "上一页"
	    }
    }
} );
$(document).ready( function () {
    $('#data_table').DataTable();
} );