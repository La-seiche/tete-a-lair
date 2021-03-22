"use strict";

function onMouseOverDisplayImage(event)
{
  event.preventDefault();
  let path = this.dataset.path;
  // console.log(path);
  let alt = this.dataset.alt;
  imageDisplayed.src = getWwwUrl() + "/images/rooms/" + path;
  imageDisplayed.setAttribute("alt", alt);
}

let roomEquipmentsList = document.querySelectorAll(".slider-room-item");
let imageDisplayed = document.querySelector("#slider-room img");


for (let i = 0; i < roomEquipmentsList.length; i++)
{
  roomEquipmentsList[i].addEventListener("mouseover", onMouseOverDisplayImage);
}
