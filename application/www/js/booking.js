"use strict";

let bookingForm = document.getElementById("booking-form");

let name = bookingForm.elements["name"];
let surname = bookingForm.elements["surname"];
let email = bookingForm.elements["email"];
let phoneNumber = bookingForm.elements["phoneNumber"];

let errorName = document.getElementById("error-name");
let errorSurname = document.getElementById("error-surname");
let errorEmail = document.getElementById("error-email");
let errorPhoneNumber = document.getElementById("error-phone");

let valueMissing = "Ce champs doit être renseigné";
let shortValue = "Ce champs doit comporter au moins 2 caractères";
let typeError = "Ne doit comporter que des lettres";
let emailTypeError = "Ceci n'est pas une adresse email valide"
let phoneTypeError = "Ceci n'est pas un numéro valide"

let validEmailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
let validPhoneRegex = /^(?:\+[0-9]{1,3}|0)[0-9 ]+$/;

let formValid;

// Vider toute les erreurs

function initForm() {
  errorName.textContent = "";
  errorSurname.textContent = "";
  errorEmail.textContent = "";
  errorPhoneNumber.textContent = "";;
}

// Validation formulaire

function validForm(event) {
  initForm();
  formValid = true;

  if (name.value == "") {
    errorName.textContent = valueMissing;
    formValid = false;
  } else if (name.value.length < 2) {
    errorName.textContent = shortValue;
    formValid = false;
  } else if (!isNaN(name.value)) {
    errorName.textContent = typeError;
    formValid = false;
  }
  if (surname.value == "") {
    errorSurname.textContent = valueMissing;
    formValid = false;
  } else if (surname.value.length < 2) {
    errorSurname.textContent = shortValue;
    formValid = false;
  } else if (!isNaN(surname.value)) {
    errorSurname.textContent = typeError;
    formValid = false;
  }
  if (email.value == "") {
    errorEmail.textContent = valueMissing;
    formValid = false;
  } else if (!email.value.match(validEmailRegex)) {
    errorEmail.textContent = emailTypeError;
    formValid = false;
  }
  if (phoneNumber.value == "") {
    errorPhoneNumber.textContent = valueMissing;
    formValid = false;
  } else if (!phoneNumber.value.match(validPhoneRegex)) {
    errorPhoneNumber.textContent = phoneTypeError;
    formValid = false;
  }

  console.log(formValid);

  if (!formValid) {
    errorName.classList.remove("hide");
    errorSurname.classList.remove("hide");
    errorEmail.classList.remove("hide");
    errorPhoneNumber.classList.remove("hide");

    event.preventDefault();
  }
}

function onClickShowBookingBloc(event)
{
  event.preventDefault();
  let bookingBloc = document.getElementById("booking-wrapper");
  console.log("coucou");
  bookingBloc.classList.remove("hide");
}


let bookingCTA = document.getElementById("booking-cta");
bookingCTA.addEventListener("click", onClickShowBookingBloc);

bookingForm.addEventListener("submit", validForm);
