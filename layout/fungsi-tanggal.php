<?php
	// Konvesi yyyy-mm-dd -> dd-mm-yyyy dan memberi nama bulan
	function tgl_eng_to_ind($tgl) {
		$tanggal	= explode('-',$tgl);
		$kdbl		= $tanggal[1];

		if ($kdbl == '01')	{
			$nbln = 'Januari';
		}
		else if ($kdbl == '02') {
			$nbln = 'Februari';
		}
		else if ($kdbl == '03') {
			$nbln = 'Maret';
		}
		else if ($kdbl == '04') {
			$nbln = 'April';
		}
		else if ($kdbl == '05') {
			$nbln = 'Mei';
		}	
		else if ($kdbl == '06') {
			$nbln = 'Juni';
		}
		else if ($kdbl == '07') {
			$nbln = 'Juli';
		}
		else if ($kdbl == '08') {
			$nbln = 'Agustus';
		}
		else if ($kdbl == '09') {
			$nbln = 'September';
		}
		else if ($kdbl == '10') {
			$nbln = 'Oktober';
		}
		else if ($kdbl == '11') {
			$nbln = 'November';
		}
		else if ($kdbl == '12') {
			$nbln = 'Desember';
		}
		else {
			$nbln = '';
		}
		
		$tgl_ind = $tanggal[2]." ".$nbln." ".$tanggal[0];
		return $tgl_ind;
	}
	function tgl_depan($tgl1){
		$tanggal1	= explode('/',$tgl1);
		$tgl_ind1 = $tanggal1[2]."-".$tanggal1[0]."-".$tanggal1[1];
		return $tgl_ind1;
	}
	
	function hari($tgl2){
		$day = date('D', strtotime($tgl2));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);
		return $dayList[$day];
	}

?>
