<?php 
BaseView::getHeader();
?>

<form action="/action.php">

  <label for="fname">Title :</label><br>
  <input type="text" id="ftitle" value="title"><br><br>
  <label for="lname">Content :</label><br>
  <textarea type="text" id="fcontent" value="content"></textarea><br><br>
  <button type="submit" value="Submit">ChargePourBase</button>

</form>

<?php 
BaseView::getFooter();
?>







