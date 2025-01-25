<?php

function kk_title(){
    return "Login Now";
}
function kk_content(){
?>
<?php
$array=array();
require "config.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
       
  if(empty($_POST['email'])){
      $array[]=("enter your data");
  }
  if(empty($array)){
      $sql="insert into roles (title,password) values (:email,:password)";
      $stmt=$pdo->prepare($sql);
      $stmt->execute([
        'email' => $_POST['email'],
        "password"=> password_hash($_POST['password'], PASSWORD_DEFAULT)
      ]);
 };
 

}
?>
<div class="login-box">
      <div class="login-logo">
        <a href="../index2.html"><b><?php echo kk_site();?> </b>LTE</a>
      </div>
      <!--login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>
          <form action="<?php echo kk_get_url('post_login');?>" method="post">
          <?php
            if(!empty($array)){
             echo '';
             for($a=0 ; $a < count($array); $a++){
              echo $array[$a];
             }
            }
            ?>
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="email" placeholder="Email" />
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password" />
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <!--begin::Row-->
            <div class="row">
              <div class="col-8">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Sign In</button>
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
          <p class="mb-1"><a href="forgot-password.html">I forgot my password</a></p>
          <p class="mb-0">
            <a href="register.html" class="text-center"> Register a new membership </a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>

<?php
}

require 'layout/guest.php';
?>