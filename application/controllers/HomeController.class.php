<?php

class HomeController
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
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */





    }
}
