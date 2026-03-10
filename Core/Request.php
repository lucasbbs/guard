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

  public function file($key = null, $default = null)
  {
    if ($key === null) {
      return $_FILES;
    }
    if (! isset($_FILES[$key]) || ! is_array($_FILES[$key])) {
      return $default;
    }

    $file = $_FILES[$key];
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
      return $default;
    }

    return $file;
  }
}
