
<?php
	include("config.php");
	
	$result = mysqli_query($conn, "select * from user where browser = 'Lynx' ");
  $data = array();
  while ($row = mysqli_fetch_array($result)) {
    $data[] = array("name"=>$row['name'],"email"=>$row['email'],"reason"=>$row['reason'],"browser"=>$row['browser'],"date"=>$row['date'],"time"=>$row['time']);
  }
      echo json_encode($data);
	    
?>