<?php
include('app_top.php');
//require("includes/db.php");
?>
<h5>Customer :</h5> 
<? 
$object = new CRUD();
 
// Design initial table header
$data = '<table class="table table-responsive-sm table-striped">
                        <tr>
                            <th>No.</th>
                            <th>First, Last Name</th>
                            <th>Tel. No. & Email</th>
                            <th>Act.</th>
                        </tr>';
 
 
$customers = $object->read('SELECT * FROM customer');
 
if (count($customers) > 0) {
    $number = 1;
    foreach ($customers as $customer) {
        $data .= '<tr>
                <td>' . $number . '</td>
                <td>' . $customer['first_name'] . ', ' . $customer['last_name'] . '</td>
                <td>T: ' . $customer['tel_no'] . '<br /><br />E: <a href="mailto:' . $customer['emailaddress'] . '">' . $customer['emailaddress'] . '</a></td>
                <td>
                    <button onclick="bookingAppointment(' . $customer['customer_id'] . ');" class="btn btn-success" data-toggle="tooltip" title="Booking">Book</button>

                    <button onclick="GetCustomerDetails(' . $customer['customer_id'] . ');" class="btn btn-warning" data-toggle="tooltip" title="Update">Update</button>
                
                    <button onclick="DeleteCustomer(' . $customer['customer_id'] . ');" class="btn btn-danger" data-toggle="tooltip" title="Delete">Delete</button>
                </td>
            </tr>';
        $number++;
    }
} else {
    // records not found
    $data .= '<tr><td colspan="4">Records not found!</td></tr>';
}
 
$data .= '</table>';
 
echo $data;
 
?>