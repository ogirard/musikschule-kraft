<?php

define('LOGGED_IN', '__logged_in__');
define('LOGGED_IN_USER', '__logged_in_user__');
define('ADMIN_USER', 'admin');
define('ADMIN_PASSWORD', 'ip2562');

function login($username, $password)
{
  if (is_logged_in()) {
    return true;
  }

  if ($username == ADMIN_USER && $password == ADMIN_PASSWORD) {
    $_SESSION[LOGGED_IN] = true;
    $_SESSION[LOGGED_IN_USER] = ADMIN_USER;
    return true;
  }

  return false;
}

function logout()
{
  session_destroy();
  $_SESSION = [];
}

function is_logged_in()
{
  return isset($_SESSION[LOGGED_IN]) && $_SESSION[LOGGED_IN];
}

function get_logged_in_user()
{
  return isset($_SESSION[LOGGED_IN_USER]) ? $_SESSION[LOGGED_IN_USER] : '';
}


