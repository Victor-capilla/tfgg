<?php
namespace App\Http\Controllers;
use App\cuentas;
use App\grupos;
use App\foros;
use App\temas;
use App\mensajes;
use App\fotoPerfil;
use App\fotos;

use Illuminate\Http\Request;

session_start();
class controladora extends Controller
{
  public function comprobarlogin()
  {

    try {
      if(isset($_SESSION["usuario"])){
        return true;
      }else{
        return false;
      }
    } catch (\Throwable $th){
        echo("Error : " . $th);
    }
   
  }

  public function logout()
  {

    try {
     session_unset();
     session_destroy();
     return view('entrada')
     ->with('mensaje', 'sesion destruida');
    } catch (\Throwable $th){
        echo("Error : " . $th);
    }
   
  }

  public function entrada(Request $req)
  {
    
    
    try {
    
      $mensaje = "";  
      if($this->comprobarlogin()){
        $mensaje = 'bienvenido'. $_SESSION["usuario"]->nombre;
        return view('entrada')
        ->with('mensaje', $mensaje)
        ->with('usuario', $_SESSION["usuario"]);
      }else{
        $mensaje = 'inicio';
        return view('entrada')
        ->with('mensaje', $mensaje);
      }
    } catch (\Throwable $th){
        echo("Error : " . $th);
    }
   
  }

  // public function meterseperfil(Request $req)
  // {
    
    
  //   try {
    
  //     $mensaje = "";  
  //     if($this->comprobarlogin()){
  //       $mensaje = 'bienvenido'. $_SESSION["usuario"]->nombre;
  //     $fotoperfil = fotoPerfil::where('id_cuenta',$_SESSION["usuario"]->id)->first();
  //     $mensajes = cuentas::where('id', $_SESSION['usuario']->id)->first();
  //     $rol =  grupos::where('id' , $mensajes->id_grupo)->first()->nombre;
      
  //     $mensajes = $mensajes->mensajess()->get();
  //     $numerodemensajes= count($mensajes);
      
  //       if(is_null($fotoperfil)){
  //         return view('perfil')
  //       ->with('numeromensajes', $numerodemensajes)
  //       ->with('rol', $rol)
  //       ->with('mensaje', $mensaje)
  //       ->with('usuario', $_SESSION["usuario"]);
  //       }else{
  //         return view('perfil')
  //         ->with('numeromensajes', $numerodemensajes)
  //         ->with('rol', $rol)
  //       ->with('mensaje', $mensaje)
  //       ->with('usuario', $_SESSION["usuario"])
  //       ->with('ruta',$fotoperfil->ruta);
  //       }

        
        
  //     }else{
  //       $mensaje = 'inicio';
  //       return view('entrada')
  //       ->with('mensaje', $mensaje);
  //     }
  //   } catch (\Throwable $th){
  //       echo("Error : " . $th);
  //   }
   
  // }


  

  public function registrocompletado(Request $req)
  {
      $cadena_fecha_actual = date('Y-m-d H:i:s');
      var_dump($cadena_fecha_actual);
    
    try {

        
      $insertusuario = cuentas::insert(['nombre' => $req->nombre, 'mail' => $req->mail,'mensajes'=> 0 , 'fecha_creacion' => $cadena_fecha_actual , 'clave' => $req->clave, 'id_grupo'=>2]);
      $_SESSION["usuario"] = $this->usuario($req->nombre);
      $mensaje = 'usuario registrado con exito BIENVENIDO '.$req->nombre;
      $fotoperfil = fotoPerfil::where('id_cuenta',$_SESSION["usuario"]->id)->first();
      $mensajes = cuentas::where('id', $_SESSION['usuario']->id)->first();
      $rol =  grupos::where('id' , $mensajes->id_grupo)->first()->nombre;
      
      $mensajes = $mensajes->mensajess()->get();
      $numerodemensajes= count($mensajes);
      
        if(is_null($fotoperfil)){
      return view('perfil')
      ->with('mensaje', $mensaje)
      ->with('rol' ,$rol)
      ->with('numeromensajes', $numerodemensajes)
      ->with('usuario', $_SESSION["usuario"]);
        }else{
          return view('perfil')
      ->with('mensaje', $mensaje)
      ->with('rol' ,$rol)
      ->with('numeromensajes', $numerodemensajes)
      ->with('usuario', $_SESSION["usuario"])
      ->with('ruta',$fotoperfil->ruta);
     
        }

    } catch (\Throwable $th) {

      $mensaje = 'Error al insertar los datos: ' . $th; 
      return view('singUp')->with('mensaje', $mensaje);
        
    }
   
  }

