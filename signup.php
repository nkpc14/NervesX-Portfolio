<?php
require_once 'Models/Awards.php';
require_once 'Models/Education.php';
require_once 'Models/Experience.php';
require_once 'Models/Projects.php';
require_once 'Models/Skills.php';
require_once 'Models/Users.php';
require_once 'includes/Model.php';
require_once 'includes/FileSystem.php';
require_once 'includes/app/Auth.php';
//require_once 'initializer.php';
require_once 'includes/Security.php';
?>

<?php
if (isset($_SESSION["SSID"])) {
    header("Location: ./index.php");
}
if (isset($_POST["submit"])) {
    var_dump($auth->signUp($_POST));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>NervesX | Portfolio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .login-holder {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin-top: 10rem;
            margin-bottom: 10rem;
        }

        .login {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: "Poppins Black", Arial, sans-serif;
            color: #3e64ff;
            font-size: 2rem;
            /*height: 25rem;*/
        }

        h2 {
            margin-bottom: 2rem;
        }

        .input {
            min-height: 4rem;
            /*text-align: center;*/
            border: 0.1rem solid #3e64ff;
            font-size: 1.6rem;
            padding-left: 2rem;
            padding-right: 2rem;
            margin-bottom: 2rem;
            border-radius: 4px;
            width: 30rem;
            /*outline-color: #3e64ff;*/
            color: #3e64ff;
            font-weight: bold;
        }

        .input:focus {
            background-color: #EBEFFE;
        }

        .input::placeholder {
            color: #3e64ff;
            font-weight: lighter;
        }

        input[type="submit"] {
            width: 15rem;
            border: 0.1rem solid #3e64ff;
            background-color: transparent;
            padding: 1rem;
            border-radius: 3rem;
            outline-color: transparent;
            color: #3e64ff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e64ff;
            color: white;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light site-navbar-target" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand"
           href="index.php"><span>N</span>ervesX Portfolio</a>
        <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse"
                data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <?php if ($auth->isAuthenticated) { ?>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav nav ml-auto">
                    <li class="nav-item"><a href="#home-section" class="nav-link"><span>Home</span></a></li>
                    <li class="nav-item"><a href="#about-section" class="nav-link"><span>About</span></a></li>
                    <li class="nav-item"><a href="#resume-section" class="nav-link"><span>Resume</span></a></li>
                    <li class="nav-item"><a href="#services-section" class="nav-link"><span>Services</span></a></li>
                    <li class="nav-item"><a href="#projects-section" class="nav-link"><span>Projects</span></a></li>
                    <li class="nav-item"><a href="#blog-section" class="nav-link"><span>My Blog</span></a></li>
                    <li class="nav-item"><a href="#contact-section" class="nav-link"><span>Contact</span></a></li>
                </ul>
            </div>
        <?php } else { ?>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav nav ml-auto">
                    <li class="nav-item"><a href="./login.php" class="nav-link"><span>Login</span></a></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</nav>


<section class="login-holder">
    <div class="login">
        <h2 style="text-align: center">Sign Up</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input class="input" name="firstname" type="text" placeholder="First Name">
            <input class="input" name="lastname" type="text" placeholder="Last Name">
            <input class="input" name="email" type="email" placeholder="Email">
            <input class="input" name="password" type="password" placeholder="Password">
            <input class="input" maxlength="10" name="mobile" type="number" placeholder="Mobile">
            <input class="input" maxlength="7" type="number" name="zipcode" placeholder="ZipCode">
            <input class="input" type="text" name="linkedin" placeholder="LinkedIn profile">
            <input class="input" type="text" name="facebook" placeholder="Facebook profile">
            <input class="input" type="text" name="github" placeholder="GitHub profile">
            <input class="input" type="text" name="instagram" placeholder="Instagram profile">
            <input class="input" type="text" name="website" placeholder="Website profile">
            <textarea class="input" name="bio" placeholder="Bio"></textarea>
            <input class="input" name="photo" style="padding: 1rem" type="file">
            <input type="submit" name="submit" value="Sign Up">
        </form>
    </div>

</section>

<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00"/>
    </svg>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/scrollax.min.js"></script>

<script src="js/main.js"></script>

</body>
</html>
