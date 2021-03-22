<?php

class RoomController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

      $roomModel = new RoomModel();
      $room = $roomModel->getOneRoomFullPresentation($_GET);
      // var_dump($room);
      return ["room"=>$room];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {


    }
}

 ?>
