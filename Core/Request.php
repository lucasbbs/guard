<?php

namespace Core;

class Request
{
  public function get($key, $default = null, $prefix = null)
  {
    return isset($_GET[$key])
      ? ($prefix ?: null) . $_GET[$key]
      : $default;
  }

  public function post($key = null, $default = null, $prefix = null)
  {
    if ($key === null) {
      return $_POST;
    }
    return isset($_POST[$key])
      ? ($prefix ?: null) . $_POST[$key]
      : $default;
  }
}
