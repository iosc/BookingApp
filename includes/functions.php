<?
require_once('db.php');
require_once('booking.php');

function return_value($query) //"SELECT * FROM booking
{
	$object = new CRUD();

	$item = $object->read($query . " LIMIT 1");

	if (!empty($item)) {
		return $item[0];
	}
}

function return_array($query) //"SELECT * FROM booking
{
	$object = new CRUD();

	$item = $object->read($query);

	if (!empty($item)) {
		return $item;
	}
}

function return_array_2($query) //"SELECT * FROM booking
{
	$object = new CRUD();

	$item = $object->read2($query);

	if (!empty($item)) {
		return $item;
	}
}

?>