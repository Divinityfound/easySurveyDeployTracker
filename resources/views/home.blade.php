<html>
	<head>
		<title>Survey</title>
    	<link href="css/bootstrap.min.css" rel="stylesheet" />
    	<style>
			input[type="radio"] {
			  margin-top: -1px;
			  vertical-align: middle;
			}
			input[type="checkbox"] {
			  margin-top: -1px;
			  vertical-align: middle;
			}

			#quick_select
			{
			    position: fixed;
			    top: 180px;
			}
    	</style>
	</head>
	<body>
		<div class='container'>
			<div class="panel panel-default">
				<div class="panel-heading"><h3>{{ $textData['header'] }}</h3></div>
				<div class="panel-body">
					<ul>
						{!! $textData['instructions'] !!}
					</ul>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-3'>
					<div class="panel panel-default" id="quick_select">
						<div class="panel-heading"><h3>Quick Select</h3></div>
						<div class="panel-body">
							@foreach ($categories as $key => $moduleItems)
								<p><a href="#{{ $key }}">{{ str_replace('_', ' ', $key) }}</a></p>
							@endforeach
							<p><a href="#submit">Submit</a></p>
						</div>
					</div>
				</div>
				<div class='col-md-9'>
						{!! Form::model($cachedData,['url'=>'/']) !!}
							@foreach ($categories as $key => $moduleItems)
								<div class="panel panel-info">
					  				<div class="panel-heading" id='{{ $key }}'><h3>{{ str_replace('_', ' ', $key) }}</h3></div>
					 				<div class="panel-body">
										@foreach ($moduleItems as $key2 => $item)
											<div class='col-md-3' style='height: 100px;'>
												<h5>{{ $item }}</h5>
												<div class="btn-group" data-toggle="buttons">
												  @if (isset($cachedData[$key.'_'.$key2]) && $cachedData[$key.'_'.$key2] == 'Yes')
												  	<label class="btn btn-success">
												  @else
													<label class="btn btn-default">
												  @endif
												  	{!! Form::radio($key.'_'.$key2, 'Yes') !!} Yes
												  </label>

												  @if (!isset($cachedData[$key.'_'.$key2]) || $cachedData[$key.'_'.$key2] == 'No')
												  	<label class="btn btn-danger">
												  @else
													<label class="btn btn-default">
												  @endif
												  	{!! Form::radio($key.'_'.$key2, 'No') !!} No
												  </label>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							@endforeach
						
						<div class="panel panel-info">
					  		<div class="panel-heading"><h3>{{ $textData['finishHeader'] }}</h3></div>
				 			<div class="panel-body">
								<input type='checkbox' id='surveyComplete' /> {{ $textData['confirmationText'] }}
							</div>
						</div>
						<input type='submit' value='Submit' id='submit' class='btn btn-primary col-md-12 disabled' />
						<br /><br /><br />
					{!! Form::close() !!}
				</div>
		</div>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="js/bootstrap.min.js"></script>

	    <script>
	    	$('.btn-group').click(function(event) {
	    		var clicked = event.toElement.className;
	    		if (clicked.indexOf('btn btn-default') != -1) {
	    			if ($(this).find('.btn-danger').length > 0) {
						$(this).find('.btn-default').addClass('btn-success').removeClass('btn-default');
			    		$(this).find('.btn-danger').addClass('btn-default').removeClass('btn-danger');
	    			} else if ($(this).find('.btn-success').length > 0) {
			    		$(this).find('.btn-default').addClass('btn-danger').removeClass('btn-default');
			    		$(this).find('.btn-success').addClass('btn-default').removeClass('btn-success');
	    			} else {
	    				alert("ERROR");
	    			}
	    		}
	    	});
	    	$('#surveyComplete').click(function() {
	    		$('#submit').removeClass('disabled');
	    	});
	    </script>
	</body>
</html>