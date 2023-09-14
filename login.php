<?php
include 'connect.php';
///for log out ----------------------

session_start();

//-----------------



$empty_email = $empty_password = '';
if(isset($_POST['submit'])){
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $md5_user_password = md5($user_password);

    if(empty($user_email)){
        $empty_email = 'Fill up the field';
    }
    if(empty($user_password)){
        $empty_password = 'Fill up the field';
    }

    if(!empty($user_email) && !empty($user_password)){
        $sql = "SELECT * FROM log_reg WHERE user_email = '$user_email' AND user_password = '$md5_user_password'";
        $query = $conn->query($sql);
        if($query->num_rows > 0){
            // echo 'found';
            $_SESSION['login'] = "login success" ;
            header ('location:welcome.php');

        }else{
            echo 'not found';
            // echo $sql;


        }
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <h4>Login Page</h4>
    
    <div class="container">
        <?php
        if(isset($_GET['usercreated']) ){
            echo "Registration Success";
        }
        ?>
    <form action ="login.php" method = "post">
  <div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name = "user_email" value = "<?php if(isset($_POST['submit'])){echo $user_email;}?>">
    <?php if(isset($_POST['submit'])){echo "<span class = 'text-danger'>". $empty_email. "<span>";} ?>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" name = "user_password" value = "<?php if(isset($_POST['submit'])){echo $user_password;}?>">
    <?php if(isset($_POST['submit'])){echo "<span class = 'text-danger'>". $empty_password. "<span>";} ?>
  </div>
  <button type="submit" class="btn btn-primary" name = "submit">Login</button>
</form>
<h5>Not have account? <a href="user.php">Register</a></h5>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>