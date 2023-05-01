<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP DYNAMIC WEBSITE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


</head>

<body class="container-fluid" id="container-fluid3">
<?= include_once __DIR__ . '/../includes/nav.php' ?>


<section class="container-fluid" id="bg-video" style="position:relative">
<div class="embed-responsive embed-responsive-16by9">
            <img class="img-fluid" src="/../images/artwork-min.png" alt="">
        </div>
</section>



   

<section class="container-fluid">
        <div class="main-heading">
            <h1>WELCOME TO ART-FT</h1>
            <P>ART-FT is an NFT trade website. It provides you with the experience of buying unique NFT art. Browse through our collection and pick your favourite pick. Send us your NFT if you want to sell your NFT for incredible price.Sign up to continue you experience</P>
            <a href="contact" class="main-btn">SIGN UP</a>
        </div>
    </section>
    


 



    <section class="container-fluid" id="about">
        <div class="about.img" id="aboutpage">
            <img class="img-fluid" src="/../images/about.png" alt="">
        </div>
        <div class="about-text">
            <h2>Lorem ipsum</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente culpa repudiandae esse iusto provident nobis, harum totam ut aliquid facere blanditiis atque facilis tenetur quia, delectus, a eos tempore magni!</p>
            <button class="main-btn">READ MORE</button>
        </div>
    </section>



    <section class="container-fluid" id="contact">
    <div class="contact-heading" id="contactpage">
        <h1>CONTACT US</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente culpa repudiandae esse iusto provident nobis, harum totam ut aliquid facere blanditiis atque facilis tenetur quia, delectus, a eos tempore magni!</p>
        <form action="userinformation.php" method="post">
            <input type="text" name="user" placeholder="Your Full Name"/>
            <input type="text" name="email" placeholder="Your Email Address"/>
            <textarea name="message" placeholder="Your Message"></textarea>
            <button class="main-btn" type="submit">Continue</button>
        </form>
    </div>

    </section>
    <?= include_once __DIR__ . '/../includes/footer.php' ?>
  
</body>
</html>
