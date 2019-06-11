{{-- <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript">
                 var edit = false;
            var edittema = false;
            var deletee =false;
            var metodo = 'post';
         function clickeditar(id){
            if(edit === false){
                edit= true;
                document.getElementById('formulario'+id).style.display = "block";
        
            }else{
                edit = false;
                document.getElementById('formulario'+id).style.display = "none";
            }
            
           
            
            }
            function clickeditartema(id){
            if(edittema === false){
                edittema = true;
                document.getElementById('formulariotema'+id).style.display = "block";
        
            
            }else{
                edittema = false;
                document.getElementById('formulariotema'+id).style.display = "none";
                
            }
            

            
         }
        </script>
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
<h1>{{$tema->nombre}}</h1>
<br>
<br>
<p>{{$tema->descripcion}}</p> 
<hr>
<hr>
@if($usuario->id === $tema->id_cuenta)
<button onclick="clickeditartema({{$tema->id}})" id="editartema">modo edicion</button>
@endif

<hr>
<form action="{{url('foro/'.$foro->nombre.'/'.$tema->id)}}" id="formulariotema{{$tema->id}}" method="post" style="display:none" >
    {{method_field('put')}}
     {{ csrf_field() }}
    texto:     <input type="text" id="cambiartema" name="cambiartema">
    
    <input type="submit" value="Cambiar tema">
   
    
</form>

@if(!is_null($mensajes))
@foreach($mensajes as $indexmensajes => $valor)
<div>
<h5> usuario : {{$usuariosMensaje[$indexmensajes]->nombre}}</h5>
<br><br>
<h4 > mensaje : {{$valor->mensaje}}</h4>
<br>
<hr>
<form action="{{url('foro/'.$foro->nombre.'/temas/'.$tema->nombre.'/'.$valor->id)}}" id="formulario{{$valor->id}}" method="post" style="display:none" >
    
    texto:     <input type="text" id="cambiarmensaje" name="cambiarmensaje">
    
    <input type="submit" value="Cambiar mensaje">
   
    {{method_field('put')}}
     {{ csrf_field() }}
</form>

@if($usuario->id == $valor->id_cuenta)
<button  onclick="clickeditar({{$valor->id}})" id="editar{{$usuario->id}}">modo edicion</button>
<form action="{{url('foro/'.$foro->nombre.'/temas/'.$tema->nombre.'/'.$valor->id)}}" method="post">
    {{method_field('delete')}}
    {{csrf_field()}}
    <button type="submit" id="eliminar">eliminar mensaje</button>
</form>


@endif
</div>
<hr>
@endforeach
@endif
@if($usuario != "")
<div id="crearmensaje">
        <hr>
        <h4>responder al tema </h4>
        <br>
                  
                  <form action="{{url('foro/'.$foro->nombre.'/temas/'.$tema->nombre )}}" method="post" id="formulario" enctype="multipart/form-data" >
                 @csrf

                  <label for="">nombre</label>
                  <input type="text" class="form-control" name="mensaje" id=""  placeholder="">
                  <label for="">subir foto</label>
                  <input type="file" name="fotomensaje" id="">
                 
                <input type="hidden" name="temanombre" value="{{$tema->nombre}}"/>
                  <input type="submit" value="enviar">
                  
                  

                
        </form>
</div>
 @endif()
</body>
</html>
 --}}
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" src="{{url('/sass/offcanvas.css')}}">
    <style>
    body{
        background: radial-gradient(#EAFDFF, #46AAF0, #1B16DD);
        height: 100vh;
    }
    </style>
   

</head>
<body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                  <ul class="navbar-nav mr-auto">
                        @if(isset($usuario) && $usuario!== '')    
                    <li class="nav-item active">
                      <a class="nav-link" href="{{url('/perfil')}}">perfil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('/logout')}}">Logout</a>
                    </li>
                         @endif
                         @if(isset($usuario)&& $usuario=== '')
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
              
              
              <main role="main" class="container">
                  <div class="row  justify-content-center">
                      <div class="col-3" >
                            @if($usuario != "")
                            
                            <button style="position:fixed; position:fixed; left:10%; top:100px;"type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter">
                                 Responder
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Responder al tema</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body" style="background:radial-gradient(#EAFDFF, #46AAF0, #1B16DD)">
                                              <div id="crearmensaje">
                                                     
                                                    
                                                      <br>
                                                                
                                                                <form class="form-group" action="{{url('foro/'.$foro->nombre.'/temas/'.$tema->nombre )}}" method="post" id="formulario" enctype="multipart/form-data" >
                                                               @csrf
                                              
                                                                
                                                                <textarea class="form-control" name="mensaje" id="nombre"  placeholder="Escribe la respuesta"></textarea>
                                                                <br>
                                                                <div class="custom-file">
                                                                      <input type="file" class="formcontrol" name="fotomensaje" id="customFile">
                                                                      <label class="custom-file-label"  for="customFile">Subir foto</label>
                                                                    </div>
                                                               
                                                                <input class="form-control" type="hidden" name="temanombre" value="{{$tema->nombre}}"/>
                                                                <br>
                                                                <br>
                                                                <input onclick="alerta()" class="btn btn-success" type="submit" value="enviar">
                                                                <div  id="mensajeenviado" style="display:none; position:fixed ;top:10%; right:10" class="alert alert-primary" role="alert">
                                                                       Mensaje enviado
                                                                </div>
                                                                
                                              
                                                              
                                                      </form>
                                              </div>
                                               @endif()
                                            </div>
                                    </div>
                                  </div>
                                </div>
  
                      </div>
                      <div class="col-9">
                            <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                                      <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$tema->nombre}}</h5>
                                        <small>3 days ago</small>
                                      </div>
                                      <p class="mb-1">{{$tema->descripcion}}</p>
                                      <small>{{$usuariotema}}</small>
                                    <small style="float:right">mensajes totales:{{$tema->mensajes}}</small>
                                      <hr>
                                      @if($usuario!== '')
                                      @if($usuariotema == $usuario->nombre)
                                      <button class="btn btn-warning" onclick="clickeditartema({{$tema->id}})" id="editartema">modo edicion</button>
                                    
        <form class="form-group"action="{{url('foro/'.$foro->nombre.'/'.$tema->id)}}" id="formulariotema{{$tema->id}}" method="post" style="display:none" >
            {{method_field('put')}}
             {{ csrf_field() }} 
             <hr>
                <textarea placeholder="modifica el tema" class="form-control" type="text" id="cambiartema" name="cambiartema"></textarea>
            
            <input class="btn-success" type="submit" value="Cambiar tema">
           
            
        </form>
        @endif
        @endif
        
    </a>
        <br>                       
                                
        
                                  </div>
                                  @if(!is_null($mensajes))
                                  @foreach($mensajes as $indexmensajes => $valor)
                                   <div class="list-group">
                                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                      
                                        <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{$tema->nombre}}</h5>
                                                <small class="" style="color: green; font-size:12px float:left">fecha:{{  date('Y-m-d',strtotime($valor->fecha_creacion))}}</small>
                                              </div>
                                       
                                        <p style="font-size:14px"class="mb-1 bol">mensaje: {{$valor->mensaje}}</p>
                                        @if($fotos!= '' && isset($fotos[$valor->id]))
                                        <div class="text-center">
                                                <img src="{{url($fotos[$valor->id])}}" class="img-fluid" alt="">
                                              </div>
                                           
                                        @endif
                                        <small class="text-muted">usuario:{{$usuariosMensaje[$indexmensajes]->nombre}}</small>
         @if($usuario!== '')                               <hr>
        @if($usuario->id == $valor->id_cuenta || $usuario->id_grupo ==2)

        <form class="form-group" action="{{url('foro/'.$foro->nombre.'/temas/'.$tema->nombre.'/'.$valor->id)}}" id="formulario{{$valor->id}}" method="post" style="display:none" >
           
            <textarea class="form-control" type="text" id="cambiarmensaje" name="cambiarmensaje" placeholder="texto a editar"></textarea>
            <br>
            
            
            <input class="btn btn-success" type="submit" value="Cambiar mensaje">
            <br>
            <hr>
            {{method_field('put')}}
             {{ csrf_field() }}
        </form>
       
        <form style="float:right" class="form-group"action="{{url('foro/'.$foro->nombre.'/temas/'.$tema->nombre.'/'.$valor->id)}}" method="post">
            {{method_field('delete')}}
            {{csrf_field()}}
            
            <button class="btn btn-danger" type="submit" id="eliminar">eliminar mensaje</button>
        </form>
        
        <button  style="float:left"class="btn btn-warning" onclick="clickeditar({{$valor->id}})" id="editar{{$usuario->id}}">modo edicion</button>
        
       
        @endif
        @endif
        
                                      </a>
                                    </div>
                                    <br>
                                  @endforeach
                                  @endif
        
                                  
                      </div>
                  </div>
                    
                     
              </main>
              <script type="text/javascript">
                var edit = false;
           var edittema = false;
           var deletee =false;
           var metodo = 'post';
           function alerta(params) {

                setTimeout(() => {
                    document.getElementById('mensajeenviado').style.display = 'block';
                    setTimeout(() => {
                        document.getElementById('mensajeenviado').style.display = 'none';   
                    }, 100);
                }, 1500);

               ;
           }
        function clickeditar(id){
           if(edit === false){
               edit= true;
               document.getElementById('formulario'+id).style.display = "block";
        
           }else{
               edit = false;
               document.getElementById('formulario'+id).style.display = "none";
           }
           
          
           
           }
           function clickeditartema(id){
           if(edittema === false){
               edittema = true;
               document.getElementById('formulariotema'+id).style.display = "block";
        
           
           }else{
               edittema = false;
               document.getElementById('formulariotema'+id).style.display = "none";
               
           }
           
        
           
        }
        </script>
              <script type="text/javascript" >
                $(function () {
                    'use strict'
                  
                    $('[data-toggle="offcanvas"]').on('click', function () {
                      $('.offcanvas-collapse').toggleClass('open')
                    })
                  })
                </script>
                 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                 
                   
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" src="{{url('css/offcanvas.css')}}">
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
                @if(isset($usuario) && $usuario!== '')    
            <li class="nav-item active">
              <a class="nav-link" href="{{url('/perfil')}}">perfil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/logout')}}">Logout</a>
            </li>
                 @endif
                 @if(isset($usuario)&& $usuario=== '')
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
      
      
      <main role="main" class="container">
          <div class="row  justify-content-center">
            
              <div class="col-3" style="background: rgb(000, 000, 000,0.7);border:1px solid white" >
                    @if($usuario != "")
                    
                    <button style="position:fixed; position:fixed; top:100px;"type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter">
                         Responder
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Responder al tema</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body" style="background:radial-gradient(#EAFDFF, #46AAF0, #1B16DD)">
                                      <div id="crearmensaje">
                                             
                                            
                                              <br>
                                                        
                                                        <form id="myform" class="form-group" action="{{url('foro/'.$foro->nombre.'/temas/'.$tema->nombre )}}" method="post" id="formulario" enctype="multipart/form-data" >
                                                       @csrf
                                      
                                                        
                                                        <textarea class="form-control" name="mensaje" id="nombre"  placeholder="Escribe la respuesta"></textarea>
                                                        <br>
                                                        <div class="custom-file">
                                                              <input type="file" class="formcontrol" name="fotomensaje" id="customFile">
                                                              <label class="custom-file-label"  for="customFile">Subir foto</label>
                                                            </div>
                                                       
                                                        <input class="form-control" type="hidden" name="temanombre" value="{{$tema->nombre}}"/>
                                                        <br>
                                                        <br>
                                                        <input onclick="alerta()" class="btn btn-success" type="submit" value="enviar">
                                                        <div  id="mensajeenviado" style="display:none; position:fixed ;top:10%; right:10" class="alert alert-primary" role="alert">
                                                               Mensaje enviado
                                                        </div>
                                                        
                                      
                                                      
                                              </form>
                                      </div>
                                       @endif()
                                    </div>
                            </div>
                          </div>
                        </div>

              </div>
              <div class="col-1"></div>
              <div class="col-8" style="background: rgb(000, 000, 000,0.7); border:1px solid white">
                <br>
                    <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                              <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$tema->nombre}}</h5>
                                <small>3 days ago</small>
                              </div>
                              <p class="mb-1">{{$tema->descripcion}}</p>
                              <small>{{$usuariotema}}</small>
                            <small style="float:right">mensajes totales:{{$tema->mensajes}}</small>
                              <hr>
                              @if($usuario!== '')
                              @if($usuariotema == $usuario->nombre)
                              <button class="btn btn-warning" onclick="clickeditartema()" id="editartema">modo edicion</button>
                            
