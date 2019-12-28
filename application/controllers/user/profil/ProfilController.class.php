<?php

class ProfilController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {


    }

    public function httpPostMethod(Http $http, array $formFields)
    {

      // var_dump($_POST);
      // var_dump($_SESSION);
      $userModel = new UserModel();
      $userModel->updateCustomer($_POST, $_SESSION);

    }
}

 ?>
