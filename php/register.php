<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- http://127.0.0.1:5500/html/register.html -->

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style-register.css">
    <link rel="icon" href="../img/icons_logo/icon_black.ico" type="image/x-icon">

    <title>VacAction | Register</title>
</head>

<body>
    <section>
        <div id="register-content">

            <img src="../img/icons_logo/icon_white2.png" alt="VacAction_logo">
            <h3>Join Our <span class="community">Community</span> Now</h3>

            <form method="POST" action="conection.php">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" autocomplete="off" required>
        
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" autocomplete="off" required>

                <div class="password">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
            
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                </div>

                <div class="optional">
                    <label for="date">Date of Birth</label>
                    <input type="date" id="date" name="date">
            
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" autocomplete="off">
                </div>

                <div class="acceptTerms">
                    <input type="checkbox" id="checkbox" name="checkbox" required>
                    <label for="checkbox">I accept the Terms & Conditions and Privacy Policy</label>
                </div>
                <input type="submit" name="submit" id="submit" value="Register">
            </form>
        </div>
    </section>

    <section id="footer-content">
        <footer id="sectores">
            <div id="sector_1">
                <p>Direccion: *************************</p>
            </div>
            <div id="sector_2">
                <img src="../img/footer/icon_footer.png" alt="Social Media Links">
            </div>
            <div id="sector_3">
                <p>Derechos reservados : VacAction ©</p>
            </div>
        </footer>
    </section>
</body>
</html>