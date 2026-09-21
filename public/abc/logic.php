<?php
function isLogin()
{
  if (empty($_SESSION['isLogin'])) {
    echo 'Need to login';
  } else {
    echo 'Login';
  }
}
function logout()
{
  session_destroy();
  header('Location: ' . './index.php');
}
