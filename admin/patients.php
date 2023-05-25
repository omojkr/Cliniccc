<?php
session_start();
include('db.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
<script language="javascript" type="text/javascript">
window.history.forward();
</script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Patients</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        table{
            table-layout: fixed;
            border: 2px;           
        }

        td{
            width: 33%;            
        }

        .today{
            background-color: #FFF169;
            
            
        }

        i {
            margin-right: 10px;
        }

        .buttonapprove {
            display: inline-block;
            font-weight: 400;
            color: #fff;
            text-align: center;
            vertical-align: middle;            
            background-color: #1cc88a;
            border: 1px solid #1cc88a;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .35rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            transition-duration: 0.15s, 0.15s, 0.15s, 0.15s;
            transition-timing-function: ease-in-out, ease-in-out, ease-in-out, ease-in-out;
            transition-delay: 0s, 0s, 0s, 0s;
            transition-property: color, background-color, border-color, box-shadow;
        }

        .buttonapprove:hover {
            color: #fff;
            background-color: #3CAC5A;
            border-color: #1cc88a;
        }

        .buttondeny{ 
            display: inline-block;
            font-weight: 400;
            color: #fff;
            text-align: center;
            vertical-align: middle;            
            background-color: #e74a3b;
            border: 1px solid #e74a3b;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .35rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            transition-duration: 0.15s, 0.15s, 0.15s, 0.15s;
            transition-timing-function: ease-in-out, ease-in-out, ease-in-out, ease-in-out;
            transition-delay: 0s, 0s, 0s, 0s;
            transition-property: color, background-color, border-color, box-shadow;


        }

        .buttondeny:hover {
            color: #fff;
            background-color: #D23F3F;
            border-color: #e74a3b;
        
        
        }

    
    
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <img src="logo.png" height="65px"/>
                <div class="sidebar-brand-text mx-2">St. Anne General Hospital </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-h-square"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">



            <!-- Nav Item - Dashboard Appointments -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Appointments</span>
                </a>
            </li>

            <!-- Nav Item - Dashboard Doctor -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="doctors.php" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-user-md"></i>
                    <span>Doctors</span>
                </a>
            </li>

            <!-- Nav Item - Dashboard Staffs -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="staff.php" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-id-badge"></i>
                    <span>Staffs</span>
                </a>
            </li>

            <!-- Nav Item - Dashboard Patients -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="patients.php" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Patients</span>
                </a>
            </li>



            <!-- Nav Item - Services Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                   aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-plus-square"></i>
                    <span>Services</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="">
                            <i class="fas fa-fw fa-medkit"></i>
                            <span>Medicine</span>
                        </a>

                        <a class="collapse-item" href="">
                            <i class="fas fa-fw fa-user"></i>
                            <span>Add Admin</span>
                        </a>

                        <a class="collapse-item" href="">
                            <i class="fas fa-fw fa-database"></i>
                            <span>Backup Database</span>
                        </a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Dashboard Settings -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">-</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        

                        <li class="nav-item dropdown no-arrow">

                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                            
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                Welcome, <?php echo $_SESSION['username'];?>
                                </span>

                                <img class="img-profile rounded-circle"
                                     src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="\logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">                

                    <!-- Table Content Row -->
                     <table class="table table-bordered">         
                            <tr class="cal">
                              <th class="cal">#</th>
                              <th class="cal">Patient's Name</th>   
                              <th class="cal">Phone Number</th>
                              <th class="cal">Email</th>
                            </tr>
                        
                          <tbody class="cal">
                            <?php
                                
                                require('db.php');

                                $query1=mysqli_query($con, "select * from users");
                                while($row=mysqli_fetch_array($query1))
                                                        
                            ?>
                            <?php
                                $query = "SELECT * FROM users";
                                $result = mysqli_query($con,$query);
                                while($row = mysqli_fetch_array($result)){ 
                            ?>
                            <tr class="cal">
                                <td class="cal"></td>
                                <td class="cal"><?php echo $row['username']; ?></td>
                                <td class="cal"><?php echo $row['phone_number']; ?></td>
                                <td class="cal"><?php echo $row['email']; ?></td>
                                <td class="cal">
                                    <form action = "" method = "POST">
                                        <input type = "hidden" name = "id" value = "<?php echo $row['id'];?>"/>
                                        <input type = "submit" button class="button buttonapprove" data-toggle="modal" data-target="#myModal" name = "approve" value = "View"/>
                                        <input type = "submit" button class="button buttondeny" name = "deny" value = "Delete"/>
                                </td>
                                
                            </tr>
                            <?php } ?>
                         </tbody>
                      </table>
                    </div>
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content"><br>
                                <div class="col-md-12">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Patient's Info:<span id="slot"></span></h4>
                                </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="" method="post">                                       
                                            <div class="form-group">
                                                <label for="">Patient's Name</label>
                                                <input required type="text"  name="name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phone Number</label>
                                                <input required type="text"  name="name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input required type="reason"  name="reason" class="form-control">
                                            </div>
                                            <div class="form-group pull-right">
                                                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>            
                            </div>

                        </div>
                    </div>

                    <?php 
                   

                    if(isset($_POST['deny'])){
                        $id = $_POST['id'];

                        $select = "DELETE FROM users WHERE id = '$id'";
                        $result = mysqli_query($con, $select);

                        echo '<script type = "text/javascript">';
                        echo 'alert("Booking Denied!");';
                        echo 'window.location.href = "patients.php"';
                        echo '</script>';

                    }
                    
                    
                    ?>

        <!-- End of Content Wrapper -->


    </div>
    <!-- End of Page Wrapper -->


   
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>