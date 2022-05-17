{{-- <!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Template</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

    <style>
        body {background: #F4F4F4;margin: 0;font-size: 16px;font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;padding: 60px;}
        .email-box {background: #ffffff;border-radius: 10px;padding: 100px;border: 1px solid #848585;}
        h3, h4 {color: #252525;font-size: 18px;}
        h4 {font-size: 15px;}
        p {color: #848585; font-size: 15px;}
        .txt-key {color: #0C4054;}
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
          <div class="col-12">
              <div class="email-box">
                  <div class="message">
                      <h3 class="font-weight-bold">Hello
                          <span class="txt-key font-weight-bold">Admin,</span>
                      </h3>
               
                      <h3 class="mt-5">
                          <span class="txt-key font-weight-bolder">Regards</span>
                      </h3>
                      <p class="mb-0">Name:  {{ $name }}</p>
                      <p class="mb-0">Contact Information: {{ $messages }}</p>
                  </div>
              </div>
          </div>

      </div>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
  crossorigin="anonymous"></script>

  </body>
</html> --}}

<h2 style="color:#8A2BE2;">Hello Admin , </h2>
<p style="color:#8A2BE2;"> You have new mail from  Website</p>
<p>
  Name : {{ $name }}<br />
  Email : {{ $email }}<br />
  Contact Information : {{ $messages }}
</p>

<p> Thank You !!</p><br/>