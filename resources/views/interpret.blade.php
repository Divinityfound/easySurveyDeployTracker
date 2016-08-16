<html>
	<head>
		<title>Module Field Use | Data Grid</title>
    	<link href="css/bootstrap.min.css" rel="stylesheet">
    	<script src="js/chartjs/Chart.js"></script>
	</head>
	<body>
		<div class='container'>
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Results of Survey</h3></div>
				<div class="panel-body">
					This is the collected results of all the people that completed the survey!
				</div>
			</div>

			<div class='row'>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#results">Results</a></li>
					<li><a data-toggle="tab" href="#graph">Graphs</a></li>
				</ul>
				<div class="tab-content">
					<div id="results" class="tab-pane fade in active">
						<table class='table table-striped table-bordered table-hover table-condensed'>
							@foreach ($set_data as $key => $data)
								<tr>
									<th>{{ $key }}</th>
									@foreach ($data as $key2 => $record)
										@if ($key == 'full_name')
											<th><a href="#" title='{{ $record }}'>{{ preg_replace("/[^A-Z]/", "", $record) }}</a></th>
										@else
											<td>
											@if ($record != '')
												@if (is_int($record))
													{{ $record-1 }}
												@else
													{{ $record }}
												@endif
											@else 
												NULL
											@endif
											</td>
										@endif
									@endforeach
								</tr>
							@endforeach
						</table>
					</div>
					<div id="graph" class="tab-pane fade">
						@foreach ($graph_data as $key => $data)
							<div class='col-md-6'>
								<h3>{{ $key }}</h3>
								<canvas id="{{ $key }}" width="450" height="450"></canvas>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		    <script src="js/bootstrap.min.js"></script>
			<script>
				@foreach ($graph_data as $key => $data)
					var labels = [];
					var dataResultsYes = [];
					var dataResultsNo = [];

					@foreach ($data as $key2 => $results)
						labels.push("{{ $key2 }}");
						dataResultsYes.push({{ $results['Yes'] - 1 }});
						dataResultsNo.push({{ $results['No'] - 1 }});
					@endforeach

					var data = {
					    labels: labels,
					    datasets: [
					        {
					            label: "Yes",
					            fillColor: "green",
					            strokeColor: "green",
					            highlightFill: "green",
					            highlightStroke: "green",
					            data: dataResultsYes
					        },
							{
					            label: "No",
					            fillColor: "red",
					            strokeColor: "red",
					            highlightFill: "red",
					            highlightStroke: "red",
					            data: dataResultsNo
					        }
					    ]
					};

					var {{ $key }} = $("#{{ $key }}").get(0).getContext("2d");
					var myNewChart = new Chart({{ $key }}).Bar(data);
				@endforeach
			</script>
		</div>
	</body>
</html>