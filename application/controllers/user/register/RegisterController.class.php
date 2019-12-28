<?php

class RegisterController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

      $error = null;
      return ["error"=>$error];

    }

    public function httpPostMethod(Http $http, array $formFields)
    {

      // var_dump($_POST);
      $userModel = new UserModel();
      $error = null;
      $error = $userModel->registerNewClient($_POST);
      return ["error"=>$error];

    }
}

 ?>
