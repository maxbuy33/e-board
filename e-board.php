<!DOCTYPE html>
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
    
     

  <div class="container my-4">
      
      
   <!--------------------------------------------------------------------->      
    <!--<div class="row">
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-header">
            <h5>Board Title 1</h5>
          </div>
          <div class="card-body">
            <h6 class="card-title">รายละเอียด</h6>
            <p class="card-text">ข้อมูลหรือข้อความที่ต้องการแสดงบน board นี้.</p>
            <a href="#" class="btn btn-primary">ดูรายละเอียด</a>
          </div>
        </div>
      </div>


      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-header">
            <h5>Board Title 2</h5>
          </div>
          <div class="card-body">
            <h6 class="card-title">รายละเอียด</h6>
            <p class="card-text">ข้อมูลหรือข้อความที่ต้องการแสดงบน board นี้.</p>
            <a href="#" class="btn btn-primary">ดูรายละเอียด</a>
          </div>
        </div>
      </div>


      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-header">
            <h5>Board Title 3</h5>
          </div>
          <div class="card-body">
            <h6 class="card-title">รายละเอียด</h6>
            <p class="card-text">ข้อมูลหรือข้อความที่ต้องการแสดงบน board นี้.</p>
            <a href="#" class="btn btn-primary">ดูรายละเอียด</a>
          </div>
        </div>
      </div>
    </div>-->
   <!--------------------------------------------------------------------->          
<?php 
include 'custom_helper.php';      

$token = 'w4axtpra8xImQSLzk612uV15aVqS33bBGSHPCe3C5HT4Hsoi4tDxbsQIeHGuuB6D';

//$url = 'http://localhost/e-board/api.php?token='.$token;
      
      
$url = 'http://localhost/e-board/api.php?token=w4axtpra8xImQSLzk612uV15aVqS33bBGSHPCe3C5HT4Hsoi4tDxbsQIeHGuuB6D&start=2567-11-01&end=2567-11-22';      
$curl = curl_init();

      if(isset($_GET['role'])){
        $role = $_GET['role'];
      }else{
          $role = "";
      }
      
      
      if($role != "staff"){
        $role  = "user";
      }
 
//  Initiate curl
$ch = curl_init();
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

      
$data = jsoninput($result);
$countloop = 1;
   //echo "<pre>";
   //print_r ($data);
   /*if($data->status == "No Data"){
        $typeShow = "null";   
   }*/
      


// Will dump a beauty json :3
//var_dump(json_decode($result, true));
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
            $years = date("y");
            $dateShow = "ประจำวัน ".$day.' '.$month.' '.$years;
            
        }
        
    }



?>      

    <!-- ตารางแสดงข้อมูลบน board -->
    <div class="row" >
        
        
      <div class="col-24" style="margin-left:20px;">
        <div class="card">
            
                <div class="card-header" style="background-color: #016dd3;">
                     <?php if($role == "staff"){ ?>
                    <!-- ปุ่ม Login -->
                     <div style="position: relative;text-align: right;">     
                        <button class="btn btn-outline-light btn-sm" >
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
              

            <table class="table table-striped table-hover" style="font-size:85%;">
                <?php if($role == "staff"){ ?>
                        <button type="button" class="btn btn-primary peopleContact" data-toggle="modal" data-target="#exampleModal"  data-numberBlack="-" >ประชาชนติดต่อศาล</button>
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
              <tbody>
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
                                
                              <td class="fs-6 fs-md-5"><?php echo  $value->numberBlack; ?></td>
                              <td class="fs-6 fs-md-5" ><?php echo  $value->prosecutorName; ?></td>
                              <td class="fs-6 fs-md-5" ><?php echo  $value->accusedName; ?></td>
                             <?php if($typeShow == "between"){ ?>
                              <td class="fs-6 fs-md-5"><?php 
                                        $dataAppointmentdate =explode("-",$value->appointmentdate);
                                        $day =   $dataAppointmentdate[2];
                                        $month = month_thaiShort($dataAppointmentdate[1]);
                                        $years = $dataAppointmentdate[0];
                                        $dateShow = $day.' '.$month.' '.$years;
                                        echo $dateShow;
                                 ?>
                                </td>
                                <?php } ?>    
                                
                              <td class="fs-6 fs-md-5"><?php echo  $value->timeappointment; ?></td>
                              <td class="fs-6 fs-md-5"><?php 
                                        if($value->bench == 0){
                                            echo "ห้องพิจารณาไกล่เกลี่ย ชั้น 2 ";
                                        }else{
                                             echo  $value->bench; 
                                        } ?>
                              </td>
                              <td class="fs-6 fs-md-5"><?php echo  $value->whyappointment; ?></td>
                               
                            </tr>
                        <?php  $countloop++;
                            }
                        }else{
                            
                            echo "ไม่มีการนัดพิจารณาคดี";
                        }
                  ?>
    
              </tbody>
            </table>
          </div>
            
                <div class="card-header">
                    <h5 style="color:red"> นัดเพิ่มเติม (เร่งด่วน) ประจำวัน <?php  echo $dateShow ; ?>  </h5>
                </div>
        </div>
      
   
  </div>

    
    
<!-- POP UP Alert -->    
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
  <div class="modal fade" id="loginModal" tabindex="-2"  role="dialog"  aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Login Form -->
          <form>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" placeholder="Enter username">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
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
      
        jQuery(".alert, .peopleContact").click(function(){
            
         var numberBlack = jQuery(this).attr("data-numberBlack" );
            jQuery("#inputNumberBlack").val(numberBlack);
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
          //alert(keywordsearch);
           $.ajax({
                  method: "POST",
                  url: "search.php",
                  data: {keyword:keywordsearch}
                })
                  .done(function( msg ) {
                    console.log(msg);
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
