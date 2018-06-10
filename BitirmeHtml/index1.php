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
    background-image: url('3.jpg');
    background-size: 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;

}
</style>
</head>

<body>
  <script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      //document.getElementById('status').innerHTML = 'Please log ' +
      // 'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1771677266474194',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + ' '+ response.email + '!';
    });
    getInfo();
  }
   var arr = [];
   function getInfo() {
    


  FB.api('/me', 'GET', {fields: 'first_name,last_name,likes,email'}, function(response) {
         //document.getElementById('status').innerHTML  = JSON.stringify(response.likes);

  var s = JSON.stringify(response.likes);
  var arrStr = s.split(/["]/);
    Scan(arrStr,arr,response.email);
    
  var post_edilecek_veriler = 'n='+response.first_name + '&a='+response.last_name+'&m='+response.email;  
      $.ajax({ 
          type:'POST',  
          url:'login2.php',  
          data:post_edilecek_veriler,  
          success: 
        function(cevap){ 
             $("#status").html(cevap); 
        } 
      });

  });

    }

    
function Get(yourUrl){
    var Httpreq = new XMLHttpRequest(); // a new request
    Httpreq.open("GET",yourUrl,false);
    Httpreq.send(null);
    return Httpreq.responseText;          
}


function Scan(arrStr,arr,email){

for(var i=0; i<arrStr.length; i++){
        if(arrStr[i]=="id"){
      
          b=arrStr[i+2];
   
          FB.api(b, 'GET', {fields: 'category,name'}, function(response1) {
          
            if(response1.category=="Movie"){
           
              var post_edilecek_veriler1 = 'e='+email+ '&m='+response1.name;  
      $.ajax({ 
          type:'POST',  
          url:'index2.php',  
          data:post_edilecek_veriler1,  
          success: 
        function(cevap){ 
             $("#status").html(cevap); 
        } 
      });

            var c= response1.name;
            arr.push(c);

document.getElementById('status').innerHTML= arr;
            
            

                                          }  
                                          });    
                            }
    else if (arrStr[i]=="next"){
      r= arrStr[i+2];
      json_obj = JSON.parse(Get(r));
      var s = JSON.stringify(json_obj);
      var arrStr = s.split(/["]/);
      Scan(arrStr,arr);

 
     

    }      
}

 window.location.href = 'main.php';
}
</script>
  <div class="topimg"><img src="Film-icon.png" width="40" height="40" class="logo">
    <p class="logotext">Movie Recommendation System</p></div>
  <div>


  <div class="logmod">
  <div class="logmod__wrapper">
    <span class="logmod__close">Close</span>
    <div class="logmod__container">
      <ul class="logmod__tabs">
        <li data-tabtar="lgm-2"><a href="#">Login</a></li>
        <li data-tabtar="lgm-1"><a href="#">Sign Up</a></li>
      </ul>
      <div class="logmod__tab-wrapper">
      <div class="logmod__tab lgm-1">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Enter your personal details <strong>to create an acount</strong></span>
        </div>
        <div class="logmod__form">
          <form accept-charset="utf-8" action="register.php" class="simform" method="POST">
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">First Name*</label>
                <input class="string optional" maxlength="255" id="user-email" placeholder="Name" type="text" size="50" name="user_name" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Last Name*</label>
                <input class="string optional" maxlength="255" id="user-email" placeholder="Last Name" type="text" size="50" name="user_surname" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Email*</label>
                <input class="string optional" maxlength="255" id="user-email" placeholder="Email" type="email" size="50" name="user_mail" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input string optional">
                <label class="string optional" for="user-pw">Password *</label>
                <input class="string optional" maxlength="255" id="user-pw" placeholder="Password" type="text" size="50" name="user_pass" />
              </div>
              <div class="input string optional">
                <label class="string optional" for="user-pw-repeat">Repeat password *</label>
                <input class="string optional" maxlength="255" id="user-pw-repeat" placeholder="Repeat password" type="text" size="50" name="user_repass" />
              </div>
            </div>
            <div class="simform__actions">
              <input class="sumbit" name="commit" type="submit" value="Create Account" />
              <span class="simform__actions-sidetext">By creating an account you agree to our <a class="special" target="_blank" role="link">Terms & Privacy</a></span>
            </div> 
          </form>
        </div> 
            <div class="logmod__alter">
          <div class="logmod__alter-container">

                <span>Sign in with <strong>Facebook</strong></span>

              
           <fb:login-button scope="public_profile,email,user_likes" onlogin="checkLoginState();">Login with Facebook
          </fb:login-button>
          </div>
        </div>
      </div>
      <div class="logmod__tab lgm-2">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Enter your email and password <strong>to sign in</strong></span>
        </div> 
        <div class="logmod__form">
          <form accept-charset="utf-8" action="login.php" class="simform" method="POST" >
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Email*</label>
                <input class="string optional" maxlength="255" name="user_mail" id="user_mail" placeholder="Email" type="email" size="50"  />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-pw">Password *</label>
                <input class="string optional" maxlength="255" id="user-pw" placeholder="Password" type="password" size="50" name="user_pass" />
                            <span class="hide-password">Show</span>
              </div>
            </div>
            <div class="simform__actions">
              <input class="sumbit" name="commit" type="submit" value="Log In" />
              <span class="simform__actions-sidetext"><a href="forgot.php" class="special" role="link"  >Forgot your password?<br>Click here</a></span>
            </div> 
          </form>
        </div> 
        <div class="logmod__alter">
          <div class="logmod__alter-container">

                <span>Sign in with <strong>Facebook</strong></span>

              
           <fb:login-button scope="public_profile,email,user_likes" onlogin="checkLoginState();">Login with Facebook
          </fb:login-button>
          </div>
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
