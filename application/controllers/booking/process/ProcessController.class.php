<?php

class ProcessController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {



    }

    public function httpPostMethod(Http $http, array $formFields)
    {

      var_dump($_POST);

      $roomId = strip_tags($_POST["room-id"]);
      $roomName = strip_tags($_POST["room-name"]);
      $arrival = strip_tags($_POST["arrival"]);
      $departure = strip_tags($_POST["departure"]);
      $duration = strip_tags($_POST["duration"]);
      $price = strip_tags($_POST["price"]);
      $name = strip_tags($_POST["name"]);
      $surname = strip_tags($_POST["surname"]);
      $email = strip_tags($_POST["email"]);
      $phoneNumber = strip_tags($_POST["phoneNumber"]);

      $validPhoneRegex = "/^(?:\+[0-9]{1,3}|0)[0-9 ]+$/";

      $http = new Http();

      // Validation formulaire

      if (
        !empty($roomId)
        && !empty($roomName)
        && !empty($arrival)
        && !empty($departure)
        && !empty($duration)
        // && !empty($price)
        && !empty($name)
        && !empty($surname)
        && !empty($email)
        && !empty($phoneNumber)
        && (strlen($name) >= 2)
        && (strlen($surname) >= 2)
        && (filter_var($email, FILTER_VALIDATE_EMAIL))
        && (preg_match($validPhoneRegex, $phoneNumber))
        )
      {
        // var_dump("complet");
        $reservationModel = new ReservationModel();
        $bookingForm = $reservationModel->registerNewBooking($roomId, $roomName, $arrival, $departure, $duration, $price, $name, $surname, $email, $phoneNumber);
        $url = "booking/success";
        $redirect = $http -> redirectTo($url);
      } else {
        // var_dump("pas complet");
        $url = "booking/fail";
        $redirect = $http -> redirectTo($url);
      }

      // TODO: connection à mailjet
      // TODO: envoyer email
      // TODO: redirection vers page de succès

    }
}

 ?>
