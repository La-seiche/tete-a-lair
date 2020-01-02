<?php

class ReservationController
{
  public function httpGetMethod(Http $http, array $queryFields)
  {



  }

  public function httpPostMethod(Http $http, array $formFields)
  {
    $reservationModel = new ReservationModel();
    $roomModel = new RoomModel();
    // $seasonModel = new SeasonModel();
    // $roomModel = new RoomModel();

    $error = null;

    // var_dump($_POST);

    $room = $roomModel->getOneRoomInformations($_POST);
    // var_dump($room);

    $dateArrival = $_POST["datePickerArrival"];
    $dateDeparture = $_POST["datePickerDeparture"];
    // var_dump($dateArrival);
    // var_dump($dateDeparture);
    $dateBeginning = $reservationModel->goToEnglishFormat($dateArrival);
    // var_dump($dateBeginning);
    $dateEnd = $reservationModel->goToEnglishFormat($dateDeparture);
    // var_dump($dateEnd);

    // var_dump($_POST);
    $reservation = $reservationModel->checkRoomAvailability($dateBeginning, $dateEnd, $_POST);
    // var_dump($reservation);

    if (empty($reservation)) {
      // var_dump("Chambre dispo");;

      $reservationDetails = $reservationModel->bookARoom($dateBeginning, $dateEnd);
      array_push($reservationDetails, $dateArrival);
      array_push($reservationDetails, $dateDeparture);
      // var_dump($reservationDetails);
    }
    else {
      $error = "Désolé cette chambre n'est pas disponible à cette période !";
      $reservationDetails = null;
      // var_dump($error);
    }
    return ["room"=>$room, "error"=>$error, "reservationDetails"=>$reservationDetails];
  }
}

?>
