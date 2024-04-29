
<?php
include 'db_con.php';

if(isset($_POST['submit'])){
    $formdata = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'message' => $_POST['message'],
        'date' => date('Y-m-d H:i:s'),
    ];

    $col = implode(',', array_keys($formdata));
    $values = implode("','", array_values($formdata));
    $sql = "INSERT INTO web_data ($col) VALUES ('$values')";

    if($con->query($sql) === true){
        echo '<script>alert("Thank you for your support! Your message has been sent.");</script>';
        // header("Location: index.php"); 
        // exit();
    } else {
        echo '<script>alert("Sorry, there was an issue processing your request. Please try again later.");</script>';
    }
    echo '<script>window.location.href = "index.php";</script>';
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="refresh" content="3000">
    <title>Akash Sharma</title>
    <script src="https://kit.fontawesome.com/19c6a4f001.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/AS-DarkCode.jpg" type="#">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="scrollToTop-btn">
        <i class="fa-solid fa-angles-up"></i>
    </div>

    <header>
        <a href="#" class="brand"><i>Akash</i></a>
        <div class="menu-btn"></div>
        <div class="navigation">
            <a href="#main">Home</a>
            <a href="#about">About</a>
            <a href="#skills">Skills</a>
            <a href="#work">Projects</a>
            <a href="images/Akash_Resume.pdf">Resume</a>
            <a href="#contact">Contact</a>
        </div>
    </header>

    <section class="main" id="main">
        <div class="content">
            <h2><B><i>Hello, I'm</i></B><br /><span>Akash Sharma</span></h2>
            <div class="animated-text">
                <h3>Web Developer</h3>
                <h3>PHP Developer</h3>
                <h3>Backend Developer</h3>
            </div>
            <a href="#services" class="btn">See My Projects</a>
            <div class="media-icons">
                <a href="https://github.com/AS-DarkCode" target="_blank"><i class="fa-brands fa-github"></i></a>
                <a href="https://www.linkedin.com/in/as-darkcode" target="_blank"><i
                        class="fa-brands fa-linkedin"></i></a>
                <a href="#" target="_blank"><i class="fa-brands fa-square-x-twitter"></i></a>
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <div class="title reveal">
            <h2 class="section-title">About Me</h2>
        </div>
        <div class="content">
            <div class="column col-left reveal">
                <div class="img-card">
                    <img src="images/profile.jpg" alt="" />
                </div>
            </div>
            <div class="column col-right reveal">
                <h2 class="content-title">Welcome to Akash's World of Web Development!</h2>
                <p class="paragraph-text">
                    Hello there! 👋 I'm Akash, a passionate BCA (Bachelor of Computer Applications) student with a flair
                    for web development. Over the course of my academic journey, I've delved into various facets of
                    software development, honing my skills in creating dynamic and user-friendly web applications.
                    <br /><br /> <i>
                        I find inspiration in transforming ideas into interactive and dynamic web experiences. My
                        passion for coding is fueled by the belief that technology has the power to make a positive
                        impact on our lives.</i>
                    <br>
                </p>
                <a href="#work" class="btn">See More</a>
            </div>
        </div>
    </section>

    <section class="skills" id="skills">
        <div class="title reveal">
            <h2 class="section-title">My Skills</h2>
        </div>
        <div class="content">
            <div class="column col-left reveal">
                <h2 class="content-title">My Skills and Experiences</h2>
                <p>
                    Throughout my academic journey, I've undertaken and successfully
                    completed a range of projects that showcase my hands-on experience.
                    From developing contact management systems, bank management applications,
                    and blood management systems to creating efficient library management systems and
                    e-commerce platforms,I've had the chance to apply my knowledge to real-world scenarios. <br><br>
                <p>I'm not just a coder; I'm someone who is enthusiastic about creating solutions that are not only
                    functional but also user-friendly and aesthetically pleasing.
                    The combination of technical expertise and creativity is what drives me to build engaging and
                    effective web applications.</p>
                </p>
                <a href="#" class="btn">See More</a>
            </div>
            <div class="column col-right reveal">
                <div class="bar">
                    <div class="info">
                        <span>HTML</span>
                        <span>90%</span>
                    </div>
                    <div class="line html"></div>
                </div>
                <div class="bar">
                    <div class="info">
                        <span>CSS</span>
                        <span>85%</span>
                    </div>
                    <div class="line css"></div>
                </div>
                <div class="bar">
                    <div class="info">
                        <span>JavaScript</span>
                        <span>80%</span>
                    </div>
                    <div class="line javascript"></div>
                </div>
                <div class="bar">
                    <div class="info">
                        <span>PHP</span>
                        <span>80%</span>
                    </div>
                    <div class="line php"></div>
                </div>
                <div class="bar">
                    <div class="info">
                        <span>MySQL</span>
                        <span>75%</span>
                    </div>
                    <div class="line mysql"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <div class="title reveal">
            <h2 class="section-title">My Works</h2>
            <p>
                <i><b>Welcome to my digital workspace! I take pride in the projects I've undertaken during my
                        journey as a web developer. Each project reflects not only my technical skills but also my
                        commitment to delivering solutions that make a difference. Here's a glimpse into some of my
                        notable work:</b> </i>
            </p>
        </div>
        <div class="content">
            <div class="card reveal">
                <div class="service-icon">
                    <i class="fa-brands fa-phoenix-framework"></i>
                </div>
                <div class="info">
                    <h3>Web Devloper</h3>
                    <p>
                        "Passionate web developer crafting seamless digital experiences
                        through HTML, CSS, JS, PHP, and MySQL. Let's build something amazing together!"
                    </p>
                </div>
            </div>
            <div class="card reveal">
                <div class="service-icon">
                    <i class="fa-brands fa-connectdevelop"></i>
                </div>
                <div class="info">
                    <h3>Web Design</h3>
                    <p>
                        "Creative web designer blending aesthetics and functionality with a mastery of design tools.
                        Transforming visions into visually stunning digital landscapes."
                    </p>
                </div>
            </div>
            <div class="card reveal">
                <div class="service-icon">
                    <i class="fa-brands fa-free-code-camp"></i>
                </div>
                <div class="info">
                    <h3>PHP Devloper</h3>
                    <p>
                        "Versatile PHP developer transforming ideas into dynamic and efficient web solutions.
                        Crafting code that brings functionality and innovation to life."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="work" id="work">
        <div class="title reveal">
            <h2 class="section-title">My Projects</h2>
        </div>
        <div class="content">
            <a href="CRUD/index.php"><div class="card reveal">
                <div class="card-img">
                    <img src="images/contact.jpg" alt="" />
                </div>
                <h5>Contact Management</h5>
            </div></a>
            
            <a href = "MVC"><div class="card reveal">
                <div class="card-img">
                    <img src="images/library.jpg" alt="" />
                </div>
                <h5>Library Management</h5>
            </div></a>
            <div class="card reveal">
                <div class="card-img">
                    <img src="images/school.jpg" alt="" />
                </div>
                <h5>School Management</h5>
            </div>
            <div class="card reveal">
                <div class="card-img">
                    <img src="images/bank.jpg" alt="" />
                </div>
                <h5>Bank Management</h5>
            </div>
            <div class="card reveal">
                <div class="card-img">
                    <img src="images/ecommerce.png" alt="" />
                </div>
                <h5>E-Commerce</h5>
            </div>
            <div class="card reveal">
                <div class="card-img">
                    <img src="images/blood.jpg" alt="" />
                </div>
                <h5>Blood Bank</h5>
            </div>
            <div class="title reveal">
                <a href="" class="btn">See All</a>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="title reveal">
            <h2 class="section-title">Contact Me</h2>
        </div>
        <div class="content">
            <div class="row">
                <div class="card reveal">
                    <div class="contact-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="info">
                        <h3>Address</h3>
                        <span>Bareilly Utter Pradesh India</span>
                    </div>
                </div>
                <div class="card reveal">
                    <div class="contact-icon">
                        <i class="fa-solid fa-phone-volume"></i>
                    </div>
                    <div class="info">
                        <h3>Phone</h3>
                        <span>7900360024</span>
                    </div>
                </div>
                <div class="card reveal">
                    <div class="contact-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="info">
                        <h3>Email Address</h3>
                        <span>akashshar985@gmail.com</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <form action="" method="post">
                    <div class="contact-form reveal">
                        <h3>Send Message</h3>
                        <div class="input-box">
                            <input type="text" name="name" value="" placeholder="Name" required />
                        </div>
                        <div class="input-box">
                            <input type="text" name="email" value="" placeholder="Email" required />
                        </div>
                        <div class="input-box">
                            <textarea name="message" id="" cols="70" rows="9" placeholder="Message" required></textarea>
                        </div>
                        <div class="input-box">
                            <input type="submit" class="send-btn" name="submit" value="Send" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer class="footer">
        <span class="footer-title">Akash</span>
        <p>Copyright @2024 <a href="Complete/index.php">AS-Darkcode</a>. All Rights Reserved.</p>
    </footer>

    <script src="script.js" charset="utf-8"></script>
</body>

</html>
