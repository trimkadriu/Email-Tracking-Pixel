<h3>Track your email</h3>
<label>Generate TRACKING ID by writing below:</label>
<input type="text" id="imgidGenerator"/>
<input type="submit" value="Generate" onclick="generateImgId()"/><br/><br/>
<div id="generatedImgid"></div>
<script>
function generateImgId() {
   var imgid = document.getElementById('imgidGenerator').value;
   var url = location.href.substring(0, location.href.lastIndexOf("/")+1);
   if(imgid !== '') {
      document.getElementById('generatedImgid').innerHTML = url + 'track.php?imgid=' + imgid;
   }
   else {
      alert('ID cannot be empty');
   }
}
</script>
<br/><br/>
<form method="GET">
   <label>Track an email by some existing TRACKING ID:</label>
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