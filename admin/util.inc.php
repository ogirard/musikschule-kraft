<?php

function try_set_int_input($name, &$field)
{
  $number = filter_input(INPUT_POST, $name, FILTER_SANITIZE_NUMBER_INT);
  if ($number !== false) {
    $field = $number;
  }
}

function try_set_int_array_input($name, &$field, $index)
{
  $number = filter_var($_POST[$name][$index], FILTER_SANITIZE_NUMBER_INT);
  if ($number !== false) {
    $field = $number;
  }
}

function try_set_text_input($name, &$field)
{
  $text = filter_input(INPUT_POST, $name, FILTER_SANITIZE_STRING);
  if ($text !== false) {
    $field = $text;
  }
}

function try_set_text_array_input($name, &$field, $index)
{
  $text = filter_var($_POST[$name][$index], FILTER_SANITIZE_STRING);
  if ($text !== false) {
    $field = $text;
  }
}