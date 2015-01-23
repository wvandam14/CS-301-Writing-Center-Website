var start;

function bookAppointment(){
		$(this).addClass('booked');
		$(this).removeClass('available');
		$(this).click(removeAppointment);
}
function removeAppointment(){
		$(this).addClass('notWorking');
		$(this).removeClass('booked');
		$(this).click(openAppointment);
}
function openAppointment(){
		$(this).addClass('available');
		$(this).removeClass('notWorking');
		$(this).click(bookAppointment);
}


$.each( $('td.available'),  
  function( i, obj ) { 
    $(obj).click( bookAppointment );
});
$.each( $('td.booked'),  
  function( i, obj ) { 
    $(obj).click( removeAppointment );
});
$.each( $('td.notWorking'),  
  function( i, obj ) { 
    $(obj).click( openAppointment );
});
$('td.booked').on('click', removeAppointment());
$('td.notWorking').on('click', openAppointment());
