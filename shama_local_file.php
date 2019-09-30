<?php
header("Access-Control-Allow-Origin: *");

if($_GET['filename'])
{
  echo checkfile_exist($filename);
}

function checkfile_exist($filename)
{
    if (file_exists($filename)) {
      return true;
  } 
      return false;
  
}

if($_GET['server_working'])
{
  echo shama_status();
}

function shama_status()
{
  return true;
}

