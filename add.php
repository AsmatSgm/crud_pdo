<?php 
    require_once('connection.php');

    if (isset($_REQUEST['btn_insert'])) {
        $firstname = $_REQUEST['txt_firstname'];
        $lastname = $_REQUEST['txt_lastname'];

        if (empty($firstname)) {
            $errorMsg = "Please enter Firstname";
        } else if (empty($lastname)) {
            $errorMsg = "Please enter Lastname";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $insert_stmt = $db->prepare("INSERT INTO tbl_person(firstname, lastname) VALUES (:fname, :lname)");
                    $insert_stmt->bindParam(':fname', $firstname);
                    $insert_stmt->bindParam(':lname', $lastname);

                    if ($insert_stmt->execute()) {
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2;index.php");
                    }
                }
            } catch(PDOEXCEPTION $e) {
                echo $e->getmessage();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Page</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card text-white bg-dark">
            <div class="card-header display-4 text-center">Add From</div>
            <div class="card-body">
                <?php
            if (isset($errorMsg)) {
        ?>
                <div class="alert alert-danger">
                    <strong>Wrong! <?php echo $errorMsg;?></strong>
                </div>
                <?php } ?>

                <?php
            if (isset($insertMsg)) {
        ?>
                <div class="alert alert-success">
                    <strong>Success! <?php echo $insertMsg;?></strong>
                </div>
                <?php } ?>

                <form method="post" class="form-horizontal mt-5">
                    <div class="form-group text-center">
                        <div class="row">
                            <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                            <div class="col-sm-8">
                                <input type="text" name="txt_firstname" class="form-control"
                                    placeholder="Enter Firstname...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="row">
                            <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                            <div class="col-sm-8">
                                <input type="text" name="txt_lastname" class="form-control"
                                    placeholder="Enter Lastname...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-sm-12 mt-4">
                            <input type="submit" name="btn_insert" class=" btn btn-success" value="Insert">
                            <a href="index.php" class="btn btn-danger">Cancle</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>