

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
 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
        <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small>xd</small>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Launch demo modal
                      </button>
                      
                      <!-- Modal -->
                     
                      
                  </div>
                  <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                  <small>Donec id elit non mi porta.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-muted">3 days ago</small>
                  </div>
                  <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                  <small class="text-muted">Donec id elit non mi porta.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-muted">3 days ago</small>
                  </div>// $('#myform1').validate({ 
                    //     rules: {
                    //         cambiarmensaje: {
                    //             required: true,
                    //             minlength: 2,
                    //             maxlength: 250,
                    //         }
                    //     },
                    //     messages: {
                    //         cambiarmensaje: {
                    //         required : 'es requerido'
                    //       }
                    //     }
                    // });
                    
                  <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                  <small class="text-muted">Donec id elit non mi porta.</small>
                </a>
              </div>

              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        ...
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
 