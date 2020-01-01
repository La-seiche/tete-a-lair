"use strict"

// Afficher calendrier arrivée

$( function() {
    $( "#datePickerArrival" ).datepicker({
      showOtherMonths: true,
      defaultDate: +1,
      dateFormat: "dd/mm/yy"
    });
  } );

// Afficher calendrier départ

  $( function() {
      $( "#datePickerDeparture" ).datepicker({
        showOtherMonths: true,
         defaultDate: +1,
         dateFormat: "dd/mm/yy"
      });
    } );

// Vérifier que les dates sont >= à la date d'aujourd'hui et vérifier que date d'arrivée < date de départ

const checkDates = () => {
  const arrivalDate = getDateFromEpoch($("#datePickerArrival").datepicker('getDate'));
  const today = getCurrentDate();
  const departureDate = getDepartureDate();
  console.log(arrivalDate);
  console.log(departureDate);
  console.log(today);

  if (departureDate){
    if (arrivalDate >= departureDate) {
      $("#datePickerDeparture").val("Date de retour invalide !");
      $("#datePickerDeparture").css("background-color", "tomato");
      $("#datePickerDeparture").css("font-weight", "bold");
    }
  }

  if (arrivalDate < today) {
    $("#datePickerArrival").val("Date choisie invalide !");
    $("#datePickerArrival").css("background-color", "var(--pink-logo)");
    $("#datePickerArrival").css("font-weight", "bold");
  }

  checkDatesValidity();

}

// Vérifier que les dates sont conformes pour pouvoir valider et passer à l'étape suivante

const checkDatesValidity = () => {
  if (!checkValidDate($("#datePickerArrival").datepicker('getDate')) || !checkValidDate($("#datePickerDeparture").datepicker('getDate'))) {
    $("#bookingCta").addClass("hide");
  }
  else {
    $("#bookingCta").removeClass("hide");
  }
}

// Obtenir date du jour au format epoch

const getCurrentDate = () => {
  const today = new Date();
  const myDate = today.getDate() + "/" + (today.getMonth() + 1) + "/" + today.getFullYear();
  return getDateFromEpoch(myDate)
}

// Vérifier que les dates sont conformes

const checkValidDate = date => {
  if (!date || isNaN(date)){
    return false;
  }

  return true;
}

// Mettre date au format epoch

const getDateFromEpoch = date => {
  return Date.parse(date)
}

// Obtenir date de départ

const getDepartureDate = () => {
  const departureDate =$("#datePickerDeparture").datepicker('getDate');
  if (!departureDate){
    return undefined;
  }
  return getDateFromEpoch(departureDate);
}

//vérifie que les 2 dates sont correctes ou masque bouton de validation


$("#datePickerArrival").on('change', checkDates);
$("#datePickerDeparture").on('change', checkDates);
checkDatesValidity();
