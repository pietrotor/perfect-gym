$(document).ready(function(){
  $("#formRegis").submit(function(e){
    e.preventDefault();
    contar=0;
    // id=$trim($("#id").val());
    usuario = $.trim($("#in-usuario").val());
    password = $.trim($("#in-password").val());    
    $.ajax({
      url:"bd/loguear.php",
      type: "POST",  
      dataType: "json",
      async:false,
      data:{usuario:usuario, password:password},
      success:function(data){       
        if(data.valor == true){
          window.open("inicio.php", "_self");          
        }else{
          swal({
            title:"Contraseña Equivoca",
            text: "Vuelva a ingresar sus datos para iniciar sesión",
            type: "error",
            timer: 2500,
            showConfirmButton: false
          }, function(){
            location.reload(true);
          });
        }
      }
    });
    // if(contar==1)
    // {
    //   console.log("CONTRASEÑA CORRECTA");
    // }
    // else {
    //   console.log("ERROR   "+contar);
    // }
  });
  // FIN - AGREGAR A LA BASE DE DATOS

});
