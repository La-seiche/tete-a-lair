<?php

class ReservationModel {

  public function getDateFromEpoch($date) {
    $dateTab = explode("-", $date);
    $result = mktime(0, 0, 0, $dateTab[1], $dateTab[2], $dateTab[0]);
    // var_dump($result);
    return $result;
  }

  public function getBookingDuration($arrivalDate, $departureDate) {
    // $daysByWeeks = 7;
    $difference = $departureDate - $arrivalDate;
    // $duration["days"] = ($difference / 86400) % $daysByWeeks;
    // $duration["weeks"] = floor(($difference / 86400) / $daysByWeeks);
    $duration = floor($difference / 86400);
    // var_dump($duration);
    return $duration;
  }

  public function checkRoomAvailability($dateBeginning, $dateEnd, $roomId) {
    $database = new Database();
    $sql = "SELECT RoomId FROM `bookings` WHERE NOT ((ArrivalDate > ? AND ArrivalDate >= ?) OR (DepartureDate <= ? AND DepartureDate < ?)) AND RoomId =?";
    $array = [$dateBeginning, $dateEnd, $dateBeginning, $dateEnd, $roomId];
    $reservation = $database->query($sql, $array);
    return $reservation;
  }

  public function getRoomCalendars($dateBeginning, $dateEnd, $roomId) {
    $dateBeginning = $dateBeginning . " 13:00:00";
    $dateEnd = $dateEnd . " 12:00:00";
    $database = new Database();
    $sql ="SELECT StartDate, EndDate, DailyPrice FROM calendars WHERE RoomId = ? AND ((StartDate <= ? AND EndDate <=?) OR (StartDate < ? AND EndDate >= ?))";
    $array = [$roomId, $dateBeginning, $dateEnd, $dateEnd, $dateBeginning];
    $calendars = $database->query($sql, $array);
    return $calendars;
  }

  public function getBookingDetails($dateBeginning, $dateEnd, $roomId, $calendars) {
    $dateFirstDay = $this->getDateFromEpoch($dateBeginning);
    $dateLastDay = $this->getDateFromEpoch($dateEnd);
    $duration = $this->getBookingDuration($dateFirstDay, $dateLastDay);
    // var_dump($duration);
    $date = new DateTime($dateBeginning);
    $date->modify("+13 hours");
    $totalHT = 0;

    for ($i = 0; $i < $duration; $i++) {
      foreach ($calendars as $calendar) {
        if (($date >= $calendar["StartDate"]) && ($date < $calendar["EndDate"])) {
          $totalHT += $calendar["DailyPrice"];
          $date->modify("+1 day");
        }
      }
    }
    // var_dump($date);
    // var_dump($totalHT);
  }

  public function bookARoom($dateBeginning, $dateEnd, $roomId) {
    $seasonModel = new SeasonModel();
    $roomModel = new RoomModel();

    $dateFirstDay = $this->getDateFromEpoch($dateBeginning);
    $dateLastDay = $this->getDateFromEpoch($dateEnd);
    $duration = $this->getReservationDuration($dateFirstDay, $dateLastDay);
    var_dump($duration);
    // $season = $seasonModel->getSeason($dateBeginning, $dateEnd);
    // var_dump($season);
    // $seasonPrice = $roomModel->getSeasonPrice($season, $roomId);
    // var_dump($seasonPrice);
    // $reservationPrice = $this->getReservationPrice($duration, $season, $seasonPrice);
    // var_dump($reservationPrice);

    // $TVA = 20;
    // $montantTVA = $reservationPrice * $TVA / 100;
    // $totalTTC = $reservationPrice + $montantTVA;
    //
    // $reservationDetails = [$duration,$reservationPrice, $TVA, $montantTVA, $totalTTC, $roomId];
    // return $reservationDetails;
  }


  public function filterRooms($_post) {
    $roomsTab = [1, 2, 3, 4];
    $roomSearched = $_post["roomId"] - 1;
    array_splice($roomsTab, $roomSearched, 1);
    // var_dump($roomsTab);
    return $roomsTab;
  }

  // public function registerNewReservation($_post) {
  //   $database = new Database();
  //   $sql = "INSERT INTO reservations (ReservationTimestamp, RoomId, ArrivalDate, DepartureDate, NumberOfNights, PriceByNight, TaxAmount, TotalAmount) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?)";
  //   $array = [$_post["roomId"], $_post["dateArrival"], $_post["dateDeparture"], $_post["numberOfNights"], $_post["priceADay"], $_post["taxAmount"], $_post["totalTTC"]];
  //   $database->executeSql($sql, $array);
  // }

}

 ?>
