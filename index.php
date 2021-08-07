<?php 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "student_data";

    $search_data=[];
    $search_data["name"]="David Cameron";
    $search_data["email"]="davidCameron@gmail.com";

    $search_data['name']="David Cameron";
    $search_data['roll_no']="B190460CS";
    $search_data['dob']="09-10-1976";
    $search_data['address']="xxxx house ,
    xxxx , xxxx post, 
    xxxx, xxxxx";
    $search_data['mobile']="123456789";
    $search_data['email_id']="davidCameron@gmail.com";
    $search_data['semester']=8;
    $search_data["CGPA"]=8.65;
    $search_data["hobbies"]="reading and writing";
    $search_data["reference"]="    National Institute of Technology Calicut,
                                Indian Institute of Management Kozhikode";
    $search_data["hosteller"]="Yes";

    $record_status="";


    $search_data['sem1']=8.1;
    $search_data['sem2']=8.2;
    $search_data['sem3']=8.9;
    $search_data['sem4']=8.9;
    $search_data['sem5']=8.9;
    $search_data['sem6']=8.8;
    $search_data['sem7']=8.9;
    $search_data['sem8']=8.9;


    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
        $student=[];

        $student['name']=$_POST['name'];
        $student['roll']=$_POST['roll_number'];
        $student['dob']=$_POST['dob'];
        $student['address']=$_POST['address'];
        $student['mobile_number']=$_POST['mobile_number'];
        $student['email']=$_POST['email'];
        $student['semester']=$_POST['semester'];

        $student['sem1']=$_POST['sem1SGPA'];
        $student['sem2']=$_POST['sem2SGPA'];
        $student['sem3']=$_POST['sem3SGPA'];
        $student['sem4']=$_POST['sem4SGPA'];
        $student['sem5']=$_POST['sem5SGPA'];
        $student['sem6']=$_POST['sem6SGPA'];
        $student['sem7']=$_POST['sem7SGPA'];
        $student['sem8']=$_POST['sem8SGPA'];

        $student['cgpa']=$_POST['cgpa'];
        $student['hobbies']=$_POST['hobbies'];

        if(isset($_POST['hosteller'])){
            $student['hosteller']=TRUE;
        }else{
            $student['hosteller']=FALSE;
        }
  
        $student['references']=strval($_POST['references']);

        // Create connection
        $conn = mysqli_connect($servername, $username, $password,$db);
    
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO student (stud_name, roll_number, date_of_birth, 
            stud_address,mobile_number,email_id,semester,sem1SGPA,sem2SGPA,sem3SGPA,sem4SGPA
            ,sem5SGPA,sem6SGPA,sem7SGPA,sem8SGPA,CGPA,
            hobbies,hosteller,stud_references)
        VALUES ( '$student[name]' , '$student[roll]' , '$student[dob]',
                '$student[address]', '$student[mobile_number]','$student[email]',
                '$student[semester]','$student[sem1]','$student[sem2]','$student[sem3]',
                '$student[sem4]','$student[sem5]',
                '$student[sem6]','$student[sem7]','$student[sem8]'
                , '$student[cgpa]' ,'$student[hobbies]',
                '$student[hosteller]' , '$student[references]' )";

        if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

      

        $conn->close();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_but'])){
        // Create connection
        $conn = mysqli_connect($servername, $username, $password,$db);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
 

        $sql="SELECT * FROM student WHERE roll_number='$_POST[search]'";

        $result= $conn->query($sql);

        if($result->num_rows>0){
            while($row= $result->fetch_assoc()){
                $search_data['name']=$row["stud_name"];
                $search_data['roll_no']=$row["roll_number"];
                $search_data['dob']=$row["date_of_birth"];
                $search_data['address']=$row['stud_address'];
                $search_data['mobile']=$row["mobile_number"];
                $search_data['email']=$row["email_id"];
                $search_data['semester']=$row["semester"];


                $search_data['sem1']=$row["sem1SGPA"];
                $search_data['sem2']=$row["sem2SGPA"];
                $search_data['sem3']=$row["sem3SGPA"];
                $search_data['sem4']=$row["sem4SGPA"];
                $search_data['sem5']=$row["sem5SGPA"];
                $search_data['sem6']=$row["sem6SGPA"];
                $search_data['sem7']=$row["sem7SGPA"];
                $search_data['sem8']=$row["sem8SGPA"];

                $search_data["CGPA"]=$row["CGPA"];
                $search_data["hobbies"]=$row["hobbies"];
                $search_data["reference"]=$row["stud_references"];
                $search_data["hosteller"]=$row["hosteller"];
                if($search_data["hosteller"]==1){
                    $search_data["hosteller"]="Yes";
                }else{
                    $search_data["hosteller"]="No";
                }
                
            }
        }else{
            $record_status="No resume found";
        }

    }


 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material CV</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>

    <header>

        <div id="prod_name">
            MATERIAL CV
        </div>



        <div class="nav_but underline" id="search_res">
            Search
        </div>
        <div class="nav_but" id="home">
            Home
        </div>

    </header>


    <div id="search_page">
        <div id="intro_title">
            Search resume
        </div>
        <div id="intro_direct">
            Search your resume using your Roll number XD
        </div>

        <form method="post" name="search_form" action="">
            <input required type="search" placeholder="Search Your Resume" name="search" id="search_box">
            <input type="submit" name="search_but" value="Search" id="sub_but" style="width:8%; margin-left:10px;">


        </form>
        <div id="preview-text">
            Resume preview
        </div>
        <div id="record_status">
            <?php echo $record_status ?>
        </div>
        <div id="resume">

            <div id="resume-name">
                <?php echo $search_data['name'] ?>
            </div>
            <a id="mail_sub">
                <?php echo $search_data['email'] ?>
            </a>
            <div class="section" style="margin-top:80px;">
                Personal information
            </div>
            <pre class="data-section">

                Name            : <?php echo $search_data['name'] ?><br>
                Roll Number     : <?php echo $search_data['roll_no'] ?><br>
                Date of Birth   : <?php echo $search_data['dob'] ?>

            </pre>
            <div class="section">
                Academic details
            </div>
            <pre class="data-section">

                       Semester          : <?php echo $search_data['semester'] ?><br>
                       Semester 1 SGPA   : <?php echo $search_data['sem1'] ?><br>
                       Semester 2 SGPA   : <?php echo $search_data['sem2'] ?><br>
                       Semester 3 SGPA   : <?php echo $search_data['sem3'] ?><br>
                       Semester 4 SGPA   : <?php echo $search_data['sem4'] ?><br>
                       Semester 5 SGPA   : <?php echo $search_data['sem5'] ?><br>
                       Semester 6 SGPA   : <?php echo $search_data['sem6'] ?><br>
                       Semester 7 SGPA   : <?php echo $search_data['sem7'] ?><br>
                       Semester 8 SGPA   : <?php echo $search_data['sem8'] ?><br>
                       CGPA              : <?php echo $search_data['CGPA'] ?><br>
                       Hosteller         : <?php echo $search_data['hosteller'] ?>
            </pre>

            <div class="section">
                Contact
            </div>
            <pre class="data-section">

                       Email    : <?php echo $search_data['email'] ?> <br>
                       Phone    : <?php echo $search_data['mobile'] ?><br>
                       address  : <span id="address" > <?php echo $search_data['address'] ?></span>
            </pre>
            
            <div class="section">
                Hobbies
            </div>
            <div class="bulk_data_disp">
                 <?php echo $search_data['hobbies'] ?>
            </div>
            <div class="section">
                References
            </div>

            <div class="bulk_data_disp">
                <?php echo $search_data['reference'] ?>
            </div>

            <!-- <pre class="data-section" >
              <?php echo $search_data['reference'] ?>
            </pre> -->
        </div>

    </div>


    <div id="home-page" style="transform: translateX(100%);">

        <div id="intro_title">
            Create your awesome resume !
        </div>
        <div id="intro_direct">
            Enter your details below to generate your resume :)
        </div>

        <form method="post" action="" name="student_form" id="student-form">

            <label for="name" class="form-label">Name</label>
            <input type="text" required name="name" class="inp_box">

            <label for="roll_number" class="form-label">Roll number</label>
            <input type="text" required name="roll_number" class="inp_box">


            <label for="dob" class="form-label">Date of birth</label>
            <input type="date" required name="dob" class="inp_box">


            <label for="address" class="form-label">Address</label>
            <textarea type="text" required name="address" class="inp_box" style="height:120px;"></textarea>

            <label for="mobile_number" class="form-label">Mobile number</label>
            <input type="tel" required name="mobile_number" class="inp_box">

            <label for="email" class="form-label">Email</label>
            <input type="email" required name="email" class="inp_box">
            
            <label for="semester" class="form-label">Semester</label>
            <input type="number" required name="semester" min="1" max="8" step="1" class="inp_box">

            <label for="sem1SGPA" class="form-label">Sem 1 SGPA</label>
            <input type="number" name="sem1SGPA" min="0" max="10" step=".01" class="inp_box">

            <label for="sem2SGPA" class="form-label">Sem 2 SGPA</label>
            <input type="number" name="sem2SGPA" min="0" max="10" step=".01" class="inp_box">

            <label for="sem3SGPA" class="form-label">Sem 3 SGPA</label>
            <input type="number" name="sem3SGPA" min="0" max="10" step=".01" class="inp_box">

            <label for="sem4SGPA" class="form-label">Sem 4 SGPA</label>
            <input type="number" name="sem4SGPA" min="0" max="10" step=".01" class="inp_box">

            <label for="sem5SGPA" class="form-label">Sem 5 SGPA</label>
            <input type="number" name="sem5SGPA" min="0" max="10" step=".01" class="inp_box">

            <label for="sem6SGPA" class="form-label">Sem 6 SGPA</label>
            <input type="number" name="sem6SGPA" min="0" max="10" step=".01" class="inp_box">

            <label for="sem7SGPA" class="form-label">Sem 7 SGPA</label>
            <input type="number" name="sem7SGPA" min="0" max="10" step=".01" class="inp_box">

            <label for="sem8SGPA" class="form-label">Sem 8 SGPA</label>
            <input type="number" name="sem8SGPA" min="0" max="10" step=".01" class="inp_box">

            <label for="cgpa" class="form-label">CGPA</label>
            <input type="number" name="cgpa" min="0" max="10" step=".01" class="inp_box">


            <label for="hobbies" class="form-label">Hobbies</label>
            <textarea type="text" required name="hobbies" class="inp_box"></textarea>

            <label for="hosteller" class="form-label">Hosteller</label>
            <input type="checkbox" name="hosteller" class="inp_box" id="check_box">

            <label for="references" class="form-label">References</label>
            <textarea type="text" required name="references" class="inp_box" style="height:120px;"></textarea>


            <input type="submit" name="submit" id="sub_but" onclick="submit_form()">
        </form>


    </div>






</body>

<script>
    var tab_id = 0;

    document.getElementById("home").addEventListener("click", home_tab);
    document.getElementById("search_res").addEventListener("click", search_tab);

    function search_tab() {
        if (tab_id == 1) {
            document.getElementById("home").classList.remove("underline");
            document.getElementById("search_res").classList.add("underline");
            document.getElementById("search_page").classList.remove("view-change-left");
            document.getElementById("home-page").style = "transform:translateX(100%);";
            tab_id = 0;
        }

    }

    function home_tab() {
        if (tab_id == 0) {
            document.getElementById("search_res").classList.remove("underline");
            document.getElementById("home").classList.add("underline");
            document.getElementById("search_page").classList.add("view-change-left");

            document.getElementById("home-page").style = "transform:translateX(0%);";
            tab_id = 1;
            document.body.scrollLeft -= 100;
        }
    }

    function submit_form() {
        document.student_form.submit();
        document.student_form.reset();

    }
</script>

</html>