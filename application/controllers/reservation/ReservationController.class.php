<?php

class ReservationController
{
  public function httpGetMethod(Http $http, array $queryFields)
  {



  }

  public function httpPostMethod(Http $http, array $formFields)
  {
    $reservationModel = new ReservationModel();
    $seasonModel = new SeasonModel();
    $roomModel = new RoomModel();

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
      // var_dump("Chambre dispo");
      $dateFirstDay = $reservationModel->getDateFromEpoch($dateBeginning);
      $dateLastDay = $reservationModel->getDateFromEpoch($dateEnd);
      $duration = $reservationModel->getReservationDuration($dateFirstDay, $dateLastDay);
      // var_dump($duration);
      $season = $seasonModel->getSeason($dateBeginning, $dateEnd);
      // var_dump($season);
      $seasonPrice = $roomModel->getSeasonPrice($season, $_POST);
      // var_dump($seasonPrice);
      $reservationPrice = $reservationModel->getReservationPrice($duration, $season, $seasonPrice);
      // var_dump($reservationPrice);

      $TVA = 20;
      $montantTVA = $reservationPrice * $TVA / 100;
      $totalTTC = $reservationPrice + $montantTVA;

      $reservationDetails = [$dateArrival, $dateDeparture, $duration,$reservationPrice, $TVA, $montantTVA, $totalTTC];
      // var_dump($reservationDetails);

    }
    else {
      $error = "Désolé cette chambre n'est pas disponible à cette période !";
      $reservationDetails = null;
      // var_dump($error);
    }
    return ["room"=>$room, "reservationDetails"=>$reservationDetails, "error"=>$error];
  }
}

?>
