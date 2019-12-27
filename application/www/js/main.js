"use strict";

function onMouseOverDisplayMenu(event) {
  event.preventDefault();
  let name = $(this).data("name");
  console.log(name);
  $(".sub-nav-" + name).removeClass("hide");
}

function onMouseOutHideMenu(event) {
  event.preventDefault();
  $(".sub-nav").addClass("hide");
}

$(".nav-item").on("mouseover", onMouseOverDisplayMenu);
$(".nav-item").on("mouseout", onMouseOutHideMenu);
$(".navButton").on("mouseout", onMouseOutHideMenu);

console.log(window.location.href);
console.log(window.location.href.split("/"));
