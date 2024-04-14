<?php 
    include_once('db.php');
    session_start();
    $_SESSION["favcolor"] = "green";
    $action = false;
    if (isset($_POST['save'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        // $image = bin2hex(file_get_contents($_FILES['image']['tmp_name']));

        if ($_POST['save'] == "Save") {
            $save_sql = "INSERT INTO `categories`( `name`, `description`)
            VALUES ('$name','$description')";
            }else{
            $id= $_POST['id'] ;
            $save_sql = "UPDATE `categories` SET `name`='$name',`description`='$description'
            WHERE id =$id " ;
            }
            
        $res_add = mysqli_query($con,$save_sql);
        if (!$res_add){
            die(mysqli_error($con));
        }else{
            if (isset($_POST['id'])){
                $action = "edit";
        }else{
                $action = "add";
            }
        
        }

}
if (isset($_GET['action']) && $_GET['action'] == 'del') {
    $id = $_GET['id'];
    $del_sql = "DELETE FROM categories WHERE id = $id";
    $res_del = mysqli_query($con, $del_sql);
    if (!$res_del) {
      die(mysqli_error($con));
  
    } else {
      $action = "del";
    }
  }
$category_sql = "SELECT * FROM categories";
$all_category = mysqli_query($con, $category_sql);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/toster.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="wrapper p-5 m-5">
            <div class="d-flex p-2 justify-content-between mb-2">
                <h2>All users</h2>
                <div><a href="add_user.php" class="text-success"><i class="fa-solid fa-user-plus fs-3"></i></a></div>

            </div>
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">description</th>
                        <th scope="col">image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

        while ($category = $all_category->fetch_assoc()) { ?>

                    <tr>

                        <td>
                        <?php echo $category['id']; ?> 
                        </td>
                        <td>
                        <?php echo $category['name']; ?> 
                        </td>
                        <td>
                        <?php echo $category['description']; ?> 
                        </td>
                        <td>
                            img   
                        </td>

                        <td>
                            <div class="d-flex p-2 justify-content-evenly mb-2">

                                <i onclick="confirm_delete(<?php echo $category['id']; ?>);"
                                    class="fa-solid fa-trash text-danger"></i>

                                <i onclick="edit(<?php echo $category['id']; ?>);"
                                    class="text-success fa-solid fa-pen-to-square"></i>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script src="js/jq.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/icons.js"></script>
        <script src="js/toster.js"></script>
        <script src="js/main.js"></script>
        <script src="js/toster.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
        <script src="https://kit.fontawesome.com/3f5c27b3b0.js" crossorigin="anonymous"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" -->
        <!-- integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"> -->
        <!-- </script> -->
        <?php
  if ($action != false) {
    if ($action == 'add') { ?>
        <script>
        show_add()
        </script>


        <?php
    }
    if ($action == 'del') { ?>
        <script>
        show_del()
        </script>


        <?php
    }
    if ($action == 'edit') { ?>
        <script>
        show_update()
        </script>


        <?php
    }
  }
  ?>

</body>

</html>