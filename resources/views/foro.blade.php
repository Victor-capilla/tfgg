
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
                body{
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
                    background:  #F3F7F9;
                        border: 1px solid black;    
                }.col-8{
                  background: rgb(000, 000, 000,0.7);border:1px solid white
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
                                        
                                        <br>
                              <div class="container">
                                    <div class="row justify-content-center">
                                        
                                        <div class="col-8 ">
                                            
        
   
    
     
    <hr>
    <h3 style="color:white">foros</h3>
    <br>
    
    @foreach($foros as $foro)
       
           
  <ul class="list-group">
        <li id="temagrande" class="list-group-item d-flex justify-content-between align-items-center">
                <a id="temafocus" href="{{url('foro/'.$foro->nombre )}}" class="list-group-item list-group-item-action active">foro: {{$foro->nombre}} <span style="float:right" class="badge badge-warning badge-pill">14</span></a>
         
        </li>
        <br>
      </ul>
       @endforeach
    </div>
    </div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
