<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet">

      <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }

        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
        
      
      </style>

    
    <!-- Custom styles for this template -->
    <link href="/source/css/signin.css" rel="stylesheet">
    
  </head>


<body class="text-center">
    
<main class="form-signin">
  <form method="POST">
    <img class="mb-4" src="/source/img/logo.jpg" alt="" width="180" height="auto">

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name="floatingInput" placeholder="User Name">
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="floatingPassword" placeholder="Password">
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

    </br>
    <div class="fs-6 fw-normal" style="margin: 11px;padding: 3px;">
    Don't have account? Create one <a href="/signup.php">now</a>!
    </div>
    
    <p class="mt-5 mb-3 text-muted">
     Tongxuan Wang (tw2484) </br>
     Haoxiang Wang (hw2766)</p>
  </form>
</main>    
</body>

<?php
include 'connectDB.php';
  
if(isset($_POST['floatingInput']) && isset($_POST['floatingPassword'])) {
  $usernameInput=$_POST['floatingInput']; 
  $passwordInput=$_POST['floatingPassword'];
  if (empty($usernameInput)) {
    echo '<script>alert("Invalid Username Input")</script>';
  }else if(empty($passwordInput)){
    echo '<script> alert ("Password is required ")</script>';
  }else{
    printf("usr: %s <br>", $usernameInput);
    printf("password: %s <br>", $passwordInput); 

    $select = "select u.password, u.user_id
    from Users as u
    where u.username = ?;";

    $stmt = $conn->prepare($select);
    $stmt->bind_param('s', $usernameInput);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($password, $uid);
    $row = $stmt->fetch();
    
    if ($passwordInput == $password){
      session_start();
      $_SESSION["loggedin"] = true;
      $_SESSION["username"] = $usernameInput;
      $_SESSION["uid"] = $uid;
      header("Location: home.php");
    }else{
      echo '<script>alert("Invalid Username/Password, please try again!")</script>';
    }
  }
}
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
