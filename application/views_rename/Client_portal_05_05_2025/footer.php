
<footer class="text-center py-3">
    <div class="container">
         &copy; 2025 Accurex Accounting | Powered by <a href="https://boffinweb.com" target="_blank">Boffin Web Technology</a>
    </div>
</footer>

<script>
$(document).on("click", ".isunread", function () {
  var notifId = $(this).data("id"); // notification ID attribute se
  $.ajax({
    url: "<?= base_url('Notifications/updateRead'); ?>",
    method: "POST",
    data: { id: notifId },
    success: function (response) {
      console.log("Status updated:", response);
      // Optional: UI ko update karo
      // Example: class change + styling
      $(`[data-id="${notifId}"]`)
        .removeClass("isunread")
        .addClass("isread")
        .find(".status-text")
        .text("isread");
 
        let notifEl = document.getElementById("notif-count");
        // Current value as number
        let currentCount = parseInt(notifEl.innerText);
        // Subtract 1, but never below 0
        let newCount = Math.max(currentCount - 1, 0);
        // Update in HTML
        notifEl.innerText = newCount;

        myAjaxNotify();
    }
  });
});

</script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="<?php echo base_url('assets/plugins/dropzone/min/dropzone.min.js'); ?>"></script>
</body>
</html>
