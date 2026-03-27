<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>

<div class="contact-container">
    <form action="https://api.web3forms.com/submit" method="POST" class="contact-left"> 

     <div class="contact-left-title">
        <h2>Get in Touch</h2>
        <hr>
     </div>
        <input type="hidden" name="access_key" value="0d321ffa-df76-4e74-b576-4e8027c8fa87">
        <input type="text"  name="name" placeholder="Your Name"  class="contact-inputs" required>
        <input type="email" name="email" placeholder="Your Email" class="contact-inputs" required>
        <textarea name="message" placeholder="Your Message" class="contact-inputs" required></textarea>
        <button type="submit">Submit<img src="image/arrow_icon.png" alt=""></button>

    </form>
    <div class="contact-right"> 
        <img src="image/right_img.png" alt="">

    </div>
        
</div>
    
</body>
</html>