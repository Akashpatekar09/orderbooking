<?php
$username = $_POST['username'];
$password = $_POST['password'];



$conn = new mysqli('localhost','root','','test');
if($conn->connect_error){
    die('Connection Failed :'.$conn->connect_error);

}else{

$stmt =$conn->prepare("select * from registration where username=?");
$stmt->bind_param("s",$username);
$stmt->execute();
$stmt_result=$stmt->get_result();
if($stmt_result->num_rows>0) {
    $data = $stmt_result->fetch_assoc();
    if ($data['password'] === $password) {
        echo "<h2> Login sucessfully</h2>";
        echo "<script>localStorage.setItem('loggedInUsername', '$username');</script>";
    }
    else{
        echo "<h2> Invalid Email or Password</h2>";
    }
}

$stmt->close();
$conn->close();

}


?>
<form action="main.html">
    <input type="submit" value="OK">
</form>
