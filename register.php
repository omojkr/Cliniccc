<?php
include 'db.php';

if(isset($_POST['reg_user'])){
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $middleInitial = mysqli_real_escape_string($con, $_POST['middleInitial']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contact_number = mysqli_real_escape_string($con, $_POST['contact_number']);
    $dateofbirth = mysqli_real_escape_string($con, $_POST['dateofbirth']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);


    

if(empty($firstName)){
    $error=" First name is required!";
}
elseif (empty($middleInitial)){
    $error=" Middle initial is required!";
}
elseif (empty($lastName)){
    $error=" Last name is required!";
}
elseif ($password != $confirm_password){
    $error=" Password does not match";
}
elseif(strlen($password) <5){
    $error=" Password must be at least 5 characters";
}
else{
    $check_email = "SELECT*FROM registered_users WHERE email='$email'";
    $data = mysqli_query($con,$check_email);
    $result = mysqli_fetch_array($data);
    if($result>0){
        $error=" Email already exist!";
    }
else{
    $password = ($confirm_password);
    $insert = "INSERT INTO registered_users (firstName, middleInitial, lastName, email, contact_number, dateofbirth, gender, address, password, confirm_password) 
    VALUES ('$firstName', '$middleInitial', '$lastName', '$email', '$contact_number', '$dateofbirth', '$gender', '$address', '$password', '$confirm_password')";
    $q = mysqli_query($con, $insert);
    if($q){
        $success = "  Your account has been created!";
    }
}
}
}



?>
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
    <title>Register</title>

     <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

     <!-- Custom styles for this template-->
         <link href="1.css" rel="stylesheet">
         
</head>

<body>
    <div class="hero">
        <div class="form-box">
            <form method="POST" action="register.php" class="input-group">           
               <img class="logo" src="logo.jpg"><br><br>

                 <h2>REGISTER</h2>
                 
            <?php 
                if(isset($error)){
                    echo '<span class="error">' .$error . '</span>';
                }elseif(isset($success)){
                    echo '<span class="success">' .$success. '</span>';
                }
            ?>
              
        
        

    <div class="half">
        <div class="item">
            <label for="firstName">First Name</label>
          <input type="text" class="input-field" name="firstName" placeholder=" First Name" required value="<?php 
                if(isset($error)){
                    echo $firstName;
            } ?>">
        </div>
        <div class="item">
            <label for="middleInitial">Middle Initial</label>
                <input type="text" class="input-field" name="middleInitial" placeholder=" Middle Initial" required value="<?php 
                if(isset($error)){
                    echo $middleInitial;
            } ?>">
        </div>
        <div class="item">
            <label for="lastName">Last Name</label>
                <input type="text" class="input-field" name="lastName" placeholder=" Last Name" required value="<?php 
                if(isset($error)){
                    echo $lastName;
            } ?>">
        </div>
    </div>

    <div class="half">
        <div class="item">
            <label for="email">Email</label>
          <input type="text" class="input-field" name="email" placeholder=" Email" required value="<?php 
                if(isset($error)){
                    echo $email;
            } ?>">
        </div>
        <div class="item">
            <label for="contact_number">Contact Number</label>
                <input type="text" class="input-field" name="contact_number" placeholder=" Contact Number" required value="<?php 
                if(isset($error)){
                    echo $contact_number;
            } ?>">
        </div>
        <div class="item">
            <label for="gender">Gender</label>
                <select class="input-field" name="gender" value="<?php 
                if(isset($error)){
                    echo $gender;
            } ?>">
                    <option>...</option>
                    <option> Male </option>
                    <option> Female </option>
                </select>
        </div>
        <div class="item">
            <label for="dateofbirth">Date of Birth</label>
                <input type="text" class="input-field" name="dateofbirth" placeholder="00/00/0000" required value="<?php 
                if(isset($error)){
                    echo $dateofbirth;
            } ?>">
        </div>
    </div>

    <div class="full">
            <label for="address">Address</label>
                <input type="text" class="input-field" name="address" placeholder=" Address" required value="<?php 
                if(isset($error)){
                    echo $address;
            } ?>"><br>
            <label for="password">Password</label>
                <input type="password" class="input-field" name="password" placeholder="" required value=""><br>
            <label for="confirm_password">Confirm Password</label>
                <input type="password" class="input-field" name="confirm_password" placeholder="" required value=""><br>
    </div>
            <button type="submit" class="submit-btn" name="reg_user"> Register </button>  
            <br><a href="login.php" class="notice"> Already have an account? Log in here. </a>
             </form>
        </div>
    </div>

   

               
</body>
</html>