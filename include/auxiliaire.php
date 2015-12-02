<?php

$env = $_SERVER;
$pwd = $env['PWD'];
$old = $env['PWD'];



function aux_ls($var){
  $i = 0;
  $ligne = "";
  if (file_exists($var) != false){
    $tab = (scandir($var));
    while (isset($tab[$i])){
      if ($tab[$i] == '.' || $tab[$i] == "..")
	$tab[$i] = NULL;
      elseif ($tab[$i][0] == '.')
	$tab[$i] = NULL;
      if (is_link($tab[$i]) && $tab[$i] != NULL)
	$ligne = $ligne . $tab[$i]."@\n";
      else if (is_dir($tab[$i]) && $tab[$i] != NULL)
	$ligne = $ligne . $tab[$i]."/\n";
      else if (is_executable($tab[$i]) && $tab[$i] != NULL)
	$ligne = $ligne . $tab[$i]."*\n";
      elseif ($tab[$i] != NULL)
	$ligne = $ligne . $tab[$i] . "\n";
      $i++;
    }
  }
  return ($ligne);
}





function aux_cat($params){
  if (is_dir($params))
    echo "cat - erreur: " . $params . " => " .  "est un dossier\n";
  else if (!file_exists($params))
    echo "cat - erreur: " . $params . " => " .  "fichier ou dossier introuvable\n";
  else if (!is_readable($params))
    echo "cat - erreur: " . $params . " => " .  "permission refusée\n";
  else{
    $r = fopen($params, 'r');
    echo fread($r, filesize($params)) . "\n";
    fclose($r);
    clearstatcache($clear_realpath_cache = True);
  }
}





function aux_red($str1, $symbol, $filename){
  $str1 = $str1 . " ";
  if (is_dir($filename))
    {
      echo "redirection: " . $filename . ": " .  "Is a directory\n";
      return (FALSE);
    }
  else if (file_exists($filename))
    {
      if (!is_writable($filename))
	{
	  echo "redirection: " . $filename . ": " .  "Permission denied\n";
	  return (FALSE);
	}
    }
  if ($symbol == ">" && isset($str1) && isset($filename))
    {
      if($file = fopen($filename, "w"))
	{
	  if (!is_writable($filename))
	    echo "redirection: " . $filename . ": " .  "Permission denied\n";
	  else
	    {
	      fwrite($file, $str1);
	      clearstatcache($clear_realpath_cache = True);
	      fclose($file);
	    }
	}
      else
	echo "redirection: " . $filename . ": " .  "Cannot open file\n";
    }
  else if ($symbol == ">>" && isset($str1) && isset($filename))
    {
      $file = fopen($filename, "a");
      if($file != False)
	{
	  if (!is_writable($filename))
	    echo "redirection: " . $filename . ": " .  "Permission denied\n";
	  else
	    {
	      fwrite($file, $str1);
	      clearstatcache($clear_realpath_cache = True);
	      fclose($file);
	    }
	}                
      else
	echo "redirection: " . $filename . ": " .  "Cannot open file\n";
    }
  else
    echo "Usage : 'string' '[> >>]' 'File' \n";
}





function aux_red2($str1, $symbol, $filename){
  $str1 = "\n" . $str1;
  if (is_dir($filename))
    {
      echo "redirection: " . $filename . ": " .  "Is a directory\n";
      return (FALSE);
    }
  else if (file_exists($filename))
    {
      if (!is_writable($filename))
	{
	  echo "redirection: " . $filename . ": " .  "Permission denied\n";
	  return (FALSE);
	}
    }
  if ($symbol == ">" && isset($str1) && isset($filename))
    {
      if($file = fopen($filename, "w"))
	{
	  if (!is_writable($filename))
	    echo "redirection: " . $filename . ": " .  "Permission denied\n";
	  else
	    {
	      fwrite($file, $str1);
	      clearstatcache($clear_realpath_cache = True);
	      fclose($file);
	    }
	}
      else
	echo "redirection: " . $filename . ": " .  "Cannot open file\n";
    }
  else if ($symbol == ">>" && isset($str1) && isset($filename))
    {
      $file = fopen($filename, "a");
      if($file != False)
	{
	  if (!is_writable($filename))
	    echo "redirection: " . $filename . ": " .  "Permission denied\n";
	  else
	    {
	      fwrite($file, $str1);
	      clearstatcache($clear_realpath_cache = True);
	      fclose($file);
	    }
	}                
      else
	echo "redirection: " . $filename . ": " .  "Cannot open file\n";
    }
  else
    echo "Usage : 'string' '[> >>]' 'File' \n";
}