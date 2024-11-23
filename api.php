<?php 
include 'custom_helper.php';

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Change db to "test" db
$conn -> select_db("appointment");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$token = "w4axtpra8xImQSLzk612uV15aVqS33bBGSHPCe3C5HT4Hsoi4tDxbsQIeHGuuB6D";

    if(!empty($_GET['token'])){
        if($_GET['token'] != $token ){

        $data['status'] = "Token Error";
        echo  jsonoutput($data);
        exit;
        }
    }else{
        
        $data['status'] = "Token Error";
        echo  jsonoutput($data);
        exit;
    }



    if(!empty($_GET['bench'])){
        $bench = input($_GET['bench']);
    }else{
        $bench = "";
    }



    if(!empty($_GET['start'])){
        $startdate =  input($_GET['start']);
        $enddate  =  input($_GET['end']);
        $now = "";
        $where = "appointmentdate between  '".$startdate."' and '".$enddate."' and  bench = '".$bench."'  ";

    }else{
        $year = date("Y")+543;
        $now = $year."-".date("m-d");

        if(!empty($bench)){
            $where = "appointmentdate = '".$now."' and  bench = '".$bench."'";
        }else{
            
            $where = "appointmentdate = '".$now."' ";

            
            if(!empty($_GET['keyword'])){
                $keyword =  $_GET['keyword'];
                $where .= "and numberblack like  '%$keyword%'  or appointmentdate  like '%$keyword%' or  prosecutorName  like '%$keyword%'  ";   
            }
            
        }

    }

    
   

    $select = "select * from  appointment where ". $where ;
    $result = mysqli_query($conn,$select);
    $rowcount=mysqli_num_rows($result);


    if($rowcount > 0){
    foreach ($result as $key => $value){ 

        if($now == $value['appointmentdate']) {
            $data['date']  =  $value['appointmentdate'];
        }else{
            $data['startTime'] =  $startdate;
            $data['endTime'] =  $enddate;
        }
        $data['count'] = $rowcount;
        $data['status'] = true;
        $data['value'][] =  array('numberBlack'=>$value['numberBlack'],
                                'appointmentdate' =>$value['appointmentdate'], 
                                'prosecutorName' =>$value['prosecutorName'],
                                'accusedName' => $value['accusedName'],
                                'appointmentdate'=> $value['appointmentdate'],
                                'charge' => $value['charge'],
                                'whyappointment' => $value['whyappointment'],
                                'timeappointment' => $value['timeappointment'],
                                'bench' => $value['bench']
                               );
    }

    }
    else{

        $data['status'] = "No Data";
    }
echo   jsonoutput($data);

