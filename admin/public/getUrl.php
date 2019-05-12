
<!-- file này có chức năng lấy đường dẫn hiện tại sử dụng trong sidebar -->
<!-- hoặc có thể sử dụng trong một số công việc nhất định khác -->
<?php
  function getURL() {
    $pageURL = 'http';

    if (!empty($_SERVER['HTTPS'])) {
      if ($_SERVER['HTTPS'] == 'on') {
        $pageURL .= "s";
      }
    }

    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80") {
      $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
      $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
  }
?>
