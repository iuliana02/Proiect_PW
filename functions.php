<?php
session_start();

    if (isset($_POST['log_out']))
     {
          log_out();
      }
      if (isset ($_POST['reserve_again']))
      {
            reserve_again();
      }

    function log_out() {
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();

        header("Location: first_page.php");
        exit;
    }

    function reserve_again() {
        unset($_SESSION["check_in"]);
        unset($_SESSION["check_out"]);
        unset($_SESSION["hotel"]);
        unset($_SESSION["type"]);
        unset($_SESSION["category"]);
        unset($_SESSION["capacity"]);
        unset($_SESSION["price"]);
        header("Location: lab10_1.php");
        exit;
    }
?>
