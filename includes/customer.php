<?
//Elson
function add_customer()
{
?>
<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/Customer -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="First Name" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="tel_no">Contact No.</label>
                    <input type="text" id="tel_no" name="tel_no" placeholder="Contact No." class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="emailaddress">Email Address</label>
                    <input type="text" id="emailaddress" name="emailaddress" placeholder="Email Address" class="form-control"/>
                </div>

<?php /*?>
                <div class="form-group">
                    <label for="check_in">Check In</label>
                    <input type="text" id="check_in" placeholder="Check In" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="check_out">Check Out</label>
                    <input type="text" id="check_out" placeholder="Check Out" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="day_stay">Day Stay</label>
                    <input type="text" id="day_stay" placeholder="Day Stay" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="arrival_time">Arrival Time</label>
                    <input type="text" id="arrival_time" placeholder="Arrival Time" class="form-control"/>
                </div>

                 <div class="form-group">
                    <label for="room_rate">Room Rate</label>
                    <input type="text" id="room_rate" placeholder="Room Rate" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <input type="text" id="remarks" placeholder="Remarks" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="staus">Status</label>
                    <input type="text" id="status" placeholder="Status" class="form-control"/>
                </div>

<?php */?>
			</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRecord();">Add Record</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
<?
}

function update_customer()
{?>
<!-- // Modal -->
<!-- Modal - Update Customer details -->
<div class="modal fade" id="update_customer_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Update</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="update_first_name">First Name</label>
                    <input type="text" id="update_first_name" name="update_first_name"  placeholder="First Name" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_last_name">Last Name</label>
                    <input type="text" id="update_last_name" name="update_last_name" placeholder="Last Name" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_tel_no">Contact No.</label>
                    <input type="text" id="update_tel_no" name="update_tel_no" placeholder="Contact No." class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_emailaddress">Email Address</label>
                    <input type="text" id="update_emailaddress" name="update_emailaddress" placeholder="Email Address" class="form-control"/>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateCustomerDetails()" >Save Changes</button>
                <button type="button" class="btn btn-secondary" onclick="UpdateCustomerDetails()" >Upgrade to User</button>
                <input type="hidden" id="hidden_customer_id">
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
<?
}


?>
