{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
                @if(isset($usuario))
                <a href="{{url('/cuenta')}}">perfil</a>
                <a href="{{url('/logout')}}">logout</a>
                    @endif
                    @if(!isset($usuario))
                    <a href="{{url('/login')}}">login</a>
                    <a href="{{url('/registro')}}">sing up</a>
                    @endif
                    <a href="{{url('/foro')}}">foro</a>
                    <hr>
        <h1>{{$nombre}}</h1>
        <div class="list-group">
                <ul>
                @foreach ($temas as $tema)
                <li><a href="{{url('foro/'.$foronombre.'/temas/'.$tema->nombre )}}" class="list-group-item list-group-item-action active">{{$tema->nombre}}</a></li>
                @if(!$usuario === '')
                @if($usuario->id === $tema->id_cuenta) 
                <form action="{{url('foro/'.$foronombre.'/'.$tema->id)}}" method="post">
                        {{method_field('delete')}}
                        {{csrf_field()}}
                        <button type="submit" id="eliminar">eliminar</button>
                </form>
                @endif
                @endif
                @endforeach 
                </ul> 
            
        </div>
        @if($usuario != "")
       <div id="creartema">
               <hr>
               <h4>crear tema</h4>
               <br>
       <form action="{{url('/foro/'.$nombre )}}" method="post">
        @csrf     
                         <label for="">nombre</label>
                         <input type="text" class="form-control" name="nombre" id=""  placeholder="">
                        
                         <label for="">descripcion</label>
                         <input type="text" class="form-control" name="descripcion" id=""  placeholder="">
                        
                         <input type="submit" value="enviar">
                       
               </form>
       </div>
        @endif()
        
</body>
</html> --}}

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" src="{{url('css/stater-template.css')}}">
    <title>Hello, world!</title>
    <style>
.valid{
    border:1px solid green;
  }#principal{
    background: rgb(000, 000, 000,0.7);
    border:1px solid white
  }
  .error{
    color:red;
    
  }.minh-100{
        height: 100vh;
    } body{
        background: radial-gradient(#EAFDFF, #46AAF0, #1B16DD);
        height: 100vh;
    }#temafocus:hover{
                        transition: 0.3s;
                        border: 1px solid black;
                        transform: scale(1.03,1.03);

                }#temagrande:hover{
                        transition: 0.3s;
                        border: 1px solid white;  
                }#temagrande{
                        border: 1px solid black;    
                }
    
    </style>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
   <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
       <a class="navbar-brand" href="#">Navbar</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
     
       <div class="collapse navbar-collapse" id="navbarsExampleDefault">
         <ul class="navbar-nav mr-auto">
               @if(isset($usuario))    
           <li class="nav-item active">
             <a class="nav-link" href="{{url('/perfil')}}">perfil <span class="sr-only">(current)</span></a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="{{url('/logout')}}">Logout</a>
           </li>
                @endif
                @if(!isset($usuario))
                <li class="nav-item">
                   <a class="nav-link" href="{{url('/login')}}">login</a>
           </li>
           <li class="nav-item">
                   <a class="nav-link" href="{{url('/registro')}}">sing in</a>
                 </li>
                @endif

                <li class="nav-item">
                       <a class="nav-link" href="{{url('/foro')}}">foro</a>
               </li>

               <li class="nav-item">
                               <a class="nav-link" href="{{url('/')}}">entrada</a>
                       </li>
           <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
             <div class="dropdown-menu" aria-labelledby="dropdown01">
               <a class="dropdown-item" href="#">Action</a>
               <a class="dropdown-item" href="#">Another action</a>
               <a class="dropdown-item" href="#">Something else here</a>
             </div>
           </li>
         </ul>
         <form class="form-inline my-2 my-lg-0">
           <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
           <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
         </form>
       </div>
     </nav>

     <br>
     <br>
     <br>
     <div class="container" style="display:flex ;justify-content:center">
            <h1>Foro: {{$nombre}}</h1> 
     </div>
     <hr>
    <div id="principal" class="container col-xl-8 col-lg-8 col-md-9 col-sm-12 col-12">
               <div class="container" style="display:flex ;justify-content:center">
                               <h3 style="color:white">Temas</h3> 
                        </div>
                        <br>
     <ul class="list-group">
               @foreach ($temas as $tema)
               <li id="temagrande"class="list-group-item d-flex justify-content-between align-items-center">
                               <a id="temafocus" style="font-size:16px ; font-weight:bold ;" href="{{url('foro/'.$foronombre.'/temas/'.$tema->nombre )}}" class="list-group-item list-group-item-action active"><span style="font-size:20px">tema: {{$tema->nombre}}</span>
                                        <span style="float:right" class="badge badge-warning badge-pill">{{$tema->mensajes}} mensajes</span>
                                       <div>
                                       <br>
                                       <p style="color:black ;display:inline-block ;float:left">usuario :{{$usuarios[$tema->id]}}</p>
                                       <p style="color:black ;display:inline-block;float:right ;color:green">fecha :{{date('Y-m-d',strtotime($tema->fecha_creacion))}}</p>
                                       </div>
                               </a>
              
                               
                
                 <div class="container col-4 " style="padding-left:13%" >
                               @if($usuario != '')
                               @if($usuario->id == $tema->id_cuenta || $usuario->id_grupo ===1) 
                               <form action="{{url('foro/'.$foronombre.'/'.$tema->id)}}" method="post" class="form-group justify-content-center">
                                       {{method_field('delete')}}
                                       {{csrf_field()}}
                                       <button  style="display:flex; justify-content:center;"type="submit" class="btn btn-danger" id="eliminar">eliminar</button>
                               </form>
                               @endif
                               @endif
                 </div>
               </li>
               <br>
               
               
               @endforeach
             </ul>

             
       </div>
       <hr>
       @if($usuario != '')
       <div class="container">
       <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
                       Crear tema
                     </button>
                     <br>
                     <br>
                     <br>
                     <!-- Modal -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Crear un tema</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body" style="background: radial-gradient(#EAFDFF, #46AAF0, #1B16DD)">
                             
             <form  id="myform" action="{{url('/foro/'.$nombre )}}" method="post">
              @csrf     
                               
                               <input type="text" class="form-control" name="nombre" id=""  placeholder="nombre">
                              
                               <br>
                               <input type="text" class="form-control" name="descripcion" id=""  placeholder="descripcion">
                              <br>
                               <input class="btn btn-success" type="submit" value="enviar">
                             
                     </form>
            
             
                           </div>

                         </div>
                       </div>
                     </div>
       
             </div>

              @endif()


              
<script>
$(document).ready(function () {

$('#myform').validate({ 
   rules: {
       nombre: {
           required: true,
           maxlength: 50,
           minlength: 4,
       },
       descripcion: {
           required:true,
           minlength: 25,
           maxlength: 200,

       }
   },
   messages: {
     nombre: {
       required : 'es requerido',
     },
     descripcion: {
       required : 'es requerido',
     }
   }
});

});
</script>
</body>
</html>