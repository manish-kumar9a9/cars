<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>UREND</title>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/zenither-slider.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/imageadd.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.range.css">
        
        <?php /* css for chat */?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chat/chat-style.css">
        
        <?php /* css for datetime picker  */ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.css"/>
        
        <script src='https://cdn.firebase.com/js/client/2.4.0/firebase.js'></script>

        <?php $this->load->view('include/head_block'); ?>
        <?php /* header end here */ ?>
        <?php
        //pre($this->session->userdata);
       if($this->uri->segment(3)!=''){
       $option = array(
       'is_json'=> false ,
       'url'=> site_url() . '/service_fetch_user_primary_record' ,
       'data'=> json_encode(array('user_id' => $this->uri->segment(3)))
       );
       $result = get_data_with_curl($option);
       $user_data = $result['Result'];
       }else{
           $user_data['profileImage']='';
           $user_data['userId']=0;
           $user_data['firstName']='';
           //$user_data=array();
       }
      // pre($user_data);
       ?>
      <form action="#" class="" >
<!--                   <input  id="frnd_msg" type="text" name="frnd_msg" >-->
                    <input type="hidden" value="submit" id="post_msg">
                </form>
 
        <div class="ui">
            <div class="left-menu">
                <form action="#" class="search" hidden="hidden">
                    <input placeholder="search..." type="search" name="" id="">
                    <input type="submit" value="&#xf002;" >
                </form>

           
               
<menu class="list-friends" id="user_list"> </menu>
                
            </div>
            <div class="chat">
                <div class="top">
                     <?php if($this->uri->segment(3)!=''){?>
                    <div class="avatar">
                       
                        <img width="50" height="50" src="<?php 
                        if (strpos($user_data['profileImage'], 'profileImages') !== false || ($user_data['profileImage'] == '')) {
                            echo base_url('assets/image/Icon-user-1.png');
                        } else {
                            echo base_url('profileImages/' . $user_data['profileImage']);
                        }
                        ?>">
                        
                    </div>
                    <div class="info">
                        <div class="name" ><?php echo $user_data['firstName'];?></div>
<!--                        <div class="online">Online</div>	-->
                    </div>
                     <?php }?>
                </div>
                

                
                   <ul class="messages" id="results"> </ul>
                
                
                <div class="write-form">
                    <textarea id="text" placeholder="Type your message"  <?php  if($this->uri->segment(2)!='online'){?> hidden="" <?php }?> rows="1"></textarea>

                    <button id="post" class="send theme-btn-basic"  <?php  if($this->uri->segment(2)!='online'){?> hidden="" <?php }?>>Send</button>
                </div>
            </div>
        </div>
  
   


        <!--footers-->
        <?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->
        <?php /* js for chat*/?>
       
        
         
        
        
        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
        <?php /* to open header drop down */ ?>
        <script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/skdslider.min.js"></script>

        <!-- Modal popup script starts -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Modal popyp script ends -->
        
       
