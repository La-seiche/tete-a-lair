<?php

class RoomModel {

  public function getAllRoomPresentation() {
    $database = new Database();
    $sql = "SELECT RoomId, RoomName, LowSeasonPriceDay, NumberOfPersonn, Description, PlusBed, PlusPersonn, PhotoMiniature, Bed, SeperateWC, RelaxSpace, WithBabyBed, WithCouch, Office FROM rooms";
    $rooms = $database->query($sql, []);
    return $rooms;
  }

  public function getOneRoomFullPresentation($_get) {
    $database = new Database();
    $sql = "SELECT RoomName, LowSeasonPriceDay, NumberOfPersonn, Description, PlusBed, PlusPersonn, Bed, SeperateWC, RelaxSpace, WithBabyBed, WithCouch, Office, Photo1, Photo2, Photo3, Photo4, Photo5, Photo6, Photo7, Photo8, Photo9, Photo10 FROM rooms WHERE RoomId = ?";
    $array = [$_get["RoomId"]];
    $room = $database->queryOne($sql, $array);
    return $room;
  }

  public function getOneRoomPresentation($_get) {
    $database = new Database();
    $sql = "SELECT RoomName, LowSeasonPriceDay, LowSeasonPriceWeek, MiddleSeasonPriceDay, MiddleSeasonPriceWeek, HighSeasonPriceDay, HighSeasonPriceWeek, NumberOfPersonn, Description, PlusBed, PlusPersonn, Bed, SeperateWC, RelaxSpace, WithBabyBed, WithCouch, Office, PhotoMiniature FROM rooms WHERE RoomId = ?";
    $array = [$_get["RoomId"]];
    $room = $database->queryOne($sql, $array);
    return $room;
  }

}

?>
