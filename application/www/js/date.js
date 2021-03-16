"use strict"

// Afficher CTA de validation des checkDates

function getValidationCTA(selectedArrivalDate, selectedDepartureDate) {
  let bookingCTA = document.getElementById("bookingCta");
  if (selectedArrivalDate < selectedDepartureDate) {
    bookingCTA.classList.remove("hide");
    console.log("ok");
  }
  else {
    bookingCTA.classList.add("hide");
    console.log("non");
  }
}

// Vérifier que date départ < date d'arrivée

function setMinDateDaparure(selectedArrivalDate, selectedDepartureDate) {
  dateDeparture.setAttribute("min", selectedArrivalDate);
  dateArrival.setAttribute("max", selectedDepartureDate);
}

// Obtenir date des champs arrivée et départ

function onChangeGetValue(event) {
  event.preventDefault();
  let selectedArrivalDate = dateArrival.value;
  let selectedDepartureDate = dateDeparture.value;
  console.log("arrivée : " + selectedArrivalDate);
  console.log("départ : " + selectedDepartureDate);
  setMinDateDaparure(selectedArrivalDate, selectedDepartureDate);
  getValidationCTA(selectedArrivalDate, selectedDepartureDate);
}


const dateArrival = document.getElementById("dateArrival");
const dateDeparture = document.getElementById("dateDeparture");

let day = new Date;
let todayDate = day.getFullYear() + "-" + "0" + (day.getMonth() + 1) + "-" + day.getDate();
console.log("aujourd'hui : " + todayDate);
dateArrival.setAttribute("min", todayDate);

dateArrival.addEventListener("change", onChangeGetValue);
dateDeparture.addEventListener("change", onChangeGetValue);
