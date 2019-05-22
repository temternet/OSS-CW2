<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

      // build an sql statment to update the student details
      $sql = "update student set firstname ='" . $_POST['txtfirstname'] . "',";
      $sql .= "lastname ='" . $_POST['txtlastname']  . "',";
      $sql .= "house ='" . $_POST['txthouse']  . "',";
      $sql .= "town ='" . $_POST['txttown']  . "',";
      $sql .= "county ='" . $_POST['txtcounty']  . "',";
      $sql .= "country ='" . $_POST['txtcountry']  . "',";
      $sql .= "postcode ='" . $_POST['txtpostcode']  . "' ";
      $sql .= "where studentid = '" . $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);

      $data['content'] = "<p>Your details have been updated</p>";

   }
   else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <div class="jumbotron vertical-center" style="margin-bottom:0">
   <h2 style="text-align: center">My Details</h2>
   <form name="frmdetails" action="" method="post">
   <div class="row">
     <div class="col-sm-4" style=""></div>
     <div class="col-sm-2" style="background-color:lavender;">First Name :</div>
     <div class="col-sm-2" style="background-color:lavenderblush;"><input name="txtfirstname" type="text" value="{$row['firstname']}" /></div>
   </div>
   <div class="row">
     <div class="col-sm-4" style=""></div>
     <div class="col-sm-2" style="background-color:lavender;">Surname :</div>
     <div class="col-sm-2" style="background-color:lavenderblush;"><input name="txtlastname" type="text"  value="{$row['lastname']}" /></div>
   </div>
   <div class="row">
     <div class="col-sm-4" style=""></div>
     <div class="col-sm-2" style="background-color:lavender;">.Number and Street :</div>
     <div class="col-sm-2" style="background-color:lavenderblush;"><input name="txthouse" type="text"  value="{$row['house']}" /></div>
   </div>
   <div class="row">
     <div class="col-sm-4" style=""></div>
     <div class="col-sm-2" style="background-color:lavender;">Town :</div>
     <div class="col-sm-2" style="background-color:lavenderblush;"><input name="txttown" type="text"  value="{$row['town']}" /></div>
   </div>
   <div class="row">
     <div class="col-sm-4" style=""></div>
     <div class="col-sm-2" style="background-color:lavender;">County :</div>
     <div class="col-sm-2" style="background-color:lavenderblush;"><input name="txtcounty" type="text"  value="{$row['county']}" /></div>
   </div>
   <div class="row">
     <div class="col-sm-4" style=""></div>
     <div class="col-sm-2" style="background-color:lavender;">Country :</div>
     <div class="col-sm-2" style="background-color:lavenderblush;"><input name="txtcountry" type="text"  value="{$row['country']}" /></div>
   </div>
   <div class="row">
     <div class="col-sm-4" style=""></div>
     <div class="col-sm-2" style="background-color:lavender;">Postcode :</div>
     <div class="col-sm-2" style="background-color:lavenderblush;"><input name="txtpostcode" type="text"  value="{$row['postcode']}" /></div>
   </div>
   <div class="row">
     <div class="col-sm-4" style=""></div>
     <div class="col-sm-2" style="background-color:lavender;"></div>
     <div class="col-sm-2" style="background-color:lavenderblush;"><input type="submit" value="Save" name="submit"/></div>
   </div>
   </div>
   </form>

EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
