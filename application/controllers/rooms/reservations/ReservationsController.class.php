<?php

class ReservationsController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

      $roomModel = new RoomModel();
      $room = $roomModel->getOneRoomPresentation($_GET);
      // var_dump($room);
      return ["room"=>$room];

    }

    public function httpPostMethod(Http $http, array $formFields)
    {


    }
}

 ?>
