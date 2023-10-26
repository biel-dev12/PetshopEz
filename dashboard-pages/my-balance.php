<?php
session_start();
?>

<?php

  if (!isset($_SESSION['email01'])) {
  ?>

    <script>
      location.href = "../index.php";
    </script>
  <?php

  }

  ?>