"use strict"

$( function() {
    $( "#datePickerArrival" ).datepicker({
      showOtherMonths: true,

    });
  } );

  $( function() {
      $( "#datePickerDeparture" ).datepicker({
        showOtherMonths: true
      });
    } );



$( "#datePickerArrival" ).on('change', function() {

  let date = $( "#datePickerArrival" ).val()
  console.log('change',date);
  let frenchDate = goToFrenchDate(date);
  console.log(frenchDate);

  $( "#datePickerArrival" ).val(frenchDate)


});


function goToFrenchDate(date) {
  let french =  date.split('/');
  return french[1]+'/'+french[0]+'/'+french[2];
}
