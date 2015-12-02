<?php

include_once('./include/affichage.php');
require_once('./include/decoupage.php');
require_once('./include/commandes.php');
require_once('./include/help.php');

echo "\033c";
$pr = fopen('php://stdin', 'r');
if ($pr != false){
  echo "\nBienvenue " . $env['USER'] . " sur le Microshell, tapez help pour acceder à la liste des commandes\n\n";
  aff_prompt();
  while (($line = fgets($pr)) != false){
    $params = decoup_params($line);
    $ptr = 'f_' . $params[0];
    if ($params[0] == "exit")
    	return;
    if (function_exists($ptr)){
      $ptr($params);
    }
    else
      echo "Microshell : $params[0] => commande invalide\n";
    aff_prompt();
  }
  fclose($pr);
}