<script src="https://www.gstatic.com/firebasejs/3.6.1/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyC-iGSqC-T2AcXUR0bnU-LrrWf-S2WFWns",
    authDomain: "urend-1288.firebaseapp.com",
    databaseURL: "https://urend-1288.firebaseio.com",
    storageBucket: "urend-1288.appspot.com",
    messagingSenderId: "5900114559"
  };
  firebase.initializeApp(config);
  
 
  var      myFirebase     =     new     Firebase('https://urend-1288.firebaseio.com');
            var      sender     =     '<?php echo $session_user; ?>';
            var receiver = '<?php echo $user_chat; ?>';
            //alert(sender);alert(receiver);
            if ((parseInt(sender)) <= (parseInt(receiver))) {
                var chat_path = sender + '_' + receiver;
            } else if ((parseInt(receiver)) < (parseInt(sender))) {
                var chat_path = receiver + '_' + sender;
            }
          // alert();   
            var parent = myFirebase.child('message_root/').child(chat_path).child('messages');
            var user_path = 'userId' + '_' + sender; 
            var userlist = myFirebase.child('AllUsers/').child(user_path).child('friendlist');
            var checkUserlist = myFirebase.child('AllUsers/');
            var textInput = document.querySelector('#text');
            var postButton = document.querySelector('#post');
            var postButton1 = document.querySelector('#post_msg');
            
            /*************************Start Send msg on send Button*************************************/     
            postButton.addEventListener("click", function () {              
               //////////////////////for send msg//////////////////////
                var sender = '<?php echo $session_user; ?>';
                var receiver = '<?php echo $user_chat; ?>';
                if ((parseInt(sender)) <= (parseInt(receiver))) {
                    var chat_path = sender + '_' + receiver;
                } else if ((parseInt(receiver)) < (parseInt(sender))) {
                    var chat_path = receiver + '_' + sender;
                }
                 var msgText = textInput.value;
		msgText = msgText.trim();	
		if(msgText == ""){
			return false;
		}
		
                var ts = Math.round((new Date()).getTime());
               
                parent.push({message: msgText,  sender: sender, time: "" + ts});
                textInput.value = "";
                //////////////////////End send msg//////////////////////
                
                
                
                /////////////////////////////// add  friend list When send msg//////////////////////////
                myFirebase.child('AllUsers/').child('userId_'+sender).child('friendlist').child('userId_'+receiver).set({
                    image: "<?php 
                        if (strpos($user_data['profileImage'], 'profileImages') !== false || ($user_data['profileImage'] == '')) {
                            echo base_url('assets/image/Icon-user-1.png');
                        } else {
                            echo base_url('profileImages/' . $user_data['profileImage']);
                        }
                        ?>",
                    message: msgText,
                    name: "<?php echo $user_data['firstName'];?>",
                    sender: sender,
                    time: ""+ts
                     });
                 
                  myFirebase.child('AllUsers/').child('userId_'+receiver).child('friendlist').child('userId_'+sender).set({
                    image: "<?php 
                        if (strpos($this->session->userdata('profileImage'), 'profileImages') !== false || ($this->session->userdata('profileImage') == '')) {
                            echo base_url('assets/image/Icon-user-1.png');
                        } else {
                            echo base_url()."profileImages/".$this->session->userdata('profileImage');
                        }
                        ?>",
                    message: msgText,
                    name: "<?php echo $this->session->userdata('firstName')?>",
                    sender: sender,
                    time: ""+ts
                     });                    
                     
                /////////////////////End friend list//////////////////////////               
                
            });
            /*************************End Send msg on send Button*************************************/
            
           /*****************frnd add  AllUsers to insert in firebase***************/
          postButton1.addEventListener("click", function () {              
                var sender = "<?php echo $session_user; ?>";
                var frnd_receiver = <?php echo $user_data['userId']?>;
                alert(frnd_receiver);
                myFirebase.child('AllUsers/').child('userId_'+sender).set({
                    firstName: "<?php echo $this->session->userdata('firstName')?>",
                    user_image: "<?php 
                        if (strpos($this->session->userdata('profileImage'), 'profileImages') !== false || ($this->session->userdata('profileImage') == '')) {
                            echo base_url('assets/image/Icon-user-1.png');
                        } else {
                            echo base_url()."profileImages/".$this->session->userdata('profileImage');
                        }
                        ?>"
                     });
              myFirebase.child('AllUsers/').child('userId_'+frnd_receiver).set({
                    firstName: "<?php echo $user_data['firstName']?>",
                    user_image: "<?php 
                        if (strpos($user_data['profileImage'], 'profileImages') !== false || ($user_data['profileImage'] == '')) {
                            echo base_url('assets/image/Icon-user-1.png');
                        } else {
                            echo base_url()."profileImages/".$user_data['profileImage'];
                        }
                        ?>"
                     }); 
               
            });   
            /********************************End frnd add  AllUsers to insert in firebase***/
            
            /********************************Start Show Chat list******************************/  
             var startListening = function () {
                parent.on('child_added', function (snapshot) {
                    var msg = snapshot.val();
                   // alert(msg.message);
                    var session_user = '<?php echo $session_user; ?>';                  
                    //var msgElement = document.createElement('ul');
                    var msgElement = document.createElement('li');
                    //msgElement.className = 'messages';
                    // Now create and append to msgElement
                    if (msg.sender == session_user) {
                        //////////////////////////////Start Your Reply/////////////////////////////
                        msgElement.className = 'i';
                        var innerDiv = document.createElement('div');
                        innerDiv.className = 'profile-image';
                        // The variable msgElement is still good... Just append to it.
                        msgElement.appendChild(innerDiv);
                        
                        ///////////////////for Image///////////////////
                        var msgTextElementImg = document.createElement("img");
                        msgTextElementImg.setAttribute("src", "<?php 
                        if (strpos($this->session->userdata('profileImage'), 'profileImages') !== false || ($this->session->userdata('profileImage') == '')) {
                            echo base_url('assets/image/Icon-user-1.png');
                        } else {
                            echo base_url()."profileImages/".$this->session->userdata('profileImage');
                        }
                        ?>");
                        msgTextElementImg.width = '50';
                        msgTextElementImg.height = '50';                 
                        innerDiv.appendChild(msgTextElementImg);
                        ///////////////////End/////////////////////////
                        
                        var innerDivchatreply = document.createElement('div');
                        innerDivchatreply.className = 'message-new';
                        msgElement.appendChild(innerDivchatreply);

                        //for massage 
                         var msgTextElementMsg = document.createElement("p");
                         msgTextElementMsg.textContent = msg.message;
                         innerDivchatreply.appendChild(msgTextElementMsg);

                        //for Time 
                        var tm = new Date(parseInt(msg.time)).toLocaleTimeString();                      
                        var msgTextElementDate = document.createElement("p");
                        msgTextElementDate.className = 'time-new';
                        msgTextElementDate.textContent = tm;
                        innerDivchatreply.appendChild(msgTextElementDate);
                       //////////////////////////////End Your Reply/////////////////////////////
                    } else {
                        //////////////////////////////User Reply/////////////////////////////
                        msgElement.className = 'friend-with-a-SVAGina';
                        var innerDiv = document.createElement('div');
                        innerDiv.className = 'reply-profile-image';
                        msgElement.appendChild(innerDiv);
                        
                        ///////////////////for Image///////////////////
                        var msgTextElementImg = document.createElement("img");
                        msgTextElementImg.setAttribute("src", "<?php 
                        if (strpos($user_data['profileImage'], 'profileImages') !== false || ($user_data['profileImage'] == '')) {
                            echo base_url('assets/image/Icon-user-1.png');
                        } else {
                            echo base_url('profileImages/' . $user_data['profileImage']);
                        }
                        ?>");
                        msgTextElementImg.width = '50';
                        msgTextElementImg.height = '50';                
                        innerDiv.appendChild(msgTextElementImg);
                        ///////////////////End///////////////////////// 
                        
                        var innerDivchatreply = document.createElement('div');
                        innerDivchatreply.className = 'message-new-reply';
                        msgElement.appendChild(innerDivchatreply);

                        //for massage 
                         var msgTextElementMsg = document.createElement("p");
                         msgTextElementMsg.textContent = msg.message;
                         innerDivchatreply.appendChild(msgTextElementMsg);

                        //for Time 
                        var tm = new Date(parseInt(msg.time)).toLocaleTimeString();                      
                        var msgTextElementDate = document.createElement("p");
                        msgTextElementDate.className = 'time-new-reply';
                        msgTextElementDate.textContent = tm;
                        innerDivchatreply.appendChild(msgTextElementDate);

                    }
                     //////////////////////////////End User Reply/////////////////////////////
                   document.getElementById("results").appendChild(msgElement);
                    $("#results").scrollTop(9999); 
                });
            }
              /********************************End Chat list******************************/  
            
            /********************************get frnd list******************************/ 
            
                var startUserList = function () {             
                userlist.on('child_added', function (snapshot) {
                var userDetail = snapshot.val();    
                var userDetailID = snapshot.key();
                var friendID=userDetailID.split('_');                  
                    var session_user = '<?php echo $session_user; ?>';                   
                   // alert(session_user);
                    var userlink = document.createElement("a");
                    var listElement = document.createElement('li');
                        //listElement.className = '';
                        
                       ///////////////////for Image///////////////////                       
                        var userlink = document.createElement("a");
                         userlink.className = 'contact-list-person';
                        userlink.setAttribute("href", "<?php echo base_url("index.php/chat/online/");?>"+friendID['1']+"");
                        listElement.appendChild(userlink);
                       ///////////////////End/////////////////////////  
                        
                       ///////////////////for Image///////////////////
                        var msgUserElementImg = document.createElement("img");
                        msgUserElementImg.setAttribute("src", userDetail.image);
                        msgUserElementImg.width = '50';
                        msgUserElementImg.height = '50';
                        userlink.appendChild(msgUserElementImg);
                      ///////////////////End/////////////////////////  
                   
                        var userInfoDiv = document.createElement('div');
                        userInfoDiv.className = 'info';
                        userlink.appendChild(userInfoDiv);
                        
                        
                        var nameInfoDiv = document.createElement('div');
                        nameInfoDiv.className = 'user';
                        nameInfoDiv.textContent = userDetail.name;
                        userInfoDiv.appendChild(nameInfoDiv);

                        //for massage 
                         var userDescription = document.createElement("p");
                         userDescription.className = 'description';
                         userDescription.textContent = (userDetail.message).substr(0, 20);
                         userInfoDiv.appendChild(userDescription);
               
                   document.getElementById("user_list").appendChild(listElement);
                    $("#user_list").scrollTop(9999); 
                });
            }
            /********************************End get frnd list******************************/
            // Begin listening for data
            startListening();
            startUserList();

</script>
       
        
   

        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('#demo1').skdslider({'delay': 3500, 'animationSpeed': 3500, 'showNextPrev': true, 'showPlayButton': true, 'autoSlide': true, 'animationType': 'fading'});


                jQuery('#responsive').change(function () {
                    $('#responsive_wrapper').width(jQuery(this).val());
                });

            });
        </script>
      <script src="<?php echo base_url(); ?>assets/js/chat/chat.js"></script>
      
      <!--script for chat section end-->
       
        
       
    </body>
</html>
