function bookAppointment(){
		$(this).addClass('booked');
		$(this).unbind('click');
		$(this).removeClass('available');
		$(this).click(removeAppointment);
}
function removeAppointment(){
		$(this).addClass('notWorking');
		$(this).unbind('click');
		$(this).removeClass('booked');
		$(this).click(openAppointment);
}
function openAppointment(){
		$(this).addClass('available');
		$(this).unbind('click');
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
