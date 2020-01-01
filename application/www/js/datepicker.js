"use strict"

// Afficher calendrier arrivée

$( function() {
    $( "#datePickerArrival" ).datepicker({
      showOtherMonths: true,

    });
  } );

// Afficher calendrier départ

  $( function() {
      $( "#datePickerDeparture" ).datepicker({
        showOtherMonths: true
      });
    } );

// Afficher date dans l'input datePickerArrival au format jj/mm/aa

$( "#datePickerArrival" ).on('change', function() {

  let date = $("#datePickerArrival").val();
  // console.log('change',date);
  let frenchDate = goToFrenchDate(date);

  let today = new Date;
  let dateCurrent = today.getDate() + "/" + (today.getMonth() + 1) + "/" + today.getFullYear();
  // Transformer date pour comparaison
  dateCurrent = Date.parse(dateCurrent);
  console.log(dateCurrent);
  let dateDeparture = $("#datePickerDeparture").val();
  // Transformer date pour comparaison
  dateDeparture = Date.parse(dateDeparture);
  console.log("Départ: ", dateDeparture);
  // Transformer date pour comparaison
  date = Date.parse(date);
  console.log("Arrivée: ", date);
  console.log("Date en français", frenchDate);

  // Vérifier si date >= date du jour et date < date de départ
  if (date >= dateDeparture) {
    $("#datePickerDeparture").val("");
    $("#datePickerArrival").val(frenchDate);
  }
  else {
    if (date >= dateCurrent) {
      $("#datePickerArrival").val(frenchDate);
    }
    else {
      $("#datePickerArrival").val("Retour dans le passé");
      console.log(parseInt($("#datePickerArrival").val()));
    }
  }
});

// Afficher date dans l'input datePickerDeparture au format jj/mm/aa

$("#datePickerDeparture").on('change', function() {

  let date = $("#datePickerDeparture").val()
  console.log('change',date);
  let frenchDate = goToFrenchDate(date);
  console.log(frenchDate);

  $("#datePickerDeparture").val(frenchDate);

  // let dateArrival = $("#datePickerArrival").val();
  // dateArrival = Date.parse(dateArrival);
  // // console.log("Départ: ", dateArrival);
  // date = Date.parse(date);
  // console.log(date);
  //
  // if (date <= dateArrival) {
  //   $("#datePickerDeparture").val("Retour dans le passé");
  // }
  // else {
  //   $("#datePickerDeparture").val(frenchDate);
  // }
});

// Transformer date au format français
function goToFrenchDate(date) {
  let french =  date.split('/');
  return french[1]+'/'+french[0]+'/'+french[2];
}

//vérifie que les 2 dates sont correctes ou masque bouton de validation

function checkDates() {
  if (isNaN(parseInt($("#datePickerArrival").val()) && parseInt($("#datePickerDeparture").val()))) {
    $("#bookingCta").addClass("hide");
  }
  else {
    $("#bookingCta").removeClass("hide");
  }
}

$("#datePickerArrival").on('change', checkDates);
$("#datePickerDeparture").on('change', checkDates);
