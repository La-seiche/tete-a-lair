"use strict";

function onMouseOverDisplayMenu(event) {
  event.preventDefault();
  let name = this.dataset.name;
  // console.log(name);
  let navItemName = ".sub-nav-" + name;
  // console.log(navItemName);
  let subNavItem = document.querySelector(navItemName);
  subNavItem.classList.remove("hide");
}

function onMouseOutHideMenu2(event) {
  event.preventDefault();
  let subNavItems = document.querySelectorAll(".sub-nav");
  console.log(subNavItems.length);
  for (let i = 0; i < subNavItems.length; i++) {
    subNavItems[i].classList.add("hide");
  }
}

function onClickShowReservationBloc(event) {
  event.preventDefault();
  let reservationBloc = document.getElementById("reservationBloc");
  console.log(reservationBloc);
  reservationBloc.classList.remove("hide");
}

let navItemsList = document.querySelectorAll(".nav-item");
// console.log(navItemsList.length);
for (let i = 0; i < navItemsList.length; i++) {
  navItemsList[i].addEventListener("mouseover", onMouseOverDisplayMenu);
  navItemsList[i].addEventListener("mouseout", onMouseOutHideMenu2);
}

let reservationCTA = document.getElementById("reservationCTA");
reservationCTA.addEventListener("click", onClickShowReservationBloc);

console.log(window.location.href);
console.log(window.location.href.split("/"));
