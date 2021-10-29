<?php
	$this_year = date("Y");
	
	$text_agama = "SELECT aa.id_agama,aa.nama_agama,count(bb.id_penduduk) as 'jml' from m_agama aa left join 
				(SELECT a.id_penduduk,a.id_agama from m_penduduk a where a.status='1')bb on aa.id_agama=bb.id_agama group by aa.id_agama,aa.nama_agama";
	$sql_title_agama = mysqli_query($mysqli,$text_agama);
	$sql_jml_agama = mysqli_query($mysqli,$text_agama);	

	$text_pekerjaan = "SELECT aa.id_pekerjaan,aa.nama_pekerjaan,count(bb.id_penduduk) as 'jml' from m_pekerjaan aa left join 
				(SELECT a.id_penduduk,a.id_pekerjaan from m_penduduk a where a.status='1')bb on aa.id_pekerjaan=bb.id_pekerjaan group by aa.id_pekerjaan,aa.nama_pekerjaan";
	$sql_title_pekerjaan = mysqli_query($mysqli,$text_pekerjaan);
	$sql_jml_pekerjaan = mysqli_query($mysqli,$text_pekerjaan);	

	$text_pendidikan= "SELECT aa.id_pendidikan,aa.nama_pendidikan,count(bb.id_penduduk) as 'jml' from m_pendidikan aa left join 
				(SELECT a.id_penduduk,a.id_pendidikan from m_penduduk a where a.status='1')bb on aa.id_pendidikan=bb.id_pendidikan group by aa.id_pendidikan,aa.nama_pendidikan";
	$sql_title_pendidikan = mysqli_query($mysqli,$text_pendidikan);
	$sql_jml_pendidikan = mysqli_query($mysqli,$text_pendidikan);	
	
	$text_gender = "SELECT aa.id_gender,aa.nama_gender,count(bb.id_penduduk) as 'jml' from m_gender aa 
					left join (SELECT a.id_penduduk,a.id_gender from m_penduduk a where a.status='1')bb 
					on aa.id_gender=bb.id_gender group by aa.id_gender,aa.nama_gender";
	$sql_title_gender = mysqli_query($mysqli,$text_gender);
	$sql_jml_gender = mysqli_query($mysqli,$text_gender);

	$text_kawin = "SELECT aa.id_statuskawin,aa.nama_statuskawin,count(bb.id_penduduk) as 'jml' from m_statuskawin aa 
					left join (SELECT a.id_penduduk,a.id_statuskawin from m_penduduk a where a.status='1')bb 
					on aa.id_statuskawin=bb.id_statuskawin group by aa.id_statuskawin,aa.nama_statuskawin";
	$sql_title_kawin = mysqli_query($mysqli,$text_kawin);
	$sql_jml_kawin = mysqli_query($mysqli,$text_kawin);

	$text_dukuh = "SELECT aa.id_dukuh,aa.nama_dukuh,count(bb.id_penduduk) as 'jml' from m_dukuh aa left join 
			(SELECT a.id_penduduk,a.id_dukuh from m_penduduk a where a.status='1')bb on aa.id_dukuh=bb.id_dukuh group by aa.id_dukuh,aa.nama_dukuh";
	$sql_title_dukuh = mysqli_query($mysqli,$text_dukuh);
	$sql_jml_dukuh = mysqli_query($mysqli,$text_dukuh);
?>
<!-- Plugin Apexchart -->
<link rel="stylesheet" type="text/css" href="plugins/apexchart/apexcharts.css">
<script src="plugins/apexchart/apexcharts.min.js"></script>

