@extends('layouts.app')

@section('content')
<title>Login</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
</head>
<body>

    
    <div id="particle-canvas"></div>
   <div class="banner">
    
     <div class="container">
       <div class="row justify-content-md-center ">
     

              <div class="card card-signin my-5 fadeInDown">
                <div class="card-body fadeIn first">
                  <img class="card-img-top" src="{{asset('img/ceind.jpg')}}" id="img" alt="Card image cap">
                  <h5 class="card-title text-center">Ingresar</h5>
                  <form class="form-signin" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    {{----------------------------------- Email ------------------------------}}
                    <div class="form-label-group">
                      <input type="email"  class="form-control" id="email"  name="email" autofocus value="{{old('email') }}" required >
                      <label >Email</label>
                    </div>
                    {{-- errors E-mail--}}
                    <div class="col-sm-12 m-2"> 
                    <small class="text-danger"> {{  $errors->first('email',':message')}} </small> 
                    </div>
                    
                    {{----------------------------------- Password ------------------------------}}
                    <div class="form-label-group">
                      <input type="password"  class="form-control" id="password" name="password" required>
                      <label >Password</label>
                    </div>
                    {{-- errors password--}}
                    <div class="col-sm-12 m-2"> 
                    <small class="text-danger"> {{  $errors->first('password',':message')}} </small> 
                    </div>
      
                    <div class="custom-control custom-checkbox mb-3">
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input" id="customCheck1">
                      <label class="custom-control-label" for="customCheck1">Recordar Contraseña</label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Ingresar</button>
                  </form>
                </div>
              </div>
            


         </div>
       </div>
   </div>


     
    
  

<!-- AnimatedSVGIcons -->
<script src="{{ asset('js/canvasbg.js') }} "></script>



</body>
</html>    