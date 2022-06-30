<?php
  function add($num1, $num2){
    return 0;
  }

  function seSolapan($hi1, $he1, $hi2, $he2){
    $hi1_time = strtotime($hi1);
    $he1_time = strtotime($he1);
    $hi2_time = strtotime($hi2);
    $he2_time = strtotime($he2);
    if( !(($he1_time <= $hi2_time) || ($hi1_time >= $he2_time)) ){
      return true;
    }
    return false;
  }

?>