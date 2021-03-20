"use strict";

let images = [
  {
    src : 1,
    alt : "Charentes-1"
  },
  {
    src : 2,
    alt : "Charentes-2"
  },
  {
    src : 3,
    alt : "Charentes-3"
  }
];

let imageDisplayed = document.querySelector("#slider-around img");
let figCaption = document.querySelector("#slider-around figcaption");
let start = 0;
let timer;

function displayImage() {
  imageDisplayed.src = getWwwUrl() + "/images/around/home/" + images[start].src + ".jpg";
  imageDisplayed.setAttribute("alt", images[start].alt);
  figCaption.textContent = images[start].alt;
}

function nextImage() {
  start++;
  if (start > images.length - 1) {
    start = 0;
  }
  displayImage();
}

displayImage();

timer = setInterval(nextImage, 3000);
