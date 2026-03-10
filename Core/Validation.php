<?php

namespace Core;

class Validation
{

  public $validations = [];

  public static function validate($rules, $data)
  {

    $validation = new self;

    foreach ($rules as $field => $fieldRules) {

      foreach ($fieldRules as $rule) {
        $value = $data[$field] ?? '';
        if (str_contains($rule, "length:")) {
          [$min, $max] = explode(":", explode("length:", $rule)[1]);
          $validation->length($min, $max, $field, $value);
        } elseif (str_contains($rule, "matches:")) {
          $matches = explode(":", $rule);
          $rule = $matches[0];
          $validation->$rule($field, $value, $data["{$field}_confirmation"] ?? '');
        } elseif (str_contains($rule, ":")) {
          $matches = explode(":", $rule);
          $rule = $matches[0];
          $rule_param = $matches[1];
          $validation->$rule($rule_param, $field, $value);
        } else {
          $validation->$rule($field, $value);
        }
      }
    }

    return $validation;
  }

  private function image($field, $value)
  {
    if ($value === null || $value === '') {
      return;
    }

    if (is_array($value)) {
      $error = $value['error'] ?? UPLOAD_ERR_NO_FILE;

      if ($error === UPLOAD_ERR_NO_FILE) {
        return;
      }

      if ($error !== UPLOAD_ERR_OK) {
        $this->addError($field, "The $field could not be uploaded.");
        return;
      }

      $value = $value['tmp_name'] ?? '';
      if (! is_string($value) || $value === '' || ! is_uploaded_file($value)) {
        $this->addError($field, "The $field could not be uploaded.");
        return;
      }
    }

    if (! is_string($value) || ! is_file($value)) {
      $this->addError($field, "The $field must be an image.");
      return;
    }

    $mime = mime_content_type($value);
    $allowedMimeTypes = [
      'image/jpeg',
      'image/pjpeg',
      'image/jpg',
      'image/png',
      'image/x-png',
      'image/gif',
      'image/webp',
    ];

    if (! is_string($mime) || ! in_array($mime, $allowedMimeTypes, true)) {
      $this->addError($field, "The $field must be a JPG, PNG, GIF, or WebP image.");
    }
  }

  private function required($field, $value)
  {

    if (strlen($value) == 0) {

      $this->addError($field, "The field {$field} is required.");
    }
  }

  private function email($field, $value)
  {

    if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {

      $this->addError($field, "The $field is not valid.");
    }
  }

  private function matches($field, $value, $confirmation_value)
  {

    if ($value != $confirmation_value) {

      $this->addError($field, "The $field confirmation does not match.");
    }
  }

  private function length($min, $max, $field, $value)
  {

    if (! $max) {
      $max = PHP_INT_MAX;
    }

    if (strlen($value) <= $min || strlen($value) >= $max) {

      $this->addError($field, "The $field needs to be between $min and $max characters.");
    }
  }

  private function min($min, $field, $value)
  {

    if (strlen($value) < $min) {

      $this->addError($field, "The $field needs to be at least $min characters.");
    }
  }

  private function max($max, $field, $value)
  {

    if (strlen($value) > $max) {

      $this->addError($field, "The $field needs to be at most $max characters.");
    }
  }

  private function strong($field, $value)
  {

    if (! strpbrk($value, "!#$%&'()*+,-./:;<=>?@[\]^_`{|}~")) {

      $this->addError($field, "The $field must contain at least one special character.");
    }
  }

  private function unique($table, $field, $value)
  {

    if (strlen($value) == 0) {

      return;
    }

    $database = new Database(config('database'));

    $resultado = $database->query(

      query: "select * from $table where $field = :value",
      params: ['value' => $value]

    )->fetch();

    if ($resultado) {

      $this->addError($field, "The $field must be unique.");
    }
  }

  private function addError($field, $error)
  {

    $this->validations[$field][] = $error;
  }


  public function fails($custom_name = null)
  {

    $key = 'validations';
    if ($custom_name) {
      $key .= "_$custom_name";
    }

    flash()->push($key, $this->validations);

    if (count($this->validations) === 0) {
      return false;
    }

    return true;
  }
}
