<?php

class ReservationModel {

  public function getBookingDuration($arrivalDate, $departureDate)
  {
    // $daysByWeeks = 7;
    $difference = $departureDate - $arrivalDate;
    // $duration["days"] = ($difference / 86400) % $daysByWeeks;
    // $duration["weeks"] = floor(($difference / 86400) / $daysByWeeks);
    $duration = floor($difference / 86400);
    // var_dump($duration);
    return $duration;
  }

  public function checkRoomAvailability($dateBeginning, $dateEnd, $roomId)
  {
    $database = new Database();
    $sql = "SELECT RoomId FROM `bookings` WHERE NOT ((ArrivalDate > :date_beginning AND ArrivalDate >= :date_end) OR (DepartureDate <= :date_beginning AND DepartureDate < :date_end)) AND RoomId = :room_id";
    $array = ["date_beginning"=> $dateBeginning, "date_end" => $dateEnd, "room_id" => $roomId];
    $reservation = $database->query($sql, $array);
    return $reservation;
  }

  public function getRoomCalendars($dateBeginning, $dateEnd, $roomId)
  {
    $dateBeginning = $dateBeginning . " 13:00:00";
    $dateEnd = $dateEnd . " 12:00:00";
    $database = new Database();
    $sql ="SELECT StartDate, EndDate, DailyPrice FROM calendars WHERE RoomId = :room_id AND ((StartDate <= :date_beginning AND EndDate <= :date_end) OR (StartDate < :date_end AND EndDate >= :date_beginning))";
    $array = ["date_beginning"=> $dateBeginning, "date_end" => $dateEnd, "room_id" => $roomId];
    $calendars = $database->query($sql, $array);
    return $calendars;
  }

  public function getBookingDetails($dateBeginning, $dateEnd, $roomId, $calendars)
  {
    $date = new DateTime($dateBeginning);
    $dateLastDay = new DateTime($dateEnd);
    $duration = $this->getBookingDuration($date->getTimestamp(), $dateLastDay->getTimestamp());
    // var_dump($duration);
    $date->modify("+13 hours");
    $totalHT = 0;

    for ($i = 0; $i < $duration; $i++) {
      foreach ($calendars as $calendar) {
        $dateStart = strtotime($calendar["StartDate"]);
        // var_dump($dateStart);
        $dateEnd = strtotime($calendar["EndDate"]);
        // var_dump($dateEnd);
        if (
          ($date->getTimestamp() >= $dateStart)
          &&
          ($date->getTimestamp() < $dateEnd)
          )
        {
          $totalHT += $calendar["DailyPrice"];
          $date->modify("+1 day");
          break;
        }
      }
    }
    // var_dump($date);
    // var_dump($totalHT);

    $bookingDetails = ["duration" => $duration, "totalHT" => $totalHT];
    return $bookingDetails;
  }

  public function filterRooms($_post)
  {
    $roomsTab = [1, 2, 3, 4];
    $roomSearched = $_post["roomId"] - 1;
    array_splice($roomsTab, $roomSearched, 1);
    // var_dump($roomsTab);
    return $roomsTab;
  }

  // public function registerNewReservation($_post)
  // {
  //   $database = new Database();
  //   $sql = "INSERT INTO reservations (ReservationTimestamp, RoomId, ArrivalDate, DepartureDate, NumberOfNights, PriceByNight, TaxAmount, TotalAmount) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?)";
  //   $array = [$_post["roomId"], $_post["dateArrival"], $_post["dateDeparture"], $_post["numberOfNights"], $_post["priceADay"], $_post["taxAmount"], $_post["totalTTC"]];
  //   $database->executeSql($sql, $array);
  // }

}

 ?>