<script type="text/javascript">
	window.onload = function () {
		//chart agama
        var options = {
			series: [{
				name: 'Jumlah',
				data: [<?php while ($jml_agama = mysqli_fetch_array($sql_jml_agama)) { echo "$jml_agama[jml],"; }?>]
			}],
			chart: {
				height: 350,
				type: 'bar',
			},
			plotOptions: {
				bar: {
					dataLabels: {
					position: 'top', // top, center, bottom
					},
				}
			},
			dataLabels: {
				enabled: true,
				formatter: function (val) {
					return val;
				},
				offsetY: -20,
				style: {
					fontSize: '12px',
					colors: ["#304758"]
				}
			},     
			xaxis: {
				categories: [<?php while ($title_agama = mysqli_fetch_array($sql_title_agama)) { echo "'$title_agama[nama_agama]',"; }?>],
				position: 'bottom',
				axisBorder: {
					show: true
				},
				axisTicks: {
					show: true
				},
				crosshairs: {
					fill: {
					type: 'gradient',
					gradient: {
						colorFrom: '#D8E3F0',
						colorTo: '#BED1E6',
						stops: [0, 100],
						opacityFrom: 0.4,
						opacityTo: 0.5,
					}
					}
				},
				tooltip: {
					enabled: false,
				}
			},
			yaxis: {
				axisBorder: {
					show: true
				},
				axisTicks: {
					show: true,
				},
				labels: {
					show: true,
					formatter: function (val) {
					return val;
					}
				}		
			},
        };
        var chart = new ApexCharts(document.querySelector("#grafik_agama"), options);
        chart.render();

		//chart pendidikan
        var options = {
			series: [{
				name: 'Jumlah',
				data: [<?php while ($jml_pendidikan = mysqli_fetch_array($sql_jml_pendidikan)) { echo "$jml_pendidikan[jml],"; }?>]
			}],
			chart: {
				height: 350,
				type: 'bar',
			},
			plotOptions: {
				bar: {
					dataLabels: {
					position: 'top', // top, center, bottom
					},
				}
			},
			dataLabels: {
				enabled: true,
				formatter: function (val) {
					return val;
				},
				offsetY: -20,
				style: {
					fontSize: '12px',
					colors: ["#304758"]
				}
			},     
			xaxis: {
				categories: [<?php while ($title_pendidikan = mysqli_fetch_array($sql_title_pendidikan)) { echo "'$title_pendidikan[nama_pendidikan]',"; }?>],
				position: 'bottom',
				axisBorder: {
					show: true
				},
				axisTicks: {
					show: true
				},
				crosshairs: {
					fill: {
					type: 'gradient',
					gradient: {
						colorFrom: '#D8E3F0',
						colorTo: '#BED1E6',
						stops: [0, 100],
						opacityFrom: 0.4,
						opacityTo: 0.5,
					}
					}
				},
				tooltip: {
					enabled: false,
				}
			},
			yaxis: {
				axisBorder: {
					show: true
				},
				axisTicks: {
					show: true,
				},
				labels: {
					show: true,
					formatter: function (val) {
					return val;
					}
				}		
			},
        };
        var chart = new ApexCharts(document.querySelector("#grafik_pendidikan"), options);
        chart.render();

		//chart pendidikan
        var options = {
			series: [{
				name: 'Jumlah',
				data: [<?php while ($jml_pekerjaan = mysqli_fetch_array($sql_jml_pekerjaan)) { echo "$jml_pekerjaan[jml],"; }?>]
			}],
			chart: {
				height: 350,
				type: 'bar',
			},
			plotOptions: {
				bar: {
					dataLabels: {
					position: 'top', // top, center, bottom
					},
				}
			},
			dataLabels: {
				enabled: true,
				formatter: function (val) {
					return val;
				},
				offsetY: -20,
				style: {
					fontSize: '12px',
					colors: ["#304758"]
				}
			},     
			xaxis: {
				categories: [<?php while ($title_pekerjaan = mysqli_fetch_array($sql_title_pekerjaan)) { echo "'$title_pekerjaan[nama_pekerjaan]',"; }?>],
				position: 'bottom',
				axisBorder: {
					show: true
				},
				axisTicks: {
					show: true
				},
				crosshairs: {
					fill: {
					type: 'gradient',
					gradient: {
						colorFrom: '#D8E3F0',
						colorTo: '#BED1E6',
						stops: [0, 100],
						opacityFrom: 0.4,
						opacityTo: 0.5,
					}
					}
				},
				tooltip: {
					enabled: false,
				}
			},
			yaxis: {
				axisBorder: {
					show: true
				},
				axisTicks: {
					show: true,
				},
				labels: {
					show: true,
					formatter: function (val) {
					return val;
					}
				}		
			},
        };
        var chart = new ApexCharts(document.querySelector("#grafik_pekerjaan"), options);
        chart.render();

		//chart dukuh
        var options = {
			series: [{
				name: 'Jumlah',
				data: [<?php while ($jml_dukuh = mysqli_fetch_array($sql_jml_dukuh)) { echo "$jml_dukuh[jml],"; }?>]
			}],
			chart: {
				height: 350,
				type: 'bar',
			},
			plotOptions: {
				bar: {
					dataLabels: {
					position: 'top', // top, center, bottom
					},
				}
			},
			dataLabels: {
				enabled: true,
				formatter: function (val) {
					return val;
				},
				offsetY: -20,
				style: {
					fontSize: '12px',
					colors: ["#304758"]
				}
			},     
			xaxis: {
				categories: [<?php while ($title_dukuh = mysqli_fetch_array($sql_title_dukuh)) { echo "'$title_dukuh[nama_dukuh]',"; }?>],
				position: 'bottom',
				axisBorder: {
					show: true
				},
				axisTicks: {
					show: true
				},
				crosshairs: {
					fill: {
					type: 'gradient',
					gradient: {
						colorFrom: '#D8E3F0',
						colorTo: '#BED1E6',
						stops: [0, 100],
						opacityFrom: 0.4,
						opacityTo: 0.5,
					}
					}
				},
				tooltip: {
					enabled: false,
				}
			},
			yaxis: {
				axisBorder: {
					show: true
				},
				axisTicks: {
					show: true,
				},
				labels: {
					show: true,
					formatter: function (val) {
					return val;
					}
				}		
			},
        };
		var chart = new ApexCharts(document.querySelector("#grafik_dukuh"), options);
		chart.render();
		
		//grafik gender
   		var options = {
          series: [<?php while ($jml_gender = mysqli_fetch_array($sql_jml_gender)) { echo "$jml_gender[jml],"; }?>],
          chart: {
          height: 320,
          type: 'pie',
        },
        labels: [<?php while ($title_gender = mysqli_fetch_array($sql_title_gender)) { echo "'$title_gender[nama_gender]',"; }?>],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
		};
		var chart = new ApexCharts(document.querySelector("#grafik_gender"), options);
		chart.render();

		//grafik kawin
		var options = {
          series: [<?php while ($jml_kawin = mysqli_fetch_array($sql_jml_kawin)) { echo "$jml_kawin[jml],"; }?>],
          chart: {
          height: 320,
          type: 'pie',
        },
        labels: [<?php while ($title_kawin = mysqli_fetch_array($sql_title_kawin)) { echo "'$title_kawin[nama_statuskawin]',"; }?>],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
		};
		var chart = new ApexCharts(document.querySelector("#grafik_kawin"), options);
		chart.render();		
   }
   
   
