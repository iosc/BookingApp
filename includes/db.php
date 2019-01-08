<?
// DATABASE connection
function DB()
{
    static $instance;
    if ($instance === null) {
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
        );
        $dsn = 'mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=' . CHARSET;
        $instance = new PDO($dsn, USER, PASSWORD, $opt);
    }
    return $instance;
}

class CRUD
{
    protected $db;
    function __construct()
    {
        $this->db = DB();
    }
    function __destruct()
    {
        $this->db = null;
    }
	
    public function read($query)
    {
        $query = $this->db->prepare($query);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function read2($query)
    {
        $query = $this->db->prepare($query);
        $query->execute();
        $data = $row = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function read_array($query)
    {
        $query = $this->db->prepare($query);
        $query->execute();
		$result = $query->fetchAll(PDO::FETCH_COLUMN, 0);

        return $result;
    }
	
    public function create_customer($xarray)
    {
		$bindingfieldName = '';
		$binding2fieldName = '';
		
		foreach ($xarray as $fieldName => $datavalue)
		{
			//echo $fieldName . ', ' . $datavalue . '<br />';
			
			$bindingfieldName .= $fieldName.', ';
			$binding2fieldName .= ':'.$fieldName.', ';
		}
		
		$bindingfieldName = rtrim($bindingfieldName,", ");;
		$binding2fieldName = rtrim($binding2fieldName,", ");;

		$stmt = 'INSERT INTO customer (' . $bindingfieldName . ') VALUES ( ' . $binding2fieldName . ');';
		//echo $stmt;
		$query = $this->db->prepare($stmt);

		foreach ($xarray as $fieldName => &$datavalue)
		{
			$query->bindParam($fieldName , $datavalue, PDO::PARAM_STR);
		}
		$query->execute();
      	return $this->db->lastInsertId();	  
    }

 
    /*
     * Delete Record
     *
     * @param $customer_id
     * */
    public function delete_customer($customer_id)
    {
        $query = $this->db->prepare("DELETE FROM customer WHERE customer_id = :customer_id");
        $query->bindParam("customer_id", $customer_id, PDO::PARAM_STR);
        $query->execute();
    }
 
    /*
     * Update Record
     *
     * @param $first_name
     * @param $last_name
     * @param $email
     * @return $mixed
     * */
    //public function update_customer($first_name, $last_name, $tel_no, $customer_id)
    public function update_customer($xarray, $customer_id)
    {

		$bindingfieldName = '';
		$binding2fieldName = '';
		
		foreach ($xarray as $fieldName => $datavalue)
		{
			//echo $fieldName . ', ' . $datavalue . '<br />';
			
			$bindingfieldName .= $fieldName.', ';
			$binding2fieldName .= $fieldName.' = :'.$fieldName.', ';
		}
		
		$bindingfieldName = rtrim($bindingfieldName,", ");;
		$binding2fieldName = rtrim($binding2fieldName,", ");;

		$stmt = "UPDATE customer SET $binding2fieldName WHERE customer_id = :customer_id; ";
		echo $stmt;
		
		$query = $this->db->prepare($stmt);

		$query->bindParam('customer_id' , $customer_id, PDO::PARAM_INT);

		foreach ($xarray as $fieldName => &$datavalue)
		{
			$query->bindParam($fieldName , $datavalue, PDO::PARAM_STR);
		}
		$query->execute();

	}
 
    /*
     * Get Details
     *
     * @param $customer_id
     * */
    public function customer_details($customer_id)
    {
        $query = $this->db->prepare("SELECT * FROM customer WHERE customer_id = :customer_id");
        $query->bindParam("customer_id", $customer_id, PDO::PARAM_STR);
        $query->execute();
        return json_encode($query->fetch(PDO::FETCH_ASSOC));
    }
 
    public function create_product($title, $short_description)
    {
      $query = $this->db->prepare("INSERT INTO products (title, short_description) VALUES (:title, :short_description)");
      $query->bindParam("title", $title, PDO::PARAM_STR);
      $query->bindParam("short_description", $title, PDO::PARAM_STR);
      $query->execute();
      return $this->db->lastInsertId();
    }
	
    public function create_booking($xarray, $tbl)
    {
		$bindingfieldName = '';
		$binding2fieldName = '';
		
		foreach ($xarray as $fieldName => $datavalue)
		{
			//echo $fieldName . ', ' . $datavalue . '<br />';
			
			$bindingfieldName .= $fieldName.', ';
			$binding2fieldName .= ':'.$fieldName.', ';
		}
		
		$bindingfieldName = rtrim($bindingfieldName,", ");;
		$binding2fieldName = rtrim($binding2fieldName,", ");;

		$stmt = 'INSERT INTO '.$tbl.' (' . $bindingfieldName . ') VALUES ( ' . $binding2fieldName . ');';
		//echo $stmt;
		$query = $this->db->prepare($stmt);

		foreach ($xarray as $fieldName => &$datavalue)
		{
			$query->bindParam($fieldName , $datavalue, PDO::PARAM_STR);
		}
		$query->execute();
      	return $this->db->lastInsertId();	  
    }

    public function delete_appmt($booking_appmt_id)
    {
        $query = $this->db->prepare("DELETE FROM booking_appmt WHERE booking_appmt_id = :booking_appmt_id");
        $query->bindParam("booking_appmt_id", $booking_appmt_id, PDO::PARAM_STR);
        $query->execute();
    }

 
	
}
?>
