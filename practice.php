<?php
    $stays = json_decode(file_get_contents('stays.json'));
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sample Website</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

   <div class="container py-5">
       <h1 class ="display-2 text-center mb-5">Sample stays.</h1>
       <div class = "row">
           <?php foreach($stays as $stay):?>

            <div class="col-12 col-md-4">
                <div class="card p-4 mb-5">
                    <img class ="card-img-top" src = "<?php echo $stay->image;?>">
                    <h2 class="h3 mb-0">
                        <?php echo $stay->name; ?>
                    </h2>
                    <p class="lead">
                        <?php echo $stay->price; ?>
           </p>
           </div>
           </div>
           <?php endforeach; ?>
           </div>
   </div>
  </body>
</html>