<?php

class ChargeController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {



    }

    public function httpPostMethod(Http $http, array $formFields)
    {

      var_dump($_POST);
      $reservationModel = new ReservationModel();
      $reservationModel->registerNewReservation($_POST);

    }
}

 ?>
