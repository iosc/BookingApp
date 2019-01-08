<?
include('app_top.php');
//include('header.php');
$action = $_GET['a'];

switch ($action)
{

	default :
	
		?>
		<script>
		console.log('call request default');
		</script>
		<?
		echo 'default';
		exit();
		break;
		
	case 'create_customer' :
	
		 	?>
            <script>
			console.log('called create customer');
			</script>
            <?
		if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['tel_no']) && isset($_POST['emailaddress'])) {
			
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$tel_no = $_POST['tel_no'];
			$emailaddress = $_POST['emailaddress'];
			$add_cust['first_name'] = $first_name;
			$add_cust['last_name'] = $last_name;
			$add_cust['tel_no'] = $tel_no;
			$add_cust['emailaddress'] = $emailaddress;
			
			echo '<pre>';
			print_r($add_cust);
			echo '</pre>';
		 
		 
			$object = new CRUD();
		 
			//$object->create_customer($first_name, $last_name, $tel_no);
			$object->create_customer($add_cust);

		} else {
			echo 'create customer error!';
		 	?>
            <script>
			console.log('create customer error!');
			</script>
            <?
		}
		exit();
		break;
		

	case 'customer_details' :
	
		if (isset($_POST['customer_id']) && isset($_POST['customer_id']) != "") {
			$customer_id = $_POST['customer_id'];
		 
			$object = new CRUD();
			
		 	//output JSON here
			print_r($object->customer_details($customer_id));
		}
		exit();
		break;
		
	case 'delete_customer' :
	
		if (isset($_POST['customer_id']) && isset($_POST['customer_id']) != "") {
			$customer_id = $_POST['customer_id'];
		 
			$object = new CRUD();
			$object->delete_customer($customer_id);
		}
		exit();
		break;
		
	case 'update_customer' :
	
		if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['tel_no'])) {
			
			$customer_id = $_POST['customer_id'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$tel_no = $_POST['tel_no'];
			$emailaddress = $_POST['emailaddress'];

			$update_cust['first_name'] = $first_name;
			$update_cust['last_name'] = $last_name;
			$update_cust['tel_no'] = $tel_no;
			$update_cust['emailaddress'] = $emailaddress;
			
			echo '<pre>';
			print_r($update_cust);
			echo '</pre>';
		 
		 
			$object = new CRUD();
		 
			$object->update_customer($update_cust, $customer_id);
		 		 
			//$object->update_customer($first_name, $last_name, $tel_no, $customer_id);
		}
		exit();
		break;
		
	case 'booking_appointment' :
	
		if (isset($_POST['customer_id']) && isset($_POST['customer_id']) != "") {
			$customer_id = $_POST['customer_id'];
		 
			$object = new CRUD();
			
		 	//output JSON here
			print_r($object->customer_details($customer_id));
		}
		exit();
		break;
		
	case 'add_booking_appointment' : //abb 4-1-19
	
		if (isset($_POST['customer_id']) && isset($_POST['customer_id']) != "") {
			$booking['customer_id'] = $customer_id = $_POST['customer_id'];
			$booking['staff_id'] = $bookingAppointment_staff_id = $_POST['bookingAppointment_staff_id'];
			$bookingAppointment_datetime = date('Y-m-d H:i:s', strtotime($_POST['bookingAppointment_date'].' '.$_POST['bookingAppointment_time']));
			$booking['appmt_date'] = $appmt_date = date('Y-m-d H:i:s', strtotime($bookingAppointment_datetime));
			$booking['appmt_time'] = $appmt_time = date('Y-m-d H:i:s', strtotime($bookingAppointment_datetime));
			
			//$booking_appmt_id
			//print_r($booking);
			$customer = return_array_2("SELECT * FROM customer WHERE customer_id = '$customer_id'");
			//print_r($customer);
			
			$booking['customer_full_name'] = $customer_full_name = $customer['last_name'] . ' ' . $customer['first_name'];
			$booking['customer_tel_no'] = $customer_tel_no = $customer['tel_no'];
			$booking['customer_emailaddress'] = $customer_emailaddress = $customer['emailaddress'];
			
			$staff = return_array_2("SELECT * FROM users WHERE user_id = '$bookingAppointment_staff_id'");
			//print_r($staff);
			
			$booking['staff_id'] = $staff_id = $staff['user_id'];
			$booking['staff_full_name'] = $staff_full_name = $staff['last_name'] . ' ' . $staff['first_name'];
			$booking['staff_tel_no'] = $staff_tel_no = $staff['tel_no'];
			$booking['staff_emailaddress'] = $staff_emailaddress = $staff['emailaddress'];

/*
			$booking['remarks'] = $remarks = $staff['emailaddress'];
			$booking['mdate'] = $mdate = $staff['mdate'];
			$booking['cdate'] = $cdate = $staff['cdate'];
*/

//print_r($booking);
		 
			$object = new CRUD();
			$object->create_booking($booking, 'booking_appmt');
		}
		exit();
		break;

	case 'delete_appmt' :
	
		if (isset($_POST['booking_appmt_id']) && isset($_POST['booking_appmt_id']) != "") {
			$booking_appmt_id = $_POST['booking_appmt_id'];
		 
			$object = new CRUD();
			$object->delete_appmt($booking_appmt_id);
		}
		exit();
		break;
		
	case 'update_appmt' :
	
		if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['tel_no'])) {
			
			$booking_appmt_id = $_POST['booking_appmt_id'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$tel_no = $_POST['tel_no'];
			$emailaddress = $_POST['emailaddress'];

			$update_cust['first_name'] = $first_name;
			$update_cust['last_name'] = $last_name;
			$update_cust['tel_no'] = $tel_no;
			$update_cust['emailaddress'] = $emailaddress;
			
			echo '<pre>';
			print_r($update_cust);
			echo '</pre>';
		 
		 
			$object = new CRUD();
		 
			$object->update_customer($update_cust, $customer_id);
		 		 
			//$object->update_customer($first_name, $last_name, $tel_no, $customer_id);
		}
		exit();
		break;
		
		
/*	case 'create_product' :
	
		$title = $_POST['title'];
		$short_description = $_POST['short_description'];
		
		echo $title . ' - ' . $short_description;
		
		$object = new CRUD();
		$create_product = $object->create_product($title, $short_description);
		
		echo '<meta http-equiv="refresh" content="0; URL=index.php" />';
		exit();
		break;*/
}
?>
