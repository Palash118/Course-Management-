<?php
        include "config.php";
        session_start();

        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
        {
            header("location: login.php");
        }
                $insert = false;
                if(isset($_POST['create']))
                {
                    header("location:create.php");
                }
                elseif(isset($_POST['upload']))
                {

            /*-------  Lecture Video   ------*/
                        $cid1 = $_POST['cid'];
                        $cid = strtoupper($cid1);
                        $series = $_POST['series'];

                        $sql1 = "SELECT course_id FROM courses WHERE cid='$cid' LIMIT 1";
                        $result = mysqli_query($conn,$sql1);
                        $row = mysqli_fetch_assoc($result);

                        /*$row1 = $row[0]; */ 
                        $row1 = $row['course_id'];                    

                        if($_FILES['lecture_video']['error'] === 0)
                        {
                        $video = $_FILES['lecture_video'];
                        $videoName = $_FILES['lecture_video']['name'];
                        $videoTmpName = $_FILES['lecture_video']['tmp_name'];
                        $videoSize = $_FILES['lecture_video']['size'];
                        $videoError = $_FILES['lecture_video']['error'];
                        $videoType = $_FILES['lecture_video']['type'];
                    
                        $videoExt = explode('.',$videoName);
                        $videoActualExt = strtolower(end($videoExt));
                    
                        $allowed = array('mp4');
                    
                        if(in_array($videoActualExt,$allowed))
                        {
                            if($videoError === 0)
                            {
                                    $videoDestination = 'lecture_video/'.$videoName;
                                    move_uploaded_file($videoTmpName,$videoDestination);
                            }
                            }

                            $sql = "INSERT INTO lecture_video(course_id,series,lectureVideo)
                            VALUES('$row1','$series','$videoName');";
                            $stmt = mysqli_query($conn,$sql);
                        }
                
            /*----- Lecture Video ------*/



            /*------  Lecture Note  ------*/

                        if($_FILES['lecture_note']['error'] === 0)
                        {
                        $note = $_FILES['lecture_note'];
                        $noteName = $_FILES['lecture_note']['name'];
                        $noteTmpName = $_FILES['lecture_note']['tmp_name'];
                        $noteSize = $_FILES['lecture_note']['size'];
                        $noteError = $_FILES['lecture_note']['error'];
                        $noteType = $_FILES['lecture_note']['type'];
                    
                        $noteExt = explode('.',$noteName);
                        $noteActualExt = strtolower(end($noteExt));
                    
                        $allowed = array('pdf','txt','docx','ppt','pptx');
                    
                        if(in_array($noteActualExt,$allowed))
                        {
                            if($noteError === 0)
                            {
                                
                                    $noteDestination = 'lecture_note/'.$noteName;
                                    move_uploaded_file($noteTmpName,$noteDestination);
                                
                            }
                            }

                            $sql = "INSERT INTO lecture_note(course_id,series,lectureNote)
                            VALUES('$row1','$series','$noteName');";

                            $stmt = mysqli_query($conn,$sql);
                        }


            /*------ Lecture Note -------*/





            /*------ Lecture Slide ------*/
                        if($_FILES['slide']['error'] === 0)
                        {
                        $slide = $_FILES['slide'];
                        $slideName = $_FILES['slide']['name'];
                        $slideTmpName = $_FILES['slide']['tmp_name'];
                        $slideSize = $_FILES['slide']['size'];
                        $slideError = $_FILES['slide']['error'];
                        $slideType = $_FILES['slide']['type'];
                    
                        $slideExt = explode('.',$slideName);
                        $slideActualExt = strtolower(end($slideExt));
                    
                        $allowed = array('ppt','pptx');
                    
                        if(in_array($slideActualExt,$allowed))
                        {
                            if($slideError === 0)
                            {
                               
                                    $slideDestination = 'slide/'.$slideName;
                                    move_uploaded_file($slideTmpName,$slideDestination);
                                
                            }
                            }

                            $sql = "INSERT INTO slide(course_id,series,lectureSlide)
                            VALUES('$row1','$series','$slideName');";

                            $stmt = mysqli_query($conn,$sql);
                        }

            /*------ Lecture Slide ------*/



            /*-------- Books and Notes -------*/

                        if($_FILES['book']['error'] === 0)
                        {
                        $book = $_FILES['book'];
                        $bookName = $_FILES['book']['name'];
                        $bookTmpName = $_FILES['book']['tmp_name'];
                        $bookSize = $_FILES['book']['size'];
                        $bookError = $_FILES['book']['error'];
                        $bookType = $_FILES['book']['type'];
                    
                        $bookExt = explode('.',$bookName);
                        $bookActualExt = strtolower(end($bookExt));
                    
                        $allowed = array('pdf','docx','txt','ppt','pptx');
                    
                        if(in_array($bookActualExt,$allowed))
                        {
                            if($bookError === 0)
                            {
                               
                                    $bookDestination = 'book/'.$bookName;
                                    move_uploaded_file($bookTmpName,$bookDestination);
                                
                            }
                            }

                            $sql = "INSERT INTO book_and_note(course_id,series,book)
                            VALUES('$row1','$series','$bookName');";

                            $stmt = mysqli_query($conn,$sql);
                        }



            /*-------- Books and Notes -------*/


            /*------- Assignments  ---------*/
                        if($_FILES['assignment']['error'] === 0)
                        {
                        $assignment = $_FILES['assignment'];
                        $assignmentName = $_FILES['assignment']['name'];
                        $assignmentTmpName = $_FILES['assignment']['tmp_name'];
                        $assignmentSize = $_FILES['assignment']['size'];
                        $assignmentError = $_FILES['assignment']['error'];
                        $assignmentType = $_FILES['assignment']['type'];
                    
                        $assignmentExt = explode('.',$assignmentName);
                        $assignmentActualExt = strtolower(end($assignmentExt));
                    
                        $allowed = array('pdf','docx','txt','ppt','pptx');
                       
                    
                        if(in_array($assignmentActualExt,$allowed))
                        {
                            if($assignmentError === 0)
                            {
                              
                                    $assignmentDestination = 'assignment/'.$assignmentName;
                                    move_uploaded_file($assignmentTmpName,$assignmentDestination);
                                
                            }
                            }

                            $sql = "INSERT INTO assignment(course_id,series,assign)
                            VALUES('$row1','$series','$assignmentName');";

                            $stmt = mysqli_query($conn,$sql);
                        }

             /*------- Assignments  ---------*/



            
            /*-------- Practice Problem  -------*/
                        if($_FILES['practice_problem']['error'] === 0)
                        {
                        $practice_problem = $_FILES['practice_problem'];
                        $practice_problemName = $_FILES['practice_problem']['name'];
                        $practice_problemTmpName = $_FILES['practice_problem']['tmp_name'];
                        $practice_problemSize = $_FILES['practice_problem']['size'];
                        $practice_problemError = $_FILES['practice_problem']['error'];
                        $practice_problemType = $_FILES['practice_problem']['type'];
                    
                        $practice_problemExt = explode('.',$practice_problemName);
                        $practice_problemActualExt = strtolower(end($practice_problemExt));
                    
                        $allowed = array('pdf','docx','txt','ppt','pptx');
                       
                    
                        if(in_array($practice_problemActualExt,$allowed))
                        {
                            if($practice_problemError === 0)
                            {
                                
                                    $practice_problemDestination = 'practice_problem/'.$practice_problemName;
                                    move_uploaded_file($practice_problemTmpName,$practice_problemDestination);
                                
                            }
                            }

                            $sql = "INSERT INTO practice_problem(course_id,series,problem)
                            VALUES('$row1','$series','$practice_problemName');";

                            $stmt = mysqli_query($conn,$sql);
                        }


            /*-------- Practice Problem  -------*/




            /*--------- CT Question  ------*/
                        if($_FILES['ct_question']['error'] === 0)
                        {
                        $ct_question = $_FILES['ct_question'];
                        $ct_questionName = $_FILES['ct_question']['name'];
                        $ct_questionTmpName = $_FILES['ct_question']['tmp_name'];
                        $ct_questionSize = $_FILES['ct_question']['size'];
                        $ct_questionError = $_FILES['ct_question']['error'];
                        $ct_questionType = $_FILES['ct_question']['type'];
                    
                        $ct_questionExt = explode('.',$ct_questionName);
                        $ct_questionActualExt = strtolower(end($ct_questionExt));
                    
                        $allowed = array('pdf','docx','txt','ppt','pptx');
                      
                    
                        if(in_array($ct_questionActualExt,$allowed))
                        {
                            if($ct_questionError === 0)
                            {
                                
                                    $ct_questionDestination = 'ct_question/'.$ct_questionName;
                                    move_uploaded_file($ct_questionTmpName,$ct_questionDestination);
                                
                            }
                            }

                            $sql = "INSERT INTO ct_question(course_id,series,ct)
                            VALUES('$row1','$series','$ct_questionName');";

                            $stmt = mysqli_query($conn,$sql);
                        }


             /*--------- CT Question  ------*/




             /*---------- Semester Question  --------*/
                        if($_FILES['semester_question']['error'] === 0)
                        {
                        $semester_question = $_FILES['semester_question'];
                        $semester_questionName = $_FILES['semester_question']['name'];
                        $semester_questionTmpName = $_FILES['semester_question']['tmp_name'];
                        $semester_questionSize = $_FILES['semester_question']['size'];
                        $semester_questionError = $_FILES['semester_question']['error'];
                        $semester_questionType = $_FILES['semester_question']['type'];
                    
                        $semester_questionExt = explode('.',$semester_questionName);
                        $semester_questionActualExt = strtolower(end($semester_questionExt));
                    
                        $allowed = array('pdf','docx','txt','ppt','pptx');
                    
                        if(in_array($semester_questionActualExt,$allowed))
                        {
                            if($semester_questionError === 0)
                            {
                                
                                    $semester_questionDestination = 'semester_question/'.$semester_questionName;
                                    move_uploaded_file($semester_questionTmpName,$semester_questionDestination);
                                
                            }
                            }

                            $sql = "INSERT INTO semester_question(course_id,series,semester)
                            VALUES('$row1','$series','$semester_questionName');";
                            $stmt = mysqli_query($conn,$sql);
                    }

                    if($stmt){ 
                        $insert = true;
                    }
                    else{
                        echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
                    } 



                /*---------- Semester Question  --------*/


                            
                }


            ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOUSE OF WISDOM</title>
    <link rel="stylesheet" href="upload.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
