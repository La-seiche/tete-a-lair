<?php

class ReservationModel {

  public function goToEnglishFormat($dateFR) {
    $dateTab = explode("/", $dateFR);
    $date = $dateTab[2]."-".$dateTab[1]."-".$dateTab[0];
    // var_dump($date);
    return $date;
  }

  public function getDateFromEpoch($date) {
    $dateTab = explode("-", $date);
    $result = mktime(0, 0, 0, $dateTab[1], $dateTab[2], $dateTab[0]);
    // var_dump($result);
    return $result;
  }

  public function getReservationDuration($arrivalDate, $departureDate) {
    $daysByWeeks = 7;
    $difference = $departureDate - $arrivalDate;
    $duration["days"] = ($difference / 86400) % $daysByWeeks;
    $duration["weeks"] = floor(($difference / 86400) / $daysByWeeks);
    // var_dump($duration);
    return $duration;
  }

  public function checkRoomAvailability($dateBeginning, $dateEnd, $roomId) {
    $database = new Database();
    $sql = "SELECT RoomId FROM `reservations` WHERE NOT ((ArrivalDate > ? AND ArrivalDate >= ?) OR (DepartureDate <= ? AND DepartureDate < ?)) AND RoomId =?";
    $array = [$dateBeginning, $dateEnd, $dateBeginning, $dateEnd, $roomId];
    $reservation = $database->query($sql, $array);
    return $reservation;
  }

  public function getReservationPrice($duration, $season, $seasonPrice) {
    $daysPrice = $duration["days"] * $seasonPrice[$season."SeasonPriceDay"];
    $weeksPrice = $duration["weeks"] * $seasonPrice[$season."SeasonPriceWeek"];
    $total = $daysPrice + $weeksPrice;
    return $total;
  }

  public function bookARoom($dateBeginning, $dateEnd, $roomId) {
    $seasonModel = new SeasonModel();
    $roomModel = new RoomModel();

    $dateFirstDay = $this->getDateFromEpoch($dateBeginning);
    $dateLastDay = $this->getDateFromEpoch($dateEnd);
    $duration = $this->getReservationDuration($dateFirstDay, $dateLastDay);
    // var_dump($duration);
    $season = $seasonModel->getSeason($dateBeginning, $dateEnd);
    // var_dump($season);
    $seasonPrice = $roomModel->getSeasonPrice($season, $roomId);
    // var_dump($seasonPrice);
    $reservationPrice = $this->getReservationPrice($duration, $season, $seasonPrice);
    // var_dump($reservationPrice);

    $TVA = 20;
    $montantTVA = $reservationPrice * $TVA / 100;
    $totalTTC = $reservationPrice + $montantTVA;

    $reservationDetails = [$duration,$reservationPrice, $TVA, $montantTVA, $totalTTC, $roomId];
    return $reservationDetails;
  }


  public function filterRooms($_post) {
    $roomsTab = [1, 2, 3, 4];
    $roomSearched = $_post["roomId"] - 1;
    array_splice($roomsTab, $roomSearched, 1);
    // var_dump($roomsTab);
    return $roomsTab;
  }

}

 ?>
