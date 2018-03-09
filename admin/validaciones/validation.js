$(document).ready(function() {

    /*------------------------------------------------------------*/
        // EMPRESA
    /*------------------------------------------------------------*/


            /*-----------EDITAR EMPRESA -------------*/
            $("#editar_empresa").validate({
                rules:{
                    nombre_empresa: "required"
                },// fin de rules

                messages:{
                    nombre_empresa: "El Nombre de la Empresa es Requerido"
                }//fin de messages
                
            });//fin de la funcion validate 



             /*-----------REDES SOCIALES-------------*/
            $("#redes-sociales").validate({
                rules:{
                    url_facebook: "url",
                    url_instagram: "url",
                    url_twitter: "url",
                    url_youtube: "url"
                },// fin de rules

                messages:{
                    url_facebook: "Dirección de URL incorrecta",
                    url_instagram: "Dirección de URL incorrecta",
                    url_twitter: "Dirección de URL incorrecta",
                    url_youtube: "Dirección de URL incorrecta"
                }//fin de messages
                
            });//fin de la funcion validate 
          


             /*-----------NUEVO VIDEO-------------*/
            $("#nuevo-video").validate({
                rules:{
                    direccion_video: "required"
                },// fin de rules

                messages:{
                    direccion_video: "La dirección URL del video es requerida"
                }//fin de messages
                
            });//fin de la funcion validate


            /*-----------EDITAR VIDEO-------------*/
            $("#editar-video").validate({
                rules:{
                    direccion_video: "required"
                },// fin de rules

                messages:{
                    direccion_video: "La dirección URL del video es requerida"
                }//fin de messages
                
            });//fin de la funcion validate 


           
             /*-----------NUEVA MIEMBRO-------------*/
            $("#nuevo-equipo").validate({
                rules:{
                    nombre: "required",
                    apellido: "required",
                    cargo: "required",
                    descripcion: "required"

                },// fin de rules

                messages:{
                    nombre: "El Nombre es requerido",
                    apellido: "El Apellido es requerido",
                    cargo: "El Cargo es requerido",
                    descripcion: "Información Requerida"
                }//fin de messages
                
            });//fin de la funcion validate 


            /*-----------EDITAR MIEMBRO-------------*/
            $("#editar-equipo").validate({
                rules:{
                    nombre: "required",
                    apellido: "required",
                    cargo: "required",
                    descripcion: "required"

                },// fin de rules

                messages:{
                    nombre: "El Nombre es requerido",
                    apellido: "El Apellido es requerido",
                    cargo: "El Cargo es requerido",
                    descripcion: "Información Requerida"
                }//fin de messages
                
            });//fin de la funcion validate










    /*------------------------------------------------------------*/
        // ARCHIVOS PDF
    /*------------------------------------------------------------*/
         
             /*-----------NUEVO ARCHIVO PDF-------------*/
            $("#nuevo-pdf").validate({
                rules:{
                    titulo: "required",
                    descripcion: "required"

                },// fin de rules

                messages:{
                    titulo: "Información Requerida",
                    descripcion: "Información Requerida"
                }//fin de messages
                
            });//fin de la funcion validate 


            /*-----------EDITAR ARCHIVO PDF-------------*/
            $("#editar-pdf").validate({
                rules:{
                    titulo: "required",
                    descripcion: "required"

                },// fin de rules

                messages:{
                    titulo: "Información Requerida",
                    descripcion: "Información Requerida"
                }//fin de messages
                
            });//fin de la funcion validate






    /*------------------------------------------------------------*/
        // NOTICIAS
    /*------------------------------------------------------------*/
            $("#nueva-noticia").validate({
                rules:{
                    titulo: "required",
                    descripcion: "required"

                },// fin de rules

                messages:{
                    titulo: "el Título de la Noticia de requerido",
                    descripcion: "Información Requerida"
                }//fin de messages
                
            });//fin de la funcion validate 


            $("#editar-noticia").validate({
                rules:{
                    titulo: "required",
                    descripcion: "required"

                },// fin de rules

                messages:{
                    titulo: "el Título de la Noticia de requerido",
                    descripcion: "Información Requerida"
                }//fin de messages
                
            });//fin de la funcion validate 


            $("#busca-noticia").validate({
                rules:{
                    busqueda: "required"

                },// fin de rules

                messages:{
                    busqueda: "Información requerida"
                }//fin de messages
                
            });//fin de la funcion validate 










    /*------------------------------------------------------------*/
        // CONTACTO
    /*------------------------------------------------------------*/


            /*-----------EDITAR CONTACTO-------------*/
            $("#editar-contacto").validate({
                rules:{
                    direccion: "required",
                    telefono: "required",
                    celular: "required",
                    email:{
                        required: true,
                        email: true
                    },
                    atencion: "required"
                },// fin de rules

                messages:{
                    direccion: "Información Obligatoria",
                    telefono: "Información Obligatoria",
                    celular: "Información Obligatoria",
                    email:{
                        required:"Información Obligatoria",
                        email:"Dirección de Email incorrecta"
                    },
                    atencion: "Información Obligatoria"
                }//fin de messages
            });//fin de la funcion validate 










    /*------------------------------------------------------------*/
        // USUARIOS
    /*------------------------------------------------------------*/

            $("#nuevo-usuario").validate({
                rules:{
                    usuario: "required",

                    p_password:{
                        required: true,
                        rangelength: [8,16]
                    },

                    password:{
                        required: true,
                        equalTo: "#p_password"
                    },

                    nombre: "required",
                    apellido: "required",

                    nivel: "required",
 
                    e_email:{
                        required: true,
                        email: true
                    },

                    email:{
                        required: true,
                        equalTo: "#e_email"
                    }                    
                },// fin de rules

                messages:{
                    usuario: "Nombre de Usuario Requerido",
                   
                    p_password:{
                        required:"La contraseña es requerida",
                        rangelength: "La contraseña debe tener 8 a 16 caracteres"
                    }, 

                    password:{
                        required:"La confirmación de la contraseña es requerida",
                        equalTo: "No coinciden las Contraseñas"
                    },

                    nombre: "El nombre del Usuario es requerido",
                    apellido: "El apellido el Usuario es requerido",

                    nivel: "El nivel e usuario es Requerido",

                    e_email:{
                        required:"El email es requerido",
                        email:"Dirección de Email incorrecta"
                    },

                    email:{
                        required:"La confirmación del Email es requerida",
                        equalTo: "El email no coincide"
                    } 
                }//fin de messages
            });//fin de la funcion validate 










     /*------------------------------------------------------------*/
        // PERFIL DE USUARIO
    /*------------------------------------------------------------*/
            $("#editar-perfil").validate({
                rules:{
                    p_password:{
                        rangelength: [8,16]
                    },

                    password:{
                        equalTo: "#p_password"
                    },

                    nombre: "required",
                    apellido: "required"                
                },// fin de rules

                messages:{
                    p_password:{
                        rangelength: "La contraseña debe tener 8 a 16 caracteres"
                    }, 

                    password:{
                        equalTo: "No coinciden las Contraseñas"
                    },

                    nombre: "El nombre del Usuario es requerido",
                    apellido: "El apellido el Usuario es requerido"
                }//fin de messages
            });//fin de la funcion validate 

}); // fin de la funcion ready