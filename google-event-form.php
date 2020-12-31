<?php
require_once('config.php');
require_once('functions.php');
$access_token = 'xxxxx';

if(isset($_POST['event_title'])){
	$user_timezone = GetUserCalendarTimezone($access_token);
	$calendar_id = 'primary';
	$event_title = $_POST['event_title'];
	
	// Event starting & finishing at a specific time
	//$full_day_event = 0; 
	//$event_time = [ 'start_time' => '2020-12-31T15:00:00', 'end_time' => '2020-12-31T16:00:00' ];

	// Full day event
	$full_day_event = 1; 
	$event_time = [ 'event_date' => date('Y-m-d', strtotime($_POST['event_date'])) ];
	
	$data = CreateCalendarEvent($calendar_id, $event_title, $full_day_event, $event_time, $user_timezone, $access_token);
	
	if($data != ''){
		header('Location:google-event-form.php?event_id='.$data);
		exit;
	}
}

?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	
	<title>Google Calendar Event API</title>
</head>
<body>
	<div class="container">
		<?php if(isset($_GET['event_id'])) echo '<div class="alert alert-success">Google Calendar event created.</div>'; ?>
		<form method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
				  <label for="event_title">Event Title</label>
				  <input type="text" class="form-control" id="event_title" name="event_title" placeholder="Event Title" require="">
				</div>
				<div class="form-group col-md-6">
					<label for="event_date">Event Date</label>
					<div class="input-group date">
					<input type="text" class="form-control" value="<?php echo date('Y-m-d') ?>" id="event_date" name="event_date">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-th"></span>
					</div>
					</div>
				</div>
				
			</div>
			<button type="submit" class="btn btn-primary">Add Google Calendar Event</button>
		</form>
	</div>
	<script>
		$('#event_date').datepicker({
			format: "yyyy-mm-dd"
		});
	</script>
</body>
</html>