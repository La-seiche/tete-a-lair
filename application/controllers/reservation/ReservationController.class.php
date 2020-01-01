<?php

class ReservationController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {



    }

    public function httpPostMethod(Http $http, array $formFields)
    {

      var_dump($_POST);
      $date = new DateTime();
      $dateToday = $date->format('d-m-Y');
      var_dump ($dateToday);
      $dateArrival = $_POST["datePickerArrival"];
      $dateDeparture = $_POST["datePickerDeparture"];
      var_dump($dateArrival);
      var_dump($dateDeparture);
    }
}

 ?>
