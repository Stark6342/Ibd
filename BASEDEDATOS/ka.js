 
 /*DEPARTAMENTOS*/              
 /*ALTAS*/ 

   $.ajax({
                    url:"../BackEnd/Back.php",
                    type:'post',
                    data:({
                        action:"Departamento",
                        Metodo: "Alta",
                        atributos:{
                            p1:"DEPARTAMENTO1",
                            p2:123,
                            p3:52
                        }
                    }),
                    success: function(data) {
                        console.log(data);

                    }

                });

 /*BAJAS*/
            $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Departamento",
                    Metodo: "Baja",
                    id: 4
                }),
                success: function (data) {
     console.log(data)
   
                }
            });

 /*CAMBIOS*/
   $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Departamento",
                    Metodo: "Cambio",
                    atributos:{
                        id:	5,
                        p1:"EDITAR",
                        p2:12321,
                        p3:52
                    }
                }),
                success: function(data) {
                   console.log(data);
            
                }
                });
/*RECIBIR TABLA*/

 $.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
               action:"Departamento",
               Metodo: "GetDepartamentos"
           }),
           success: function (data) {
               data=JSON.parse(data);
                     console.log(data);

           }
       });

/*RECIBIR TABLA POR ID*/

     $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"Departamento",
                Metodo: "GetDepartamentosPorId",
                id: 5
            }),
            success: function (data) {
                console.log(data);
                data=JSON.parse(data);
                console.log(data);

            }
        });





 /*Proveedores*/              
 /*ALTAS*/ 

   $.ajax({
                    url:"../BackEnd/Back.php",
                    type:'post',
                    data:({
                        action:"Proveedor",
                        Metodo: "Alta",
                        atributos:{
                            d1:"Proveedor",
                            d2:"12345",
                            d3:1
                        }
                    }),
                    success: function(data) {
                        console.log(data);

                    }

                });

 /*BAJAS*/
            $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Proveedor",
                    Metodo: "Baja",
                    id: 4
                }),
                success: function (data) {
     console.log(data)
   
                }
            });

 /*CAMBIOS*/
   $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Proveedor",
                    Metodo: "Cambio",
                    atributos:{
                        id:	124,
                        d1:"ProveedorEDITAR",
                        d2:01234,
                        d3:0
                    }
                }),
                success: function(data) {
                   console.log(data);
            
                }
                });
/*RECIBIR TABLA*/

        $.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
               action:"Proveedor",
               Metodo: "GetProveedores"
           }),
           success: function (data) {
               data=JSON.parse(data);
                     console.log(data);

           }
       });

/*RECIBIR TABLA POR ID*/

     $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"Proveedor",
                Metodo: "GetProveedoresPorId",
                id: 125
            }),
            success: function (data) {
                data=JSON.parse(data);
                console.log(data);

            }
        });






 /*PEDIDOS*/              
 /*ALTAS*/ 



   $.ajax({
                    url:"../BackEnd/Back.php",
                    type:'post',
                    data:({
                        action:"Pedido",
                        Metodo: "Alta",
                        atributos:{
							d1:1,
                            d2:1,
                            d3:"aa33",
                            d4:"1",
                            d5:1,
                            d6:1
                        }
                    }),
                    success: function(data) {
                        console.log(data);

                    }

                });

 /*BAJAS*/
            $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Pedido",
                    Metodo: "Baja",
                    id: 1
                }),
                success: function (data) {
     console.log(data)
   
                }
            });

 /*CAMBIOS*/
   $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Pedido",
                    Metodo: "Cambio",
                    atributos:{
                        id:	13,
                        d1:1,
                        d2:1,
                        d3:"aa33",
                        d4:"HOLA",
                        d5:1,
                        d6:1
                    }
                }),
                success: function(data) {
                   console.log(data);
            
                }
                });
/*RECIBIR TABLA*/



  $.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
               action:"Pedido",
               Metodo: "GetPedidos"
           }),
           success: function (data) {
               data=JSON.parse(data);
                     console.log(data);

           }
       });

