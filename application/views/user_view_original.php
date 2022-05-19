<!doctype html>
<html>
 <head>
   <title>How to send AJAX request in Codeigniter</title>
 </head>
 <body>
 
  Select Username : <select id='sel_user'>
     <?php 
     foreach($users as $user){
	echo "<option value='".$user['username']."' >".$user['username']."</option>";
     }
     ?>
  </select>

  <!-- User details -->
  <div >
   Username : <span id='suname'></span><br/>
   First Name : <span id='fname'></span><br/>
   Last Name : <span id='lname'></span><br/>
   
   Email : <span id='semail'></span><br/>
  </div>

  <!-- Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript'>
  $(document).ready(function(){
 
   $('#sel_user').change(function(){
    var username = $(this).val();
    $.ajax({
     url:'<?=base_url()?>index.php/User/userDetails',
     method: 'post',
     data: {username: username},
     dataType: 'json',
     success: function(response){
       var len = response.length;
       $('#suname,#sname,#semail').text('');
       if(len > 0){
         // Read values
         var uname = response[0].username;
         var fname = response[0].first_name;
         var lname = response[0].last_name;
         var email = response[0].email;
 
         $('#suname').text(uname);
         $('#fname').text(fname);
         $('#lname').text(lname);
         $('#semail').text(email);
 
       }
 
     }
   });
  });
 });
 </script>
 </body>
</html>