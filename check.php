<h3>Track your email</h3>
<form method="GET" id="generateForm">
   <label>Generate TRACKING ID by writing below:</label><br/>
   <input type="text" name="generateid" id="imgidGenerator"/>
   <input type="button" value="Generate" onclick="generateImgId()"/><br/>
   <small>Click on generate again after you sent the email just to make sure there are no pre-fetches from the mail service</small><br/>
<?php 
   $genId = $_GET["generateid"];
   $actual_link = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/track.php?imgid='.$genId;
   if(isset($genId)) echo '<div id="generatedImgid"><b>'.$actual_link.'</b></div>';
   $str=file_get_contents('./emails.db');
   $str=str_replace($genId, "", $str);
   file_put_contents('./emails.db', $str);
?>
</form>
<script>
function generateImgId() {
   var imgid = document.getElementById('imgidGenerator').value;
   var url = location.href.substring(0, location.href.lastIndexOf("/")+1);
   if(imgid !== '') {
      //document.getElementById('generatedImgid').innerHTML = url + 'track.php?imgid=' + imgid;
      document.getElementById('generateForm').submit();
   }
   else {
      alert('ID cannot be empty');
   }
}
</script>
<br/><br/>
<form method="GET">
   <label>Track an email by some existing TRACKING ID:</label><br/>
   <input type="text" name="imgid"/>
   <input type="submit" value="Check!"/>
</form>
<?php

if(empty($_GET['imgid'])) exit;
if( exec('grep '.escapeshellarg($_GET['imgid']).' ./emails.db')) {
   echo '<b>Your email is seen :)</b>';
}
else {
   echo '<b>Your email is NOT seen :(</b>';
}
?>