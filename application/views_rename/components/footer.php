<div class="sidebar-overlay" data-reff=""></div>
    <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url();?>assets/js/Chart.bundle.js"></script>
    <script src="<?php echo base_url();?>assets/js/chart.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/app.js"></script>
    <script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>


    <script>
    $(document).ready(function() {
      $('#recipients').select2({
        placeholder: "Select recipients",
        width: '100%'
      });
    });
  </script>

<script>
  document.getElementById('copyFrom').addEventListener('input', function () {
    const email = this.value;
    document.getElementById('copyTo').value = email;
  });
</script>
<script>
  document.getElementById('imageInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('previewImage');

    if (file) {
      const reader = new FileReader();

      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
      };

      reader.readAsDataURL(file); // convert file to base64
    } else {
      preview.style.display = 'none';
    }
  });
</script>

</body>

</html>