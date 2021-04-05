"use strict";

// Coordonnées du centre de la carte

let lat = 45.6489712;
let lon = -0.5029854;

let maCarte = null;

// initialisation de la liste des marqueurs

let interestedPoints = [
  {
    id : 1,
    name : "Cognac",
    lat : 45.6931647,
    lon : -0.3250175,
    lien : '<a class="cta-map" href="#1">Cognac</a>',
    description : "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
    image : "1.jpg"
  },
  {
    id : 2,
    name : "Saintes",
    lat : 45.7460663,
    lon : -0.6300671,
    lien : '<a class="cta-map" href="#2">Saintes</a>',
    description : "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
    image : "2.jpg"
  },
  {
    id : 3,
    name : "Chateau de Pons",
    lat : 45.5781785,
    lon : -0.5476816,
    lien : '<a class="cta-map" href="#3">Chateau de Pons</a>',
    description : "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
    image : "3.jpg"
  }
];

let tableMarker = [];

// Fonction d'initialisation de la carte

function initMap() {
  // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
  maCarte = L.map('map').setView([lat, lon], 11);
  // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
  L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    // Il est toujours bien de laisser le lien vers la source des données
    attribution: 'données © OpenStreetMap/ODbL - rendu OSM France',
    minZoom: 1,
    maxZoom: 20
  }).addTo(maCarte);
  // Nous parcourons la liste des villes
  for (let i = 0; i < interestedPoints.length; i++) {
    // console.log(interestedPoints[i]);
    // Afficher les marqueurs
    let marker = L.marker([interestedPoints[i].lat, interestedPoints[i].lon]).addTo(maCarte);
    // Ajouter des bulles d'informations au clic
    // marker.bindPopup(interestedPoints[i].name);
    marker.bindPopup(interestedPoints[i].lien);
    // Nous ajoutons le marqueur à la liste des marqueurs
		tableMarker.push(marker);
  }
  // On regroupe les marqueurs dans un groupe Leaflet
  let group = new L.featureGroup(tableMarker);

  // On adapte le zomm au groupe
  maCarte.fitBounds(group.getBounds());

  // Définir logo tête à l'air
  let iconHome = L.icon({
    iconUrl : getWwwUrl() + "/images/logo/logo.webp",
    iconSize : [50, 50],
    iconAnchor : [25, 50],
  });
  // Afficher localisation tête à l'air
  let home = L.marker([lat, lon], { icon: iconHome}).addTo(maCarte)
}

// Fonction qui affiche les descriptions des points d'intérêts

function displayDescriptions() {
  let descriptionContainer = document.getElementById("sites-container");

  for (let i = 0; i < interestedPoints.length; i++) {
    const div = document.createElement("div");
    div.id = interestedPoints[i].id;
    div.classList.add("site-wrapper");

    const image = document.createElement("img");
    image.classList.add("description-image");
    image.src = getWwwUrl() + "/images/around/tourism/" + interestedPoints[i].image;

    const descriptionWrapper = document.createElement("article");
    descriptionWrapper.classList.add("description-wrapper");
    const descriptionTitle = document.createElement("h3");
    descriptionTitle.textContent = interestedPoints[i].name;
    descriptionWrapper.appendChild(descriptionTitle);
    const description = document.createElement("p");
    description.textContent = interestedPoints[i].description;
    descriptionWrapper.appendChild(description);

    if (i%2 === 0) {
      div.appendChild(image);
      div.appendChild(descriptionWrapper);
    } else {
      div.appendChild(descriptionWrapper);
      div.appendChild(image);
    }

    descriptionContainer.appendChild(div);

    // console.log(div);
  }
}

// Code Principale

displayDescriptions();

window.onload = function(){
  // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
  initMap();
};