  public function creartema(Request $req)
  {
      $cadena_fecha_actual = date('Y-m-d H:i:s');
      var_dump($cadena_fecha_actual);
    
    try {

        
      $insertusuario = temas::insert(['id_cuenta' => $_SESSION["usuario"]->id, 'nombre' => $req->nombre , 'mensajes' => 1 , 'fecha_creacion' => $cadena_fecha_actual, 'id_foro' => $_SESSION["foro"]->id, 'descripcion' => $req->descripcion]);
      $user = cuentas::where('id', $_SESSION['usuario']->id)->first();
      $user->mensajes++;
      $user->save();
      $_SESSION['usuario']= $user;
      $mensaje = 'tema creado con exito '.$req->nombre;
      $usuarios=[];
        $temas = temas::where('id_foro' ,$_SESSION["foro"]->id)->orderBy('id', 'desc')->get();
        if (!is_null($temas)) {
         foreach ($temas as $tema) {
          $usuarios[$tema->id]= $tema->cuenta()->first()->nombre;
        } 
        }
      return view('foronombre')
        ->with('mensaje' , $mensaje)
        ->with('usuarios',$usuarios)
        ->with('foronombre' ,$_SESSION['foro']->nombre)
        ->with('nombre' , $_SESSION['foro']->nombre)
        ->with('temas' , $temas)
        ->with('usuario' , $_SESSION["usuario"]);

    } catch (\Throwable $th) {
      $mensaje = 'Error al insertar los datos: ' . $th;
      return view('entrada')->with('mensaje' , $mensaje); 
     
        
    }
   
  }

  public function modificartema(Request $req)
  {
      
    
    try {
      $nombre = "";
      if (isset($req->temanombre)) {
        $nombre = $req->temanombre;
      }else{
        $nombre = $req->nombre;
      }

      $temamodificar = temas::where('id',$req->id)->first();
      
      
      $temamodificar->descripcion = $req->cambiartema;
      $temamodificar->save();
      $tema = $temamodificar;
          
         
          $mensaje="guarra";
          $mensajes = $tema->mensajess()->orderBy('id', 'desc')->get();
          
          
          $usuarios = [];
          $fotos =[];
        if (is_null($mensajes)) {
          $usuarios = "todavia no hay usuarios";
        }else{
          foreach ($mensajes as $mensaje ) {
            $user = cuentas::where('id', $mensaje->id_cuenta)->first();
            $foto = fotos::where('id_mensaje', $mensaje->id)->first();
           array_push($usuarios , $user );
           if(is_null($foto)){

           }else{
            $fotos[$mensaje->id]= $foto->ruta;
        
           }
          }
        }
        
          $_SESSION['mensajes']= $mensajes;
         $_SESSION['tema'] = $tema;
         $usuariotema = temas::where('id' , $tema->id)->first()->cuenta()->first()->nombre;
         return view('tema')
         ->with('fotos', $fotos)
         ->with('usuariosMensaje' , $usuarios)
         ->with('mensajes' , $mensajes)
         ->with('tema', $tema)
         ->with('foro', $_SESSION['foro'])
         ->with('usuario', $_SESSION['usuario'])
         ->with('usuariotema', $usuariotema);
    
       
  
      } catch (\Throwable $th) {
        $mensaje = 'Error al insertar los datos: ' . $th;
        return view('entrada')->with('mensaje' , $mensaje); 
       
          
      }
     
   
  }

