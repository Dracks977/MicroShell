<?php

function aff_prompt(){
  global $env;
  date_default_timezone_set('Europe/Paris');
  $date = date("d-m-Y");
  $heure = date("H:i");
  if (isset($env['USER']))
    echo $date . " ~ " . $heure . " ~ " . $env['USER'] . " $>";
  else
    echo $date . " ~ " . $heure . " ~ " . "inconnu_i" . " $>";
}