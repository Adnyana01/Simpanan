<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
      .container-fluid{
        background: hsla(0, 0%, 5%, 1);
        background: linear-gradient(45deg, hsla(0, 0%, 5%, 1) 0%, hsla(0, 0%, 64%, 1) 100%);
        background: -moz-linear-gradient(45deg, hsla(0, 0%, 5%, 1) 0%, hsla(0, 0%, 64%, 1) 100%);
        background: -webkit-linear-gradient(45deg, hsla(0, 0%, 5%, 1) 0%, hsla(0, 0%, 64%, 1) 100%);
        filter: progid: DXImageTransform.Microsoft.gradient( startColorstr="#0c0c0c", endColorstr="#a2a2a2", GradientType=1 );
        height: 100vh;
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

        @media (min-width: 768px) {
        .gradient-form {
        height: 100vh !important;
        }
        }
        @media (min-width: 769px) {
        .gradient-custom-2 {
        border-top-right-radius: .3rem;
        border-bottom-right-radius: .3rem;
        }
        }
    </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center" >
      <div class="col-10" >
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="{{ asset('asset/img/BPS_Logo.png') }}"
                    style="width: 165px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Badan Pusat Statistik Karangasem</h4>
                </div>


                <form method="POST" action="post-login">
                  @csrf
                  <p>Please login to your account</p>

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
                    <input type="password" id="password" name="password" class="form-control" required minlength="7" maxlength="18">
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
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">Sistem Informasi Simpanan Badan Pusat Statistik Kabupaten Karangasem</h4>
              </div>
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