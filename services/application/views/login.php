

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <img src="<?php echo $url; ?>/img/icon-paraguas.png" style="max-width: 170px; max-height: 200px; padding-bottom: 20px;padding-top: 20px;" id="icon" alt="User Icon" />
        </div>

        <!-- Login Form -->
        <form action="<?= $url ?>admin/login" role="form" method="POST">
            <input type="text" id="username" class="fadeIn second" name="username" placeholder="Usuario">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Contraseña">
            <input type="submit" class="fadeIn fourth" value="Entrar">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="#">Forgot Password?</a>
        </div>

    </div>
</div>

<!-- Footer -->                    
<footer class="footer clearfix fooerLogin" id="footerTSoft">
    <div class="text-center">

    </div>
</footer>         
<!-- /footer -->

</body>
</html>