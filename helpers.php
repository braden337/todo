<?php

// class flash {
    
//     function __construct($status, $message) {
//       $this->status = $status;
//       $this->message = $message;
//   }
    
// }

function display_flash() {
  if (isset($_SESSION['flash_status']) && isset($_SESSION['flash_message'])):
    $status = $_SESSION['flash_status'];
    $message = $_SESSION['flash_message'];
    echo "<div class=\"alert alert-$status\">$message</div>";
    unset($_SESSION['flash_status']);
    unset($_SESSION['flash_message']);
  endif;
}