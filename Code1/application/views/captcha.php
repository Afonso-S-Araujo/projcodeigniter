<html>
  <head>
    <title>reCAPTCHA Aula</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <form action="<?=base_url('my_captcha/verificar')?>" method="POST">
      <div class="g-recaptcha" data-sitekey="6LcAhPMlAAAAAMeWr1J62nh3Dbq4SwuJWXgczc1v">
      </div>
      <br/>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>
