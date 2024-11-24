<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML…3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Board Information</title>
  <!-- เพิ่มลิงก์ของ Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   <!--<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>-->
   <!-- <scipt src="js/jquery3.7.1.js"></scipt>-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> 
</head>
<body>
<style>

    .video-container {
      max-width: 100%;
      width: 100%;
      background: #fff;
      border: 1px solid #ddd;
      padding: 10px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    video {
      width: 100%;
      border-radius: 8px;
    }
</style>
<?php 
include 'custom_helper.php';      

$token = 'w4axtpra8xImQSLzk612uV15aVqS33bBGSHPCe3C5HT4Hsoi4tDxbsQIeHGuuB6D';

$url = 'http://localhost/e-board/api.php?token='.$token;
//$url = 'http://localhost/e-board/api.php?token='.$token.'&start=2567-11-01&end=2567-11-22';      
if(isset($_GET['role'])){
        $role = $_GET['role'];
      }else{
          $role = "";
      }

      if($role != "staff"){
        $role  = "user";
      }
        $result = getCurl($url); //ลิงค์ไปยัง API เพื่อรับข้อมูล
        $data = jsoninput($result);
        $countloop = 1;

    if(!empty($data->startTime) || !empty($data->endTime) ){
         $dateStart =explode("-",$data->startTime);
        
        $dayStart =   $dateStart[2];
        $monthStart = month_thai($dateStart[1]);
        $yearsStart = $dateStart[0];
       
        $dateEnd =explode("-",$data->endTime);
        $dayEnd =   $dateEnd[2];
        $monthEnd = month_thai($dateEnd[1]);
        $yearsEnd = $dateEnd[0];

        $dateShow  = "<br> ประจำวัน".$dayStart.'  '.$monthStart.'  '.$yearsStart ." ถึงวันที่ ".$dayEnd.'  '.$monthEnd.'  '.$yearsEnd ;
        $typeShow ="between";
        
    }else{
        if(!empty($data->date)){
            $dataAppointmentdate =explode("-",$data->date);
            $day =   $dataAppointmentdate[2];
            $month = month_thai($dataAppointmentdate[1]);
            $years = $dataAppointmentdate[0];
            $dateShow = $day.' '.$month.' '.$years;
            $typeShow ="day";
        }else{
            $data->count = 0;
            $typeShow ="null";
            $day =   date("d");
            $month = month_thai(date("m"));
            $years = date("Y")+543;
            $dateShow = "ประจำวัน ".$day.' '.$month.' '.$years;
            
        }
        
    }



?>         
     

  <div class="container my-4">
      
  


    <!-- ตารางแสดงข้อมูลบน board -->
    <div class="row" >
        
        
      <div class="col-24" style="margin-left:20px;">
        <div class="card">
            
                <div class="card-header" style="background-color: #016dd3;">
                     <?php if($role == "staff"){ ?>
                    <!-- ปุ่ม Login -->
                     <div style="position: relative;text-align: right;">     
                        <button class="btn btn-outline-light btn-sm btnlogin"  type="button" data-toggle="modal" data-target="#modal2" >
                          <i class="bi bi-box-arrow-in-right"></i> เข้าสู่ระบบ
                        </button>
                    </div>
                    <?php } ?>
                       <!-- ปุ่ม Login -->
                      <div class="row">
                                             
                          <div class="card-body">
                            <!-- ข้อความหัวข้อ -->
                            <h5 class="card-title mb-3">
                               <div class=""><h2 style="color:white;"><center>รายการพิจารณาคดีศาลแรงงานภาค 2  <?php  echo $dateShow ; ?> </center> </h2>


                                </div>
                            </h5>
                          </div>


      
    <!-- ช่องค้นหาและปุ่ม -->
    <!--<div class="d-flex flex-column flex-md-row justify-content-between align-items-center">-->
      <!-- <div class="d-flex flex-column flex-md-row  align-items-center">
      
      <div class="input-group mb-3 mb-md-0" style="max-width: 250px;">
        <input type="text" class="form-control" placeholder="Search..." />
        <button class="btn btn-secondary" type="button">
          <i class="bi bi-search"></i>
        </button>
          
          
          
      </div>

      
    </div>-->
      
      
    
   
      <div class="col-12">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search..." aria-label="Recipient's   
 username" aria-describedby="basic-addon2" id="txtsearch" >
          <button class="btn btn-secondary" type="button" id="btnsearch"> <i class="bi bi-search"></i> </button>
        </div>   

      </div>


      
      
  </div>

                          
                          
                         
                         
                </div>
            </div>
        </div>    
            
          <div class="card-body">
            <span id="noShowData"></span> 

            <table class="table table-striped table-hover tabledata" style="font-size:85%;">
                <?php if($role == "staff"){ ?>
                        <button type="button" class="btn btn-primary peopleContact" data-toggle="modal" data-target="#exampleModal"  data-numberBlack="-" >ประชาชนติดต่อศาล</button>
                        <br>
                        <br>
                    <?php } ?>
                
             <?php if( $data->count > 0 ) { ?>
              <thead style="text-align: center;" class="table-dark" >
                <tr >
                    <?php if($role == "staff"){ ?>
                  <th>ดำเนินการ</th>
                    <?php } ?>
                    
                  <th>เลขคดีดำ</th>
                  <th>โจทก์</th>
                  <th>จำเลย</th>
                   <?php if($typeShow == "between"){ ?>
                          <th>วันนัด</th>
                            <?php } ?>
                  <th>เวลานัด</th>
                  <th>ห้องพิจารณาคดี</th>
                  <th>กระบวนการพิจารณคดี</th>
                  
                </tr>
              </thead>
                <?php } ?>
              <tbody id="showData">
                <?php  
                        if($data->count > 0){
                            foreach($data->value as $key=> $value){  ?>
                            <tr>
                                <?php if($role == "staff"){ ?>
                              <td>
                                
                                        <button class=" btn btn-success btn-sm alert" data-numberBlack="<?php echo $value->numberBlack; ?>" data-toggle="modal" data-target="#exampleModal"  >
                                           แจ้งมาติดต่อ
                                        </button>
                              </td>
                                 <?php } ?>
                                
                              <td class="fs-6 fs-md-5 showDataResult"><?php echo  $value->numberBlack; ?></td>
                              <td class="fs-6 fs-md-5 showDataResult" ><?php echo  $value->prosecutorName; ?></td>
                              <td class="fs-6 fs-md-5 showDataResult" ><?php echo  $value->accusedName; ?></td>
                             <?php if($typeShow == "between"){ ?>
                              <td class="fs-6 fs-md-5 showDataResult"><?php 
                                        $dataAppointmentdate =explode("-",$value->appointmentdate);
                                        $day =   $dataAppointmentdate[2];
                                        $month = month_thaiShort($dataAppointmentdate[1]);
                                        $years = $dataAppointmentdate[0];
                                        $dateShow = $day.' '.$month.' '.$years;
                                        echo $dateShow;
                                 ?>
                                </td>
                                <?php } ?>    
                                 
                              <td class="fs-6 fs-md-5 showDataResult "><?php echo  $value->timeappointment; ?></td>
                              <td class="fs-6 fs-md-5 showDataResult"><?php 
                                        if($value->bench == 0){
                                            echo "ห้องพิจารณาไกล่เกลี่ย ชั้น 2 ";
                                        }else{
                                             echo  $value->bench; 
                                        } ?>
                              </td>
                              <td class="fs-6 fs-md-5 showDataResult"><?php echo  $value->whyappointment; ?></td>
                               
                            </tr>
                        <?php  $countloop++;
                            }
                        }else{
                          
                        echo       '<div class="card text-center ShowNullData">
                                        <div class="card-body">
                                            <h5 class="card-title">ไม่มีการนัดพิจารณตดี</h5>
                                            <p class="card-text">ขออภัย ไม่มีข้อมูลที่คุณต้องการในขณะนี้</p>
                                        </div>
                                    </div>';
                        }
                  ?>
    
                

       
 
                
                
              </tbody>
            </table>
          </div>
            
               <!-- <div class="card-header">
                    <h5 style="color:red"> นัดเพิ่มเติม (เร่งด่วน) ประจำวัน <?php  echo $dateShow ; ?>  </h5>
                </div>-->

                    <div class="video-container">
                        <button id="unmuteButton" class="btn btn-success">เปิดเสียง</button>
                        <video controls autoplay muted id="videoPlayer">
                          <source src="video/PresidentPolicy.mp4" type="video/mp4">
                          Your browser does not support the video tag.
                        </video>
                      </div>
        </div>
      
   
  </div>

    
    
<!-- POP UP Alert แจ้งเตือนไปยังเจ้าหน้าที่ -->    
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">แจ้งเตือนผู้มาติดต่อศาลไปยังเจ้าหน้าที่</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
    <div class="modal-body">
        <form>
           <div class="mb-3">
            <label for="name" class="form-label">หมายเลขคดีดำ</label>
            <input type="text" class="form-control inputNumberBlack" id="inputNumberBlack" placeholder="" disabled>
          </div>
            
          <div class="mb-3">
            <label for="name" class="form-label">ชื่อ-นามสกุล</label>
              
              <div class="row">
                <div class="col-sm">
                  <input type="text" class="form-control" id="name" placeholder="กรุณากรอกชื่อ">
                </div>
                <div class="col-sm">
                    <img src="img/idCard.png" class="readerCard" height="45" width="55">
                    <img src="img/ThaiID.png" class="thaiId" height="45" width="45">
                </div>

              </div>
              
              
            
            
          </div>
            
          <div class="mb-3">
         

               <label for="name" class="form-label">ผู้มาติดต่อ</label>
              
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span id="PeopleContact">--กรุณาเลือก--</span>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item PeopleContact" href="#">โจทก์/ผู้ร้อง</a>
                            <a class="dropdown-item PeopleContact" href="#">จำเลย/ผู้คัดค้าน</a>
                            <a class="dropdown-item PeopleContact" href="#">ทนายโจทก์</a>
                            <a class="dropdown-item PeopleContact" href="#">ทนายจำเลย</a>
                            <a class="dropdown-item PeopleContact" href="#">ผู้ร้อง (ไกล่เกลี่ยก่อนฟ้อง)</a>
                            <a class="dropdown-item PeopleContact "  href="#">ผู้ถูกร้อง (ไกล่เกลี่ยก่อนฟ้อง)</a>
                      </div>
                    </div>
            </div>
          
            
            
            
          <div class="mb-3">
            <label for="message" class="form-label">กลุ่มงานที่ประชาชนมาติดต่อ</label>
            
            <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle room" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span id="roomselect">--กรุณาเลือก--</span>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class=" dropdown-item RoomItem" href="#">กลุ่มงานรับฟ้อง</a>
                            <a class=" dropdown-item RoomItem" href="#">ศูนย์ไกล่เกลี่ยและประนอมข้อพิพาท</a>
                            <a class=" dropdown-item RoomItem" href="#">กลุ่มงานนิติการ</a>
                            <a class=" dropdown-item RoomItem" href="#">ศูนย์หน้าบังลังค์</a>
                            <a class=" dropdown-item RoomItem" href="#">รับเงินตามคำพิพากษา</a>
                            <a class=" dropdown-item RoomItem" href="#">ห้องพิจารณาคดี  1</a>
                            <a class=" dropdown-item RoomItem" href="#">ห้องพิจารณาคดี  2</a>
                            <a class=" dropdown-item RoomItem" href="#">ห้องพิจารณาคดี  3</a>
                            <a class=" dropdown-item RoomItem" href="#">ห้องพิจารณาคดี  4</a>
                            <a class=" dropdown-item RoomItem" href="#">ห้องพิจารณาคดี  5</a>
                            <a class=" dropdown-item RoomItem" href="#">ห้องพิจารณาคดี  6</a>
                           
                      </div>
                    </div>  
              
              
              
          </div>
        </form>
      </div>
        
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cancle" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary sentData">แจ้งข้อมูล</button>
      </div>
    </div>
  </div>
</div>    
<!-- POP UP Alert -->
    

<!--POP UP Login -->

<!-- Modal -->
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> <!-- เครื่องหมาย X -->
        </button>
        </div>
        <div class="modal-body">
          <!-- Login Form -->
            <div class="login-container">
                <h5 class="text-center mb-4">Login</h5>
                <form>
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password">
                  </div>
                  <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="text-center mt-3">
                  <p class="mb-1">Or login with</p>
                  <div class="logo-buttons">
                    <a href="#"><img src="img/ThaiID.png" alt="ThaiID" width="45" height="45"></a>
                    <a href="#"><img src="img/COJ_logo.png" alt="COJ Connect" width="45" height="45"></a>
                  </div>
                </div>
              </div>

        </div>
      </div>
    </div>
  </div>
<!--POP UP Login --> 
    
    
    
    
  <!-- เพิ่มสคริปต์ของ Bootstrap JS -->
 
</body>
</html>

<script>
  jQuery( document ).ready(function() {
      
         jQuery('#unmuteButton').click(function () {
            const video = $('#videoPlayer')[0]; // ดึง <video> ออกมา
             video.muted = false; // ปิด mute
            video.volume = 0.5; // ตั้งระดับเสียงเป็น 100%
            jQuery(this).text('Sound On'); // เปลี่ยนข้อความปุ่ม
            jQuery(this).prop('disabled', true); // ปิดใช้งานปุ่มหลังเปิดเสียง
      });
      
        jQuery(".alert, .peopleContact").click(function(){
            
         var numberBlack = jQuery(this).attr("data-numberBlack" );
            jQuery("#inputNumberBlack").val(numberBlack);
        })
      
          jQuery(document).on('click', '.alert', function () {
             var numberBlack = jQuery(this).attr("data-numberBlack" );
            jQuery("#inputNumberBlack").val(numberBlack);
        });
      
        jQuery(".btnlogin").click(function(){
                /*jQuery('body').attr('class','model-open');
                jQuery('.login').attr('class','modal fade login show');
                jQuery('.login').attr('role','dialog');
                jQuery('.login').css('style','display:block');*/
            
            
                    jQuery('.login').preventDefault();
                  dataModal = jQuery('.login').attr("data-modal");
                  jQuery('.login').css({"display":"block"});
              /*var actualModal = jQuery('#loginModal').attr('data-actual');
              var newModal = jQuery('#loginModal').attr('data-target');
                console.log(actualModal);
                jQuery(actualModal).modal('hide');
                jQuery(newModal).modal('show');
                alert('login');*/
        })
     
       jQuery('.dropdown-toggle').dropdown()
       jQuery('.PeopleContact').click(function(){
          var selectItem     =  jQuery(this).text();
            jQuery('#PeopleContact').text(selectItem);
        });
      
        jQuery('.Room').dropdown()
         jQuery('.RoomItem').click(function(){
         var selectItem     =  jQuery(this).text();
            jQuery('#roomselect').text(selectItem);
        });
      
       jQuery('.cancle').click(function(){
            jQuery('#name').val("");
            jQuery('#PeopleContact').text("--กรุณาเลือก--");
            jQuery('#roomselect').text("--กรุณาเลือก--");
            jQuery("#inputNumberBlack").val();
       })
      
      jQuery('.readerCard').click(function(){
          
           jQuery('#name').val("ทดสอบ อ่านบัตร");
          
      })
      
    
      jQuery('.thaiId').click(function(){
          
           alert('อยู่ระหว่างปรับปรุงระบบ');
      })
      
      
      jQuery('#btnsearch').click(function(){
         
          var keywordsearch  = jQuery('#txtsearch').val();
          var typeShow = '<?php echo $typeShow; ?>';
          var role = "<?php echo  $role; ?>";
          var htmlResult  = "";
          var roomShow = "";
          var countData = '<?php echo $data->count ?>';
  
          jQuery(".ShowNullData").remove();
           $.ajax({
                  method: "POST",
                  url: "search.php",
                 
                  data: {keyword:keywordsearch,typeShow:typeShow,role:role}
                })
                  .done(function( msg ) {
                    var result = JSON.parse(msg);
                    console.log(result);
                    var count = result['count']
                        if(count > 0 && result['status'] == true){
                            jQuery("#noShowData").fadeOut().remove();
                        
                           jQuery(".showDataResult").fadeOut().remove();
                             var   obj = result['value'];
                            
                            if(countData == 0){
                                    htmlResult += '<thead style="text-align: center;" class="table-dark" >'
                                  htmlResult += '<tr >'
                                  if(role == "staff"){
                                     htmlResult += '<th>ดำเนินการ</th>'
                                  
                                  }
                                  htmlResult += '<th>เลขคดีดำ</th>'
                                  htmlResult += '<th>โจทก์</th>'
                                  htmlResult += '<th>จำเลย</th>'
                                  if(typeShow == "between" || role == "staff" ){
                                      htmlResult+= '<th>วันนัด</th>'
                                  }
                                    htmlResult+= '<th>เวลานัด</th>'
                                    htmlResult+= '<th>ห้องพิจารณาคดี</th>'
                                    htmlResult+= '<th>กระบวนการพิจารณคดี</th>'
                                    htmlResult+= '</tr></thead>'
                                } 
                                htmlResult +='<tr>'
                              Object.keys(obj).forEach(function(key) {
                              
                                /*console.log (obj[key]['numberBlack']);
                                console.log (obj[key]['accusedName']);
                                console.log (obj[key]['appointmentdate']);
                                console.log (obj[key]['bench']);
                                 console.log (obj[key]['prosecutorName']);
                                console.log (obj[key]['timeappointment']);
                                console.log (obj[key]['whyappointment']);*/
                                  
                                  
                                  
                                  
                                 

                                if(role == "staff"){
                                    
                                    htmlResult += '<td>'
                                    htmlResult += '<button class=" btn btn-success btn-sm alert" data-numberBlack="'+obj[key]['numberBlack']+'" data-toggle="modal" data-target="#exampleModal">'
                                    htmlResult += 'แจ้งมาติดต่อ'
                                    htmlResult += '</button>'
                                    htmlResult += '</td>'
                                }                                
                                    htmlResult += '<td class="fs-6 fs-md-5 showDataResult">'+obj[key]['numberBlack']+'</td>';
                                    htmlResult += '<td class="fs-6 fs-md-5 showDataResult" >'+obj[key]['prosecutorName']+'</td>';
                                    htmlResult += '<td class="fs-6 fs-md-5 showDataResult" >'+obj[key]['accusedName']+'</td>';
                                if(typeShow == "between" || role=="staff"){
                                    
        
                                    htmlResult += '<td class="fs-6 fs-md-5 showDataResult">'+obj[key]['appointmentdate']+'</td>';
                                }
                                    htmlResult += '<td class="fs-6 fs-md-5 showDataResult ">'+obj[key]['timeappointment']+'</td>';
                                    
                                    if(obj[key]['bench'] == 0) {
                                        
                                        roomShow = 'ห้องพิจารณาไกล่เกลี่ย ชั้น 2';
                                    }else{
                                        
                                        roomShow =  obj[key]['bench'];
                                    }
                                     htmlResult += '<td class="fs-6 fs-md-5 showDataResult ">'+roomShow+'</td>';
                                    htmlResult += '<td class="fs-6 fs-md-5 showDataResult ">'+obj[key]['whyappointment']+'</td>';
                                    htmlResult += '</tr>';
                                    jQuery("#showData").html(htmlResult);
                                
                                
                                
                                //console.log(key, obj[key]);
                            });

                        }else{
                          jQuery(".tabledata").fadeOut();
                          var HtmlShowNoData = '<div class="card text-center ShowNullData">';  
                              HtmlShowNoData += '<div class="card-body">';
                              HtmlShowNoData += '<h5 class="card-title">ไม่มีการนัดพิจารณตดี</h5>';
                              HtmlShowNoData += '<p class="card-text">ขออภัย ไม่มีข้อมูลที่คุณต้องการในขณะนี้</p>';
                              HtmlShowNoData += '</div></div>';    
                            jQuery(".tabledata").fadeOut();
                            jQuery("#noShowData").html(HtmlShowNoData);
                        }
                  });
          
          
      })
      
      jQuery('.sentData').click(function(){
          
      
           /*var myKeyVals ="";
            var saveData = jQuery.ajax({
                type: 'POST',
                url: "alert.php",
                data: myKeyVals,
                dataType: "json",
                success: function(resultData) { alert("Save Complete") }
            });*/
          

            var numberBlack = jQuery("#inputNumberBlack").val();
            var nameContact  =  jQuery("#name").val();
            var typeContact   = jQuery('#PeopleContact').text();
            var roomSelect = jQuery('#roomselect').text();
          
                /*console.log(numberBlack);
                console.log(nameContact);
                console.log(typeContact);
                console.log(roomSelect);*/
            $.ajax({
                  method: "POST",
                  url: "alert.php",
                  data: { name:nameContact,tpyeContact:typeContact,numberBlack:numberBlack,roomSelect:roomSelect}
                })
                  .done(function( msg ) {
                    console.log(msg);
                  });

      })
})
 
    

    
</script>
