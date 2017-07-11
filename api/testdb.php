<?php
class db {
	private $conn;
	private $host;
	private $user;
	private $password;
	private $baseName;

	function __construct($params=array()) {
		$this->conn = false;
		$this->host = 'localhost'; //hostname
		$this->user = 'root'; //username
		$this->password = 'root'; //password
		$this->baseName = 'apidb'; //name of your database
		$this->connect();
	}

	function __destruct() {
		$this->disconnect();
	}

	function connect() {
		if (!$this->conn) {
			$this->conn = mysql_connect($this->host, $this->user, $this->password);
			mysql_select_db($this->baseName, $this->conn);
			mysql_set_charset('utf8',$this->conn);

			if (!$this->conn) {
				$this->status_fatal = true;
				echo 'Connection BDD failed';
				die();
			}
			else {
				$this->status_fatal = false;
			}
		}

		return $this->conn;
	}

	function disconnect() {
		if ($this->conn) {
			@pg_close($this->conn);
		}
	}

	function execute($query,$use_slave=false) { // execute function: to use INSERT or UPDATE
		$cnx = $this->conn;
		if (!$cnx||$this->status_fatal) {
			return null;
		}

		$cur = @mysql_query($query, $cnx);

		if ($cur == FALSE) {
			$ErrorMessage = @mysql_last_error($cnx);
			$this->handleError($query, $ErrorMessage);
		}
		else {
			$this->Error=FALSE;
			$this->BadQuery="";
			$this->NumRows = mysql_affected_rows();
			return;
		}
		@mysql_free_result($cur);
	}

	function handleError($query, $str_erreur) {
		$this->Error = TRUE;
		$this->BadQuery = $query;
		if ($this->Debug) {
			echo "Query : ".$query."<br>";
			echo "Error : ".$str_erreur."<br>";
		}
	}
}






// 
// <?php
//   class DB{
//       public $db ;
//       function __construct(){
//           $this->db = mysqli_connect('localhost','root','root','apidb');
//           echo "ok <br>";
//           if( mysqli_connect_error()){
//                 echo "Can not connect";
//                 exit;
//           }
//           echo "ok2 <br>";
//         //  echo $db. "<br>";
//
//
//       }
//
//       function executeQueries($query){
//           //extract($userData);
//           //print_r($userData);
//           //$query = "insert into Users (fname,lname,username,email,passwd) values('".$fname_f."', '".$lname_f."' , '".$username_f."' , '".$email_f."' , '".$passwd_f."' );";
//           // echo $db." <br>";
//           // print_r($db);
//           // echo "ok2 <br>";
//           $result = mysqli_query($this->db , $query);
//           // echo "he is : ".$result."<br>";
//           if(! $result){
//             echo "laaaa";
//               return False;
//
//           }else{
//             echo "yeeeeeees";
//               return True;
//             }
//             mysqli_close($this->db);
//           }
//
//       }
//
//
//  ?>
