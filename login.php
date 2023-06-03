<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript" type="text/javascript">
window.history.forward();
</script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>

     <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

     <!-- Custom styles for this template-->
         <link href="login.css" rel="stylesheet">
         
</head>

<body>
    <div class="hero">
        <div class="form-box">           
        <form method="POST" action="" id="login" class="input-group">  
            <img class="logo" src="logo.jpg"><br><br>
            <br><br><br>
            <br><br><br>
            <input type="text" class="input-field" name="email" placeholder="Email" required><hr><br>
            <input type="password" class="input-field" name="password" placeholder="Enter Password" required><hr><br>
            <input type="checkbox" class="chech-box"><span> Remember Me </span><br>
            <br><br><button type="submit" class="submit-btn" name="login_user"> Log in </button>
            <br><a href="register.php" class="noticee"> No account? Click to register </a>
        </form>
        <?php 
        include 'db.php';
        if(isset($_POST['login_user'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $select = "SELECT * FROM registered_users WHERE email='$email' && password='$password'";
            $query = mysqli_query($con, $select);
            $row = mysqli_num_rows($query);
            $fetch = mysqli_fetch_array($query);
            if($row==1){
                $email=$fetch['email'];    
                session_start();
                $_SESSION['email']=$email;
                header('location:admin/index.php');
            }else{  
                echo "Invalid Email/Password";
            }
        }

        ?>
        <br>       
        </div>
    </div>

</body>
</html>