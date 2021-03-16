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

      $reservation = $reservationModel->checkRoomAvailability($dateArrival, $dateDeparture, $_POST["roomId"]);
      // var_dump($reservation);

      if (empty($reservation)) {
        // var_dump("Chambre dispo");
        $calendars = $reservationModel->getRoomCalendars($dateArrival, $dateDeparture, $_POST["roomId"]);
        var_dump($calendars);
        $bookingDetails = $reservationModel->getBookingDetails($dateArrival, $dateDeparture, $_POST["roomId"], $calendars);
      }
      else {
        $error = "Désolé cette chambre n'est pas disponible à cette période !";
        // var_dump($error);
      }

      $roomsAvailable = $reservationModel->filterRooms($_POST);
      // var_dump($roomsAvailable);

      foreach ($roomsAvailable as $roomAvailable) {
        $reservation = $reservationModel->checkRoomAvailability($dateArrival, $dateDeparture, $roomAvailable);
        if (empty($reservation)) {
          // var_dump("chambre dispo : " . $roomAvailable);
        }
        }
      }

// TODO: vérifier chaque date de la réservation et obtenir un prix par jour => calculer total
// TODO: affichage des informations
// TODO: calculer prix pour chambres dispo et affichage chambre dispo
}
 ?>
