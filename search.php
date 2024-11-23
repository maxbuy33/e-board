<?php 
    include 'custom_helper.php';
    include 'config.php';

    $keyword =  $_POST['keyword'];
    if(!empty($keyword)){
        
        $keyword = input($keyword);
        
        
        $token = 'w4axtpra8xImQSLzk612uV15aVqS33bBGSHPCe3C5HT4Hsoi4tDxbsQIeHGuuB6D';

            //$url = 'http://localhost/e-board/api.php?token='.$token;


            $url = 'http://localhost/e-board/api.php?token=w4axtpra8xImQSLzk612uV15aVqS33bBGSHPCe3C5HT4Hsoi4tDxbsQIeHGuuB6D&keyword='.$keyword;    
        
            $result = getCurl($url);
            echo  $result;
            /*$curl = curl_init();
            
              
            $ch = curl_init();
            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
            // Execute
            $result=curl_exec($ch);
            // Closing
            curl_close($ch);
        
        print_r ($result);
        $data = jsoninput($result);
        //echo $data;*/
    }else{
        
        echo "null";
    }
    //echo "search";
?>