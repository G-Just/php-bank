<!DOCTYPE html>
<html>

<head>
  <meta charset='UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1.0' />
  <link rel='stylesheet' href='style.scss' />
  <link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
  <script src='./scripts/popup.js' defer></script>
  <title>PHP Bank</title>
</head>

<body class=<?php
            if (isset($_COOKIE['theme'])) {
              echo $_COOKIE['theme'];
            } ?>>