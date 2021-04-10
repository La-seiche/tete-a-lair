<?php

class ProcessController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {



    }

    public function httpPostMethod(Http $http, array $formFields)
    {

      // var_dump($_POST);

      $name = strip_tags($_POST["name"]);
      $surname = strip_tags($_POST["surname"]);
      $email = strip_tags($_POST["email"]);
      $phoneNumber = strip_tags($_POST["phoneNumber"]);
      $topic = strip_tags($_POST["topic"]);
      $message = strip_tags($_POST["message"]);

      $validPhoneRegex = "/^(?:\+[0-9]{1,3}|0)[0-9 ]+$/";

      $http = new Http();

      // Validation formulaire

      if (
        !empty($name)
        && !empty($surname)
        && !empty($email)
        && !empty($phoneNumber)
        && !empty($topic)
        && !empty($message)
        && (strlen($name) >= 2)
        && (strlen($surname) >= 2)
        && (strlen($topic) >= 2)
        && (strlen($message) >= 2)
        && (filter_var($email, FILTER_VALIDATE_EMAIL))
        && (preg_match($validPhoneRegex, $phoneNumber))
        )
      {
        // var_dump("complet");
        $userModel = new UserModel();
        $contactForm = $userModel->saveContactForm($name, $surname, $email, $phoneNumber, $topic, $message);
        $url = "contacts/success";
        $redirect = $http -> redirectTo($url);
      } else {
        // var_dump("pas complet");
        $url = "contacts/fail";
        $redirect = $http -> redirectTo($url);
      }

      // TODO: connecter à mailjet
      // TODO: envoyer emails
      // TODO: redirection

    }
}

 ?>