  public function eliminartema(Request $req)
  {
      
    
    try {
     

      $temamodificar = temas::where('id', $req->id)->first();
     
      $temamodificar->delete();

      $user = cuentas::where('id', $_SESSION['usuario']->id)->first();
      $user->mensajes--;
      $user->save();
      $_SESSION['usuario']= $user;
      $foro = foros::where('nombre' , $req->nombre)->first();
      $usuarios=[];
        $temas = temas::where('id_foro' , $foro->id)->orderBy('id', 'desc')->get();
        if (!is_null($temas)) {
         foreach ($temas as $tema) {
           
           $numeromensajes= count($tema->mensajess()->get());
           $tema->mensajes = $numeromensajes+1;
           $tema->save();
          $usuarios[$tema->id]= $tema->cuenta()->first()->nombre;
          
        } 
        } 
      
         
     
       
        
        
     
      
      $usuario = "";
      if($this->comprobarlogin()){
        $usuario=$_SESSION["usuario"];
      }
      $_SESSION["foro"] = $foro;
      return view('foronombre')
      ->with('usuarios', $usuarios)
      ->with('foronombre' , $foro->nombre)
      ->with('nombre' , $foro->nombre)
      ->with('temas' , $temas)
      ->with("usuario" , $usuario);
  
      } catch (\Throwable $th) {
        $mensaje = 'Error al insertar los datos: ' . $th;
        return view('entrada')->with('mensaje' , $mensaje); 
       
          
      }
     
   
  }

  public function crearmensaje(Request $req)
  {
      $cadena_fecha_actual = date('Y-m-d H:i:s');
      
    
    try {
// aqui me he quedado con lo de las fotos de los mensajes
// tengo que pensar otra vez como voy a hacer la estructura de las bbdd de fotos para recuperarlas despues
      
      var_dump($cadena_fecha_actual);
     
        $insert= mensajes::insert(['id_cuenta' => $_SESSION["usuario"]->id, 'id_tema' => temas::where('nombre', $req->temanombre)->first()->id , 'caracteres' => strlen($req->mensaje) , 'fecha_creacion' => $cadena_fecha_actual, 'mensaje' => $req->mensaje]);
      if( !is_null($insert)){
        $user = cuentas::where('id', $_SESSION['usuario']->id)->first();
        $user->mensajes++;
        $user->save();
        $_SESSION['usuario']= $user;
        
       
       $mensajefoto=  mensajes::where('mensaje', $req->mensaje)->first();
        if(isset($req->fotomensaje)){
          if(is_array($req->fotomensaje)){
            foreach ($req->fotomensaje as $indice => $foto) {
              $name = time().$foto->getClientOriginalName();
              $foto->move(public_path().'/fotosmensajes/',$name);
              $ruta ='\\fotosmensajes\\'.$name;
             fotos::insert(['id_mensaje' => $mensajefoto->id, 'extension' => 'png', 'tamaño' => 10, 'fecha_creacion' =>$cadena_fecha_actual, 'ruta' => $ruta] );
            }
          }
          else{
            $name = time().$req->fotomensaje->getClientOriginalName();
            $req->fotomensaje->move(public_path().'/fotosmensajes/',$name);
            $ruta ='fotosmensajes/'.$name;
           fotos::insert(['id_mensaje' => $mensajefoto->id, 'extension' => 'png', 'tamaño' => 10, 'fecha_creacion' =>$cadena_fecha_actual, 'ruta' => $ruta] );
          }
          
        }
     
        
      
      
        $tema = temas::where('nombre', $req->temanombre)->first();
        $tema->mensajes++;
        $tema->save();
       $_SESSION['tema'] = $tema;
       
        $mensaje="guarra";
        $mensajes = $tema->mensajess()->orderBy('id', 'desc')->get();
        
        
        $usuarios = [];
        $fotos =[];
        if (is_null($mensajes)) {
          $usuarios = "todavia no hay usuarios";
        }else{
          foreach ($mensajes as $mensaje ) {
            $user = cuentas::where('id', $mensaje->id_cuenta)->first();
            $foto = fotos::where('id_mensaje', $mensaje->id)->first();
           array_push($usuarios , $user );
           if(is_null($foto)){

           }else{
            $fotos[$mensaje->id]= $foto->ruta;
            
           }
          }
        }
      
        $_SESSION['mensajes']= $mensajes;
        $usuariotema = temas::where('id' , $tema->id)->first()->cuenta()->first()->nombre;
        $_SESSION['usuariotema']=$usuarios;   
      return view('tema')
      ->with('fotos' ,$fotos)
      ->with('usuariosMensaje' , $_SESSION['usuariotema'])
      ->with('mensajes' , $_SESSION['mensajes'])
      ->with('tema', $_SESSION['tema'])
      ->with('foro', $_SESSION['foro'])
      ->with('usuario', $_SESSION['usuario'])
      ->with('usuariotema', $usuariotema);
      }else{
        echo("<p>error al insertar</p>");
      }
     
    
    } catch (\Throwable $th) {
      $mensaje = 'Error al insertar los datos: ' . $th;
      return view('entrada')->with('mensaje' , $mensaje); 
     
        
    }
   
  }

