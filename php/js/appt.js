$(function(){

	var schedule;
	var consultants;

	function loadSchedule(){
		$.getJSON('./data/data.json').done( function(data) {
			schedule = data.schedule;
			consultants = data.consultants;
	    });
	}



	$('#apptDate').on('input',function(e){
		var date = $('#apptDate').val();

		$('#apptTime').find('option').remove().end().append('<option>Choose A Time</option>');

		for(var i=0;i < schedule.length && schedule[i].date != date;i++){}
		if(i != schedule.length){
			$.each(schedule[i].time_slots,function(index,slot){
				var args = slot.split('-');
				 $('#apptTime').append($('<option>', { 
				        value: slot,
				        text : consultants[args[1]]+"-"+args[2] 
				    }));
			});
		}
		
	});


	loadSchedule();

});
