
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" src="{{url('/sass/offcanvas.css')}}">
  <link rel="stylesheet" src="{{url('css/stater-template.css')}}">
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
    }.modal-body{
      background: radial-gradient(#EAFDFF, #46AAF0, #1B16DD);
    }.col-8{
      margin-bottom: 15px;
      justify-content: center;
    } #principal{
      background: rgb(000, 000, 000,0.7);
      border:1px solid white
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
      <hr>
          <h4 style="text-align:center ;color:white">{{$mensaje}}</h4>
          <br>
          <br>
          <div class="container">
            <div class="row justify-content-center">
                <div style="display:flex;align-items:center; padding:0;" id="miniatura"class="col-xl-4 col-lg-4 col-md-8 col-sm-8 col-8">
                  
                      
                    <div class="card" style="width: 18rem;border:3px solid black;margin:0 ">
          
                        <div class="card-body" style="background:#007bff">
                            <div class="progress">
                            <p  class="card-text"><div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 10% ;color:black">
                                {{$numeromensajes}}/500 mensajes para llegar a viajero experto</div>
                              </div></p>
                          <h5 class="card-title">Usuario:{{$usuario->nombre}}</h5>
                        <p class="card-text">numero de mensajes: {{$numeromensajes}}</p>
                        <p class="card-text">Rol :{{$rol}}</p>
                        
                          <p class="card-text" style="color:green" >fecha de creación: {{date('Y-m-d',strtotime($usuario->fecha_creacion))}}</p>
                        </div>
                        @if(isset($ruta))
                        
                       
                        
                       <div class="card-img" style="width:100% ; max-height:125px">
                        <img style="max-height: 125px;"class="card-img-top" src="{{$ruta}}" alt="Card image cap">
                      </div>
                        @endif
                      </div>
                </div>
              <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8" id="principal" style="padding:0 ;">
                  <div style="padding:0" class="container-fluid">
                      @if(!isset($ruta))
                        <h4>subir foto al perfil</h4>
                        <form class="form-group" action="{{url('/perfil')}}" method="post" id="formsubirfoto" enctype="multipart/form-data" >
                          @csrf
                           
                          
                                  <div class="custom-file">
                                    <input type="file" class="form-control" name="foto" id="inputGroupFile01"
                                      aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                  </div>
                                
                           
                           <br>
                           <br>
                           <input class="btn btn-success" type="submit" value="enviar">
                 </form>
                        @endif
                        @if(isset($ruta))
                        <form class="form-group" action="{{url('/perfil')}}" method="post" id="formcambiarfoto" enctype="multipart/form-data" >
                          {{method_field('put')}}
                           {{ csrf_field() }} 
                            <div class="custom-file">
                            <input type="file" class="form-control" name="fotocambiar" id="inputGroupFile01"
                              aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                          </div>
                           
                           <br>
                           <br>
                           <input class="btn btn-warning" type="submit" value="Cambiar foto">
                 </form>
                        @endif
                        <hr style="color:white">
                        
                        <button  type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal1">
                            modificarperfil
                          </button>
                          
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modificar perfil</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-group"action="{{url('/perfil')}}" method="post" id="formclave">
                                      {{method_field('patch')}}
                                      {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="exampleInputNombre">Nombre</label>
                                            <input type="text" class="form-control" id="exampleInputNombre"  name="nombre" aria-describedby="emailHelp" placeholder="Nombre">
                                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                          </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1" name="clave">Password</label>
                                          <input type="password" class="form-control" id="clave" name="clave" placeholder="Password">
                                        </div>
                                      
                                        <button type="submit" class="btn btn-success">Submit</button>
                                      </form>
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          <br>
                          <br>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal2">
                              Eliminar perfil
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar perfil</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                      <form class="form-group" action="{{url('/perfil')}}" method="post">
                                        {{method_field('delete')}}
                                        {{ csrf_field() }}
                                          <button type="submit" class="btn btn-danger">Eliminar</button>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
                                        </form>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
    
                    </div>
              </div>
              
            </div>
          </div>
          <br>
          <hr>
          <br>
      <script type="text/javascript" >
        $(function () {
            'use strict'
          
            $('[data-toggle="offcanvas"]').on('click', function () {
              $('.offcanvas-collapse').toggleClass('open')
            })
          })
        </script>
               
<script>
$(document).ready(function () {

$('#formsubirfoto').validate({ 
  rules: {
        foto: {
            required:true,
            extension:('jpg|jpeg|png')
        }
    },
    messages: {
      foto: {
        required :'campo requerido',
        extension : 'solo pertimos subir fotos',
      }
    }
    
});

$('#formcambiarfoto').validate({ 
    rules: {
        fotocambiar: {
          required:true,
            extension:('jpg|jpeg|png')
            
        }
    },
    messages: {
      fotocambiar: {
        required :'campo requerido',
        extension : 'solo pertimos subir fotos',
      }
    }
});

$('#formclave').validate({ 
    rules: {
        nombre: {
            minlength:4,
            maxlength:25
        },
        clave: {
            minlength:10,
            maxlength:25
        }
    },
    messages: {
      nombre: { 
      },
      clave: {
      }
    }
});

});
</script>
</body>
</html>