<?php 

    include_once('db.php');
    $title="Add";
    $btn_title="Save";
    $name = "";
    $description = "";
    $image = "";
if (isset($_GET['action']) && $_GET['action'] == 'edit'){
    $id =  $_GET['id'];
    $sql = "SELECT * FROM categories WHERE id = ".$id;
    $category =mysqli_query($con,$sql);
    if ($category){
        $title="Update" ;
        $current_category = $category->fetch_assoc();
        $name = $current_category['name'];
        $description = $current_category['description'];
        $image = $current_category['image'];
        $btn_title = "Update";
    }

}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
<div class="container">
        <div class="wrapper p-5 m-5">
            <div class="d-flex p-2 justify-content-between">
            <h2><?php echo $title; ?> user</h2>
            <div><a href="index.php" class="fs-3 text-success"><i class="fa-solid fa-backward"></i></a></div>
            </div>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" value="<?php echo $name; ?>"
                    placeholder="enter your name" name="name"
                        autocomplete="false">
                </div>
                <div class="mb-3">
                    <label class="form-label">description</label>
                    <input type="text" class="form-control"  value="<?php echo $description; ?>"
                    placeholder="enter your description" name="description"
                        autocomplete="false">
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Image</label>
                    <input type="file" class="form-control" name="image" id="inputGroupFile02">
                </div>
                    <input type="hidden" name="id" value="">
                <input type="submit" class="btn btn-primary" value="<?php echo $btn_title; ?>" name="save">
            </form>
        </div>

    </div>
    <script src="https://kit.fontawesome.com/3f5c27b3b0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>