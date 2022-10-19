<?php

    include 'config.php';
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    {
        header("location: login.php");
    }


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOUSE OF WISDOM</title>
    <link rel="stylesheet" href="superadmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    
  </head>
  <body>


  <section class="header">
        <nav class="d-flex" style="height:90px">
        <div style="display:inline-block;">
            <a href="" style="text-decoration:none">
                <h1>HOUSEOFWISDOM</h1>
            </a>
        </div>
            <div class="nav-links float-right pt-3" id="navLinks" style="display:inline-block;">
                <ul>
                    <li><a href="welcome.php">HOME</a></li>
                    <li><a href="course.php">COURSE</a></li>
                   <!-- <li><a href="blog.php">BLOG</a></li>
                    <li><a href="about.php">ABOUT</a></li>-->
                </ul>
            </div>
        </nav>
    </section>


    <section class="control">

    <h1 class="text-center mt-5 pb-3"> Request For Class Representative </h1>

    <table class="table" id="myTable1">
    <thead>
        <tr>
        <th scope="col">Previous_CR</th>
        <th scope="col">Selected_CR</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Series</th>
        <th scope="col">Role</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
       
    <?php

        $sql = "SELECT previous_cr,selected_cr,username,email,series FROM users JOIN request WHERE users.roll = request.selected_cr";
        $result = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_assoc($result))
        {
            $var = $row['selected_cr'];
            $var1 = $row['previous_cr'];
        ?>

        <tr>
        <th scope="row"><?php echo $row['previous_cr'] ?></th>
        <td><?php echo $row['selected_cr']?></td>
        <td><?php echo $row['username'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['series'] ?></td>
        <td>CR</td>
        <td>
            <form action="superadmin.php" method="POST">
                <button type="submit" name="accept" class='btn btn-sm btn-primary'>Accept</button>
            </form>
            <?php

            if(isset($_POST['accept']))
            {
                $sql = "UPDATE `users` SET `role`='1' WHERE `roll`='$var';";
                $stmt = mysqli_query($conn,$sql);

            if(!$stmt){ 
                echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
            }
                $sql1 = "DELETE FROM `request` WHERE `selected_cr`='$var'";
                $stmt1 = mysqli_query($conn,$sql1);
                $sql2 = "UPDATE `users` SET `role`='0' WHERE `roll`='$var1';";
                $stmt2 = mysqli_query($conn,$sql2);
            }

            ?>
        </td>
        </tr>

        <?php
        }
        ?>

        <hr/>
        
    </tbody>
    </table>
    </section>


    <section class="control">

    <h1 class="text-center mt-5 pt-5 pb-3"> Class Representatives List </h1>

    <table class="table" id="myTable">
    <thead>
        <tr>
        <th scope="col">Roll</th>
        <th scope="col">Name</th>
        <th scope="col">Series</th>
        <th scope="col">Role</th>
        </tr>
    </thead>
    <tbody>
       
    <?php

        $sql = "SELECT * FROM users WHERE role = '1'";
        $result = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_assoc($result))
        {
        ?>

        <tr>
        <th scope="row"><?php echo $row['roll'] ?></th>
        <td><?php echo $row['username']?></td>
        <td><?php echo $row['series'] ?></td>
        <td>CR</td>
        </tr>

        <?php
        }
        ?>

        <hr/>
        
    </tbody>
    </table>
    </section>


      <!-----   Footer   ----->

      <section class="footer">

        <div class="last">
        <p>Made with <i class="fa fa-heart-o"></i> by Palash</p>

        </div>

    </section>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
         $('#myTable').DataTable();
         } );
    </script>
    <script>
        $(document).ready( function () {
         $('#myTable1').DataTable();
         } );
    </script>

    <script>



    </script>
    
  </body>
</html>