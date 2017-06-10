<?php
include("config.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$name = $_POST["name"];
	$email = $_POST["email"];
	$reason = $_POST["reason"];
	$browser = $_POST["browser"];
  $look = "SELECT email FROM user WHERE email = '$email'";
  $ans = mysqli_query($conn, $look);
  $count = mysqli_num_rows($ans);
  if ($count > 0){
    $sql = "UPDATE user SET name = '$name', reason = '$reason', browser = '$browser' ,time = CURTIME(), date = CURDATE() WHERE email = '$email' ";
    $go = mysqli_query($conn, $sql);
  }
  else{
    $sql = "INSERT INTO user VALUES('$name', '$email', '$reason', '$browser',CURDATE(),CURTIME())";
    $go = mysqli_query($conn, $sql);
  }
	
  //email code
  $to = $email;
  $from = "anujjangre25119@gmail.com";
  $subject = "Displaying Records";
  $message = "Hello, you have entered "."\n".$name."\n".$email."\n".$reason."\n".$browser;
  $headers = "From:" . $from;
  mail($to,$subject,$message,$headers);
}
  //upto here
 
//queries
  $fire = mysqli_query($conn, "select count(email) from user where browser = 'Firefox' ");
?>

<!DOCTYPE html>
<html>
<head>
	<title>DTUhub</title>
	 <script type="text/javascript" src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
	 <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
      #myProgress {
        width: 100%;
        background-color: #ddd;
      }

      #myBar {
       
        height: 30px;
        background-color: #4CAF50;
        text-align: center;
        line-height: 30px;
        color: white;
      }
</style>
</head>
<body ng-app="myApp" >
<div class="container">
  <h2>Favourite Web Browser</h2>
  <form class="form-horizontal" action="" name="myForm" method="POST">
    <div class="form-group">
      <label class="control-label col-sm-2" >Name:</label>
      <div class="col-sm-10">
        <input class="form-control"  placeholder="Enter Name" name="name"  ng-model="myInput" required = "Enter your name" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Email:</label>
      <div class="col-sm-10">          
        <input type="email" class="form-control"  placeholder="Enter Email" name="email" required="Enter Your email" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Reason:</label>
      <div class="col-sm-10">          
        <textarea class="form-control"  placeholder="Enter You Reason" name="reason" required ></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >Select your Browser:</label>
      <div class="col-sm-10">          
        <select class="form-control" name="browser">
        	<option value="Internet Explorer">Internet Explorer</option>
        	<option value="Firefox">FireFox</option>
        	<option value="Safari">Safari</option>
        	<option value="Chrome">Chrome</option>
        	<option value="Opera">Opera</option>
        	<option value="Konqueror">Konqueror</option>
        	<option value="Lynx">Lynx</option>
        </select>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" ">Submit</button>
      </div>
    </div>
  </form>
  

<div  ng-controller = "userCtrl">
  <h1>Statistics</h1>
  <h4>Internet Explorer: {{ie.length/names.length*100}}% Fans</h4>
  <div  style ="width: {{ie.length/names.length*100}}%;" id="myProgress">
  <div id="myBar">{{ie.length/names.length*100}}%</div>
  </div><br>
    <h4>Firefox: {{fire.length/names.length*100}}% Fans</h4>
  <div  style ="width: {{fire.length/names.length*100}}%;" id="myProgress">
  <div id="myBar">{{fire.length/names.length*100}}%</div>
  </div><br>
    <h4>Safari: {{safari.length/names.length*100}}% Fans</h4>
  <div  style ="width: {{safari.length/names.length*100}}%;" id="myProgress">
  <div id="myBar">{{safari.length/names.length*100}}%</div>
  </div><br>
    <h4>Chrome: {{chrome.length/names.length*100}}% Fans</h4>
  <div  style ="width: {{chrome.length/names.length*100}}%;" id="myProgress">
  <div id="myBar">{{chrome.length/names.length*100}}%</div>
  </div><br>
    <h4>Opera: {{opera.length/names.length*100}}% Fans</h4>
  <div  style ="width: {{opera.length/names.length*100}}%;" id="myProgress">
  <div id="myBar">{{opera.length/names.length*100}}%</div>
  </div><br>
    <h4>Konqueror: {{konqueror.length/names.length*100}}% Fans</h4>
  <div  style ="width: {{konqueror.length/names.length*100}}%;" id="myProgress">
  <div id="myBar">{{konqueror.length/names.length*100}}%</div>
  </div><br>
    <h4>Lynx: {{lynx.length/names.length*100}}% Fans</h4>
  <div  style ="width: {{lynx.length/names.length*100}}%;" id="myProgress">
  <div id="myBar">{{lynx.length/names.length*100}}%</div>
  </div><br>
  


  <h1>Records</h1>
  <table class="table table-striped">
 
  <tr>
  <th>Name</th>
  <th>Email</th>
  <th>Reason</th>
  <th>Browser</th>
  <th>Time</th>
  </tr>
  
  <!-- Display records -->
  <tr ng-repeat="user in names">
  <td>{{user.name}}</td>
  <td>{{user.email}}</td>
  <td>{{user.reason}}</td>
  <td>{{user.browser}}</td>
  <td>{{user.time}}</td>
  </tr>
 
  </table>
</div>
</div>
<script>
var app = angular.module('myApp', []);

app.controller('userCtrl',function ($scope, $http) {
  $http.get("result.php")
  .then(function(response){
    $scope.names = response.data;
  });
  $http.get("fire.php")
  .then(function(response){
    $scope.fire = response.data;
  });
  $http.get("ie.php")
  .then(function(response){
    $scope.ie = response.data;
  });
  $http.get("chrome.php")
  .then(function(response){
    $scope.chrome = response.data;
  });
  $http.get("safari.php")
  .then(function(response){
    $scope.safari = response.data;
  });
  $http.get("opera.php")
  .then(function(response){
    $scope.opera = response.data;
  });
  $http.get("lynx.php")
  .then(function(response){
    $scope.lynx = response.data;
  });
  $http.get("konqueror.php")
  .then(function(response){
    $scope.konqueror = response.data;
  });
} );
</script>
<script>
    var myvar = <?php echo json_encode($fire); ?>;
</script>
</body>
</html>