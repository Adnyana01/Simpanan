<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
      body{
        font-family: Georgia, 'Times New Roman', Times, serif;
      }
      .login-container{
        box-shadow: 1px 1px 5px black inset,5px 5px 10px 1px black;
        overflow: hidden;
      }
      .login-container img{
        width: 90px;
        height: 90px;
      }
      .login-container input{
        background-color: white;
        border: 1px solid black;
        transition: 1s;
      }
      .login-container input:hover{
        background-color: white;
        border: 1px solid black;
      }
        .info-massage{
            width: 50vw;
            position: fixed;
            left: 0px;
            bottom: 0px;
            z-index:9999;
        }
        .gradient-custom-2 {
          background: hsla(182, 64%, 53%, 1);

          background: linear-gradient(135deg, rgb(85, 206, 76) 0%, rgb(36, 3, 252) 100%);

          background: -moz-linear-gradient(135deg, rgb(85, 206, 76) 0%, rgb(36, 3, 252) 100%);

          background: -webkit-linear-gradient(135deg, rgb(85, 206, 76) 0%, rgb(36, 3, 252) 100%);

          filter: progid: DXImageTransform.Microsoft.gradient( startColorstr="#3bcfd4", endColorstr="#a2fc05", GradientType=1 );
        }

        @media only screen and (max-width: 280px) {
          .login-container{
            font-size: 0.1rem !important;
          }
          .login-container img{
            width: 70px;
            height: 70px;
          }
          .login-container h1,
          .login-container h5{
            font-size: 20px;
          }
        }
    </style>
</head>
<body>
  <div class="container-fluid" >
    <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
      <div class="col-lg-4 col-md-10 col-sm-10 col-10 bg-light border rounded p-3 d-flex justify-content-center align-items-center login-container">
        <div class="container d-flex justify-content-center align-items-center p-3">
          <div class="row d-flex justify-content-center align-items-center">
            <div class="col">
              <div class="container-fluid d-flex justify-content-center align-items-center pb-5">
                <div class="row p-1">
                  <div class="col">
                    <img src="{{ asset('asset/img/BPS_Logo.png') }}" alt="">
                  </div>
                </div>
                <div class="row p-1">
                  <div class="col">
                    <h1 class="h1">SIMPANAN</h1>
                  </div>
                </div>
              </div>
              <form method="POST" action="post-login" class="">
                @csrf
                <h5 class="h5">Please login to your account</h5>

                <div class="form-outline mb-4">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" id="email" name="email" class="form-control"
                    placeholder="Your email address" required>
                </div>
                @if($errors->has('email'))
                  <div class="alert alert-warning" role="alert">{{ $errors->first('email') }}</div>
                @endif
                @if(session("masalah"))
                  @if(array_key_exists("email",session("masalah")))                      
                  <div class="alert alert-warning" role="alert">{{ session("masalah")['email'] }}</div>
                  @endif
                @endif

                <div class="form-outline mb-4">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" id="password" name="password" class="form-control" required minlength="7" maxlength="18" placeholder="Your Password" >
                </div>
                @if($errors->has('password'))
                  <div class="alert alert-warning" role="alert">{{ $errors->first('password') }}</div>
                @endif
                @if(session("masalah"))
                @if(array_key_exists("password",session("masalah")))                       
                  <div class="alert alert-warning" role="alert">{{ session("masalah")['password'] }}</div>
                  @endif
                @endif

                <div class="text-center pt-1 mb-5 pb-1">
                  <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Log
                    in</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>