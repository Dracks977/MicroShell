<?php

function decoup_params($line){
  preg_match_all('/[0-9a-zA-z,?$!.:>\-<\/;\']{1,}/i', $line, $parsed);
  return ($parsed[0]);
}