<?php

class RoomsController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

      $roomModel = new RoomModel();
      $rooms = $roomModel->getAllRoomPresentation();
      // var_dump($rooms);
      return ["rooms" => $rooms];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {


    }
}

 ?>
