<?
include('app_top.php');
include('includes/customer.php');
$page_title = 'Home';
include('header.php');
?>

<div class="container">
	<div class="row">
<?
//booking_listing("SELECT * FROM room_list ORDER BY room_num ASC");
?>
	</div>

    <div class="row">
        <div class="col-md-12">
            <div class="records_content"></div>
        </div>
    </div>
</div>

<?
add_customer();

update_customer();

add_booking_appointment();
?>

<?
include('footer.php');
?>