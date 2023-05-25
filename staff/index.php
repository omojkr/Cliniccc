<?php
function build_calendar($month, $year){
    $mysqli = new mysqli('localhost','root','','bookingcalendar');
    /*$stmt = $mysqli->prepare("select * from bookings where MONTH(date) = ? AND YEAR(date) = ?");
    $stmt->bind_param('ss',$month,$year);
    $bookings = array();
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $bookings[]=$row['date'];
            }

            $stmt->close();
        }
    }*/ 


    $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    $numberDays = date('t',$firstDayOfMonth);

    $dateComponents = getdate($firstDayOfMonth);
    
    $monthName = $dateComponents['month'];

    $dayOfWeek = $dateComponents['wday'];

    $datetoday = date('Y-m-d');



    //HTML table 
    $calendar = "<table class='table table-bordered'><br>";
    $calendar.="<center><h1>$monthName $year</h1>";
    $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, 
        $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";

    $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";

    $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, 
        $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></center><br>";


    $calendar.="<tr class='cal'>";

    //Calendar headers
     foreach($daysOfWeek as $day) {
          $calendar.= "<th class='header'>$day</th>";
     } 


    $currentDay = 1;
    $calendar.= "</tr><tr>";

    if($daysOfWeek > 0){
        for($k=0;$k<$dayOfWeek;$k++){
            $calendar.="<td class='cal'></td>";
        }
    }

    
    $month = str_pad($month,2,"0",STR_PAD_LEFT);

    while($currentDay <= $numberDays){


        if($dayOfWeek == 7){
            $dayOfWeek = 0;
            $calendar.="</tr><tr class='cal'>";
        }

        $currentDayRel = str_pad($currentDay,2,"0",STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

            
            $dayname=strtolower(date('l', strtotime($date)));
            $eventNum=0;
            $today = $date==date('Y-m-d')?"today":"";
            
            
            if($dayname=='sunday'||$dayname=='monday'||$dayname=='tuesday'||$dayname=='thursday'||$dayname=='saturday'){
             $calendar.="<td class='cal'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Close</button>";
            }elseif($date<date('Y-m-d')){
             $calendar.="<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Not Available</button>";
            }else{

             $totalbookings=checkSlots($mysqli, $date);
             if($totalbookings==6){
                $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='#' class='btn btn-danger btn-xs'>All Booked</a>";
             }else{
                $availableslots=6-$totalbookings;
                $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='book.php?date=".$date."' class='btn btn-success btn-xs'>Available</a>
                    <small><i>$availableslots slots available</i></small>";
             }
            }



        

        $calendar.= "</td>";

        $currentDay++;
        $dayOfWeek++;
    }

    if($dayOfWeek !=7){
        $remainingDays = 7 - $dayOfWeek;
        for($i=0;$i<$remainingDays;$i++){
            $calendar.= "<td class='cal'></td>";
        }
    }

    $calendar.= "</tr>";
    $calendar.= "</table>";

    echo $calendar;

}

function checkSlots($mysqli, $date){
    $stmt = $mysqli->prepare("select * from bookings where date = ?");
    $stmt->bind_param('s',$date);
    $totalbookings = 0;
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $totalbookings++;
            }

            $stmt->close();
        }  
    }

    return $totalbookings;
}



?>    
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Staff - Dashboard</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        table{
            table-layout: fixed;
            border: 2px solid black; 

            
        }

        tr.cal{
            border: 2px solid black;
            font-family:verdana;
            color:black;
        }
        
        tbody{
            border: 2px solid black;
            font-family:verdana;
            color:black;
        }

        th.header{
            color: black;
            font-family: verdana;
            border: 2px solid black;
        }

        td.cal{
            width: 33%;
            font-family: verdana;
            border: 2px solid black;
            color:black;
            
        }

        .today{
            background-color: #FFF169;                      
        }

        .btn-danger{
            font-size:.8rem;
            width:100%;
            height:auto;
            position:relative;
            font-family: verdana;
        }

        .btn-success{
            font-size:.8rem;
            width:100%;
            height:auto;
            position:relative;
            font-family: verdana;
        }

        .container-fluid{ 
            color: black;
            font-family: verdana;
        }

  
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
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
                <a class="nav-link collapsed" href="appointment.php" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Appointments</span>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Sample User</span>
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
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-12">
                        <!-- Calendar -->
                            <?php 
                                $dateComponents = getdate();
                                if(isset($_GET['month']) && isset($_GET['year'])){
                                    $month = $_GET['month'];
                                    $year = $_GET['year'];
                                }else{
                                    $month = $dateComponents['mon'];
                                    $year = $dateComponents['year'];
                                }
                               
                                echo build_calendar($month, $year);                         
                            ?>
                        </div>
                    </div>

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
                    <a class="btn btn-primary" href="login.html">Logout</a>
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


</body>

</html>				