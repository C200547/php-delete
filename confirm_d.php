<?php
  session_start();

  $name = $_POST['name'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $delete = $_POST['delete'];
  
  $_SESSION['name'] = $_POST['name'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['gender'] = $_POST['gender'];
  $_SESSION['delete'] = $_POST['delete'];

  $dbh = db_conn();

  try{
    $sql = "SELECT * FROM user WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $delete, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

  }catch (PDOException $e){
    echo($e->getMessage());
    die();
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>削除確認画面</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <header>
       <div>
            <h1>削除確認画面</h1>
       </div>
    </header>
</div>
<hr>

<div class="form-group">
    <label for="name"><span>お名前</span></label>
    <p><?php echo $row[name];?></p>
</div>
<div class="form-group">
    <label for="email"><span>メールアドレス</span></label>
    <p><?php echo $row[email];?></p>
</div>
<div class="form-group">
    <label><span>性別</span></label>

    <div>
    <?php
          echo "<label class='radio-inline'>";
          if( $row[gender] === 1 ) {
             echo "男性";
          } elseif( $row[gender] === 2 ) {
             echo "女性";
          } elseif( $row[gender] === 9 ) {
             echo "その他";
          }
          echo "</label>";
   ?>
    </div>

</div>

<p>こちらのデータを削除してよろしいですか？</p>
<form action="complete_d.php" method="POST">
<div class="button-wrapper">
    <button type="button" onclick="location.href='list_d.php'">戻る</button>
    <button type="submit" class="btn btn--naby btn--shadow">削除する</button>
</div>
</form>
<hr>
<div class="container">
    <footer>
        <p>CCC.</p>
    </footer>
</div>
</body>
</html>
