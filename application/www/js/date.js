"use strict"

// Définition variables

let bookingDateForm = document.getElementById("booking-date-form");

let arrivalDateInput = bookingDateForm.elements["dateArrival"];
let departureDateInput = bookingDateForm.elements["dateDeparture"];
let submitCta = document.getElementById("bookingCta");

let errorArrival = document.getElementById("error-arrival");
let errorDeparture = document.getElementById("error-departure");

let validDateRegex = /^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/;

let valueMissing = "Ce champs doit être renseigné";
let typeError = "Date au format yyyy-mm-dd";

let formValid;

// Définir date min arrivée et départ à la date du jour

function setMinInputsToday(inputArrival, inputDeparture)
{
  let day = new Date;
  let todayDate = day.getFullYear() + "-" + "0" + (day.getMonth() + 1) + "-" + day.getDate();
  // console.log("aujourd'hui : " + todayDate);
  inputArrival.setAttribute("min", todayDate);
  let tomorrowDate = day.getFullYear() + "-" + "0" + (day.getMonth() + 1) + "-" + (day.getDate() + 1);
  inputDeparture.setAttribute("min", tomorrowDate);
}

// Vider toute les erreurs

function initForm()
{
  errorArrival.textContent = "";
  errorDeparture.textContent = "";
}

// Vérifier si départ > arrivée et afficher cta de validation

function checkDates(dateArrival, dateDeparture)
{
  let arrivalDate = new Date(dateArrival);
  let departureDate = new Date(dateDeparture);

  if (arrivalDate < departureDate)
  {
    submitCta.classList.remove("hide");
    initForm();
  } else {
    submitCta.classList.add("hide");
  }
}

// Définir min date pour le départ

function getMinDepartureDate(inputDeparture, date)
{
  let minDeparture = new Date(date);
  minDeparture.setDate(minDeparture.getDate() + 1);
  minDeparture = minDeparture.getFullYear() + "-" + "0" + (minDeparture.getMonth() + 1) + "-" + minDeparture.getDate();
  console.log("mindépart : " + minDeparture);
  inputDeparture.setAttribute("min", minDeparture);
}

// Définir max date pour l'arrivée

function getMaxArrivalDate(inputArrival, date)
{
  let maxArrival = new Date(date);
  maxArrival.setDate(maxArrival.getDate() - 1);
  maxArrival = maxArrival.getFullYear() + "-" + "0" + (maxArrival.getMonth() + 1) + "-" + maxArrival.getDate();
  console.log("maxArrivée : " + maxArrival);
  inputArrival.setAttribute("max", maxArrival);
}

// Obtenir valeurs des champs

function onChangeGetValue(event)
{
  event.preventDefault();
  console.log("arrivée : " + arrivalDateInput.value);
  console.log("départ : " + departureDateInput.value);
  getMinDepartureDate(departureDateInput, arrivalDateInput.value);
  getMaxArrivalDate(arrivalDateInput, departureDateInput.value);
  checkDates(arrivalDateInput.value, departureDateInput.value);
}

// Valider format datepicker

function validateDateFormat(date) {
  let testFormat = validDateRegex.test(date);
  return testFormat;
}

// Validation formulaire

function validForm(event)
{
  initForm();
  formValid = true;
  let arrivalDateFormat = validateDateFormat(arrivalDateInput.value);
  let departureDateFormat = validateDateFormat(departureDateInput.value);

  if (arrivalDateInput.value == "")
  {
    errorArrival.textContent = valueMissing;
    formValid = false;
  } else if (!arrivalDateFormat) {
    errorArrival.textContent = typeError;
    formValid = false;
  }

  if (departureDateInput.value == "")
  {
    errorDeparture.textContent = valueMissing;
    formValid = false;
  } else if (!departureDateFormat) {
    errorDeparture.textContent = typeError;
    formValid = false;
  }

  if (!formValid)
  {
    errorArrival.classList.remove("hide");
    errorDeparture.classList.remove("hide");
    event.preventDefault();
  }
}

// Code Principal

setMinInputsToday(arrivalDateInput, departureDateInput);

arrivalDateInput.addEventListener("change", onChangeGetValue);
departureDateInput.addEventListener("change", onChangeGetValue);

bookingDateForm.addEventListener("submit", validForm);
