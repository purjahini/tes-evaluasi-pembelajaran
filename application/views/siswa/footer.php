      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    
    <script src="<?php echo base_url();?>assets/js/siswa-bootstrap.min.js"></script>
    
    
    <script src="<?php echo base_url();?>assets/js/siswa-jquery.nicescroll.js" type="text/javascript"></script>
    


    <!--common script for all pages-->
    <script src="<?php echo base_url();?>assets/js/siswa-common-scripts.js"></script>

	<script>
        function getTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('showtime').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){getTime()},20);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>
  

  </body>
</html>
