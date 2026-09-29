<div class="footer-basic">
            <footer>
            </footer>
        </div>
    
<script type="text/javascript" src="../assets/js/jquery.smartWizard.min.js"></script>
<script type="text/javascript">
         $(document).ready(function(){
			 
            const Toast = Swal.mixin({
              toast: true,
              position: 'bottom-end',
              showConfirmButton: true,
              confirmButtonText: "x",
              timer: 10000
            })
			
			
			setTimeout(function() {

            Toast.fire({
              type: 'success',
              title: '<?=$khuyenmai;?>'
            })
			}, 10000);

		 });
			

    </script>
    </body>

    </html>