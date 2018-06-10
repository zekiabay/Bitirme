
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login/Sign-In</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="indexcss.css">
<style type="text/css">
  .logotext{
  position: absolute;
  top: 0px;
  margin-left: 48px;
  font-family: 'Lato', sans-serif;
  color: black;
}
.topimg{
  margin-left: 25px;
}
img{
  margin-top: 7px;
}
body{
    background-image: url('4.jpg');
    background-size: 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;

}
</style>
</head>

<body>
  <div class="topimg"><img src="Film-icon.png" width="40" height="40" class="logo">
    <p class="logotext">Movie Recommendation System</p></div>
  <div>


  <div class="logmod">
  <div class="logmod__wrapper">
    <span class="logmod__close">Close</span>
    <div class="logmod__container">
      <ul class="logmod__tabs">
        <li data-tabtar="lgm-1"><a href="#">Take New Password</a></li>
      </ul>
      <div class="logmod__tab-wrapper">
      <div class="logmod__tab lgm-1">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle"> <strong>Refresh Password</strong></span>
        </div>
        <div class="logmod__form">
          <form accept-charset="utf-8" action="refpasssql.php" class="simform" method="POST">
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Enter New Password</label>
                <input class="string optional" maxlength="255" id="user-email" placeholder="Password" type="text" size="50" name="pass" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Enter Password Again</label>
                <input class="string optional" maxlength="255" id="user-email" placeholder="Password" type="text" size="50" name="repass" />
              </div>
            </div>
            <div class="simform__actions">
              <input class="sumbit" name="commit" type="submit" value="Create New Password" />
              <span class="simform__actions-sidetext"><a class="special" target="_blank" role="link"></a></span>
            </div> 
          </form>
        </div> 
          
      </div>
      </div>
    </div>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="index.js"></script>


</div>
</body>

</html>
