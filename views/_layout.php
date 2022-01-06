<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/_layout.css"/>
    <script src="https://kit.fontawesome.com/681737ea39.js" crossorigin="anonymous"></script>
    <script src="/js/_layout.js" defer></script>
    <title>NaMe</title>
  </head>
<body>
<header>
  <div class="container">
    <div class="container2">
      <a href="/">
        <img src="/images/logo.png" alt="logo" class="image"/>  <!-- our root folder is public folder-->
      </a>
      <ul class="navigation">
        <li class="active"><a href="/">Home</a></li>
        <li><a href="/about">About us</a></li>
        <li id="relative">
          <a href="/">Services</a>
          <ul id="dropdown">
            <li><a>Overview</a></li>
            <li><a>Hospital treatment</a></li>
            <li><a>Home treatment</a></li>
          </ul>
        </li>
        <li><a href="/">Education</a></li>
        <li><a href="/">Doctors</a></li>
        <li><a href="/">Pricelist</a></li>
        <li><a href="/">Contact Us</a></li>
      </ul>
      <label for="check" class="checkbtn">
        <img src="/images/bar.png" alt="bar" class="bar"/>
      </label>
    </div>
  </div>
</header>
<div class="body">
  <?php echo $content; ?> 
</div>
<footer>
  <div class="footer">
    <div class="footer_container">
      <div class="information">
        <img src="/images/logo2.png" alt="logo" class="image2"/>
        <div class="call">
          <div class="icon">
            <i class="fas fa-phone phone fa-2x"></i>
          </div>
          <div class="koper">
            <p class="days">7 days 0-24</p>
            <p class="number">+381 41 349 7800</p>
          </div>
        </div>
        <div class="call">
          <div class="icon">
          <i class="fas fa-map-marker gps fa-2x"></i>
          </div>
          <div class="koper">
            <p class="days">Pesterska bb</p>
            <p class="number">Sjenica</p>
          </div>
        </div>
      </div>
      <div class="container3">
          <div>
            <h4 class="title">ABOUT US</h4>
            <div class="container4">
              <p class="content">Centers</p>
              <p class="content">Pricelist</p>
              <p class="content">Doctors</p>
              <p class="content">Contact</p>
            </div>  
          </div>
          <div>
            <h4 class="title">SERVICES</h4>
            <div class="container4">
              <p class="content">Overview</p>
              <p class="content">Hospital treatment</p>
              <p class="content">Home treatment</p>
            </div>  
          </div>
          <div>
            <h4 class="title">FOR PATIENTS</h4>
            <div class="container4">
              <p class="content">Preparing for the review</p>
              <p class="content">Terms of payment</p>
              <p class="content">Education</p>
              <p class="content">Diseases</p>
            </div>  
          </div>
      </div>
    </div>
  </div>
</footer>
</body>
</html>