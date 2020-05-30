<?php
    require_once('connection.php');
    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];
        // echo $id;
        $select_stmt = $db->prepare("SELECT * FROM tbl_person WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        $delete_stmt = $db->prepare("DELETE FROM tbl_person WHERE id = :id");
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header('Location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Page</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>

    <div class="container mt-5">

    <div class="card text-white bg-dark mb-3">
  <h5 class="card-header display-4 text-center">Information  <a href="add.php" class="btn btn-success mb-3 float-right">Add+</a></h5>
  <div class="card-body">
 
    <table class="table table-striped table-dark table-bordered table-hover">
        <thead  class="text-center">
            <tr>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>EDIT</th>
                <th>DELETE</th>
            </tr>
        </thead>    
        <tbody class="text-center">
            <?php 
                $select_stmt = $db->prepare("SELECT * FROM tbl_person");
                $select_stmt->execute();
                
                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
      
            <tr >
                <td><?php echo $row["firstname"];?></td>
                <td><?php echo $row["lastname"];?></td>
                <td><a href="edit.php?update_id=<?php echo $row["id"];?>" class="btn btn-warning">Edit</a></td>
                <td><a href="?delete_id=<?php echo $row["id"];?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
  </div>
</div>

    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>