<?php

class SeasonModel {

  public function getSeason($beginDate, $endDate) {
    $database = new Database();
    $sql="SELECT Season FROM seasons WHERE STR_TO_DATE(?,'%Y-%m-%d') BETWEEN BeginDate AND EndDate OR STR_TO_DATE(?,'%Y-%m-%d') BETWEEN BeginDate AND EndDate";
    $array = [$beginDate, $endDate];
    $seasons = $database->query($sql, $array);
    // var_dump($seasons);

    foreach ($seasons as $season) {
      if (in_array("Haute", $season)) {
        $result = "High";
        return $result;
      }
      else if (in_array("Moyenne", $season)) {
        $result = "Middle";
        return $result;
      }
      else {
        $result = "Low";
        return $result;
      }
    }
    return $result;
  }

}

 ?>
