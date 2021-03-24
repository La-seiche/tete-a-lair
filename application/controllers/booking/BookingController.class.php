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
      $pictures = $roomModel->getOneRoomPictures($_POST["roomId"]);
      // var_dump($pictures);

      $dateArrival = $_POST["dateArrival"];
      $dateDeparture = $_POST["dateDeparture"];
      // var_dump($dateArrival);
      // var_dump($dateDeparture);
      $dateArrival_Fr = date("d-m-y", strtotime($dateArrival));
      // var_dump($dateArrival_Fr);
      $dateDeparture_Fr = date("d-m-y", strtotime($dateDeparture));

      $reservation = $reservationModel->checkRoomAvailability($dateArrival, $dateDeparture, $_POST["roomId"]);
      // var_dump($reservation);

      if (empty($reservation)) {
        // var_dump("Chambre dispo");
        $available = true;
        $calendars = $reservationModel->getRoomCalendars($dateArrival, $dateDeparture, $_POST["roomId"]);
        // var_dump($calendars);
        $bookingDetails = $reservationModel->getBookingDetails($dateArrival, $dateDeparture, $_POST["roomId"], $calendars);
        // var_dump($bookingDetails);
      }
      else {
        // $error = "Désolé cette chambre n'est pas disponible à cette période !";
        // var_dump($error);
        $available = false;
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

        if ($available)
        {
          return ["room" => $room, "pictures" => $pictures, "dateArrival" => $dateArrival_Fr, "dateDeparture" => $dateDeparture_Fr, "bookingDetails" => $bookingDetails, "roomsAvailableBookingDetails" => $roomsAvailableBookingDetails, "available" => $available];
        }
        else
        {
          return ["room" => $room, "dateArrival" => $dateArrival_Fr, "dateDeparture" => $dateDeparture_Fr, "roomsAvailableBookingDetails" => $roomsAvailableBookingDetails, "available" => $available];
        }
      }

}
 ?>
