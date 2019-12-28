<?php

class UserModel {

  public function registerNewCustomer($_post) {
    $database = new Database();
    $http = new HTTP();

    $email = $database->queryOne("SELECT Email FROM customers WHERE Email = ?", [$_post["email"]]);

    $hashPassword = $this->hashPassword($_post["password"]);

    if ($email != false) {
      $error = "Désolé! Il y a déjà un compte à cette adresse mail !";
    }
    else {
      $database->executeSql("INSERT INTO customers (FirstName, LastName, Email, Password, Address, City, Zip, Country, PhoneNumber, Role) VALUES(?, ?, ?, ?, ?, ?, ?,?, ?, 'user')", [
        $_post["firstName"],
        $_post["lastName"],
        $_post["email"],
        $hashPassword,
        $_post["address"],
        $_post["city"],
        $_post["zip"],
        $_post["country"],
        $_post["phoneNumber"]
      ]);
      $http->redirectTo("/");
      exit();
    }
    return $error;
  }

  private function hashPassword($password)
  {

    $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);
    return crypt($password, $salt);
  }

  public function login($_post) {
    $database = new Database();
    $http = new HTTP();

    $user = $database->queryOne("SELECT * FROM customers WHERE Email = ?", [$_post["email"]]);
    // var_dump($user);

    if ($user === false) {
      $error = "Pas de compte à cette adresse mail !";
    }
    else {
      if ($this->verifyPassword($_post["password"], $user["Password"])) {
        $_SESSION['user']['email'] = $user['Email'];
        $_SESSION['user']['firstName'] = $user['FirstName'];
        $_SESSION['user']['lastName'] = $user['LastName'];
        $_SESSION['user']['address'] = $user['Address'];
        $_SESSION['user']['zip'] = $user['Zip'];
        $_SESSION['user']['city'] = $user['City'];
        $_SESSION['user']['country'] = $user['Country'];
        $_SESSION['user']['phoneNumber'] = $user['PhoneNumber'];
        $_SESSION['user']['role'] = $user['Role'];
        $_SESSION['user']['id'] = $user['CustomerId'];
        $http->redirectTo("/");
        exit();
      }
      else {
        $error = "Mauvais mot de passe !";
      }
    }
    return $error;
  }

private function verifyPassword($password, $hashedPassword)
  {
    return crypt($password, $hashedPassword) == $hashedPassword;
  }

public function updateCustomer($_post, $_session) {
  $database = new Database();
  // $http = new HTTP();

  $database->executeSql("UPDATE customers SET FirstName = ?, LastName = ?, Address = ?, Zip = ?, City = ?, Country = ?, Email = ?, PhoneNumber = ? WHERE CustomerId = ?", [
    $_post["firstName"],
    $_post["lastName"],
    $_post["address"],
    $_post["zip"],
    $_post["city"],
    $_post["country"],
    $_post["email"],
    $_post["phoneNumber"],
    $_session["user"]["id"]
  ]);
  $_SESSION['user']['firstName'] = $_post["firstName"];
  $_SESSION['user']['lastName'] = $_post["lastName"];
  $_SESSION['user']['address'] = $_post["address"];
  $_SESSION['user']['zip'] = $_post["zip"];
  $_SESSION['user']['city'] = $_post["city"];
  $_SESSION['user']['country'] = $_post["country"];
  $_SESSION['user']['email'] = $_post["email"];
  $_SESSION['user']['phoneNumber'] = $_post["phoneNumber"];
}

}

?>
