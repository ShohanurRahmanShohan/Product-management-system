
<?php 
// databse connections 
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$statement=$pdo->prepare('SELECT * FROM products ORDER BY create_date DESC ');
$statement->execute();
$products =$statement->fetchAll(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Home</title>
  </head>
  <body>
    <h1 class= "font-weight-bold" style="text-align: center;
    margin-bottom: 10px;
    margin-top: 10px;color: cadetblue;">Product database </h1>
    <p>
      <a href="create.php" class="btn btn-success"> Create Product</a>
    </p>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Image </th>
      <th scope="col"> Title </th>
      <th scope="col"> Price </th>
      <th scope="col"> Create date </th>
      <th scope="col"> Action </th>

    </tr>
  </thead>
  <tbody>
   <?php foreach($products as $i=> $product ) : ?>
    <tr>
      <th scope="row"><?php echo $i+1 ?></th>
      <td></td>
      <td><?php echo $product['title']?></td>
      <td><?php echo $product['pries']?></td>
      <td><?php echo $product['create_date']?></td>
      <td><a href="update.php?id=<?php echo$product['id'] ?>" class="btn btn-outline-primary">Edit</a>
     <td>
       <form style="display: inline-block;" action="delete.php" method="POST">
       <input type="hidden" name="id" value="<?php echo$product['id'] ?>">
       <button type="submit" class="btn btn-outline-danger">Delete</button>
       </form>
    
      </td>
    </tr>
 <?php endforeach ?>
  </tbody>
</table>
  </body>
</html>