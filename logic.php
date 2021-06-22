<?php

$conn = mysqli_connect("127.0.0.1", "root", "", "microblog");

if(!$conn){
    echo "<h3>Error Database Connection<h3>";
}


$sql = "SELECT * FROM data ORDER BY id DESC";
$query = mysqli_query($conn, $sql);

// Create a new post
if(isset($_REQUEST['new_post'])){
    $content = $_REQUEST['content'];
    $time = date('Y-m-d H:i:s');
    $img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));

    $sql = "INSERT INTO data(content, time, img) VALUES('$content', '$time', '$img')";
    mysqli_query($conn, $sql);

    //echo $sql;

    header("Location: index.php");
    exit();
}

// Get post data based on id
if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM data WHERE id = $id";
    $query = mysqli_query($conn, $sql);
}

// Delete a post
if(isset($_REQUEST['delete'])){
    $id = $_REQUEST['id'];

    $sql = "DELETE FROM data WHERE id = $id";
    mysqli_query($conn, $sql);

    header("Location: index.php");
    exit();
}

// Update a post
if(isset($_REQUEST['update'])){
    $id = $_REQUEST['id'];
    $content = $_REQUEST['content'];
    $img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));

    $sql = "UPDATE data SET content = '$content', img = '$img' WHERE id = $id";
    mysqli_query($conn, $sql);

    header("Location: index.php");
    exit();
}