  public function modificarmensaje(Request $req)
  {
    
    try {
      
    $mensajeamodificar = mensajes::where('id',$req->id)->first();
    $mensajeamodificar->mensaje = $req->cambiarmensaje;
    $mensajeamodificar->save();
        $tema = temas::where('nombre', $req->nombre)->first();
        
       
        $mensaje="guarra";
        $mensajes = $tema->mensajess()->orderBy('id', 'desc')->get();
        
        
        $usuarios = [];
        $fotos =[];
        if (is_null($mensajes)) {
          $usuarios = "todavia no hay usuarios";
        }else{
          foreach ($mensajes as $mensaje ) {
            $user = cuentas::where('id', $mensaje->id_cuenta)->first();
            $foto = fotos::where('id_mensaje', $mensaje->id)->first();
           array_push($usuarios , $user );
           if(is_null($foto)){

           }else{
            $fotos[$mensaje->id]= $foto->ruta;
         
           }
          }
        }
      
        $_SESSION['mensajes']= $mensajes;
        
           $usuariotema = temas::where('id' , $tema->id)->first()->cuenta()->first()->nombre;
      return view('tema')
      ->with('fotos',$fotos)
      ->with('usuariosMensaje' , $usuarios)
      ->with('mensajes' , $_SESSION['mensajes'])
      ->with('tema', $_SESSION['tema'])
      ->with('foro', $_SESSION['foro'])
      ->with('usuario', $_SESSION['usuario'])
      ->with('usuariotema', $usuariotema);

    } catch (\Throwable $th) {
      $mensaje = 'Error al insertar los datos: ' . $th;
      return view('entrada')->with('mensaje' , $mensaje); 
     
        
    }
   
  }

  public function eliminarmensaje(Request $req)
  {
     
      
    
    try {

      
      
    $mensajeliminado = mensajes::where('id', $req->id)->first()->delete();
        
        $tema = temas::where('nombre', $req->nombre)->first();
       $tema->mensajes--;
        $tema->save();
       $_SESSION['tema']= $tema;

       $user = cuentas::where('id', $_SESSION['usuario']->id)->first();
        $user->mensajes--;
        $user->save();
        $_SESSION['usuario']= $user;
       
        $mensaje="guarra";
        $mensajes = $tema->mensajess()->orderBy('id', 'desc')->get();
        
        
        $usuarios = [];
        $fotos =[];
        if (is_null($mensajes)) {
          $usuarios = "todavia no hay usuarios";
        }else{
          foreach ($mensajes as $mensaje ) {
            $user = cuentas::where('id', $mensaje->id_cuenta)->first();
            $foto = fotos::where('id_mensaje', $mensaje->id)->first();
           array_push($usuarios , $user );
           if(is_null($foto)){

           }else{
            $fotos[$mensaje->id]= $foto->ruta;
           }
          }
        }
      
        $_SESSION['mensajes']= $mensajes;
     
       $usuariotema = temas::where('id' , $tema->id)->first()->cuenta()->first()->nombre;

      return view('tema')
      ->with('fotos', $fotos)
      ->with('usuariosMensaje' , $usuarios)
      ->with('mensajes' , $_SESSION['mensajes'])
      ->with('tema', $_SESSION['tema'])
      ->with('foro', $_SESSION['foro'])
      ->with('usuario', $_SESSION['usuario'])
      ->with('usuariotema', $usuariotema);
    
     

    } catch (\Throwable $th) {
      $mensaje = 'Error al insertar los datos: ' . $th;
      return view('entrada')->with('mensaje' , $mensaje); 
     
        
    }
   
  }
  
  
  
