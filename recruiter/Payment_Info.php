<?php
session_start();
$_SESSION['page']='Payment_Info';
 ?>

<html>

<head>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet"  type="text/css" href="css/global.css">
  <link rel="stylesheet" type="text/css" href="css/userhome.css">
  <link rel="stylesheet" type="text/css" href="css/payment_info.css"> 
  <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous">
</script>
<script> 
  $(function(){
    $("#header").load("Header.php"); 
    $("#footer").load("Footer.php"); 
  });
</script> 


<script>
  function edit(id){
    window.location.href = window.location.href.replace(/[^/]*$/, "")+"Edit_Questions.php?contestid="+id;
  }

  function editcontest(id){
    window.location.href = window.location.href.replace(/[^/]*$/, "")+"Edit_Contest.php?contestid="+id;
  }



</script>

<script type="text/javascript">
  function user(id){
            // $("#userform").submit();
            window.location.href = window.location.href.replace(/[^/]*$/, "")+"Contest_Users.php?contestid="+id;
          }
        </script>

      </head>



      <body>
        <div id="header"></div>

        <?php
        require_once("Config.php");
        ?>


        <div id="headnam" style="background : #f7f7f7;">
          <label  style="font-size:30px;
          color:black;
          font-family: 'Times New Roman', Times, serif;
          font-style: normal;
          font-weight:normal;
          margin-left:20px;
          margin-top:15px;
          margin-bottom:15px;">Payment</label>
        </div>  




        <div id="parent" >
          <div id="inside">

            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Pay INR 2000 to get permanent membership of Quizzer.</h4>

              </div>

              <div class="modal-body">
                <div class="container">

                  <form  method="post" id="register_form" action="Payment_Middle.php">

                    <input type="hidden" id="id" value="<?php echo $_SESSION['id'] ?>" name="recruiterid" readonly />

                   <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" value="<?php echo $_SESSION['email'] ?>" placeholder="Enter email" name="email" readonly />
                  </div>

                  <div class="form-group">
                    <label for="pass">Amount:</label>
                    <input type="text" class="form-control" id="pass" placeholder="Enter Amount" name="amount" value="2000" readonly />
                  </div>

                  <div class="form-group">
                    <label for="pass">Mobile No:</label>
                    <input type="text" pattern="[789][0-9]{9}" name="mobno" class="form-control" id="_pass" placeholder="Enter Mobile No."  required />
                  </div>


                  <div class="form-group form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" name="remember" required /> I agree on <a href="tc.htm"> terms and conditions</a>
                    </label>
                  </div>
                  <input type="submit" name="submit" id="submit" value="&nbsp;Submit&nbsp;" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                </form>
              </div>

            </div>



          </div>

        </div>  
      </div>


      <footer>
        <div id="footer"></div>
      </footer>


    </body>

    </html>
    </html>