<form class="form-group"action="{{url('foro/'.$foro->nombre.'/'.$tema->id)}}" id="formulariotema" method="post" style="display:none" >
    {{method_field('put')}}
     {{ csrf_field() }} 
     <hr>
        <textarea placeholder="modifica el tema" class="form-control" type="text" id="cambiartema" name="cambiartema"></textarea>
    
    <input class="btn-success" type="submit" value="Cambiar tema">
   
    
</form>
@endif
@endif

</a>
<br>                       
                        

                          </div>
                          @if(!is_null($mensajes))
                          @foreach($mensajes as $indexmensajes => $valor)
                           <div class="list-group">
                          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                              
                                <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$tema->nombre}}</h5>
                                        <small class="" style="color: green; font-size:12px float:left">fecha:{{  date('Y-m-d',strtotime($valor->fecha_creacion))}}</small>
                                      </div>
                               
                                <p style="font-size:14px"class="mb-1 bol">mensaje: {{$valor->mensaje}}</p>
                                @if($fotos!= '' && isset($fotos[$valor->id]))
                                <div class="text-center">
                                        <img src="{{url($fotos[$valor->id])}}" class="img-fluid" alt="">
                                      </div>
                                   
                                @endif
                                <small class="text-muted">usuario:{{$usuariosMensaje[$indexmensajes]->nombre}}</small>
 @if($usuario!== '')                               <hr>
