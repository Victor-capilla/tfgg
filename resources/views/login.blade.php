<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" src="{{url('css/singin.css')}}">
  <style>
  .valid{
    border:1px solid green;
  }.error{
    
    color:red;
    
  }.minh-100{
        height: 100vh;
    } body{
        background: radial-gradient(#EAFDFF, #46AAF0, #1B16DD);
        height: 100vh;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
    
</head>
<body class="text-center">
    {{-- <form action="singUp" method="post">
    
        {{csrf_field()}}
        nombre : <input type="text" name="nombre">
        contraseña : <input type="password" name="clave">
        mail : <input type="mail" name="mail">
        enviar : <input type="submit" value="enviar">
    
        </form>  --}}

     <div class="container">
         <div class="row  justify-content-center align-items-center minh-100">
        
         <div  class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-8" >
                <form id="myform" class="form-signin" action="{{url('/perfil')}}" method="get">
                        {{csrf_field()}}
                        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                        <label for="nombre" class="sr-only">Nombre o Email</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre o Email" required autofocus>
                        <br>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" name="clave" class="form-control" placeholder="Password" required>
                        
                        <br>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        <p class="mt-5 mb-3 text-muted">&copy; 2017</p>
                      </form>
                      
                            @if(isset($mensaje))
                            <h1>{{$mensaje}}</h1>
                                @endif  
         </div>
        
     
        </div>
    </div>
    <script>
            $(document).ready(function () {
            
            $('#myform').validate({ 
                rules: {
                    nombre: {
                        required: true,
                        minlength: 2
                    },
                    clave: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                  nombre: {
                    required : 'obligatorio',
                    minlength : 'introduce un nombre de al menos 3 caracteres'
                  },
                  clave: {
                    required : 'obligatorio',
                    minlength : 'introduce un nombre de al menos 10 caracteres'
                  }
                }
            });
            
            });
            </script></body>
</html>