<section class="header">
        <nav>
            <a href="resource.php">
                <h1>HOUSEOFWISDOM</h1>
            </a>
            <div class="nav-links" id="navLinks">
            <i class="fa fa-times" onclick="hideMenu()"></i>
            <ul>
                <?php
                    $var = $_SESSION['id'];
                    $sql = "SELECT * FROM users WHERE id = $var ";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="pro-image1">
                    <img src="profile/<?php echo $row['profile_picture'] ?>">
                    <p> <?php echo $row['username'] ?> </p>
                    <p> <?php echo $row['email'] ?> </p>
                    <hr>
                    </div>
                    <li><a href="welcome.php">HOME</a></li>
                    <li><a href="course.php">COURSE</a></li>
                    <div class="logout11">
                    <li><a href="logout.php">Log Out</a></li>
                    </div>
                </ul>
            </div>
            <div class="pro-image">
            <img src="profile/<?php echo $row['profile_picture'] ?>">
            </div>
            <div class="dropdown">
            <button class="link"> <?php echo $_SESSION['roll'] ?> </button>
            <?php
            if($row['role'] === '0')
            {
            ?>
            <div class="dropdown-menu">
                <img src="profile/<?php echo $row['profile_picture'] ?>">
                <h4> <?php echo $row['username'] ?> </h4>
                <h5> <?php echo $row['email'] ?> </h5>
                <br>
                <form action="" method="POST">
                <div class="btn1">
                <button type="submit" name="logout" class="log-out"> Log Out </button>
                </div>
                <?php

                if(isset($_POST['logout']))
                {
                    header("location: logout.php");
                }

                ?>

                </form>
                
            </div>
            <?php
            }
            elseif($row['role'] === '1')
            {
            ?>
            <div class="dropdown-menu">
                <img src="profile/<?php echo $row['profile_picture'] ?>">
                <h4> <?php echo $row['username'] ?> </h4>
                <h5> <?php echo $row['email'] ?> </h5>
                <br>
                <a href="upload.php">  UPLOAD  </a> <br>
                <a href="create.php"> CREATE COURSE </a><br>
                <a href="request.php"> CR_REQUEST </a><br><br>
                <form action="" method="POST">
                <div class="btn1">
                <button type="submit" name="logout" class="log-out"> Log Out </button>
                </div>
                <?php

                if(isset($_POST['logout']))
                {
                    header("location: logout.php");
                }

                ?>

                </form>
                
            </div>
            <?php
            }
            elseif($row['role'] === '2')
            {
            ?>
            <div class="dropdown-menu">
                <img src="profile/<?php echo $row['profile_picture'] ?>">
                <h4> <?php echo $row['username'] ?> </h4>
                <h5> <?php echo $row['email'] ?> </h5>
                <br>
                <a href="superadmin.php">  CR_LIST  </a> <br>
                <a href="superadmin.php">  CR_REQUEST  </a> <br><br>
                <form action="" method="POST">
                <div class="btn1">
                <button type="submit" name="logout" class="log-out"> Log Out </button>
                </div>
                <?php

                if(isset($_POST['logout']))
                {
                    header("location: logout.php");
                }

                ?>

                </form>
                
            </div>
            <?php
            }
            ?>

            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>  
        <?php
        if($insert)
        {
            echo"
                <script>
                     alert('Contents are successfully uploaded!');
                     window.location.href = 'upload.php';
                 </script>
                 ";
        }
        ?>
    </section>

    <section class="upload">
        <h1>UPLOAD YOUR CONTENTS</h1>
        <div class="content">
            <form action="upload.php" method="POST" enctype="multipart/form-data" class="content_upload">
                <label class="label1">Course No.</label><br/>
                <input type="text" name="cid" class="input-field"><br/>
                <label>Series</label><br/>
                <input type="text" name="series" class="input-field"><br/>
                <label>Lecture Video</label><br/>
                <input type="file" name="lecture_video" class="input-file"><br/>
                <label>Lecture Note</label><br/>
                <input type="file" name="lecture_note" class="input-file"><br/>
                <label>Lecture Slide</label><br/>
                <input type="file" name="slide" class="input-file"><br/>
                <label>Books and Notes</label><br/>
                <input type="file" name="book" class="input-file"><br/>
                <label>Assignments</label><br/>
                <input type="file" name="assignment" class="input-file"><br/>
                <label>Practice Problems</label><br/>
                <input type="file" name="practice_problem" class="input-file"><br/>
                <label>CT Questions</label><br/>
                <input type="file" name="ct_question" class="input-file"><br/>
                <label>Semester Questions</label><br/>
                <input type="file" name="semester_question" class="input-file"><br/>
                <button type="submit" name="upload" class="upload-btn">Upload</button>
                <button type="submit" name="create" class="course-btn">Create a Course</button>
            </form>
        </div>
    </section>
</body>
</html>