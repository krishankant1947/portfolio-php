<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
  exit(header('location: dashboard.php'));
}
function kk_title(){
    return "Login Now";
}
function kk_content(){
?>
<?php
$array=array();
require "config.php";

$errors = [];

if($_SERVER['REQUEST_METHOD']=='POST'){
       
  if(!empty($_POST['admin'])){
      $array[]=("enter your data");
      $sl = "select u.email,u.id,u.password_string ,u.roles_id ,r.id as r_id,r.role_name 
      from users u join roles r on(r.id = u.roles_id) where u.email=:email" ;
      $stmt = $pdo->prepare($sl);
      $stmt->execute(['email' => $_POST['admin']]);
      $userinfo = $stmt->fetch(\PDO::FETCH_ASSOC);
      if(empty($userinfo)){
        $errors[] = "Invalid username and password";
      }

      if(!password_verify($_POST['password'], $userinfo['password_string'])){
        $errors[] = "Invalid password";
      }
      if(empty($errors)){
        $_SESSION['errors'] = '';
        $_SESSION['loggedin'] = true;
        unset($userinfo['password_string']);
        $_SESSION['user'] = $userinfo;
        header('location: dashboard.php');
        exit;
      } else{
        $_SESSION['errors'] = implode("<Br/>", $errors);
        header("location: login.php");
        die;
      }
  }
}
?>
<div class="login-box">
      <div class="login-logo">
        <a href=""><b> </b>LTE</a>
      </div>
      <!--login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>
          <form action="" method="post">
          <?php
            if(!empty($_SESSION['errors'])){
              echo $_SESSION['errors'];
              unset($_SESSION['errors']);
            }
            ?>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="admin" placeholder="Email" />
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
          <p class="mb-1"><a href="">I forgot my password</a></p>
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