@if($usuario->id == $valor->id_cuenta || $usuario->id_grupo ==2)

<form  class="form-group" action="{{url('foro/'.$foro->nombre.'/temas/'.$tema->nombre.'/'.$valor->id)}}" id="formulario{{$valor->id}}" method="post" style="display:none" >
   {{method_field('put')}}
     {{ csrf_field() }}
    <textarea class="form-control" type="text" id="cambiarmensaje" name="cambiarmensaje" placeholder="texto a editar"></textarea>
    <br>
    
    
    <input class="btn btn-success" type="submit" value="Cambiar mensaje">
    <br>
    <hr>
    
</form>

<form style="float:right" class="form-group"action="{{url('foro/'.$foro->nombre.'/temas/'.$tema->nombre.'/'.$valor->id)}}" method="post">
    {{method_field('delete')}}
    {{csrf_field()}}
    
    <button class="btn btn-danger" type="submit" id="eliminar">eliminar mensaje</button>
</form>

<button  style="float:left"class="btn btn-warning" onclick="clickeditar({{$valor->id}})" id="editar{{$usuario->id}}">modo edicion</button>


@endif
@endif

                              </a>
                            </div>
                            <br>
                          @endforeach
                          @endif

                          
              </div>
          </div>
            
             
      </main>
      <script type="text/javascript">
        var edit = false;
   var edittema = false;
   var deletee =false;
   var metodo = 'post';
   function alerta(params) {

        setTimeout(() => {
            document.getElementById('mensajeenviado').style.display = 'block';
            setTimeout(() => {
                document.getElementById('mensajeenviado').style.display = 'none';   
            }, 100);
        }, 1500);

       ;
   }
