<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="assets/margins.css">
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="stylesheet" href="assets/nav.css">
    <link rel="stylesheet" href="assets/email.css">
    <link rel="stylesheet" href="assets/social.css">
    <link rel="stylesheet" href="assets/success.css">
    </link>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <?php
      $url = 'http://127.0.0.1/backend/routes/insert.php';
      $data = array('email' => 'olafs.alkned@lak.ssd', 'checkbox' => 'checked');

      function httpPost($url, $data) {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
      }

      //TODO: debug and understand why curl hangs the connection

      httpPost($url, $data)
   ?>
   <div class = "PageContent">
    <div class="Header">
      <div class="HeaderLogoText">
        <img class="logo" src="assets/images/Union.jpg" alt="Union">
        <img class="logotxt" src="assets/images/pineapple..jpg" alt="pineapple">
      </div>
       <nav>
         <a href="#About">About</a>
         <a href="#How_it_works">How it works</a>
         <a href="#Contact">Contact</a>
       </nav>
      </div>
        <div class="Left">
         <div class="Left-Wrapper">
          <div id="success" class="Success">
            <div class="Icon"></div>
            <div class="Text">
              <h1>Thanks for subscribing!</h1>
              <p>You have successfully subscribed to our email listing. Check your email for the discount code.</p>
            </div>
          </div>
          <div id="subscribe" class ="Subscribe">
            <div class="Subscribe-TopText">
              <h1>Subscribe to newsletter</h1>
              <p>Subscribe to our newsletter and get 10% discount on pineapple glasses.</p>
            </div>
          <form id="form" class="Form" action="./backend/routes/insert.php">
            <div class="Blueline"></div>
            <input type="text" class="email" id="email" placeholder="Type your email address here..."></input>
            <div class="arrow" id="submit"></div>
            <label class="container">
              <input type="checkbox" id="checkbox">
              <span id="agree" class="checkmark"></span>
            </label>
          </form>
          <p class="error" id="err"></p>
          <p class="agree">I agree to <a href="#Terms_of_service" class="Terms">terms of service</a></p>
        </div>
        <div class="SocialMedia">
            <div class="SocialMedia-LinksWrapper">
              <a class="Facebook" href="#Facebook"></a>
              <a class="Instagram" href="#Instagram"></a>
              <a class="Twitter" href="#Twitter"></a>
              <a class="Youtube" href="#Youtube"></a>
            </div>
        </div>
      </div>
    </div>
    <div class="Right">
      <img src="assets/images/image_summer.jpg" alt="image_summer">
    </div>
  </body>
</html>
