<?php include "logic.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>Microblogging Applikation</title>
</head>
<body>

<div class="container mt-5">
    <form method="POST" enctype="multipart/form-data" action="index.php">
        <textarea required onmouseout="checkText()" onchange="checkText()" id="name" name="content" class="form-control my-3 bg-light text-dark" cols="30" rows="10" maxlength="280" placeholder="Was gibt's Neues?"></textarea>
        <input type="file" name="img_upload"><br><br>
        <button id="submit" disabled class="btn btn-primary twitter" name="new_post">Twittern</button>
    </form>
</div>



<!-- Disabled button -->
<script>
    function checkText() {
        var name = $('#name').val();
        if(name.length !== 0)
            $('#submit').removeAttr('disabled');
        else
            $('#submit').attr('disabled', 'disabled');
    }
</script>



<!-- Display posts from database -->
<div class="row">
    <div class="col md-12">
        <p class="tweets p-3">Tweets</p>
    </div>

    <?php
    foreach($query as $q){
        ?>
        <div class="col-12 col-lg-12 d-flex justify-content-center">
            <div class="card text-dark bg-light mt-5" style="width: 50%; margin: auto">
                <div class="card-body">
                    <p class="card-text"><?php echo $q['content']; ?><span style="float: right" class="text-secondary"><?php echo $q['time']; ?></span></p>

                    <br>
                    <?php $show_img = base64_encode($q['img']); ?>
                    <img class="img" src="data:image/jpeg;base64, <?php echo $show_img ?>"> <br>

                    <div class="btn-group" style="float: right">
                        <button class="bg-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: none; font-size: 25px; outline: none;">
                            ...
                        </button>
                        <div class="dropdown-menu">
                            <form method="POST">
                                <input type="text" hidden value='<?php echo $q['id']?>' name="id">
                                <button class="btn btn-white text-danger btn-sm" name="delete">Löschen</button>
                            </form>
                            <div class="dropdown-divider"></div>
                            <a href="edit.php?id=<?php echo $q['id']?>" class="btn btn-white btn-sm" name="edit">Bearbeiten</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>