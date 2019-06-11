<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
<body>

    <div class="container">
        <div class="row  justify-content-center align-items-center minh-100">
       
        <div  class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-8" >
               <form id="myform" class="form-signin" action="{{url('/singUp')}}" method="post">
                       {{csrf_field()}}
                       <h4 class="h3 mb-3 font-weight-normal">Por favor , registrese</h4>
                       <label for="nombre" class="sr-only">Email address</label>
                       <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required autofocus>
                       <br>
                       <label for="mail" class="sr-only">Password</label>
                       <input type="email" id="mail" name="mail" class="form-control" placeholder="Email" required>
                       <br>
                       <label for="inputPassword" class="sr-only">Password</label>
                       <input type="password" id="inputPassword" name="clave" class="form-control" placeholder="Password" required>
                       <br>
                       <div class="checkbox mb-3">
                       </div>
                       <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
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
        mail: {
            required:true,
            email:true,
            extension:'com|es|org',
            
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
      mail: {
        required : 'obligatorio',
        email : 'introduce un email',
        extension:'introduce bien el email'
      },
      clave: {
        required : 'obligatorio',
        minlength : 'introduce un nombre de al menos 10 caracteres'
      }
    }
});

});
</script>
</body>
</html>
