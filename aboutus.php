<?php require_once("includes/database.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>

<!DOCTYPE HTML>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
    <meta name="title" content="Project">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Project</title>
</head>

<body>
    <div class="preloader">
        <div class="inner-preloader">
            <img src="assets/preloader.gif">
        </div>
    </div>
    <!-- Navbar -->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    NewsBlogger
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutus.php">About Us</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control -x mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" name="searchingButton">Search</button>
                        </form>
                    </ul>
                </div>
            </div>

        </nav>
    </header>
    <main>
      <h1 class="header1 mb-4" style="color: #1E6C9F">
              Who We Are
          </h1>
     <section class="banner">
         <div class="overlay">
             <div class="d-flex">
                 <h2 class="header-2">
                     We're NewsBlogger Blog Website !
                 </h2>
                 <p class="text">
                     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum, impedit, quos. Quisquam nisi impedit nobis in, reprehenderit commodi, obcaecati, ipsa quas vero aliquid inventore ut tenetur eos quam? Non, illo.
                 </p>
                 <a class="btn-reg" href="blog.php">
                     Check All Blogs
                 </a>
             </div>
         </div>
     </section>
      <section class="about">
         <h1 class="header1 mb-4" style="color: #1E6C9F">
            Our Services
          </h1>
          <div class="container">
              <div class="row">
                  <div class="col-md-4 mb-4">
                    <div class="about-wrapper" data-aos="fade-down">
                        <img src="assets/live-streaming.png" alt="" class="img-fluid">
                        <h6 class="header-6">24 Hours Streaming</h6>
                        <p class="text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque aspernatur expedita, sint doloribus, consectetur 
                        </p>
                    </div>  
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="about-wrapper" data-aos="fade-down">
                        <img src="assets/bullhorn.png" alt="" class="img-fluid">
                        <h6 class="header-6">Social Ads</h6>
                        <p class="text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque aspernatur expedita, sint doloribus, consectetur 
                        </p>
                    </div>  
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="about-wrapper" data-aos="fade-down">
                        <img src="assets/start-up.png" alt="" class="img-fluid">
                        <h6 class="header-6">Creative</h6>
                        <p class="text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque aspernatur expedita, sint doloribus, consectetur 
                        </p>
                    </div>  
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="about-wrapper" data-aos="fade-down">
                        <img src="assets/list.png" alt="" class="img-fluid">
                        <h6 class="header-6">All Categories</h6>
                        <p class="text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque aspernatur expedita, sint doloribus, consectetur 
                        </p>
                    </div>  
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="about-wrapper" data-aos="fade-down">
                        <img src="assets/high-five.png" alt="" class="img-fluid">
                        <h6 class="header-6">Friend Website</h6>
                        <p class="text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque aspernatur expedita, sint doloribus, consectetur 
                        </p>
                    </div>  
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="about-wrapper" data-aos="fade-down">
                        <img src="assets/investigate.png" alt="" class="img-fluid">
                        <h6 class="header-6">Researchers</h6>
                        <p class="text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque aspernatur expedita, sint doloribus, consectetur 
                        </p>
                    </div>  
                  </div>
              </div>
          </div>
      </section>
    </main>
       
    <!-- Footer -->
    <div class="crights" style="background-color:#1E6C9F; ">
        <div class="container">
            <div class="row justify-content-center align-items-center text-center" style="margin:0; padding:0;">
                <p class="text pl-2 " style="color:#fff; font-weight:bold; margin: 4px;">
                    All Copyrights Reserved &copy; 2019 Team
                </p>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/aos.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script>
    </script>
</body>

</html>
