<?php
if(isset($_POST['submit'])){
  $username=$_POST['username'];
  $password=$_POST['password'];
 
  $host='localhost';
  $user='root';
  $pass='';
  $dbname='recaptcha';
  $conn=mysqli_connect($host,$user,$pass,$dbname);
  $sql="INSERT INTO rd(username,password) values('$username','$password')";
  mysqli_query($conn,$sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form with reCAPTCHA</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <style>
  body {
    font-family: Arial, sans-serif;
  }
  
  .login-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid black;
    background-color: lightgoldenrodyellow;
  }
  
  h1 {
    font-size: 24px;
  }
  
  label, input {
    display: block;
    margin-bottom: 10px;
  }
  
  button {
    margin-top: 10px;
  }
</style>
</head>
<body>
  <div class="login-container">
    <form id="login-form" action="#" method="POST">
      <h1>Login</h1>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <div class="g-recaptcha" data-sitekey="6LeNFsQnAAAAABNKZsyEZSO2Jbpvx8kFldigljqx"></div>
      <input type="submit" name="submit" value="Send Data"> 
    </form>
  </div>
  <script>
    
function onClick(e) {
  e.preventDefault();
  grecaptcha.enterprise.ready(async () => {
    const token = await grecaptcha.enterprise.execute('6LeRysMnAAAAADtErIqndoInI22S__5Fxh-taSW2', {action: 'LOGIN'});
    // IMPORTANT: The 'token' that results from execute is an encrypted response sent by
    // reCAPTCHA Enterprise to the end user's browser.
    // This token must be validated by creating an assessment.
    // See https://cloud.google.com/recaptcha-enterprise/docs/create-assessment
  });
}

  document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login-form');
  
    loginForm.addEventListener('submit', (event) => {
      event.preventDefault();
  
      const username = loginForm.username.value;
      const password = loginForm.password.value;
  
      // Verify reCAPTCHA
      const recaptchaResponse = grecaptcha.getResponse();
      if (recaptchaResponse === '') {
        alert('Please complete the reCAPTCHA.');
        return;
      }
  
      // Perform login logic here
      // You can make an AJAX request to your backend for authentication
  
      alert('Login successful!');
      // Reset reCAPTCHA
      grecaptcha.reset();
    });
  });
</script>
</body>
</html>
