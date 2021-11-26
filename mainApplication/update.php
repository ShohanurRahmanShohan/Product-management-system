<?php
$error =[];
$sus = 0;
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$id =$_GET['id']??null ;
if (!$id) {
    header('location:index.php');
    exit;
}
$statement =$pdo->prepare(' SELECT * FROM  products WHERE id = :id');
$statement->bindValue(':id',$id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);
$title=$product['title'];
$pries=$product['pries'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $pries = $_POST['pries'];
    if (!$title) {
      $error[] ='Product title is required';
    };
    if (!$pries) {
      $error[] ='Prise is required';
    };
    if (empty($error)) {
    $statement = $pdo->prepare("UPDATE products SET title = :title ,pries = :pries");
    $statement->bindValue(':title',$title);
    $statement->bindValue(':pries',$pries);
    $statement->bindValue(':id',$id);
    $statement->execute();
    $sus=1;
    };
      };
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Create post</title>
    <?php if ($sus===1):?> 
      <div class="alert alert-primary" role="alert">
        Product Updatet
</div>
    <?php endif ?>
  </head>
  <body>
  <h1 style="text-align: center;
    margin-bottom: 10px;
    margin-top: 10px;color: cadetblue;">  Update product <?php echo $product['title'] ?></h1>
    <a href="index.php" class="btn btn-warning">Go back Home</a>
    <?php if (!empty($error)):?>
    <div class="alert alert-danger">
        <?php foreach($error as $error): ?>
          <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
    <?php endif ?>
    <form action="" method="POST" enctype="multiart/form-data">
  <div class="form-group">
  <label for="exampleInputEmail1">Image </label>
    <br>
    <input name="image" type="file">
    <br>
    <br>
    <label class="td" for="exampleInputEmail1" >Title</label>
    <br>
    <input name="title" type="text" class="form-control" value="<?php  echo "$title"?>" >
    <br>
    <label class="td" for="exampleInputEmail1">Price</label>
    <br>
    <input name="pries"type="number" step=".01" class="form-control" value="<?php  echo "$pries"?>">
   </div>
   <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </body>
</html>