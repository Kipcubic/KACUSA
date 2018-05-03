<?php
 $message = '';
include('dbCon.php');
    if (isset($_POST["register"])) {
      if ( $_POST['user_password_new']!== $_POST['user_password_repeat'])
      {
        $message="Password Did Not Match! Please try Again";
        
      }
      else
      {
           $query = "
              INSERT INTO users (first_name,last_name,course,course_duration,institution,reg_number,campustown,gender,phone_number,year_of_admission,village,user_password_hash,user_email, user_registration_datetime) 
              VALUES (:first_name,:last_name,:course,:course_duration,:institution,:regNo,:campustown,:gender,:phone_number,:year_of_admission,:village,:user_password_hash,:user_email, :user_registration_datetime)
                   ";
              $statement = $connect->prepare($query);
               $statement->execute(
           array(
                  ':first_name' =>  $_POST["first_name"],
                  'last_name'=>  $_POST["last_name"],
                  'course'=>  $_POST["course"],
                  'course_duration'=>  $_POST["course_duration"],
                  'institution'=>  $_POST["institution"],
                  'regNo'=>  $_POST["regNo"],
                  'campustown'=>  $_POST["campustown"],
                  'gender'=>  $_POST["gender"],
                  'phone_number'=>  $_POST["phone_number"],
                  'year_of_admission'=>  $_POST["year_of_admission"],
                  'village'=>  $_POST["village"],
                  'user_password_hash'=>  password_hash($_POST["user_password_new"], PASSWORD_DEFAULT),
                  'user_email'=>  $_POST["user_email"],
                  'user_registration_datetime'=> '2018'
                )
    );
    $result = $statement->fetchAll();
    if(isset($result))
    {
      header("Location: success.html");
die();
    }
      }
     
     
            
         

      
        } 
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="KACUSA Registration Form" content="KACUSA Registration form, Kalokol College And University  Website Registration">
  <meta name="Kipcubic" content="">
  <title>KACUSA Registration</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">KACUSA Registration Form</div>
      <div class="card-body">
        <form method="post" action="register.php" name="registerform" class="needs-validation" novalidate>
        
            <?php echo $message; ?>       
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">First name</label>
                <input class="form-control" name="first_name" id="first_name" type="text" aria-describedby="nameHelp" placeholder="Enter first name" required>
                <div class="invalid-feedback">
                       Please Provide Your First Name.
                </div>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last name</label>
                <input class="form-control" name="last_name" id="last_name" type="text" aria-describedby="nameHelp" placeholder="Enter last name" required>
                <div class="invalid-feedback">
                       Please Provide Your Last Name.
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Mobile Number</label>
                <input class="form-control" name="phone_number" id="phone_number" type="Number" required placeholder="0711253***">
                <div class="invalid-feedback">
                       Please Provide Your Mobile Number.
                </div>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Village</label>
                <input class="form-control" id="village" name="village" type="text" aria-describedby="nameHelp" placeholder="Eg Nakiria" required>
                <div class="invalid-feedback">
                       Please Provide the name of your Village.
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Course</label>
                <input class="form-control" name="course" id="course" type="text" aria-describedby="nameHelp" required placeholder="Eg Business Management">
                <div class="invalid-feedback">
                       Please Provide the Name of your Course.
                </div>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Learning Institution</label>
                <input class="form-control" name="institution" id="institution" type="text" aria-describedby="nameHelp" placeholder="Eg Kings College" required>
                <div class="invalid-feedback">
                       Please Type your Learning Institution.
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Registration Number</label>
                <input class="form-control" name="regNo" id="regNo" type="text" aria-describedby="nameHelp" placeholder="Eg E17/2018" required>
                <div class="invalid-feedback">
                       Please Provide your Admission Number.
                </div>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Institution Location</label>
                <input class="form-control" name="campustown" id="campustown" type="text" aria-describedby="nameHelp" placeholder="Eg Nairobi">
              </div>
            </div>
          </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Course Duration</label>
                <input class="form-control" name="course_duration" id="course_duration" type="text" aria-describedby="nameHelp" placeholder="Eg 2 Years">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Year of Admission</label>
                <input class="form-control" name="year_of_admission" id="year_of_admission" type="Number" aria-describedby="nameHelp" placeholder="Eg 2016 ">
              </div>
            </div>
          </div>

          
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="user_email" name="user_email" type="email" aria-describedby="emailHelp" placeholder="Enter email">
            <div class="invalid-feedback">
                       Please Provide Valid Email address.
                </div>
          </div>
          <div class="form-group">
                <label>Select Gender</label>  
                          <select name="gender" id="gender">  
                               <option  value="Male">Male</option>  
                               <option value="Female">Female</option>  
                          </select> 
               </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input class="form-control" name="user_password_new" id="user_password_new" type="password" required placeholder="Password" autocomplete="off">
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input class="form-control" name="user_password_repeat" id="user_password_repeat" type="password" placeholder="Confirm password">
              </div>
            </div>
          </div>
          <div class="form-group">
          <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
    <label class="form-check-label" for="exampleCheck1">I have read and understood the <a href="#">Constitution</a>  of Kalokol college and university student association and accepted to abide by the rules and regulation of operation of the group. I will work with other members to benefit the group</label>
    <div class="invalid-feedback">
                       Please Accept to KACUSA rules and Regulations
                </div>
  </div>
        </div>
          <div class="form-group">
            <input type="submit" name="register" class="btn btn-primary btn-block btn-lg"  value="Register" />
            </div>
          </div>
          <div class="form-group">
   

        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login Page</a>
         
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
 
</script>