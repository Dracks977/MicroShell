<?php

require_once('./include/auxiliaire.php');

function f_echo($params){
  $i = 1;
  global $env;
  if (isset($params[2]) && isset($params[1]) && isset($params[3]) 
      && ($params[2] == '>' || $params[2] == '>>')){
    if ($params[2] == '>>'){
      aux_red($params[1], '>>', $params[3]);
      $i++;
    }
    else if ($params[2] == '>'){
      aux_red($params[1], '>', $params[3]);
      $i++;
    }
  }
  else{
    while (isset($params[$i])){
      if ($params[$i][0] == '$'){
	$sub = substr($params[$i], 1);
	if (isset($env[$sub])){
	  echo $env[$sub] . " ";
	}
	else
	  echo $params[$i] . " ";
	$i++;
      }
      else{
	echo $params[$i] . " ";
	$i++;
      }
    }
  }
  echo "\n";
}




function f_pwd($params = NULL){
  global $pwd;
  echo ($pwd . "\n");
}

function f_cat($params){
  $i = 1;
  if (isset($params[1])){
    while (isset($params[$i])){
      aux_cat($params[$i]);
      $i++;
    }
  }
  else
    echo "argument invalide : Usage => cat [chemin du fichier à ouvrir] [...]\n";
}




// function f_exit($params = NULL){
//   return;
// }



function	f_ls($params){
  global $pwd;
  $i = 0;
  if (isset($params[1])){
    if (is_dir($params[1])){
      $var = $params[1];
    }
    else if (!file_exists($params[1])){
      echo "ls - erreur: " . $params[1] . " => " .  " n'existe pas\n";
      return(False);
    }
    else{
      echo "ls - erreur: " . $params[1] . " => " .  " n'est pas un dossier\n";
      return(False);
    }
  }
  else
    $var = $pwd;
  if (isset($params[2]) && isset($params[3])){
    if ($params[2] == '>>'){
      aux_red2(aux_ls($var), '>>', $params[3]);
      $i++;
    }
    else if ($params[2] == '>'){
      aux_red2(aux_ls($var), '>', $params[3]);
      $i++;
    }
  }
  else{
    echo $var . "\n";
    if (file_exists($var) != false){
      $tab = (scandir($var));
      while (isset($tab[$i])){
	if ($tab[$i] == '.' || $tab[$i] == "..")
	  $tab[$i] = NULL;
	elseif ($tab[$i][0] == '.')
	  $tab[$i] = NULL;
	if (is_link($tab[$i]) && $tab[$i] != NULL)
	  echo $tab[$i]."@\n";
	else if (is_dir($tab[$i]) && $tab[$i] != NULL)
	  echo $tab[$i]."/\n";
	else if (is_executable($tab[$i]) && $tab[$i] != NULL)
	  echo $tab[$i]."*\n";
	elseif ($tab[$i] != NULL)
	  echo $tab[$i]."\n";
	$i++;
      }
    }
  }
}




function f_env($params){
  $i = 0;
  global $env;
  $lol = array_keys($env);
  while (isset($lol[$i])){
    if (isset($env[$lol[$i]][0])){
      if($env[$lol[$i]][0] == "MicroShell.php")
	echo $lol[$i] . " = " . $env[$lol[$i]][0] . "\n";
      else
	echo $lol[$i] . " = " . $env[$lol[$i]] . "\n";
    }
    else
      echo $lol[$i] . " = " . $env[$lol[$i]] . "\n";
    $i++;
  }
}




function f_cd($params){
  global $pwd;
  global $old;
  global $env;
  if (!isset($params[1])){
    $old = $pwd;
    $pwd = $env['HOME'];
    chdir($pwd);
  }
  else{
    if(is_dir($params[1]) || $params[1] == '..' || $params[1] == "-" ||
       $params[1] == '.' || $params[1] == "../.."){
      if ($params[1] == '..'){
	$tmp = preg_replace('/[\/][a-zA-Z0-9_.$#%&!@\-]+$/', "", $pwd);
	$old = $pwd;
	$pwd = $tmp;
	chdir($pwd);
      }
      else if ($params[1] == "-"){
	chdir($old);
	$tmp2 = $pwd;
	$pwd = $old;
	$old = $tmp2;
      }
      else if ($params[1] == "../.."){
	$tmp = preg_replace('/[\/][a-zA-Z0-9_.$#%&!@\-]+$/', "", $pwd);
	$tmptmp = preg_replace('/[\/][a-zA-Z0-9_.$#%&!@\-]+$/', "", $tmp);
	$old = $pwd;
	$pwd = $tmptmp;
	chdir($pwd);
      }
      else if ($params[1] == '.'){
      }
      else{
	chdir($params[1]);
	$old = $pwd;
	$pwd = $pwd . "/$params[1]";
      }
    }
    else
      echo "cd - erreur: " . $params[1] . " => " .  "n'est pas un dossier, ou est inexistant\n";
  }
}




function f_setenv($params){
  global $env;
  if ($params[1] != "" && $params[2] != ""){
    $env[$params[1]] = $params[2];
  }
  else
    echo "setenv - erreur: arguments invalides\n";
}




function f_unsetenv($params){
  global $env;
  $i = 1;
  while (isset($params[$i])){
    if (isset($env[$params[$i]])){
      unset($env[$params[$i]]);
      echo "$params[$i] correctement suprimée\n";
    }
    else
      echo "unsetenv - erreur: arguments $params[$i] invalides\n";
    $i++;
  }
}



function f_clear($params){
  echo "\033c";
}