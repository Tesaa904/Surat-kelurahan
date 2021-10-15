    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SIDEKRA</title>

        <!-- Standard -->
        <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
        <!-- Retina iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
        <!-- Retina iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
        <!-- Standard iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
        <!-- Standard iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

        <!-- Styles -->
        <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
        <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
        <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
        <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
        <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
        <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">

        <link href="assets/css/lib/helper.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">

        <script src="assets/js/jquery.min.js" type="text/javascript"></script>
         <script src="assets/js/lib/morris-chart/morris.js" type="text/javascript"></script>
		
		<!-- Other Plugin -->
		<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
		<link href="vendor/select2/css/select2.min.css" rel="stylesheet">
		<link href="vendor/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet">
		<style>
			.ui-datepicker{ font-size: 12px; width: 220px; }
			.ui-datepicker select.ui-datepicker-month{ width:30%; font-size: 12px; }
			.ui-datepicker select.ui-datepicker-year{ width:40%; font-size: 12px; }
		</style>
       <script type="text/javascript" src="assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#propinsi').change(function(){
                    $.getJSON('index.php',{action:'getKab', kode_prop:$(this).val()}, function(json){
                        $('#kabupaten').html('');
                        $.each(json, function(index, row) {
                            $('#kabupaten').append('<option value='+row.kode+'>'+row.nama+'</option>');
                        });
                    });
                });
            });
        </script>
    </head>