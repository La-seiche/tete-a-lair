<?php

class ReservationModel {

  public function goToEnglishFormat($dateFR) {
    $dateTab = explode("/", $dateFR);
    $date = $dateTab[2]."-".$dateTab[1]."-".$dateTab[0];
    // var_dump($date);
    return $date;
  }

  public function CheckRoomAvailability($dateBeginning, $dateEnd, $_post) {
    $database = new Database();
    $sql = "SELECT ReservationNumber FROM reservations WHERE STR_TO_DATE(?,'%Y-%m-%d') BETWEEN ArrivalDate AND DepartureDate OR STR_TO_DATE(?,'%Y-%m-%d') BETWEEN ArrivalDate AND DepartureDate AND RoomId =?";
    $array = [$dateBeginning, $dateEnd, $_post["roomId"]];
    $reservation = $database->query($sql, $array);
    return $reservation;
  }

}

 ?>
