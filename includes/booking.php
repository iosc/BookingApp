<?
function booking_listing($query) //"SELECT * FROM booking
{
	$object = new CRUD();
	//echo '<pre>';
    //print_r($object->read($query));
	//echo '</pre>';

	$booking = $object->read($query);

	//echo '<pre>';
		//print_r($booking);
	//echo '</pre>';

	foreach ($booking as $each_booking)
	{
		//print_r($booking);
		$room_id = $each_booking['room_id'];
		$today = date('Y-m-d');
		
		$room_log = return_value("SELECT * FROM room_log WHERE room_id = '$room_id' AND checkin >= '$today'");
		
		//echo $today;
		//echo "SELECT * FROM room_log WHERE room_id = '$room_id' AND checkin >= '$today'";
		
		//print_r($room_log);
		
		echo '<div class="col-sm each_booking_wrapper">';
		echo '<p>'.ucwords($each_booking['type']).' - '.$each_booking['room_num'].'</p>';
		if (!empty($room_log))
		{
			echo '<p>'.$room_log['checkin'].'</p>';
			echo '<p>'.$room_log['checkout'].'</p>';
		}
		echo '</div>';

	}
}

function add_booking_appointment()
{
	//return_array($query);
	?>
<!-- // Modal -->
<!-- Modal - add bookings -->
<div class="modal fade" id="add_booking_appointment_modal" tabindex="-1" role="dialog" aria-labelledby="add_booking_appointment_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="add_booking_appointment_modal_Label">New Booking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
 
                <div id="show_bookingAppointment_customer_data">
                    
                </div>
 
                <div class="form-group">
                    <label for="bookingAppointment_staff_id">Choose Staff</label>
                    <select id="bookingAppointment_staff_id" name="bookingAppointment_staff_id" class="form-control"/>
                    <?
					$staff_id_list = return_array('SELECT user_id, first_name, last_name FROM users WHERE level = 8');
					//print_r($staff_id_list);
					foreach ($staff_id_list as $key => $staff)
					{
						echo '<option value="', $staff['user_id'],'">', ucwords($staff['last_name']), ' ', ucwords($staff['first_name']), '</option>';
					}
					?>
                    </select>
                </div>
                
                <? $booking_date = date('d-m-Y', strtotime('+1 day')); ?>
 
                <div class="form-group">
                    <label for="bookingAppointment_date">Appointment Date</label>
                    <input type="text" id="bookingAppointment_date" name="bookingAppointment_date" placeholder="<? echo $booking_date; ?>" class="form-control" value="<? echo $booking_date; ?>"/>
                </div>
 
                <div class="form-group">
                    <label for="bookingAppointment_time">Appointment Time</label>
                    <select type="text" id="bookingAppointment_time" name="bookingAppointment_time" class="form-control"/>
                    <?
					$start_timeslot = strtotime('07:30');
					$current_timeslot =  '';
					for ($timeslot = 0; $timeslot < 62; $timeslot++)
					{
						$current_timeslot = date("H:i", strtotime("+15 minutes", $start_timeslot));
						echo '<option value="',$current_timeslot,'">', $current_timeslot, '</option>';
						$start_timeslot = strtotime($current_timeslot);
					}
					?>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" id="hidden_bookingAppointment_customer_id">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="AddBookingAppointment()" >Book Now!</button>
            </div>
        </div>
    </div>
</div>

<script>
	$( function() {
		$( "#bookingAppointment_date" ).datepicker({
			showButtonPanel: true,
			showWeek: true,
			firstDay: 1, 
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy'
		});
	});
  </script>
<!-- // Modal -->
<?
}
?>
