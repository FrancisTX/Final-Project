<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description">
    <meta name="author">
    <meta name="generator" content="Hugo 0.88.1">
    <title>my question</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
</head>
<body>
<?php
    session_start();
    if(!isset($_SESSION["username"])){
        echo "<script>
            alert('Log in first');
            window.location.href='index.php';
            </script>";
    }
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand"> 
        <?php
        
        printf("%s's question",$_SESSION["username"])
        ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>

  <?php
  printf("<a href=\"/home.php\" class=\"btn btn-info my-2 my-sm-0\" style=\"margin:3px;width: 125px;\">Back home</a>");
  ?>
</nav>

<?php
include 'connectDB.php';
$select = "select question_id, uid, tag, title, body, question_time, status
        from Question as q, Users as u
        where q.uid = u.user_id
        and u.username = ?;";
$stmt = $conn->prepare($select);
$stmt->bind_param('s', $_SESSION["username"]);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($question_id, $uid, $tag, $title, $body, $question_time, $status);

if ($stmt->num_rows > 0){
  while ($row = $stmt->fetch()) {
      printf(
      "<div class=\"card-group\" style=\"display: inline-block;\">
      <div class=\"card mx-auto\" style=\"width: 80rem; margin:3px\">
      <div class=\"card-body\">
      <h5 class=\"card-title\">%s</h5>
      <p class=\"card-text\">%s</p>
      <div style=\"display: inline-flex\">
      <a href=\"/post.php?qid=%s\" class=\"card-link\" style=\"margin: 5px;\">View the question</a>
      <p class=\"card-text\" style=\"margin: 5px;\">(%s)</p> 
      </div>
      <div style=\"display: inline-flex;float: right;\">
        <p class=\"card-text\" style=\"margin: 5px;\" >%s</p> 
      </div>
      </div>
      </div>
      </div>", $title, $body, $question_id, $status, $question_time);
  }
}

?>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</html>