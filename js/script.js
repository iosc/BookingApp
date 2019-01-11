switch (document.location.hostname)
{
	case 'vdo.my':
		var rootFolder = '';
		var doc_root = rootFolder;
		break;

case 'localhost' :
	var rootFolder = '';
	var doc_root = rootFolder;
	break;

	case 'localhost:8081' :
		var rootFolder = '';
		var doc_root = rootFolder;
		break;

	default :  // set whatever you want
		var rootFolder = '';
		var doc_root = '';
		break;
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

// Add Record
function addRecord() {
    // get values
    var first_name = $("#first_name").val();
    first_name = first_name.trim();
    var last_name = $("#last_name").val();
    last_name = last_name.trim();
    var tel_no = $("#tel_no").val();
    tel_no = tel_no.trim();
    var emailaddress = $("#emailaddress").val();
    emailaddress = emailaddress.trim();

    if (first_name == "") {
        alert("First name field is required!");
    }
    else if (last_name == "") {
        alert("Last name field is required!");
    }
    else if (tel_no == "") {
        alert("Contact No. field is required!");
    }
    else if (emailaddress == "") {
        alert("Email Address field is required!");
    }
    else if (!isEmail(emailaddress)) {
        alert("Email Address not valid!");
    }
    else {
        // Add record
		//alert(first_name + last_name + tel_no);
		//console.log(doc_root + "request.php?a=create_customer");
		//alert(document.location.hostname);
		//alert(doc_root + "request.php?a=create_customer");

        $.post(doc_root + "request.php?a=create_customer", {
            first_name: first_name,
            last_name: last_name,
            tel_no: tel_no,
            emailaddress: emailaddress
        }, function (data, status) {
            // close the popup
            $("#add_new_record_modal").modal("hide");

			//debug php log
        	$("#log_debug_div").html(data);

			//console.log(doc_root + "request.php?a=create_customer " + first_name + last_name + tel_no);

            // read records again
            readRecords();

            // clear fields from the popup
            $("#first_name").val("");
            $("#last_name").val("");
            $("#tel_no").val("");
           	$("#emailaddress").val("");
        });
    }
}

/*Read Records:*/

// READ records
function readRecords() {
    $.get("read.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

/*Get details:*/

function GetCustomerDetails(customer_id) {
    // Add Customer ID to the hidden field
    $("#hidden_customer_id").val(customer_id);
	console.log(doc_root + "request.php?a=customer_details " + customer_id);

    $.post(doc_root + "request.php?a=customer_details", {
            customer_id: customer_id
        },
        function (data, status) {

  			//debug php log
        	//$("#log_debug_div").html(data);

			// PARSE json data
            var customer = JSON.parse(data);
			console.log(customer);
            // Assign existing values to the modal popup fields
            $("#update_first_name").val(customer.first_name);
            $("#update_last_name").val(customer.last_name);
            $("#update_tel_no").val(customer.tel_no);
            $("#update_emailaddress").val(customer.emailaddress);
       }
    );
    // Open modal popup
    $("#update_customer_modal").modal("show");
}

/*Update Record:*/

function UpdateCustomerDetails() {
    // get values
    var first_name = $("#update_first_name").val();
    first_name = first_name.trim();
    var last_name = $("#update_last_name").val();
    last_name = last_name.trim();
    var tel_no = $("#update_tel_no").val();
    tel_no = tel_no.trim();
	var emailaddress = $("#update_emailaddress").val();
    emailaddress = emailaddress.trim();

    if (first_name == "") {
        alert("First name field is required!");
    }
    else if (last_name == "") {
        alert("Last name field is required!");
    }
    else if (tel_no == "") {
        alert("Contact No. field is required!");
    }
    else if (emailaddress == "") {
        alert("Email Address field is required!");
    }
    else if (!isEmail(emailaddress)) {
        alert("Email Address not valid!");
    }
    else {
        // get hidden field value
        var customer_id = $("#hidden_customer_id").val();

        // Update the details by requesting to the server using ajax
        $.post(doc_root + "request.php?a=update_customer", {
                customer_id: customer_id,
                first_name: first_name,
                last_name: last_name,
                tel_no: tel_no,
                emailaddress: emailaddress
            },
            function (data, status) {
				//debug php log
				$("#log_debug_div").html(data);

				console.log(data);

                // hide modal popup
                $("#update_customer_modal").modal("hide");
                // reload Customers by using readRecords();
                readRecords();
            }
        );
    }
}

/*Delete Record:*/

function DeleteCustomer(customer_id) {
    var conf = confirm("Are you sure, do you really want to delete Customer No." + customer_id + "?");
    if (conf == true) {
        $.post(doc_root + "request.php?a=delete_customer", {
                customer_id: customer_id
            },
            function (data, status) {
                // reload Customers by using readRecords();
                readRecords();
            }
        );
    }
}

/*Bookings:*/
// READ records
function readBookingRecords() {
    $.get("bookings.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

function bookingAppointment(customer_id) {
    // Add Customer ID to the hidden field
    $("#hidden_bookingAppointment_customer_id").val(customer_id);
	console.log(doc_root + "request.php?a=booking_appointment " + customer_id);

    $.post(doc_root + "request.php?a=booking_appointment", {
            customer_id: customer_id
        },
        function (data, status) {

  			//debug php log
        	//$("#log_debug_div").html(data);

			// PARSE json data
            var customer = JSON.parse(data);
			console.log(customer);
            // Assign existing values to the modal popup fields
            $("#show_bookingAppointment_customer_data").html(customer.customer_id + ' - ' + customer.first_name + ', ' + customer.last_name + '<br />Tel. No. : ' + customer.tel_no + '<br />Email : ' + customer.emailaddress + '<br /><br />');
       }
    );
    // Open modal popup
    $("#add_booking_appointment_modal").modal("show");
}

function AddBookingAppointment() {
    // get values
    var customer_id = $("#hidden_bookingAppointment_customer_id").val();
    var bookingAppointment_staff_id = $("#bookingAppointment_staff_id").val();
    var bookingAppointment_date = $("#bookingAppointment_date").val();
    var bookingAppointment_time = $("#bookingAppointment_time").val();

        // Add record
		//alert(customer_id + bookingAppointment_staff_id + bookingAppointment_date + bookingAppointment_time);
		console.log(doc_root + "request.php?a=add_booking_appointment");
		//alert(document.location.hostname);
		//alert(doc_root + "request.php?a=add_booking_appointment");

        $.post(doc_root + "request.php?a=add_booking_appointment", {
            customer_id: customer_id,
            bookingAppointment_staff_id: bookingAppointment_staff_id,
            bookingAppointment_date: bookingAppointment_date,
            bookingAppointment_time: bookingAppointment_time
		}, function (data, status) {
		// close the popup
		$("#add_booking_appointment_modal").modal("hide");

		//debug php log
		$("#log_debug_div").html(data);

		//console.log(doc_root + "request.php?a=create_customer " + first_name + last_name + tel_no);

		// read records again
		readRecords();

		// clear fields from the popup
		$("#customer_id").val("");
		//$("#bookingAppointment_staff_id").val("");
		//$("#bookingAppointment_date").val("");
		//$("#bookingAppointment_time").val("");

		//$("#log_debug_div").html('add_booking_appointment();');

	});
}


/*Update Record:*/

function UpdateAppmt() {
    // get values
    var first_name = $("#update_first_name").val();
    first_name = first_name.trim();
    var last_name = $("#update_last_name").val();
    last_name = last_name.trim();
    var tel_no = $("#update_tel_no").val();
    tel_no = tel_no.trim();
	var emailaddress = $("#update_emailaddress").val();
    emailaddress = emailaddress.trim();

    if (first_name == "") {
        alert("First name field is required!");
    }
    else if (last_name == "") {
        alert("Last name field is required!");
    }
    else if (tel_no == "") {
        alert("Contact No. field is required!");
    }
    else if (emailaddress == "") {
        alert("Email Address field is required!");
    }
    else if (!isEmail(emailaddress)) {
        alert("Email Address not valid!");
    }
    else {
        // get hidden field value
        var customer_id = $("#hidden_customer_id").val();

        // Update the details by requesting to the server using ajax
        $.post(doc_root + "request.php?a=update_customer", {
                customer_id: customer_id,
                first_name: first_name,
                last_name: last_name,
                tel_no: tel_no,
                emailaddress: emailaddress
            },
            function (data, status) {
				//debug php log
				$("#log_debug_div").html(data);

				console.log(data);

                // hide modal popup
                $("#update_customer_modal").modal("hide");
                // reload Customers by using readRecords();
                readRecords();
            }
        );
    }
}

/*Delete Record:*/

function DeleteAppmt(booking_appmt_id) {
    var conf = confirm("Are you sure, do you really want to delete this appointment No." + booking_appmt_id + "?");
    if (conf == true) {
        $.post(doc_root + "request.php?a=delete_appmt", {
                booking_appmt_id: booking_appmt_id
            },
            function (data, status) {
                // reload Customers by using readRecords();
                readBookingRecords();
            }
        );
    }
}

/* initialising startup */


$(document).ready(function () {
    // READ records on page load
    readRecords(); // calling function
});
