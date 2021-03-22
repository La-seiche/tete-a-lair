<?php

class RoomModel {

  public function getAllRoomPresentation()
  {
    $database = new Database();
    $sql = "SELECT RoomId, RoomType, RoomName, LowSeasonPriceDay, NumberOfPersonn, PhotoMiniature FROM rooms";
    $rooms = $database->query($sql, []);
    return $rooms;
  }

  public function getOneRoomFullPresentation($_get)
  {
    $database = new Database();
    $sql = "SELECT RoomName, RoomType, LowSeasonPriceDay, NumberOfPersonn, Description, PlusBed, PlusPersonn, Bed, SeperateWC, RelaxSpace, WithBabyBed, WithCouch, Office, Photo1, Photo2, Photo3, Photo4, Photo5, Photo6, Photo7, Photo8, Photo9, Photo10 FROM rooms WHERE RoomId = :room_id";
    $array = ["room_id" => $_get["RoomId"]];
    $room = $database->queryOne($sql, $array);
    return $room;
  }

  public function getOneRoomPresentation($_get)
  {
    $database = new Database();
    $sql = "SELECT RoomName, LowSeasonPriceDay, NumberOfPersonn, Description, PlusBed, PlusPersonn, Bed, SeperateWC, RelaxSpace, WithBabyBed, WithCouch, Office, PhotoMiniature FROM rooms WHERE RoomId = :room_id";
    $array = ["room_id" => $_get["RoomId"]];
    $room = $database->queryOne($sql, $array);
    return $room;
  }

  public function getOneRoomInformations($roomId)
  {
    $database = new Database();
    $sql = "SELECT RoomId, RoomName, NumberOfPersonn, Description, PlusBed, PlusPersonn, Bed, SeperateWC, RelaxSpace, WithBabyBed, WithCouch, Office, PhotoMiniature FROM rooms WHERE RoomId = :room_id";
    $array = ["room_id" => $roomId];
    $room = $database->queryOne($sql, $array);
    return $room;
  }

  public function getOneRoomPictures($roomId)
  {
    $database = new Database();
    $sql = "SELECT Photo1, Photo2, Photo3, Photo4, Photo5, Photo6, Photo7, Photo8, Photo9, Photo10 FROM rooms WHERE RoomId = :room_id";
    $array = ["room_id" => $roomId];
    $pictures = $database->queryOne($sql, $array);
    return $pictures;
  }

  public function getAllRoomIds()
  {
    $database = new Database();
    $sql = "SELECT RoomId FROM rooms";
    $roomIdList = $database->query($sql, []);
    return $roomIdList;
  }

}

?>