</script>
</head>
	<body>
		<div class="pageheader">
		<h3><i class="fa fa-pencil"></i> INFORMASI DATA KEPENDUDUKAN DESA KRAGUMAN </h3>
	</div>

	<div id="page-content">
	<div class="row">
		<!-- column -->
		<div class="col-lg-8">
			<div class="panel">
   				<div class="panel-heading text-center">
				   <br><h4>Grafik Penduduk Berdasarkan Agama Tahun <?php echo $this_year;?></h4>
				</div>
				<div class="panel-body">
					<div id="grafik_agama"></div>
				</div>
			</div>
		</div>

		<!-- column -->
		<div class="col-lg-4">
			<div class="panel">
   				<div class="panel-heading text-center">
				   <br><h4>Grafik Penduduk Berdasarkan Jenis Kelamin Tahun <?php echo $this_year;?></h4>
				</div>
				<div class="panel-body">
					<div id="grafik_gender"></div>
				</div>
			</div>
		</div>

		<div class="col-lg-8">
			<div class="panel">
   				<div class="panel-heading text-center">
				   <br><h4>Grafik Penduduk Berdasarkan Jenjang Pendidikan Tahun <?php echo $this_year;?></h4>
				</div>
				<div class="panel-body">
					<div id="grafik_pendidikan"></div>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="panel">
   				<div class="panel-heading text-center">
				   <br><h4>Grafik Penduduk Berdasarkan Status Kawin Tahun <?php echo $this_year;?></h4>
				</div>
				<div class="panel-body">
					<div id="grafik_kawin"></div>
				</div>
			</div>
		</div>
                
        <div class="col-lg-12">
			<div class="panel">
   				<div class="panel-heading text-center">
				   <br><h4>Grafik Penduduk Berdasarkan Dukuh Tahun <?php echo $this_year;?></h4>
				</div>
				<div class="panel-body">
					<div id="grafik_dukuh"></div>
				</div>
			</div>
		</div>
                
        <div class="col-lg-12">
			<div class="panel">
   				<div class="panel-heading text-center">
				   <br><h4>Grafik Penduduk Berdasarkan Pekerjaan Tahun <?php echo $this_year;?></h4>
				</div>
				<div class="panel-body">
					<div id="grafik_pekerjaan"></div>
				</div>
			</div>
		</div>
    
	</div>
</div>
</body>