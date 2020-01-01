<?php

class ReservationController
{
  public function httpGetMethod(Http $http, array $queryFields)
  {



  }

  public function httpPostMethod(Http $http, array $formFields)
  {
    $reservationModel = new ReservationModel();

    $dateArrival = $_POST["datePickerArrival"];
    $dateDeparture = $_POST["datePickerDeparture"];
    // var_dump($dateArrival);
    // var_dump($dateDeparture);
    $dateBeginning = $reservationModel->goToEnglishFormat($dateArrival);
    var_dump($dateBeginning);
    $dateEnd = $reservationModel->goToEnglishFormat($dateDeparture);
    var_dump($dateEnd);

    // var_dump($_POST);
    $reservation = $reservationModel->CheckRoomAvailability($dateBeginning, $dateEnd, $_POST);
    var_dump($reservation);
  }
}

?>
