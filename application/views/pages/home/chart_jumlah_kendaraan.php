<div id="chart2" style="height: 400px;" class="col-md-12"></div>
<?php 
	$nm = "";
	$total = "";
	foreach($chart2 as $row){
		$nm .= "'" . $row->jenis . "',";
		$total .= $row->total . ",";
	}
?>

<script type="text/javascript">

	
		
	$(function () {
		
		Highcharts.setOptions({
			colors: ['#24CBE5']
		});
		
		$('#chart2').highcharts({
			chart: {
				type: 'column',
				options3d: {
					enabled: true,
					alpha: 12,
					beta: 22
				},
				backgroundColor: "#FFFFFF",
				borderWidth: 0,
				borderColor: "#FFFFFF"
			},
			exporting: { enabled: false },
			title: {
				text: 'Summary Jumlah Kendaraan per Jenis'
			},
			pane:{
				background: [{
					borderWidth: 0
				}]
			},
			subtitle: {
				text: ''
			},
			xAxis: {
				categories: [<?= $nm ?>]
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Jumlah'
				}
			},
			tooltip: {
				formatter: function () {
					return this.series.name + ': ' + this.y;
				}
			},
			plotOptions: {
				column: {
					stacking: 'normal',
					dataLabels: {
						enabled: true,
						color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						style: {
							textShadow: '0 0 3px black'
						}
					},
					borderWidth: 0 // < set this option
				}
			},
				series: 
				[
					{
						name: 'Jenis Kendaraan',
						data: [<?= $total ?>]
					}
				]
		});
	});
</script>