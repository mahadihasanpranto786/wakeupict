<?php

if (!isset($_COOKIE['TestCookie'])) {
  echo 'Cookie not set';
}else{
  echo "$_COOKIE[TestCookie]";
}


?>