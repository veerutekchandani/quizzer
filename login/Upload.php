<?php

session_start();

if(isset($_POST['submit']))
{
   $new = explode('.',$_SESSION['id']);
    $id = $new[0];
    $table=$new[1];

    $conn = mysqli_connect("localhost","root","","quizzer");


	//print_r($file);

	$fileName = $_FILES['profile']['name'];
	$fileSize = $_FILES['profile']['size'];
	$fileError = $_FILES['profile']['error'];
	$fileType = $_FILES['profile']['type'];
	$fileTmpName = $_FILES['profile']['tmp_name'];


   $fileExt = explode('.', $fileName);

   $fileNewExt = strtolower(end($fileExt));

   $extensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf');

   if(in_array($fileNewExt, $extensions))
   {

     if($fileError === 0)
     {
             if($table == 'Recruiters')
            $fileDest = 'uploads/Recruiter_Profile/'.$fileName;
             else
            $fileDest = 'uploads/User_Profile/'.$fileName;

            move_uploaded_file($fileTmpName,$fileDest);

            if($table == 'Recruiters')
             {
            
            $query = "update $table
                      set ProfilePic = '$fileName'
                      where RecruiterId = '$id'";
             }
             else
             {
                  $query = "update $table
                      set ProfilePic = '$fileName'
                      where UserId = '$id'";

             }

             mysqli_query($conn,$query);

     }
     else
     {
     	echo "Some error occured during upload";
     }
   }
   else
   {
   	echo "Please enter an image with jpg/jpeg/png/gif/pdf extensions";
   }


   if($table == 'Recruiters')
            {
               if(!empty($_POST['org']))
               {
                $college = $_POST['org'];
                     $query = "update Recruiters set Organization='$college' where RecruiterId = '$id'";
                      mysqli_query($conn,$query);
               }

               if(!empty($_POST['dob']))
               {
                    $dob = $_POST['dob'];
                     $query = "update Recruiters set DOB='$dob' where RecruiterId = '$id'";
                      mysqli_query($conn,$query);
               }

               if(!empty($_POST['mobile']))
               {
                     $mobile = $_POST['mobile'];
                     $query = "update Recruiters set Mobile='$mobile' where RecruiterId = '$id'";
                      mysqli_query($conn,$query);
               }

               header("Location: Recruiter_Profile.php");
                          
            }
            else
            {

                if(!empty($_POST['name']))
               {
                     $name = $_POST['name'];
                     $query = "update Users set FullName='$name' where UserId = '$id'";
                      mysqli_query($conn,$query);
               }   

                if(!empty($_POST['org']))
               {
                     $college = $_POST['org'];
                     $query = "update Users set CollegeName='$college' where UserId = '$id'";
                      mysqli_query($conn,$query);
               }   

                if(!empty($_POST['dob']))
               {
                     $dob = $_POST['dob'];
                     $query = "update Users set DOB='$dob' where UserId = '$id'";
                      mysqli_query($conn,$query);
               }   

                if(!empty($_POST['mobile']))
               {
                     $mobile = $_POST['mobile'];
                     $query = "update Users set Mobile='$mobile' where UserId = '$id'";
                      mysqli_query($conn,$query);
               }   
               
               header("Location: User_Profile.php");
            }

}

mysqli_close($conn);

 ?>