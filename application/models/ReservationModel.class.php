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

  public function checkRoomAvailability($dateBeginning, $dateEnd, $_post) {
    $database = new Database();
    $sql = "SELECT ReservationNumber FROM reservations WHERE STR_TO_DATE(?,'%Y-%m-%d') BETWEEN ArrivalDate AND DepartureDate OR STR_TO_DATE(?,'%Y-%m-%d') BETWEEN ArrivalDate AND DepartureDate AND RoomId =?";
    $array = [$dateBeginning, $dateEnd, $_post["roomId"]];
    $reservation = $database->query($sql, $array);
    return $reservation;
  }

  public function getReservationPrice($duration, $season, $seasonPrice) {
    $daysPrice = $duration["days"] * $seasonPrice[$season."SeasonPriceDay"];
    $weeksPrice = $duration["weeks"] * $seasonPrice[$season."SeasonPriceWeek"];
    $total = $daysPrice + $weeksPrice;
    return $total;
  }

}

 ?>
