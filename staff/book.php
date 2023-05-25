<?php
$mysqli = new mysqli('localhost','root','','bookingcalendar');
    if(isset($_GET['date'])){
        $date = $_GET['date'];
        $stmt = $mysqli->prepare("select * from bookings where date = ?");
        $stmt->bind_param('s',$date);
        $bookings = array();
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $bookings[]=$row['timeslot'];
            }

            $stmt->close();
        }
      }
    }

    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $reason=$_POST['reason'];
        $timeslot=$_POST['timeslot'];
        $stmt = $mysqli->prepare("select * from bookings where date = ? AND timeslot = ?");
        $stmt->bind_param('ss',$date,$timeslot);
    if($stmt->execute()){
        $result=$stmt->get_result();
        if($result->num_rows>0){
            $msg="<div class='alert alert-danger'>Already Booked!</div>";
        }else{
            $stmt = $mysqli->prepare("INSERT INTO bookings(name,timeslot,reason,date)VALUES(?,?,?,?)");
            $stmt->bind_param('ssss',$name,$timeslot,$reason,$date);
            $stmt->execute();
            $msg="<div class='alert alert-success'>Appointment Booked!</div>";
            $bookings[]=$timeslot;
            $stmt->close();
            $mysqli->close();
        }
      }        
    }

    $duration=30;
    $cleanup=0;
    $start="13:00";
    $end="16:00";


    function timeslots($duration, $cleanup, $start, $end){
        $start=new DateTime($start);
        $end=new DateTime($end);
        $interval=new DateInterval("PT".$duration."M");
        $cleanupInterval=new DateInterval("PT".$cleanup."M");
        $slots=array();

        for($intStart=$start;$intStart<$end;$intStart->add($interval)->add($cleanupInterval)){
            $endPeriod=clone $intStart;
            $endPeriod->add($interval);
            if($endPeriod>$end){
                break;
            }

            $slots[]=$intStart->format("H:iA")."-". $endPeriod->format("H:iA");

        }
        return $slots;
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
    <title>Book An Appointment</title>

     <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

     <!-- Custom styles for this template-->
         <link href="css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body>
<br>
    <div class="container">        
        <h1 class="text-center">Book An Appointment: <?php echo date('F d,Y',strtotime($date)); ?></h1><hr>
        <center>
        <div class="row">
            <div class="col-md-12">
                <?php echo isset($msg)?$msg:"";  ?>
            </div>
            <?php $timeslots=timeslots($duration, $cleanup, $start, $end); 
            foreach($timeslots as $ts){          
            ?>
            <div class="col-md-6"><hr><br>
                <div class="form-group">
                    <?php if(in_array($ts,$bookings)){ ?>
                    <button class="btn btn-danger"><?php echo $ts;?></button>

                    <?php }else{ ?>
                    <button class="btn btn-success book" data-timeslot="<?php echo $ts;?>"><?php echo $ts;?></button>

                    <?php } ?>
                
                </div>
            </div>

           <?php } ?>
        </div>      
    </div>

 <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
         <div class="modal-content"><br>
            <div class="col-md-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Appointment:<span id="slot"></span></h4>
            </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Time</label>
                            <input required type="text"  name="timeslot" id="timeslot" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Patient's Name</label>
                            <input required type="text"  name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Doctor</label>
                            <select name="doctor" id="doctor"  class="form-control">
                           
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Reason</label>
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


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>    
    
    <script>
    $(".book").click(function(){
        var timeslot=$(this).attr('data-timeslot');
        $("#slot").html(timeslot);
        $('#timeslot').val(timeslot);
        $("#myModal").modal("show");
    })
    </script>

</body>
</html>