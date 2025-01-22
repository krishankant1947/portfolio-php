<?php

function kk_title(){
    return "Register Now";
}
function kk_content(){
?>
<?php
$array=array();
require "config.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(empty($array)){
      $sql="insert into users (full_name,email,password_string, role_id) values(:full_name,:email_address,:password, :role_id)";
      $stmt=$pdo->prepare($sql);
      $stmt->execute([
        'role_id' =>  9,
        "full_name"=>$_POST['full_name'],
        "email_address"=>$_POST['email_address'],
        "password"=> password_hash($_POST['password'],  PASSWORD_DEFAULT)
      ]);
      echo'data inserted';
  }
}

$orig = "admin123";
echo $enc = password_hash($orig, PASSWORD_DEFAULT);
var_dump("\n", $orig == $enc, password_verify($orig, $enc));

echo "<br/>",md5($orig), "<br/>";
echo sha1($orig);
?>
    <div class="register-box">
      <div class="register-logo">
        <a href="../index2.html"><b>Admin</b>LTE</a>
      </div>
      <!-- /.register-logo -->
      <div class="card">
        <div class="card-body register-card-body">
          <p class="register-box-msg">Register a new membership</p>
          <form action="register.php" method="post">
            <div class="input-group mb-3">
              <input type="text" name="full_name" class="form-control" placeholder="Full Name" />
              <div class="input-group-text"><span class="bi bi-person"></span></div>
            </div>
            <div class="input-group mb-3">
              <input type="email" name="email_address" class="form-control" placeholder="Email" />
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password" />
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <!--begin::Row-->
            <div class="row">
              <div class="col-8">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  <label class="form-check-label" for="flexCheckDefault">
                    I agree to the <a href="#">terms</a>
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary"><a href/="login.php">Sign in</a></button>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </form>
          <div class="social-auth-links text-center mb-3 d-grid gap-2">
            <p>- OR -</p>
            <a href="#" class="btn btn-primary">
              <i class="bi bi-facebook me-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-danger">
              <i class="bi bi-google me-2"></i> Sign in using Google+
            </a>
          </div>
          <!-- /.social-auth-links -->
          <p class="mb-0">
            <a href="login.html" class="text-center"> I already have a membership </a>
          </p>
        </div>
        <!-- /.register-card-body -->
      </div>
    </div>
    <!-- /.register-box -->
<?php
}

require 'layout/guest.php';
?>