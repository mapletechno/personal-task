<!doctype html>
<html>
 <head>
   <title>Paytabs</title>
 </head>
 <body>
<div style='border: 3px solid #fff;padding:20px;'>
<div style='width:20%;float:left;padding:20px;' id="asd">
<select name="main_category" onchange="createSelect(this)">
			<option>Select...</option>
			
      <?php
      foreach ($users as $user):
?>
      <option value="<?=$user['id'];?>"><?=$user['name'];?>
				</option>

<?php
      endforeach;
      ?>
      
     	
		</select>


</div>
<div style='width:20%;float:left;padding:20px;'>


</div>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script type='text/javascript'>
  </script>

<script type="text/javascript">
	var base_url = "<?= base_url('') ?>";



function createSelect(a, b=0) {
//	if (!a.value || !a) alert(a.value);

  if(b==0)
  {
    if(!a.value) return;
    
  }else{
    if(!a) return;
    //let parentID = parseInt(a);

  }
  
  if(b>1)
  {
    var parentID = parseInt(a);
    
  }else{
    var parentID = parseInt(a.value);

  }
  
  var testData = document.getElementById("child-of-"+ parentID);
    if(Number.isInteger(parentID) && !testData)
{


  var select = document.createElement("SELECT");
  select.setAttribute("id", "child-of-"+parentID);
  document.body.appendChild(select);



<?php
//   if(parentID == 923){
//   var data = { "childrenCategories": [ { "id":"924", "title":"asd 2" }, { "id":"534", "title":"cvb ff 2" } ] };

// }else{
//   var data = { "childrenCategories": [ { "id":"923", "title":"asd" }, { "id":"533", "title":"cvb ff" } ] };

// }


?>
//      let data = { "childrenCategories": [ { "id":"923", "title":"asd" }, { "id":"533", "title":"cvb ff" } ] };

//  var items = ["Foo","Bar","Zoo"];
var newOption = document.createElement("option");
newOption.setAttribute("value", "subcategory");
    var textNode = document.createTextNode("select a subcategory");
    newOption.appendChild(textNode);
    select.appendChild(newOption);

    
//    var username = $(this).val();
    $.ajax({
     url:'<?=base_url()?>index.php/User/userDetails',
     method: 'post',
     data: {username: parentID},
     dataType: 'json',
     success: function(response){
     //  alert(response);
       var len = response.length;
       $('#suname,#sname,#semail').text('');
      
       $.each(response, function(index) {
//put attributes here
var newOption = document.createElement("option");
    newOption.setAttribute("value", response[index].id);
    var textNode = document.createTextNode(response[index].name);
    newOption.appendChild(textNode);
    select.appendChild(newOption);

      });
       if(len > 0){
         // Read values
         
 
       }





//add select function to children
$("#child-of-"+parentID).on('change', function () {
   // alert("getElementById....");
   var username = $(this).val();
    $.ajax({
     url:'<?=base_url()?>index.php/User/userDetails',
     method: 'post',
     data: {username: username},
     dataType: 'json',
     success: function(response){
       //alert(response[0]);
       var len = response.length;
     
       createSelect(username, b=3);
 
     }
   });

});



 
     }
   }).done(function() {
//        alert('Done!');
    }).fail(function() {
        alert('Fail!');
    });;


  }

}
</script>





<?php
 
// print_r($users);
 exit();
 ?>
 </body>
</html>