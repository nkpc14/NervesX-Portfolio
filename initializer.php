<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 4/2/2020
 * Time: 2:49 PM
 */

require_once 'includes/Model.php';
require_once 'includes/FileSystem.php';

//User init
$db->insert([
    "username", "firstname", "lastname", "email", "password", "mobile", "bio", "zipcode", "linkedin", "github", "facebook", "instagram", "website"],
    [
        "nkpc14",
        "Nitish",
        "Kumar",
        "nkpc14@gmail.com", password_hash("123", PASSWORD_DEFAULT), 7376977077,
        "Success isn’t always about greatness. It’s about consistency.", 277001,
        "https://www.linkedin.com/in/nitishkumarfullstack/",
        "https://github.com/nkpc14", "https://www.facebook.com/nkpc14",
        "https://www.instagram.com/yaduvanshi_nitish_kumar/", "http://www.nervesx.com"
    ]
    , "users")->execute();
$db->insert([
    "userid", "degree", "college", "start", "end"],
    [
        1,
        "Bachelor of Science in Computer Science (Hons.)",
        "Lovely Professional University",
        "2019",
        "2021"
    ]
    , "education")->execute();
$db->insert([
    "userid", "title", "company", "description", "start", "end"],
    [
        1,
        "CEO & Founder",
        "NervesX",
        "NervesX deal with the overall growth of an individuall and provides web solutions to startups. by the use of ML & Deep Nural Network. It helps to grow bussiness. NervesX helps students as a mentor and helps them to decide their goal in life.",
        "2019",
        "2021"
    ]
    , "experience")->execute();
$db->insert([
    "userid", "name", "tagline", "description", "start", "end"],
    [
        1,
        "CEO & Founder",
        "NervesX",
        "NervesX deals with the overall growth of an individual and provides web solutions to startups. by the use of ML & Deep Neural Network. It helps to grow business. NervesX helps students as a mentor and helps them to decide their goal in life. NervesX uses : Python, Tensorflow, VueJS, NodeJS, ReactJS, GPC, GraphQL, WebRTC, WebSockets, Django REST Frameworks, Django Channels, ExpressJS, AWS, ML with JS, NervesX Provides users ability to customise by the use of Plugins, it creates new job opportunities for, it provides and also uses Inter-Domain Routing which helps small businesses to grow with zero investment to mark their online presence.",
        "2017",
        "2021"
    ]
    , "projects")->execute();
$db->insert(["userid", "name", "score"], [1, "PHP", 96], "skills")->execute();
$db->insert(["userid", "name", "score"], [1, "Django", 94], "skills")->execute();
$db->insert(["userid", "name", "score"], [1, "NodeJS", 90], "skills")->execute();
$db->insert([
    "userid", "title", "description", "start", "end"],
    [
        1,
        "YouthVibe Web Developer",
        "Awarded 1st Prize in YouthVibe – University Blood Donation Website Development with PHP.",
        "2014",
        "2015"
    ]
    , "awards")->execute();
//if(isset($_POST["submit"])){
//    $fs = new FileSystem("images", 5000000, ["jpg", "png", "jpeg", "gif"]);
//    $fs->upload("image", "submit");
//}
