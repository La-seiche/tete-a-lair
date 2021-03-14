<?php

class BookingController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {



    }

    public function httpPostMethod(Http $http, array $formFields)
    {
      $reservationModel = new ReservationModel();
      $roomModel = new RoomModel();

      // var_dump($_POST);

      $room = $roomModel->getOneRoomInformations($_POST["roomId"]);
      // var_dump($room);

      $dateArrival = $_POST["dateArrival"];
      $dateDeparture = $_POST["dateDeparture"];
      // var_dump($dateArrival);
      // var_dump($dateDeparture);

// TODO: créer bdd bookings (ArrivalDate, DepartureDate, RoomId)
// TODO: lancer checkRoomAvailability pour obtenir tableau d'Id de rooms disponible
// TODO: créer bdd prix des réservations / RoomId et des périodes
// TODO: obtenir les périodes et prix pour la chambre sur la période date d'arrivée, date de départ
// TODO: vérifier chaque date de la réservation et obtenir un prix par jour => calculer total
// TODO: affichage des informations

      $reservationDetails = $reservationModel->getBookingDetails($dateArrival, $dateDeparture, $_POST["roomId"]);
      var_dump($reservationDetails);
    }
}

 ?>
