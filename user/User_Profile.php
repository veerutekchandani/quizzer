<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="Valid.js"></script>
<!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<?php
  if(isset($_SESSION['id']))
  {
  	$new = explode('.',$_SESSION['id']);
    $id = $new[0];
    $table=$new[1];

    $conn = mysqli_connect("localhost","root","","quizzer");
    $query = "SELECT UserName FROM users where UserId='$id'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    $userName = $row['UserName'];

    $query = "select * from Users where UserId = '$id'";
    $res = mysqli_query($conn,$query);
    
    if(mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $UserName = $row["UserName"];
        $ProfilePic = $row["ProfilePic"];
        $UserId = $row["UserId"];
        $UserEmail = $row["UserEmail"];
        $FullName = $row["FullName"];
        $DOB = $row["DOB"];
        $CollegeName = $row["CollegeName"];
        $Mobile = $row["Mobile"];

   }
   else
   {
   	echo "cannot extract info from database!!!";
   }

  }
?>


<!-- ===================== HEADER OF PAGE ============================= -->
<div class="header">
  <a href="User_Home.php" style="padding: 0px;"><img src="./../Images/logo.png" class="img-rounded image"></a>
    <a href="User_Home.php" class="logo">Quizzer</a>
    <div style="margin-left: 230px;">
        <a href="User_Home.php">CONTESTS</a>
        <a href="Practice.php">PRACTICE</a>
        <a href="#about">ARTICLES</a>
    </div>
    <div class="header-right" style="margin-right: 50px;">
        <div class="dropdown show">
          <a class="active" class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" ><?php echo $userName; ?></a>
          <div class="dropdown-menu">
              <a class="dropdown-item" href="User_Profile.php">Profile</a>
              <a class="dropdown-item" href="#">History</a>
          </div>
          <a href="./../login/Logout.php" style="color : #6699ff;font-size: 15px;">LOGOUT</a>
        </div>
    </div>
</div> 


<br><br>
<div class='container bootstrap snippet'>
    <div class='row'>
        <div class='col-sm-10'> 
          <h1>Hi,<br>&nbsp;&nbsp;&nbsp;<?php echo $UserName; ?></h1>
        </div>
        <div class='col-sm-2'>
          <a href='./../Images/logo.png' class='pull-right'><img style="height: 70px;width: 70px;" title='logo' class='img-circle img-responsive' src='./../Images/logo.png'></a>
        </div>
    </div>
    <div class="row" >
      <div class="col-sm-3">
        <div class="col-sm-10">
            <div class="text-center">
              <a href="uploads/User_Profile/<?php echo $ProfilePic; ?>"><img style="height: 100px;width: 100px;" src="./../uploads/User_Profile/<?php echo $ProfilePic; ?>" class="avatar img-circle img-thumbnail " alt="profile_pic" /></a>
                <br>
                <h4>USER</h4>
            </div>
            <hr>
            <ul class="list-group">
              <li class="list-group-item text-center" style="color:red">
                <strong>Activity</strong><i class="fa fa-dashboard fa-1x"></i>
              </li>
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
          </ul>
           <div class="tab-content">
                <div class="tab-pane active" id="home">
                  <hr>
                  <div class="col-sm-3"></div>
                    <table>
                      <tr>
                        <td><h3> Username :&nbsp;&nbsp;</h3></td>
                        <td><h3><?php echo $UserName; ?></h3></td>
                      </tr>
                      <tr>
                        <td><h3> Email :&nbsp;&nbsp;</h3> </td>
                        <td><h3><?php echo $UserEmail; ?></h3></td>
                      </tr>
                      <tr>
                        <td><h3> Full Name :&nbsp;&nbsp;</h3> </td>
                        <td><h3><?php echo $FullName; ?></h3></td>
                      </tr>
                      <tr>
                        <td><h3> DOB :&nbsp;&nbsp;</h3> </td>
                        <td><h3><?php echo $DOB; ?></h3></td>
                      </tr>
                      <tr>
                        <td><h3> Institution :&nbsp;&nbsp;</h3> </td>
                        <td><h3><?php echo $CollegeName; ?></h3></td>
                      </tr>
                      <tr>
                        <td><h3> Contact :&nbsp;&nbsp;</h3> </td>
                        <td><h3><?php echo $Mobile; ?></h3></td>
                      </tr>
                      <tr>
                        <td><h3> Rating :&nbsp;&nbsp;</h3> </td>
                        <td><h3>   50 </h3></td>
                      </tr>
                    </table>
                    <form method="POST" action="User_Home.php">
                        <div class="form-group">
                            <div class="col-xs-6">
                              <br>
                              <button class="btn btn-lg btn-success" type="submit" name="submit"><i class="glyphicon glyphicon-ok-sign"></i> Register for a Challenge</button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="User_Home.php">
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
                        <div class="col-xs-6"><br />
                          <label for="name"><h4>Full Name</h4></label>
                          <input type="text" class="form-control" name="name" id="name" placeholder="enter your name" title="enter name" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-6"><br />
                          <label for="dob"><h4>Date Of Birth</h4></label>
                          <input type="date" class="form-control" name="dob" id="dob" placeholder="enter DOB" title="enter your DOB" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-6">
                          <label for="org"><h4>College</h4></label>
                          <input type="text" class="form-control" name="org" id="org" placeholder="enter college/institution name" title="enter your college name if any."/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-6">
                          <label for="mobile"><h4>Mobile</h4></label>
                          <input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any."/>
                        </div>
                      </div>
                      <div class="form-group"><br>
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
                </div>
              </div>
          </div>
      </div>

<br><br><br><br><br><br>

<!-- ----------------------- FOOTER OF PAGE -------------------------- -->
<div id="footer"></div>
<script type="text/javascript">
  $(function(){
      $("#footer").load("Footer.html"); 
    });
</script>

</body>
</html>