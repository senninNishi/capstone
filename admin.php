<html>
    <head>
        <title> Admin Page</title>
    </head>

    <body>
        <center>

        <h1>Search data into Textbox and update it using PHP</h1>
            <form action="" method = "POST">

                <input type = "text" name ="id" placeholder = "Enter username for search"/><br>
                <input type = "submit" name="search" value = "Search Data"/>

            </form>

            <?php

                $connection = mysqli_connect("localhost", "root", "");
                $db = mysqli_select_db($connection,'capstone1');

                if(isset($_POST['search']))
                {
                    $id = $_POST['id'];

                    $query = "SELECT * FROM logininfo where username='$id' ";
                    $query_run = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($query_run))
                    {
                        ?>

                        <input type="hidden" name="id" value="<?php echo $row['id']?>"/><br>
                        <input type="hidden" name="id" value="<?php echo $row['id']?>"/><br>
                        <input type="hidden" name="id" value="<?php echo $row['id']?>"/><br>
                        <input type="hidden" name="id" value="<?php echo $row['id']?>"/><br>
                        <input type="hidden" name="id" value="<?php echo $row['id']?>"/><br>
                        <input type="hidden" name="id" value="<?php echo $row['id']?>"/><br>
                        <input type="hidden" name="id" value="<?php echo $row['id']?>"/><br>


                        <?php
                    }
                }

            ?>

        </center>


</body>

</html>