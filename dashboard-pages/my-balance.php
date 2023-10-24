<?php
session_start();
?>

<?php

  if (!isset($_SESSION['email01'])) {
  ?>

    <script>
      location.href = "../signup.php";
    </script>
  <?php

  }

  ?>