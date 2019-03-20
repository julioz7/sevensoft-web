
@extends('footer')
@extends('header')

@section('header')
   @parent


   <div class="header"></div>
        <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
        <label for="openSidebarMenu" class="sidebarIconToggle">
         <div class="spinner diagonal part-1"></div>
         <div class="spinner horizontal"></div>
          <div class="spinner diagonal part-2"></div>
      </label>
      <div id="sidebarMenu">
        <ul class="sidebarMenuInner">
         <li>Liliana García Guevara <span>Administrador</span></li>
          <li><a href="https://vanila.io" target="_blank">Preguntas de Clientes</a></li>
          <li><a href="https://instagram.com/plavookac" target="_blank">Configurar usuario</a></li>
          <li><a href="https://twitter.com/plavookac" target="_blank">Subir actualización</a></li>
         </ul>
       </div>

<head> <link href="/css/bootstrap.min.css" rel="stylesheet"></head>
   <div ng-controller="ctrl">
    <div id="formulario">
      <h1>USUARIOS</h1>
    <script type="text/javascript">
        window.idUser = "<?php print_r($modificarUsuarios[0]->idusuarios);?>";
        window.correo = "<?php print_r($modificarUsuarios[0]->correo);?>";
        window.contrasena= "<?php print_r($modificarUsuarios[0]->contraseña);?>";
        window.tipo= "<?php print_r($modificarUsuarios[0]->tipo);?>";
      </script>

      


     

   		<form name="frm" style="width: 500px;height: 500px;">
        <img id="Usuario" src="/fondos/usuarios.png">
            <div> 
   			        <label>Correo:</label>
                <input class="form-control" id="inputSeleccionado" placeholder="example@gmail.com " type="email" name="correo"  ng-model="usuarioEditado.correo" onkeyup ="return validarEmail(this)" required>
                <span ng-show="frm.correo.$dirty && frm.correo.$error.required"> Campo requerido </span> <br>
                <span ng-show="frm.correo.$error.email"> Formato e-mail incorrecto</span> 
                  <a id='resultado'></a>
            </div>
            <div>
                <label>Contraseña:</label>
                <input class="form-control" id="inputSeleccionado" type="text" name="contrasena" ng-model="usuarioEditado.contrasena" required>
                <span ng-show="frm.contrasena.$dirty && frm.contrasena.$error.required"> Campo requerido </span> <br>
           </div>
           <div>
            <label>Tipo:</label>
             <select  class="form-control" id="inputSeleccionado" class="form-control" name="fechaCita" ng-model="usuarioEditado.tipo" required>
                <option value=""> Elige una opcion</option>
                <option value="1">Cliente</option>
                <option value="2">Soporte</option>
            </select>
              <span ng-show="frm.usuarioEditado.$dirty && frm.usuarioEditado.$error.required"> Campo requerido </span> <br>
           </div>
            <button type=" text" class="btn btn-primary" ng-disabled="frm.$invalid" ng-click="editar()"> Modificar</button>
         
      </form>
   </div>
</div>
<script type="text/javascript">
 function validarEmail(elemento){

  var texto = document.getElementById(elemento.id).value;
  var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
  
  if (!regex.test(texto)) {
      document.getElementById("resultado").innerHTML = "Correo invalido";
  } else {
      document.getElementById("resultado").innerHTML = "";
  }

}

</script>
      
   	@section('footer')
   	  @parent

      <script>

   	     var app = angular.module('app',[])
        .controller('ctrl',function($scope,$http)
   	     {

            $scope.usuarioEditado={};

            

            $scope.usuarioEditado={
            id:window.idUser,
            correo:window.correo,
            contrasena:window.contrasena,
            tipo:window.tipo
           }

          
          $scope.editar=function(){
              $http.post('/modificarUsuarios/'+$scope.usuarioEditado.id,$scope.usuarioEditado).then(
                function(response){
                    alert('Los datos fueron modificados con exito');
                    $scope.usuarioEditado={};
                    $scope.frm.$setPristine();
                    window.location.href=`{{url("/consultaUsuarios")}}`;
                  
              },function(errorResponse){

            }
          );}
});
  </script>
      
   @endsection
@endsection
