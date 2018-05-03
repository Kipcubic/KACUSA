<?php 
include('dbCon.php');

if(isset($_POST["user_id"]))
{
	$statement = $connect->prepare(
   "UPDATE users 
   SET user_active=1 WHERE user_id = :id"
  );
  $result = $statement->execute(
   array(
    ':id'   => $_POST["user_id"]
   )
  );
  if(!empty($result))
  {
   echo 'User Activated Successfully';
  }
}
?>