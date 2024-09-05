<?php
session_start(); // Start the session at the beginning of your page


// TEACHER BUTTON MODOL IF INSERT OR ALREADY TAKEN 
if (isset($_SESSION['insert_success']) && $_SESSION['insert_success'] == true) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
                notificationModal.show();
            });
          </script>";
    unset($_SESSION['insert_success']); // Unset the session variable
} else if (isset($_SESSION['insert_error']) && $_SESSION['insert_error'] == true) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var notificationError = new bootstrap.Modal(document.getElementById('notificationError'));
                notificationError.show();
            });
          </script>";
    unset($_SESSION['insert_error']); // Unset the session variable
}
