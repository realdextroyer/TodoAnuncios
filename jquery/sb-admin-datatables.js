// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('table').DataTable({
		"columnDefs": [ {
			"searchable": true,
			"orderable": false,
			"targets": [1,4]
		},
		{
			"width": "30%", 
			"targets": 0
		},
		{
			"width": "30%", 
			"targets": 1
		},
		{
			"width": "20%", 
			"targets": 2
		},
		{
			"width": "10%", 
			"targets": 3
		},
		{
			"width": "10%", 
			"targets": 4
		}],
		"dom": 'lprt<"bottom"ip>',
		"order": [],
		"lengthMenu": [[3,6,9,-1], [3, 6, 9, "All"]]
	});
	
});