    public function logueado(Request $req)
    {
     
      
      try {

        $mensaje = ""; 
        if (isset($_SESSION["usuario"])) {
          
         
          $mensaje = 'bienvenido'. $_SESSION["usuario"]->nombre;
          $fotoperfil = fotoPerfil::where('id_cuenta',$_SESSION["usuario"]->id)->first();
          $mensajes = cuentas::where('id', $_SESSION['usuario']->id)->first();
         $rol =  grupos::where('id' , $mensajes->id_grupo)->first()->nombre;
         $numerodemensajes = $mensajes->mensajes;
      
          
            if(is_null($fotoperfil)){
              return view('perfil')
              ->with('rol', $rol)
              ->with('numeromensajes', $numerodemensajes)
            ->with('mensaje', $mensaje)
            ->with('usuario', $_SESSION["usuario"]);
            }else{
              return view('perfil')
            ->with('rol', $rol)
            ->with('numeromensajes', $numerodemensajes)
            ->with('mensaje', $mensaje)
            ->with('usuario', $_SESSION["usuario"])
            ->with('ruta',$fotoperfil->ruta);
            }
          
          
        }else{
          $usuario = cuentas::where('nombre', $req->nombre)->orWhere('mail', $req->nombre)->first();
        
        if (is_null($usuario)) {
          return view('login')->with('mensaje', 'el usuario no exsite');
        }
       
        $usuarioyclave = $usuario->where('clave' , $req->clave)->first();

        if(is_null($usuarioyclave)){

            if($usuario){
              $mensaje = 'contraseña incorrecta';
            }else{
              $mensaje = 'no existe el usuario';  
            }

            return view('login')->with('mensaje', $mensaje);

        }else{
            
          $_SESSION["usuario"] = $usuario;
         
          $mensaje = 'bienvenido'. $_SESSION["usuario"]->nombre;
          $fotoperfil = fotoPerfil::where('id_cuenta',$_SESSION["usuario"]->id)->first();
          $mensajes = cuentas::where('id', $_SESSION['usuario']->id)->first();
         $rol =  grupos::where('id' , $mensajes->id_grupo)->first()->nombre;
      $mensajes = $mensajes->mensajess()->get();
      $numerodemensajes= count($mensajes);
          
            if(is_null($fotoperfil)){
              return view('perfil')
              ->with('rol', $rol)
              ->with('numeromensajes', $numerodemensajes)
            ->with('mensaje', $mensaje)
            ->with('usuario', $_SESSION["usuario"]);
            }else{
              return view('perfil')
            ->with('rol', $rol)
            ->with('numeromensajes', $numerodemensajes)
            ->with('mensaje', $mensaje)
            ->with('usuario', $_SESSION["usuario"])
            ->with('ruta',$fotoperfil->ruta);
            }
        }
        }
        
      } catch (\Throwable $th) {
          echo("Error : " . $th);
      }
     
    }

    
    

    public function foro(Request $req)
    {
        
      
      try {

          
        $foros = foros::get();
        
        $mensaje = 'entrada al foro con exito';
        if (isset($_SESSION['usuario'])) {
          return view('foro')
          ->with('mensaje', $mensaje)
          ->with('foros', $foros)
          ->with('usuario', $_SESSION['usuario']);
        }else{
          return view('foro')
        ->with('mensaje', $mensaje)
        ->with('foros', $foros);
        }
        

      } catch (\Throwable $th) {

        $mensaje = 'Error' . $th; 
        return view('singUp')->with('mensaje', $mensaje);
          
      }
     
    }

