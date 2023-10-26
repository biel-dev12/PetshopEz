<?php
session_start();

  if (!isset($_SESSION['email01'])) {
  ?>

    <script>
      location.href = "../index.php";
    </script>
  <?php

  }

  ?>