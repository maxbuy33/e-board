<?php 

    function numeric($string){
        
        if(is_numeic($string)){
            $result = "true";
        }
        else
        {
            $result = "false";
        }
        
        return $result;
    }

    function input($string){
        
        $result  = addslashes(strip_tags(trim($string)));
        return $result;
    }

    function output($string)
    {
        $result = stripslashes($string);
        return $result;
    }

    function  jsonoutput($string){
        $result  = json_encode($string);
        return $result;
    }

    function  jsoninput($string){
        $result  = json_decode($string);
        return $result;
    }

    function exploadString($format,$string){
        
        $result   =  explode($format,$string);
        return $result;
    }
        


    function alert($string,$link)
    {
        $link  = base_url().$link;
        if(!empty($string)){
            
             echo '<script>alert("'.$string.'");window.location.href="'.$link.'";</script>';
        }
        else
        {
            /*echo "<script>alert(".$string.");window.location =' ".$link."';</script>";*/
            echo '<script>window.location.href="'.$link.'";</script>';
        }
    }


    function month_eng($value){
        $month = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");
         return $month[$value];
    }

     function month_thai($value){
        $month = array(1 => "มกราคม", 2 => "กุภาพันธ์", 3 => "มีนาคม", 4 => "เมษายน", 5 => "พฤภษาคม", 6 => "มิถุนายน", 7 => "กรกฏาคม", 8 => "สิงหาคม", 9 => "กันยายน", 10 => "ตุลาคม", 11 => "พฤศจิกายน", 12 =>"ธันวาคม");
         return $month[$value];
    }

    function month_thaiShort($value){
        $month = array(1 => "ม.ค.", 2 => "ก.พ.", 3 => "มี.ค.", 4 => "เม.ย.", 5 => "พ.ค.", 6 => "มิ.ย.", 7 => "ก.ค.", 8 => "ส.ค.", 9 => "ก.ย.", 10 => "ต.ค.", 11 => "พ.ย.", 12 =>"ธ.ค.");
         return $month[$value];
    }

  function  numberformat($number,$point){
        if(empty($point)){
            $result = number_format($number);
        }
        else
        { 
            $result = number_format($number,$point);
        }
        return $result;
    }
    


?>
