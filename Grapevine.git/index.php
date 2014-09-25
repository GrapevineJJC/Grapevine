<!DOCTYPE="html">
<html>
<head>
<meta charset="UTF-8">
<title>Grapevine!</title>


<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style type="text/css">
p{
    font-size: 15px;
    text-align: center;
}
</style>
</head>
<body>
<center>


<h1>Welcome to Grapevine.</h1><br/>



<!-- REGISTER AN ACCOUNT -->
<form class="well" method="post" action="dbopsUSERS.php">
<h3>1. Sign Up!</h3><br/>

<input type="text" name="firstName", id="firstName "placeholder="First Name" /><br/><br/>
<input type="text" name="lastName", id="lastName" placeholder="Last Name" /><br/><br/>
<input type="text" name="username", id="username" placeholder="Username" /><br/><br/>
<input type="text" name="email", id="email" placeholder="Email" /><br/><br/>
<input type="password" name="password", id="password" placeholder="Password" /><br/><br/>
<input type="text" name="bio", id="bio" placeholder="Bio" /><br/><br/>

<select name="group">
    <option name="group" value="bc">Boston College</option>
    <option name="group" value="bu">Boston University</option>
    <option name="group" value="nu">Northeastern University</option>
    <option name="group" value="hu">Harvard University</option>
</select><br/><br/>

<input type="submit" name="submit" class="btn btn-success" value="Register" />

</form>

<?php
    //If submits form, grab information
    if(isset($_POST['submit'])){
        handleform();
    }
    
    function handleform(){
        echo "Submit was clicked<br/>";
    }
?>


<br/><br/><br/>

<!-- CREATE A BUCKETLIST -->
<form class="well" method="post" action="dbopsBLS.php">
<h3>2. Create a Bucket List!</h3><br/>

<input type="text" name="BLname", id="BLname "placeholder="Bucket List Name" /><br/><br/>

<input type="submit" name="submitBL" class="btn btn-success" value="Create Bucket List" />

</form>


<?php
    //If submits form, grab information
    if(isset($_POST['submitBL'])){
        $BLname = $_POST['BLname'];
        
        handleformBL($BLname);

    }
    
    function handleformBL($BLname){
        echo "Bucket List name is $BLname <br/>";
    }
?>

<br/><br/><br/>

<!-- CREATE AN ITEM -->
<form class="well" method="post" action="dbopsBLItems.php">
<h3>3. Create a Bucket List Item!</h3><br/>

<input type="text" name="itemName", id="itemName" placeholder="Item Name" /><br/><br/>
<input type="text" name="itemAddress", id="itemAddress" placeholder="Address" /><br/>

<br/>
<input type="submit" name="submitBLitem" class="btn btn-success" value="Create Bucket List Item" />

</form>

<?php
    //If submits form, grab information
    if(isset($_POST['submitBLitem'])){
        $itemName = $_POST['itemName'];
        $itemAddress = $_POST['itemAddress'];
        
        handleformBLitem($itemName, $itemAddress);
    }
    
    function handleformBLitem($itemName, $itemAddress){
        echo "Bucket List Item is $itemName <br/>";
        echo "Item Address is $itemAddress <br/>";
    }
?>




</body>
</html>