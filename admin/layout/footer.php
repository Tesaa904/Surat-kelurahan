	<!-- jquery vendor -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
	<!-- nano scroller -->
	<script src="assets/js/lib/menubar/sidebar.js"></script>
	<script src="assets/js/lib/preloader/pace.min.js"></script>
	<!-- sidebar -->
	<script src="assets/js/lib/bootstrap.min.js"></script>

	<!-- bootstrap -->
	<script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
	<script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>

	<script src="assets/js/lib/morris-chart/raphael-min.js"></script>
	<script src="assets/js/lib/morris-chart/morris.js"></script>
	<script src="assets/js/lib/morris-chart/morris-init.js"></script>

	<!--  flot-chart js -->
	<script src="assets/js/lib/flot-chart/jquery.flot.js"></script>
	<script src="assets/js/lib/flot-chart/jquery.flot.resize.js"></script>
	<script src="assets/js/lib/flot-chart/flot-chart-init.js"></script>
	<!-- // flot-chart js -->



	<script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
	<script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
	<script src="assets/js/scripts.js"></script>
	<!-- scripit init-->

	<!-- Other Plugin -->
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="vendor/select2/js/select2.full.min.js"></script>

	<script src="vendor/jquery-ui-1.12.1/jquery-ui.min.js"></script>
	<script>
	  $( function() {
		$('.datatable').DataTable();
		$('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true			
		});
		$('.datepicker').css("z-index","0");
		$('.select2').select2({
			width:'100%'
		});
		 $('[data-toggle="tooltip"]').tooltip();
	  } );
	</script>			
	<script type="text/javascript">
		function konfirmasi(){
			var opt = confirm("Anda yakin akan menghapus data?");
			if (opt){
				return true
			} else {
				return false
			}
		}
		function verif(){
			var opt = confirm("Anda yakin akan memverifikasi data?");
			if (opt){
				return true
			} else {
				return false
			}
		}
	</script>
	<script>
		window.setTimeout(function() { $(".alert").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); 
	</script>		
