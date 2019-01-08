<?php
include('app_top.php');
//require("includes/db.php");
?>
<h5>Booking :</h5> 
<?
$object = new CRUD();
 
// Design initial table header
$data = '<table class="table table-responsive-sm table-striped">
                        <tr>
                            <th>No.</th>
                            <th>Customer</th>
                            <th>Staff</th>
                            <th>Appmt.</th>
                            <th>Act.</th>
                        </tr>';
 
 
$booking_apmt = $object->read('SELECT * FROM booking_appmt ORDER BY appmt_date ASC, appmt_time ASC');
 
if (count($booking_apmt) > 0) {
    foreach ($booking_apmt as $appmt) {
		
		$customer_tel_no = $appmt['customer_tel_no'];
		$customer_emailaddress = $appmt['customer_emailaddress'];
		$staff_tel_no = $appmt['staff_tel_no'];
		$staff_emailaddress = $appmt['staff_emailaddress'];
		
		$customer_contact = "<i class='fas fa-mobile-alt'></i> $customer_tel_no<br /><i class='far fa-envelope'></i> <a href='mailto:$customer_emailaddress'>$customer_emailaddress</a>";
		$staff_contact = "<i class='fas fa-mobile-alt'></i> $staff_tel_no<br /><i class='far fa-envelope'></i> <a href='mailto:$staff_emailaddress'>$staff_emailaddress</a>";

        $data .= '<tr>
                <td>' . $appmt['booking_appmt_id'] . '</td>
                <td>' . $appmt['customer_full_name'] . ' <i class="fas fa-address-card fa-lg" title="'.$customer_contact.'"></i><br /><span id="cust_contact_'.$appmt['booking_appmt_id'].'"><br />'.$customer_contact.'</span></td>
                <td>' . $appmt['staff_full_name'] . ' <i class="fas fa-address-card fa-lg" title="'.$staff_contact.'"></i><br /><span id="staff_contact_'.$appmt['booking_appmt_id'].'"><br />'.$staff_contact.'</span></td>
                <td>' . date('l, d-m-Y', strtotime($appmt['appmt_date'])) . ' => ' . date('H:i', strtotime($appmt['appmt_time'])) . '</a></td>
                <td>
                    <button onclick="UpdateAppointment(' . $appmt['booking_appmt_id'] . ');" class="btn btn-success" data-toggle="tooltip" title="Booking">Book</button>

                    <button onclick="GetAppmtDetails(' . $appmt['booking_appmt_id'] . ');" class="btn btn-warning" data-toggle="tooltip" title="Update">Update</button>
                
                    <button onclick="DeleteAppmt(' . $appmt['booking_appmt_id'] . ');" class="btn btn-danger" data-toggle="tooltip" title="Delete">Delete</button>
                </td>
            </tr>';
    }
} else {
    // records not found
    $data .= '<tr><td colspan="5">Records not found!</td></tr>';
}
 
$data .= '</table>';
 
echo $data;
 
?>
<script>
$(function () {
    $(document).tooltip({
        track: true,
		content: function () {
            return $(this).prop('title');
        },
        show: null, 
        close: function (event, ui) {
            ui.tooltip.hover(

            function () {
                $(this).stop(true).fadeTo(400, 1);
            },

            function () {
                $(this).fadeOut("400", function () {
                    $(this).remove();
                })
            });
        }
    });
});

$(document).ready(function () {
    $('span').hide();
});
</script>