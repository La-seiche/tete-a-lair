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

      $pictures = $roomModel->getOneRoomPictures($_POST["roomId"]);
      // var_dump($pictures);

      $dateArrival = $_POST["dateArrival"];
      $dateDeparture = $_POST["dateDeparture"];
      // var_dump($dateArrival);
      // var_dump($dateDeparture);

      $reservation = $reservationModel->checkRoomAvailability($dateArrival, $dateDeparture, $_POST["roomId"]);
      // var_dump($reservation);

      if (empty($reservation)) {
        // var_dump("Chambre dispo");
        $calendars = $reservationModel->getRoomCalendars($dateArrival, $dateDeparture, $_POST["roomId"]);
        // var_dump($calendars);
        $bookingDetails = $reservationModel->getBookingDetails($dateArrival, $dateDeparture, $_POST["roomId"], $calendars);
        // var_dump($bookingDetails);
      }
      else {
        $error = "Désolé cette chambre n'est pas disponible à cette période !";
        // var_dump($error);
      }

      $roomsAvailable = $reservationModel->filterRooms($_POST);
      // var_dump($roomsAvailable);

      $roomsAvailableBookingDetails = [];

      foreach ($roomsAvailable as $roomAvailable) {
        $reservation = $reservationModel->checkRoomAvailability($dateArrival, $dateDeparture, $roomAvailable);
        if (empty($reservation)) {
          // var_dump("chambre dispo : " . $roomAvailable);
          $roomAvailableCalendars = $reservationModel->getRoomCalendars($dateArrival, $dateDeparture, $roomAvailable);
          // var_dump($roomAvailableCalendars);
          $roomAvailableBookingDetails = $reservationModel->getBookingDetails($dateArrival, $dateDeparture, $roomAvailable, $roomAvailableCalendars);
          // var_dump($roomAvailableBookingDetails);
          $roomAvailableDetails = $roomModel->getOneRoomInformations($roomAvailable);
          array_push($roomsAvailableBookingDetails, $roomAvailableBookingDetails);
        }
        }

        // var_dump($roomsAvailableBookingDetails);

        return ["pictures" => $pictures, "dateArrival" => $dateArrival, "dateDeparture" => $dateDeparture, "bookingDetails" => $bookingDetails, "roomsAvailableBookingDetails" => $roomsAvailableBookingDetails];
      }

// TODO: calculer prix pour chambres dispo et affichage chambre dispo
}
 ?>
