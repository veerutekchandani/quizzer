<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <script src="Valid.js"></script>

<?php

  if(isset($_SESSION['id'])) {
  	$new = explode('.',$_SESSION['id']);
    $id = $new[0];
    $table=$new[1];
    $conn = mysqli_connect("localhost","root","","quizzer");
    $query = "select * from Recruiters where RecruiterId = '$id'";
    
    $res = mysqli_query($conn,$query);
     
    if(mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        echo "<hr>
              <div class='container bootstrap snippet'>
              <div class='row'>
              <div class='col-sm-10'> <h1>";
        echo "Hi, <br />&nbsp;&nbsp;&nbsp;". $row["RecruiterName"];
        echo "</h1></div>
              <div class='col-sm-2'><a href='uploads/quizzer.png' class='pull-right'><img title='logo' class='img-circle img-responsive' src='uploads/quizzer.png'></a></div>
              </div>";
        echo '<div class="row">
              <div class="col-sm-3">
              <div class="col-sm-10">
              <div class="text-center">';

        if($row["ProfilePic"]==1) {
          echo '<a href="uploads/Recruiter_Profile/'.$table.$id.'.jpg"><img src="uploads/Recruiter_Profile/'.$table.$id.'.jpg"  class="avatar img-circle img-thumbnail" alt="profile_pic" /></a>';
        }
        else {
          echo '<img src="uploads/defaultprofile.jpg" class="avatar img-circle img-thumbnail" alt="profile_pic" />';
        }
        echo' <br /><h4>RECRUITER</h4>
              </div></hr><br />
              <ul class="list-group">
                <li class="list-group-item text-center" style="color:red"><strong>Activity</strong><i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Quizzes</strong></span> 0</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Participated</strong></span> 0</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Won</strong></span> 0</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Rank</strong></span> 0</li>
              </ul> 
              </div>
              </div>
                 <div class="col-sm-8">
                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"><h4>Home</h4></a></li>
                    <li><a data-toggle="tab" href="#update_profile"><h4>Update Profile</h4></a></li>
                    <li><a data-toggle="tab" href="#change_pass"><h4>Change Password</h4></a></li>
                    <li>
                    <div class="col-sm-1 pull-right">
                      <form method="POST" action="Logout.php">
                      <button type="submit" name="logout" class="btn btn-danger">Logout</button>
                      </form>
                    </div>
                    </li>
                  </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="home">
                  <hr>
                  <div class="col-sm-3"></div>
                  <table>
                    <tr>
                      <td> <h3> Recruiter Id :&nbsp;&nbsp;</h3> </td>
                      <td><h3>'.$row["RecruiterId"].'</h3></td>
                    </tr>
                    <tr>
                      <td> <h3> Email :&nbsp;&nbsp;</h3> </td>
                      <td><h3>'.$row["RecruiterEmail"].'</h3></td>
                    </tr>
                    <tr>
                      <td> <h3> Full Name :&nbsp;&nbsp;</h3> </td>
                      <td><h3>'.$row["RecruiterName"].'</h3></td>
                    </tr>
                    <tr>
                      <td> <h3> DOB :&nbsp;&nbsp;</h3> </td>
                      <td><h3>'.$row["DOB"].'</h3></td>
                    </tr>
                    <tr>
                      <td> <h3> Organization :&nbsp;&nbsp;</h3> </td>
                      <td><h3>'.$row["Organization"].'</h3></td>
                    </tr>
                    <tr>
                      <td> <h3> Contact :&nbsp;&nbsp;</h3> </td>
                      <td><h3>'.$row["Mobile"].'</h3></td>
                    </tr>
                  </table>
                <form method="POST" action="challenges.php">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <br>
                            <button class="btn btn-lg btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-ok-sign"></i> Create a Challenge</button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="past.php">
                    <div class="form-group">
                        <div class="col-xs-6">
                              <br>
                              <button class="btn btn-lg btn-primary" type="submit" name="submit"><i class="glyphicon glyphicon-refresh"></i>&nbsp;&nbsp;&nbsp;&nbsp;Past Challenges&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        </div>
                    </div>
                </form>
              </div>
              <div class="tab-pane" id="update_profile">
                <hr>
                <form method="POST" action="Upload.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-xs-7">
                            <label for="upload"><h4>upload a profile picture</h4></label>
                            <input type="file" class="form-control" name="profile" id="profile" /><br />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="org"><h4>Organization</h4></label>
                            <input type="text" class="form-control" name="org" id="org" placeholder="enter organization name" title="enter your company name if any."/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                          <label for="dob"><h4>Date Of Birth</h4></label>
                          <input type="date" class="form-control" name="dob" id="dob" placeholder="enter DOB" title="enter your DOB" />
                        </div>
                    </div>
                    div class="form-group">
                        <div class="col-xs-6">
                          <label for="mobile"><h4>Mobile</h4></label>
                          <input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any."/>
                        </div>
                    </div>
                    <div class="form-group"><br />
                        <div class="col-xs-12">
                        <br>
                        <button class="btn btn-lg btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-ok-sign"></i> Update</button>
                        <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="tab-pane" id="change_pass">
                <form method="POST" action="Change_Pass.php">
                    <div class="form-group">
                      <div class="col-xs-8">
                        <label for="pass"><h4>Enter new Password:</h4></label>
                          <input type="password" class="form-control" id="pass" placeholder="min 8 characters, at least 1-digit, 1-alphabet & 1-symbol" name="pass" onchange=IsValid(pass.value,"new","pass") required /> <p id="new" style="color:red"></p>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-8">
                        <label for="_pass"><h4>Confirm Password:</h4></label>
                        <input type="password" class="form-control" id="_pass" placeholder="Re-enter password" name="_pass" onchange=validate(pass.value,_pass.value,"old","_pass") required /> <p id="old" style="color:red"></p>
                      </div>
                    <div class="form-group">
                      <div class="col-xs-6"><br>
                        <button class="btn btn-lg btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-ok-sign"></i>Change</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>';
   }
   else  {
   	  echo "cannot extract info from database!!!";
   }
}

?>
</body>
</html>