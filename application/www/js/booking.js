"use strict";

function onClickShowBookingBloc(event)
{
  event.preventDefault();
  let bookingBloc = document.getElementById("booking-wrapper");
  console.log("coucou");
  bookingBloc.classList.remove("hide");
}


let bookingCTA = document.getElementById("booking-cta");
bookingCTA.addEventListener("click", onClickShowBookingBloc);
