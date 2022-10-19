<?php

    include "config.php";

    if(isset($_GET['email']) && isset($_GET['v_code']))
    {
        $var1 = $_GET['email'];
        $var2 = $_GET['v_code'];
        $sql = "SELECT * FROM users WHERE email = '$var1' AND v_code = '$var2' ";
        $result = mysqli_query($conn,$sql);
        if($result)
        {
            if(mysqli_num_rows($result) == 1)
            {
                $result_fetch = mysqli_fetch_assoc($result);
                if($result_fetch['verified'] == 0)
                {
                    $var3 = $result_fetch['email'];
                    $update = "UPDATE users SET verified = '1' WHERE email = '$var3' ";
                    if(mysqli_query($conn,$update))
                    {
                        echo"
                        <script>
                        alert('The email is successfully verified');
                        window.location.href='login.php';
                        </script>
                        ";
                    }
                    else
                    {
                        echo"
                        <script>
                        alert('Cannot run query');
                        window.location.href='login.php';
                        </script>
                        ";
                    }
                }
                else
                {
                    echo"
                        <script>
                        alert('The email is already registered');
                        window.location.href='login.php';
                        </script>
                        ";
                }
            }
        }
        else
        {
            echo"
                <script>
                alert('Cannot run query');
                window.location.href='login.php';
                </script>
                ";
        }
    }




?>