    public function foronombres(Request $req )
    {
        
      
      try {

          
        
        
        $mensaje = 'oleeeeeee';
        
          $foro = foros::where('nombre' , $req->nombre)->first();
       
        
        $usuarios=[];
        $temas = temas::where('id_foro' , $foro->id)->orderBy('id', 'desc')->get();
        if (!is_null($temas)) {
         foreach ($temas as $tema) {
           
           $numeromensajes= count($tema->mensajess()->get());
           $tema->mensajes = $numeromensajes+1;
           $tema->save();
          $usuarios[$tema->id]= $tema->cuenta()->first()->nombre;
          
        } 
        }
        
       
        
        $usuario = '';
        if($this->comprobarlogin()){
          $usuario=$_SESSION["usuario"];
        }
      
        $_SESSION["foro"] = $foro;
        return view('foronombre')
        ->with('usuarios', $usuarios)
        ->with('foronombre' , $foro->nombre)
        ->with('mensaje' , $mensaje)
        ->with('nombre' , $foro->nombre)
        ->with('temas' , $temas)
        ->with("usuario" , $usuario);
        

      } catch (\Throwable $th) {

        $mensaje = 'Error' . $th; 
        return view('singUp')->with('mensaje', $mensaje);
          
      }
     
    }
    public function usuario(string $nombre)
      {
       return cuentas::where('nombre' , $nombre)->first();
      }
    public function temas(Request $req)
    {
       
      
      try {

          $nombre = "";
        if (isset($req->temanombre)) {
          $nombre = $req->temanombre;
        }else{
          $nombre = $req->nombre;
        }
        
        
        $tema = temas::where('nombre', $nombre)->first();
       
        $mensaje="guarra";
        $mensajes = $tema->mensajess()->orderBy('id', 'desc')->get();
        
        
        $usuarios = [];
        $fotos =[];
        if (is_null($mensajes)) {
          $usuarios = "todavia no hay usuarios";
        }else{
          foreach ($mensajes as $mensaje ) {
            $user = cuentas::where('id', $mensaje->id_cuenta)->first();
            $foto = fotos::where('id_mensaje', $mensaje->id)->first();
           array_push($usuarios , $user );
           if(is_null($foto)){

           }else{
            $fotos[$mensaje->id]= $foto->ruta;
          
           }
          }
        }
      
        $_SESSION['mensajes']= $mensajes;
        $_SESSION['tema']= $tema;
        
        $usuariotema = temas::where('id' , $tema->id)->first()->cuenta()->first()->nombre;
        if($this->comprobarlogin()){
          $usuario = $_SESSION['usuario'];
        }else{
          $usuario = '';
        }
        return view('tema')
        ->with('fotos', $fotos)
        ->with('usuariosMensaje' , $usuarios)
        ->with('mensajes' , $mensajes)
        ->with('tema', $tema)
        ->with('foro', $_SESSION['foro'])
        ->with('usuario', $usuario)
        ->with('usuariotema', $usuariotema);
        
        

      } catch (\Throwable $th) {

        $mensaje = 'Error' . $th; 
        return view('tema')->with('mensaje', $mensaje);
          
      }
      
     
    }
   public function subirfoto(Request $req)
  { 
    if ($req->hasFile('foto')) {
      
        $foto = $req->file('foto');
        $name = time().$foto->getClientOriginalName();
        $foto->move(public_path().'/images/',$name);
      
      
        $ruta ='images/'.$name;
        $fotoasubir = fotoPerfil::insert(['id_cuenta' => $_SESSION["usuario"]->id, 'extension' => 10 , 'formato' =>'png' , 'ruta' =>$ruta , 'fecha_creacion' => date('Y-m-d H:i:s')]);
  
       
        $fotoperfil = fotoPerfil::where('id_cuenta',$_SESSION["usuario"]->id)->first();
      $mensajes = cuentas::where('id', $_SESSION['usuario']->id)->first();
      $rol =  grupos::where('id' , $mensajes->id_grupo)->first()->nombre;
      $numerodemensajes = $mensajes->mensajes;
      $mensaje = "bienvenido ". $_SESSION['usuario']->nombre;
        if(is_null($fotoperfil)){
          return view('perfil')
        ->with('numeromensajes', $numerodemensajes)
        ->with('rol', $rol)
        ->with('mensaje', $mensaje)
        ->with('usuario', $_SESSION["usuario"]);
        }else{
          return view('perfil')
          ->with('numeromensajes', $numerodemensajes)
          ->with('rol', $rol)
        ->with('mensaje', $mensaje)
        ->with('usuario', $_SESSION["usuario"])
        ->with('ruta',$fotoperfil->ruta);
        }

      
     
    }
  }
  public function modificarperfil(Request $req){
    $perfil = cuentas::where('id', $_SESSION['usuario']->id)->first();

    if($req->clave != '' || !is_null($req->clave)){
      $perfil->clave = $req->clave;
      
    }
    if ($req->nombre != '' || !is_null($req->nombre)) {
      $perfil->nombre = $req->nombre;
    }
    $perfil->save();
    $_SESSION['usuario'] = cuentas::where('id',  $_SESSION['usuario']->id)->first();

      $fotoperfil = fotoPerfil::where('id_cuenta',$_SESSION["usuario"]->id)->first();
      $mensajes = cuentas::where('id', $_SESSION['usuario']->id)->first();
      $rol =  grupos::where('id' , $mensajes->id_grupo)->first()->nombre;
      $numerodemensajes = $mensajes->mensajes;
      $mensaje = "bienvenido ". $_SESSION['usuario']->nombre;
        if(is_null($fotoperfil)){
          return view('perfil')
        ->with('numeromensajes', $numerodemensajes)
        ->with('rol', $rol)
        ->with('mensaje', $mensaje)
        ->with('usuario', $_SESSION["usuario"]);
        }else{
          return view('perfil')
          ->with('numeromensajes', $numerodemensajes)
          ->with('rol', $rol)
        ->with('mensaje', $mensaje)
        ->with('usuario', $_SESSION["usuario"])
        ->with('ruta',$fotoperfil->ruta);
        }

  }
  public function cambiarfoto(Request $req)
  { 
    if ($req->hasFile('fotocambiar')) {
        $fotoactual = fotoPerfil::where('id_cuenta', $_SESSION['usuario']->id)->first();
       
       
       
        $fotillo = $req->file('fotocambiar');
        $name = time().$fotillo->getClientOriginalName();
         $ruta ='images/'.$name;
        $fotillo->move(public_path().'/images/',$name);
        $fotoactual->ruta = $ruta;
        $fotoactual->save();
        
        
      
        
       
        
        $mensajes = cuentas::where('id', $_SESSION['usuario']->id)->first();
         $rol =  grupos::where('id' , $mensajes->id_grupo)->first()->nombre;
         $numerodemensajes = $mensajes->mensajes;
       
          return view('perfil')
          ->with('numeromensajes',$numerodemensajes)
          ->with('rol', $rol)
          ->with('ruta', $ruta)
          ->with('mensaje', 'bienvenido '.$_SESSION['usuario']->nombre)
          ->with('usuario', $_SESSION['usuario']);
      
     
    }
  }public function eliminarperfil(Request $req)
  { 
    $usuarioeliminado = cuentas::where('id' , $_SESSION['usuario']->id)->first();
    if($usuarioeliminado->id_grupo ===1){

      $mensaje = 'No puedes eliminar a un administrador'. $_SESSION["usuario"]->nombre;
          $fotoperfil = fotoPerfil::where('id_cuenta',$_SESSION["usuario"]->id)->first();
          $mensajes = cuentas::where('id', $_SESSION['usuario']->id)->first();
         $rol =  grupos::where('id' , $mensajes->id_grupo)->first()->nombre;
         $numerodemensajes = $mensajes->mensajes;
      
          
            if(is_null($fotoperfil)){
              return view('perfil')
              ->with('rol', $rol)
              ->with('numeromensajes', $numerodemensajes)
            ->with('mensaje', $mensaje)
            ->with('usuario', $_SESSION["usuario"]);
            }else{
              return view('perfil')
            ->with('rol', $rol)
            ->with('numeromensajes', $numerodemensajes)
            ->with('mensaje', $mensaje)
            ->with('usuario', $_SESSION["usuario"])
            ->with('ruta',$fotoperfil->ruta);
            }

    }else{
      $usuarioeliminado->delete();
    session_unset();
    session_destroy();
    return view('entrada')->with('mensaje', 'usuario eliminado' );
    }
    
  }
}
