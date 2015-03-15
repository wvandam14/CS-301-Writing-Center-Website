$(function(){

	var schedule;
	var consultants;
	var consultationFlag = false;
	var whatsThisFlag = false;


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


	// Event handler for when the checkbox is checked or unchecked
	$('#consultationNotes').on('click', function() {
		if (!consultationFlag) {
			$('#instructorEmail').show();
		}
		else {
			$('#instructorEmail').hide();
		}

		// Toggle flag
		consultationFlag = !consultationFlag;
	});

	// Event handler for when the checkbox is checked or unchecked
	$('#whatsThis').on('click', function() {
		if (!whatsThisFlag) {
			$('#tooltip').show();
		}
		else {
			$('#tooltip').hide();
		}

		// Toggle flag
		whatsThisFlag = !whatsThisFlag;
	});




	loadSchedule();

});
