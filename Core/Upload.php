<?php

namespace Core;

class Upload
{
  public static function storeImage($file, $directory = 'images')
  {
    if (! is_array($file)) {
      return null;
    }

    $error = $file['error'] ?? UPLOAD_ERR_NO_FILE;

    if ($error === UPLOAD_ERR_NO_FILE) {
      return null;
    }

    if ($error !== UPLOAD_ERR_OK) {
      return false;
    }

    $tmpName = $file['tmp_name'] ?? null;
    if (! is_string($tmpName) || $tmpName === '' || ! is_uploaded_file($tmpName)) {
      return false;
    }

    $mime = mime_content_type($tmpName);
    $mimeToExtension = [
      'image/jpeg' => 'jpg',
      'image/pjpeg' => 'jpg',
      'image/jpg' => 'jpg',
      'image/png' => 'png',
      'image/x-png' => 'png',
      'image/gif' => 'gif',
      'image/webp' => 'webp',
    ];

    if (! is_string($mime) || ! isset($mimeToExtension[$mime])) {
      return false;
    }

    $extension = $mimeToExtension[$mime];

    $newName = bin2hex(random_bytes(16));
    $directory = trim((string) $directory, '/');
    $relativePath = ($directory === '' ? '' : ($directory . '/')) . "$newName.$extension";
    $destination = __DIR__ .  "/../public/$relativePath";

    $destinationDir = dirname($destination);
    if (! is_dir($destinationDir)) {
      mkdir($destinationDir, 0775, true);
    }

    if (! move_uploaded_file($tmpName, $destination)) {
      return false;
    }

    return $relativePath;
  }
}

