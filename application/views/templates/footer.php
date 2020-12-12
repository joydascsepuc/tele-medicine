<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<footer class="page-footer text-center mt-5">
  <?php $year = date('Y'); ?>
  <div class="footer-copyright text-center">© <?=$year;?> Copyright : SoftSource, Bangladesh.</div>
</footer>

</div>
    <!-- /#page-content-wrapper -->

  </div>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>


<script type="text/javascript">
  $(document).ready( function () {
    $('#datatable').DataTable();
  });

  $('.nav-item a').on('click', function() {
   
    $('.nav-item').children('.dropdown-menu').slideUp(150);
    
    if ($(this).parent().hasClass("show")) {
      $(this).next('.dropdown-menu').slideUp(150);
    } else {
      $(this).next('.dropdown-menu').slideDown(200);
    }

  });

  var base_url = "<?php echo base_url(); ?>";
  $('#available').change(function() {
    //alert($(this).prop('checked'))
    var avail=0;
    if($(this).prop('checked'))
     {
        avail = 1;
     }

     $.ajax({
       url:base_url + 'toggle',
       method:"POST",
       //dataType: "json",
       data:{avail:avail},
       success:function(data)
       {
         
       }
    });


  })




</script>

</body>
</html>