function clickeditar(id){
   if(edit === false){
       edit= true;
       document.getElementById('formulario'+id).style.display = "block";
       $('#formulario'+id).validate({ 
    rules: {
        cambiarmensaje: {
            required: true,
            minlength: 2,
            maxlength:25,
        }
    },
    messages: {
      cambiarmensaje: {
        required : 'es requerido'
      }
    }
});

   }else{
       edit = false;
       document.getElementById('formulario'+id).style.display = "none";
   }
   
  
   
   }
   function clickeditartema(){
   if(edittema === false){
       edittema = true;
       document.getElementById('formulariotema').style.display = "block";

   
   }else{
       edittema = false;
       document.getElementById('formulariotema').style.display = "none";
       
   }
   

   
}
</script>
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

$('#myform').validate({ 
    rules: {
        mensaje: {
            required: true,
            minlength: 2,
        },
        fotomensaje: {
            extension: "jpg|png|jpeg"
        }
    },
    messages: {
      mensaje: {
        required : 'es requerido',
        minlength : 'introduce un campo mas largo'
      },
      fotomensaje: {
        extension : 'solo admitimos imagenes'
      }
    }
});

$('#formulariotema').validate({ 
    rules: {
        cambiartema: {
            required: true,
            minlength: 25,
            maxlength:250,
        }
    },
    messages: {
        cambiartemamensaje: {
        required : 'es requerido'
      }
    }
});

});
</script>
</body>
</html>