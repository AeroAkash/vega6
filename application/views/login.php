<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>Vega Login</title>

    <style>
      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: monospace;
      }
      .row {
        border-radius: 32px;
        box-shadow: 12px 12px 22px;
      }
      .login img {
        border-top-left-radius: 32px;
        /* border-bottom-left-radius: 32px; */
        border-top-right-radius: 32px;
      }
      .login h1 {
        font-size: 3rem;
        font-weight: 700;
      }
      .inp {
        height: 48px;
        width: 70%;
        border: none;
        outline: none;
        border-radius: 64px;
        box-shadow: -1px 1px 32px -12px rgba(0, 0, 0, 0.75);
        -webkit-box-shadow: -1px 1px 32px -12px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: -1px 1px 32px -12px rgba(0, 0, 0, 0.75);
      }
      .signin-btn {
        height: 50px;
        width: 50%;
        border: none;
        outline: none;
        border-radius: 64px;
        font-weight: 600;
        background: rgb(235, 9, 9);
        color: white;
      }
      .signin-btn:hover {
        background-color: brown;
        transition: 0.5s;
      }
    </style>
  </head>
  <body>
    <section class="login py-5">
      <div class="container" style="width: 512px">
        <div class="row g-0">
          <div class="col-md-12">
            <img src="https://cdn.pixabay.com/photo/2018/08/13/18/05/landscape-3603564_1280.jpg" class="img-fluid" alt="login_images" />
          </div>

          <div class="col-md-12 text-center py-5">
            <h1 class="animate__animated animate__bounce animate__infinite">Welcome User</h1>

            <form id="signin_form">
              <div class="form-row py-3">
                <div class="offset-1 col-md-10">
                  <input type="text" name="email" id="" placeholder="Enter Email_Id" class="inp px-3" required />
                </div>
              </div>

              <div class="form-row py-3">
                <div class="offset-1 col-md-10">
                  <input type="password" name="password" id="" placeholder="Enter Your password" class="inp px-3" required />
                </div>
              </div>

              <span id="error" style="color: red" hidden  >Wrong Email_Id Or Password</span>

              <div class="form-row">
                <div class="offset-1 col-md-10">
                  <button type="submit" class="signin-btn">Sign In</button>
                </div>
              </div>
            </form>
            <span><a href="<?php echo base_url('Vega/signup_page') ?>" style="text-decoration: none">Create Our Account</a></span>
          </div>
        </div>
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      $(() => {
        $("#signin_form").on("submit", (e) => {
          e.preventDefault();

          let form_data = new FormData($("#signin_form")[0]);
          fetch('<?php echo base_url("Vega/sign_in") ?>', {
            method: "post",
            body: form_data,
          })
            .then((res) => res.json())
            .then((data) => {
              if (data.status) {
                window.location = "<?php echo base_url('Vega/dashboard')?>";
              } else {
                var span = document.getElementById("error");
                span.hidden = false;
              }
            })
            .catch((err) => console.log(err));
        });
      });
    </script>
  </body>
</html>