/*RECIBIR TABLA POR ID*/

     $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"Pedido",
                Metodo: "GetPedidosPorId",
                id: 51
            }),
            success: function (data) {
                data=JSON.parse(data);
                console.log(data);

            }
        });




 /*EMPLEDOS*/              
 /*ALTAS*/ 


   $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"Empleado",
                Metodo: "GetPedidosPorId",
                id: 51
            }),
            success: function (data) {
                data=JSON.parse(data);
                console.log(data);

            }
        });



   $.ajax({
                    url:"../BackEnd/Back.php",
                    type:'post',
                    data:({
                        action:"Empleado",
                        Metodo: "Alta",
                        atributos:{
							d1:"sdff",
                            d2:"123",
                            d3:"123",
                            d4:1,
                            d5:"123",
                            d6:"123",
                            d7:1,
                            d8:"12",
                            d9:"12",
                            d10:123,
                        }
                    }),
                    success: function(data) {
                        console.log(data);

                    }

                });

 /*BAJAS*/
            $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Empleado",
                    Metodo: "Baja",
                    id: 2
                }),
                success: function (data) {
     console.log(data)
   
                }
            });

 /*CAMBIOS*/
   $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Empleado",
                    Metodo: "Cambio",
                    atributos:{
                    		id:1,
							d1:"JUANITO",
                            d2:"123",
                            d3:"123",
                            d4:1,
                            d5:"123",
                            d6:"123",
                            d7:1,
                            d8:"12",
                            d9:"12",
                            d10:123,
                    }
                }),
                success: function(data) {
                   console.log(data);
            
                }
                });
/*RECIBIR TABLA de empleados sin departamento*/

$.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
               action:"Empleado",
               Metodo: "GetEmpleadosSin"
           }),
           success: function (data) {
               data=JSON.parse(data);
                     console.log(data);

           }
       });


/*RECIBIR TABLA de empleados con departamento*/

$.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
               action:"Empleado",
               Metodo: "GetEmpleadosCon"
           }),
           success: function (data) {
               data=JSON.parse(data);
                     console.log(data);

           }
       });




/*RECIBIR TABLA POR ID*/

     $.ajax({
            url:"../BackEnd/Back.php",
            type:'post',
            data:({
                action:"Empleado",
                Metodo: "GetEmpleadosPorId",
                id: 1
            }),
            success: function (data) {
                data=JSON.parse(data);
                console.log(data);

            }
        });


/*HIJOS*/
       $(document).ready(Cargar);
    function Cargar(){

       $.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
               action:"Hijo",
               Metodo: "Cambio",
               atributos:{
                id:1,
                d1:"HIJO",
                d2:"HIJO",
                d3:"HIJO",
                d4:1,
                d5:"HIJO",
                d6:"HIJO",
                d7:"HIJO",
                d8:1,
                d9:"2015-05-05",
                d10: 6
               }
           }),
           success: function (data) {

               data=JSON.parse(data);

            console.log(data);
           }
       });
    };


       $(document).ready(Cargar);
    function Cargar(){

       $.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
               action:"Hijo",
               Metodo: "Cambio",
               atributos:{
                d1:"HIJO",
                d2:"HIJO",
                d3:"HIJO",
                d4:1,
                d5:"HIJO",
                d6:"HIJO",
                d7:"HIJO",
                d8:1,
                d9:"2015-05-05",
                d10: 6
               }
           }),
           success: function (data) {

               data=JSON.parse(data);

            console.log(data);
           }
       });
    };

   $.ajax({
                url:"../BackEnd/Back.php",
                type:'post',
                data:({
                    action:"Hijo",
                    Metodo: "Baja",
                    id: 1
                }),
                success: function (data) {
                    console.log(data)
       
                }
            });




     $.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
               action:"Direcciones",
               Metodo: "Alta",
               atributos:{
                d1:"HIJO",
                d2:"HIJO",
                d3:"HIJO",
                d4:4,
                d5:4
               }
           }),
           success: function (data) {

               data=JSON.parse(data);

            console.log(data);
           }
       });


     $.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
               action:"Direcciones",
               Metodo: "Cambio",
               atributos:{
                id:4,
                d1:"HIJO",
                d2:"HIJO",
                d3:"HIJO",
                d4:4,
                d5:4
               }
           }),
           success: function (data) {

               data=JSON.parse(data);

            console.log(data);
           }
       });

$.ajax({
           url:"../BackEnd/Back.php",
           type:'post',
           data:({
               action:"Direcciones",
               Metodo: "GetDirecciones"
           }),
           success: function (data) {
               data=JSON.parse(data);
                     console.log(data);

           }
       });