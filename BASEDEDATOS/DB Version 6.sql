drop database if exists proyectobasedatos;
create database proyectobasedatos;
use  proyectobasedatos;

create table sexo(
idsexo                      int primary key auto_increment,
sexo                        varchar (50)
);

insert into sexo values (1,'Masculino'), (2,'Femenino');

create table estado (
idestado                    int primary key auto_increment,
nombre                      varchar (50)
);

insert into estado values (1,'Tamaulipas'),(2,'Nuevo Leon'),(3,'Chihuahua'),(4,'Puebla')
                         ,(5,'Jalisco'),(6,'Veracruz'),(7,'Yucatan');
                


create table poblacion(
idpoblacion                 int primary key auto_increment,
nombre                      varchar (50),
idestado                    int,
foreign key (idestado) references estado(idestado)  on delete cascade
);


insert into poblacion values (1,'Victoria',1),(2,'Monterrey',2),(3,'Chihuahua',3),
                             (4,'Puebla',4),(5,'Guadalajara',5),(6,'Xalapa',6),(7,'Merida',7);
                             

create table empleado (
    codigoempleado          int primary key auto_increment,
    nombreempleado          varchar(50),
    apellidopempleado       varchar(50),
    apellidomempleado       varchar(50),
    idsexo                  int,
    colonia                 varchar(50),
    calle                   varchar(50),
    idpoblacion             int,    
    numero                  varchar(50),
    telefono                varchar(50),
    fechaalta               date,
    numerohijos             int,
    salario                 float,
    foreign key (idsexo) references sexo(idsexo)   on delete cascade,
    foreign key (idpoblacion) references poblacion(idpoblacion)   on delete cascade
    );




create table hijo (
    codigohijo              int primary key auto_increment,
    nombrehijo              varchar(50),
    apellidophijo           varchar(50),
    apellidomhijo           varchar(50),
    idsexo                      int,
    colonia                 varchar(50),
    calle                   varchar(50),
    numero                  varchar(50),
    idpoblacion             int,    
    fechanacimiento         date,
    codigoempleado          int,
    foreign key (codigoempleado) references empleado(codigoempleado)   on delete cascade,
    foreign key (idsexo) references sexo(idsexo)   on delete cascade,
    foreign key (idpoblacion) references poblacion(idpoblacion)  on delete cascade
    );

 

create table centrodetrabajo (
    codigocdt               int primary key auto_increment,
    nombrecdt               varchar(50),
    idpoblacion             int,
    colonia                 varchar(50),
    calle                   varchar(50),
    numero                  varchar(50),
    codigoempleado          int,
    
    foreign key (idpoblacion) references poblacion(idpoblacion)  on delete cascade,
    foreign key (codigoempleado) references empleado(codigoempleado)  on delete cascade

    );
    

  
create table departamento (
    codigodepartamento      int primary key auto_increment,
    nombre                  varchar(50),
    presupuestoanual        float,
    codigocdt               int,
    foreign key (codigocdt) references centrodetrabajo(codigocdt)  on delete cascade
    );
insert into departamento (codigodepartamento,nombre)values(0,'Sin departamento');




create table habilidad (
    codigohabilidad         int primary key auto_increment,
    habilidad               varchar(50),
    desripcion              text
    );
    



    
create table empleadohabilidad(
    codigoempleado          int,
    codigohabilidad         int,
    foreign key (codigoempleado) references empleado(codigoempleado)  on delete cascade,
    foreign key (codigohabilidad) references habilidad(codigohabilidad)  on delete cascade
);


create table cliente (
    codigocliente           int primary key auto_increment,
    nombrecliente           varchar(50),
    apellidopcliente        varchar(50),
    apellidomcliente        varchar(50),
    idsexo                      int,
    colonia                 varchar(50),
    calle                   varchar(50),
    numero                  varchar(50),
    idpoblacion             int,    
    teléfono                varchar(50), 
    saldo                   float,
    límitecrédito           float,
    personaempresa          bool,

    foreign key (idsexo) references sexo(idsexo)  on delete cascade,
    foreign key (idpoblacion) references poblacion(idpoblacion)  on delete cascade
);



    create table direccionenvio(
    codigodireccion         int primary key auto_increment,
    colonia                 varchar(50),
    calle                   varchar(50),
    numero                  varchar(50),
    idpoblacion             int,    
    codigocliente           int,

    foreign key (idpoblacion) references poblacion(idpoblacion)  on delete cascade,
    foreign key (codigocliente) references cliente(codigocliente)  on delete cascade
    );
    
create table tipoproveedores (
idtipo int primary key ,
tipo varchar(50)
);
    insert into tipoproveedores (idtipo,tipo) values(1,'Principal'),(2,'Secundario');

drop table if exists proveedor;
     create table proveedor(
    codigoproveedor         int primary key auto_increment,
    nombreproveedor         varchar(50),
    telefono                varchar(50),
    totalarticulosqueprovee int,
    alternativo             int ,-- tipoproveedor
    foreign key (alternativo) references tipoproveedores(idtipo)
    );
    



    create table articulo(
    codigoarticulo          varchar(4) primary key,
    nombre                  varchar(50),
    precioventa             float,
    preciofabrica           float,
    codigoproveedor         int,
    foreign key (codigoproveedor) references proveedor(codigoproveedor)  on delete cascade

    );
    
 

 
   create table pedido(
        codigopedido            int primary key auto_increment,
        codigocliente           int,
        codigodireccion         int,
        fechapedido             date,
        codigoarticulo          varchar(4),
        descripcionarticulo     text,
        cantidadarticulos       int,
        importetotal            float,
        descuento               float,
        foreign key (codigoarticulo) references articulo(codigoarticulo)  on delete cascade,
        foreign key (codigodireccion) references direccionenvio(codigodireccion)  on delete cascade,
        foreign key (codigocliente) references cliente(codigocliente)  on delete cascade
    );
    

   -- se agrega llave foranea al empleado, asi se especifica a que departamento pertenece 
   alter table empleado add codigodepartamento  int;
   alter table empleado add foreign key (codigodepartamento) references departamento(codigodepartamento)   on delete cascade; 




-- **********************vistas*******************************



    drop view if exists pedidovista;
    create view pedidovista as
    select pe.codigopedido,pe.codigocliente,concat(cl.nombrecliente,' ',cl.apellidopcliente,' ',cl.apellidomcliente) as nombrecliente, 
    concat(de.colonia,' ',de.calle,' #',de.numero,' ',po.nombre) as direcciondeenvio, pe.fechapedido,
    ar.nombre,pe.descripcionarticulo,pe.cantidadarticulos,pe.importetotal,pe.descuento
    from pedido pe
    inner join articulo ar on ar.codigoarticulo=pe.codigoarticulo
    inner join direccionenvio de on pe.codigodireccion=de.codigodireccion
    inner join cliente cl on pe.codigocliente=cl.codigocliente
    inner join poblacion  po on de.idpoblacion=po.idpoblacion;

    

drop view if exists proveedorvista;
create view proveedorvista as
select 
pr.codigoproveedor,
pr.nombreproveedor,
pr.telefono,
pr.totalarticulosqueprovee,
pr.alternativo,
tp.tipo
 from proveedor pr
inner join tipoproveedores tp on pr.alternativo=tp.idtipo;





drop view if exists clientevista;
CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `ClienteVista` AS
    SELECT 
        `cl`.`CodigoCliente` AS `CodCliete`,
        `cl`.`NombreCliente` AS `NombreCliente`,
        CONCAT(`cl`.`ApellidoPCliente`,
                ' ',
                `cl`.`ApellidoMCliente`) AS `Apellidos`,
        `se`.`sexo` AS `Sexo`,
        `po`.`nombre` AS `Poblacion`,
        CONCAT(`cl`.`Colonia`,
                ' ',
                `cl`.`Calle`,
                ' #',
                `cl`.`Numero`) AS `Direccion`,
        `cl`.`teléfono` AS `Telefono`,
        `cl`.`saldo` AS `Saldo`,
        `cl`.`PersonaEmpresa` AS `Empresa`
    FROM
        ((`Cliente` `cl`
        JOIN `Sexo` `se` ON ((`se`.`idSexo` = `cl`.`idSexo`)))
        JOIN `poblacion` `po` ON ((`po`.`idpoblacion` = `cl`.`idpoblacion`)));



create view clientesselect as
 SELECT 
cl.codigocliente,concat(cl.nombrecliente,cl.apellidopcliente,' ',cl.apellidomcliente) as nombre,
concat(cl.colonia,' ',cl.calle,' #',cl.numero,' ',po.nombre) as direccion
FROM cliente cl
INNER JOIN sexo se ON se.idsexo=cl.idsexo
INNER JOIN poblacion po ON po.idpoblacion=cl.idpoblacion;

create view direcionesselect as
 SELECT 
cl.codigodireccion,
concat(cl.colonia,' ',cl.calle,' #',cl.numero,' ',po.nombre) as direccion
FROM direccionenvio cl
INNER JOIN poblacion po ON po.idpoblacion=cl.idpoblacion;



drop view if exists departamentovista;

create view departamentovista as
select dep.codigodepartamento,dep.nombre,dep.presupuestoanual,cdt.nombrecdt from departamento dep
inner join centrodetrabajo cdt on cdt.codigocdt=dep.codigocdt;




drop view if exists vistaarticulos;

create view vistaarticulos as
 select ar.codigoarticulo,ar.nombre,ar.precioventa,ar.preciofabrica,pr.nombreproveedor from articulo ar
 inner join proveedor pr on pr.codigoproveedor=ar.codigoproveedor;
 

 
 drop view if exists empleadosvista;
 
 create view empleadosvista as
 select em.codigoempleado,em.nombreempleado as nombreempleado , em.apellidopempleado,em.apellidomempleado,
se.sexo,em.colonia,em.calle,em.numero,
po.nombre as nombreciudad, em.telefono,em.fechaalta,em.numerohijos,em.salario,
 cd.nombre
from empleado em 
inner join sexo se on se.idsexo=em.idsexo
inner join  departamento cd on   cd.codigodepartamento = em.codigodepartamento
inner join poblacion po on po.idpoblacion=em.idpoblacion;





drop view if exists centrosdetrabajovista;
create view   centrosdetrabajovista as
  select cdt.codigocdt,cdt.nombrecdt,po.nombre as nombrepoblacion, 
            concat(cdt.colonia,' ',cdt.calle,' #',cdt.numero)as direccion,
            concat(em.nombreempleado,em.apellidopempleado,em.apellidomempleado) as director
from centrodetrabajo cdt
  inner join poblacion po on po.idpoblacion=cdt.idpoblacion
  inner join empleado em on em.codigoempleado=cdt.codigoempleado;


 
 -- ***********prcedimientos y funciones******
drop procedure if exists AddDepartamentoEmpleado;
delimiter $$

create procedure AddDepartamentoEmpleado(_idempleado int, _iddepartamento int)
begin
UPDATE empleado SET codigodepartamento = _iddepartamento WHERE empleado.codigoempleado =_idempleado;
end$$
    delimiter $$


    create function crearidarticulo(nombrearticulo varchar(50))
    returns varchar(4)
    begin
    declare  numal int(2);
    declare  idarticulo varchar(4);
    set numal =rand() * 99;
    set nombrearticulo=substring(nombrearticulo, 1, 2);
    if(numal>=0 and numal<=9) then
         set  idarticulo= concat(nombrearticulo,0,numal);
    else 
        set  idarticulo= concat(nombrearticulo,numal );
    end if;
    return idarticulo;
    end$$
    
    
        drop procedure if exists addarticulo;
    delimiter $$
--    call addarticulo('dfsd',234,8998,2);
    create procedure addarticulo( 
        _nombre                     varchar(50),
        _precioventa                float,
        _preciofabrica              float,
        _codigoproveedor            int
    )
    begin
        declare _codigoarticulo varchar(4);
        declare num int;
        set _codigoarticulo=(select crearidarticulo(_nombre));
        
        insert into articulo (codigoarticulo,nombre,precioventa,preciofabrica,codigoproveedor) 
                       values(_codigoarticulo,_nombre,_precioventa,_preciofabrica,_codigoproveedor);
        
        set num =(select totalarticulosqueprovee from proveedor where codigoproveedor=_codigoproveedor);
        
        update proveedor set totalarticulosqueprovee=num+1 where codigoproveedor=_codigoproveedor;

    end$$
    
    
    
     drop procedure if exists editararticulo;
    delimiter $$
   create procedure editararticulo( 
            _codigoarticulo              varchar(4),
            _nombre                      varchar(50),
            _precioventa                 float,
            _preciofabrica               float,
            _codigoproveedor             int)
    begin

    update  articulo  set nombre=_nombre,precioventa=_precioventa,preciofabrica=_preciofabrica,
                            codigoproveedor=_codigoproveedor where codigoarticulo=_codigoarticulo;
    end$$
    
    
    
    
     drop procedure if exists eliminararticulo;
    delimiter $$
   create procedure eliminararticulo( 
            _codigoarticulo varchar(4)
    )
    begin

    delete from  articulo   where codigoarticulo= _codigoarticulo;
    end$$

-- call eliminararticulo('pa87');   

 -- select * from articulo;
 
 
 drop procedure if exists addempleado;
--  call addempleado('sdff','123','123',1,'213','234',1,'123','123',2);
delimiter $$
create procedure addempleado(
    in _nombreempleado          varchar(50),
    in _apellidopempleado       varchar(50),
    in _apellidomempleado       varchar(50),
    in _idsexo                  int,
    in _colonia                 varchar(50),
    in _calle                   varchar(50),
    in _idpoblacion             int,    
    in _numero                  varchar(50),
    in _telefono                varchar(50),
    in _salario                 float
)
begin

insert into empleado (
    nombreempleado, apellidopempleado,apellidomempleado,idsexo,colonia,
    calle,idpoblacion,numero,telefono,fechaalta,numerohijos,salario,codigodepartamento)
    values (
    _nombreempleado,_apellidopempleado,_apellidomempleado,_idsexo,
    _colonia,_calle,_idpoblacion,_numero,_telefono,CURDATE(),0,_salario,0
    );

end$$


 drop procedure if exists editarempleado;
delimiter $$
create procedure editarempleado(
    in _codigoempleado          int,
    in _nombreempleado          varchar(50),
    in _apellidopempleado       varchar(50),
    in _apellidomempleado       varchar(50),
    in _idsexo                  int,
    in _colonia                 varchar(50),
    in _calle                   varchar(50),
    in _idpoblacion             int,    
    in _numero                  varchar(50),
    in _telefono                varchar(50),
    in _salario                 float
)
begin

update empleado set  
    nombreempleado=_nombreempleado, apellidopempleado=_apellidopempleado,
    apellidomempleado=_apellidomempleado,idsexo=_idsexo,colonia=_colonia,
    calle=_calle,idpoblacion=_idpoblacion,numero=_numero,telefono=_telefono,salario=_salario
    where codigoempleado=_codigoempleado;

end$$


 drop procedure if exists eliminarempleado;
delimiter $$
create procedure eliminarempleado(
    in _codigoempleado          int
)
begin
    delete from empleado where codigoempleado=_codigoempleado;
end$$

-- call addempleado('sdsd', 'manueñ','gloria',1,'xd','sdf',1,'123','123',234);
--  call editarempleado(1,'juanito', 'juanito','juanito',1,'juanito','juanito',1,'juanito','juanito',234);
-- call eliminarempleado(1);

 drop procedure if exists addhijo;

 delimiter $$
create procedure addhijo (
    in _nombrehijo              varchar(50),
    in _apellidophijo           varchar(50),
    in _apellidomhijo           varchar(50),
    in _idsexo                  int,
    in _colonia                 varchar(50),
    in _calle                   varchar(50),
    in _numero                  varchar(50),
    in _idpoblacion             int,    
    in _fechanacimiento         date,
    in _codigoempleado          int
    )
begin
   declare num int ;

insert into hijo (
    
      nombrehijo,
     apellidophijo,
     apellidomhijo,
     idsexo,
     colonia,
     calle,
     numero,
     idpoblacion,
     fechanacimiento,
     codigoempleado 
    ) values (
         _nombrehijo,
     _apellidophijo,
     _apellidomhijo,
     _idsexo,
     _colonia,
     _calle,
     _numero,
     _idpoblacion,
     _fechanacimiento,
     _codigoempleado
    );
 
    set num =(select numerohijos from empleado where codigoempleado=_codigoempleado);
    
    update empleado set numerohijos=num+1  where codigoempleado=_codigoempleado;
    
end$$


drop procedure if exists editarhijo;

delimiter $$
create procedure editarhijo (
    in _codigohijo              int,
    in _nombrehijo              varchar(50),
    in _apellidophijo           varchar(50),
    in _apellidomhijo           varchar(50),
    in _idsexo                  int,
    in _colonia                 varchar(50),
    in _calle                   varchar(50),
    in _numero                  varchar(50),
    in _idpoblacion             int,    
    in _fechanacimiento         date,
    in _codigoempleado          int
    )
begin
   declare num int ;

update  hijo set
      nombrehijo=_nombrehijo,
     apellidophijo=_apellidophijo,
     apellidomhijo=_apellidomhijo,
     idsexo=_idsexo,
     colonia=_colonia,
     calle=_calle,
     numero=_numero,
     idpoblacion=_idpoblacion,
     fechanacimiento=_fechanacimiento,
     codigoempleado=_codigoempleado 
     where codigohijo=_codigohijo;
    

    
end$$

-- call editarhijo(3,'juanito','juanito','juanito',1,'juanito','juanito','juanito',1,'2015-05-05',2);
-- call addhijo('dfsdf','dfsdf','sdf',1,'sdfsdf','sdf','sdfsdf',1,'2015-05-05',2);


drop procedure if exists eliminarhijo;

delimiter $$
create procedure eliminarhijo (
    in _codigohijo              int
    )
begin
delete from  hijo where codigohijo=_codigohijo;
    
end$$

-- call eliminarhijo(3);


drop procedure if exists addcentrodetrabajo;
delimiter $$
create procedure addcentrodetrabajo(
    in _nombrecdt               varchar(50),
    in _idpoblacion             int,
    in _colonia                 varchar(50),
    in _calle                   varchar(50),
    in _numero                  varchar(50),
    in _codigoempleado          int
)
begin
insert into centrodetrabajo(
      nombrecdt,
      idpoblacion   ,
      colonia   ,
      calle,
      numero    ,
      codigoempleado
    )values 
    (   
      _nombrecdt,
     _idpoblacion   ,
     _colonia   ,
     _calle,
     _numero    ,
     _codigoempleado
     );
end$$
--    call addcentrodetrabajo('sfdf',1,'sdvdsf','sdf','234',2);
  
  drop procedure if exists editarcentrodetrabajo;
delimiter $$
create procedure editarcentrodetrabajo(
    in _codigoctd               int,
    in _nombrecdt               varchar(50),
    in _idpoblacion             int,
    in _colonia                 varchar(50),
    in _calle                   varchar(50),
    in _numero                  varchar(50),
    in _codigoempleado          int
)
begin
  update centrodetrabajo set 
      nombrecdt=_nombrecdt,
      idpoblacion=_idpoblacion  ,
      colonia=_colonia  ,
      calle=_calle,
      numero=_numero    ,
      codigoempleado=_codigoempleado
     where codigocdt=_codigoctd;
end$$
--    call editarcentrodetrabajo(1,'juanitp',1,'juanitp','juanitp','juanitp',2);

  drop procedure if exists eliminarcentrodetrabajo;
delimiter $$
create procedure eliminarcentrodetrabajo(
    in _codigoctd               int
)
begin
  delete from centrodetrabajo  
     where codigocdt=_codigoctd;
end$$

-- call eliminarcentrodetrabajo(1);

  drop procedure if exists adddepartamento ;
  delimiter $$

create procedure adddepartamento(
    in _nombre                  varchar(50),
    in _presupuestoanual        float,
    in _codigocdt               int)
begin
insert into departamento(   
    nombre,
    presupuestoanual,
    codigocdt ) values (
    _nombre,
    _presupuestoanual,
    _codigocdt);
end$$


 drop procedure if exists editardepartamento ;
  delimiter $$

create procedure editardepartamento(
    in _codigodepartamento      int,
    in _nombre                  varchar(50),
    in _presupuestoanual        float,
    in _codigocdt               int)
begin
update departamento set 
    nombre=_nombre,
    presupuestoanual=_presupuestoanual,
    codigocdt=_codigocdt  
    where codigodepartamento=_codigodepartamento;
end$$

 drop procedure if exists eliminardepartamento ;
  delimiter $$

create procedure eliminardepartamento(
    in _codigodepartamento      int)
begin
delete from departamento  
    where codigodepartamento=_codigodepartamento;
end$$


      drop procedure if exists addhabilidad;
  delimiter $$

create procedure addhabilidad(  
                in _habilidad               varchar(50),
                in _desripcion              text)
begin
insert into habilidad (habilidad,desripcion) values (_habilidad,_desripcion);
end$$


      drop procedure if exists editarhabilidad;
  delimiter $$

create procedure editarhabilidad(   
                in _codigohabilidad         int,
                in _habilidad               varchar(50),
                in _desripcion              text)
begin
update  habilidad set habilidad=_habilidad,desripcion=_desripcion where codigohabilidad=_codigohabilidad;
end$$


     drop procedure if exists eliminarhabilidad;
  delimiter $$

create procedure eliminarhabilidad(in _codigohabilidad int)
begin

delete from  habilidad where codigohabilidad=_codigohabilidad;
end$$


   
   
drop procedure if exists asignarhabilidad;

delimiter $$
create procedure asignarhabilidad (
    in _codigoempleado          int,
    in _codigohabilidad         int
    )
begin
insert into empleadohabilidad(codigoempleado,codigohabilidad) values 
                            (_codigoempleado,_codigohabilidad   );
end$$;


drop procedure if exists quitarhabilidad;

delimiter $$
create procedure quitarhabilidad (
    in _codigoempleado          int,
    in _codigohabilidad         int
    )
begin
delete from empleadohabilidad where (codigoempleado=_codigoempleado and codigohabilidad=_codigohabilidad    );
end$$

--  call quitarhabilidad(1,1);



drop procedure if exists addcliente;

delimiter $$
create procedure addcliente (
    in _nombrecliente           varchar(50),
    in _apellidopcliente        varchar(50),
    in _apellidomcliente        varchar(50),
    in _idsexo                      int,
    in _colonia                 varchar(50),
    in _calle                   varchar(50),
    in _numero                  varchar(50),
    in _idpoblacion             int,    
    in _teléfono                varchar(50), 
    in _saldo                   float,
    in _límitecrédito           float,
    in _personaempresa          bool
    )
begin
insert into cliente(
     nombrecliente,
     apellidopcliente,
     apellidomcliente,
     idsexo,
     colonia,
     calle,
     numero,
     idpoblacion,    
     teléfono, 
     saldo,
     límitecrédito,
     personaempresa
) values (
     _nombrecliente,
     _apellidopcliente,
     _apellidomcliente,
     _idsexo,
     _colonia,
    _calle,
     _numero,
     _idpoblacion,    
     _teléfono, 
     _saldo,
     _límitecrédito,
     _personaempresa
     );
end$$




drop procedure if exists editarcliente;

delimiter $$
create procedure editarcliente (
    in _codigocliente           int,
    in _nombrecliente           varchar(50),
    in _apellidopcliente        varchar(50),
    in _apellidomcliente        varchar(50),
    in _idsexo                      int,
    in _colonia                 varchar(50),
    in _calle                   varchar(50),
    in _numero                  varchar(50),
    in _idpoblacion             int,    
    in _teléfono                varchar(50), 
    in _saldo                   float,
    in _límitecrédito           float,
    in _personaempresa          bool
    )
begin
update cliente set
     nombrecliente=_nombrecliente,
     apellidopcliente=_apellidopcliente,
     apellidomcliente=_apellidomcliente,
     idsexo=_idsexo,
     colonia=_colonia,
     calle=_calle,
     numero=_numero,
     idpoblacion=_idpoblacion,    
     teléfono=_teléfono, 
     saldo=_saldo,
     límitecrédito=_límitecrédito,
     personaempresa=_personaempresa
where codigocliente=_codigocliente;
end$$


drop procedure if exists eliminarcliente;

delimiter $$
create procedure eliminarcliente (
    in _codigocliente           int
    )
begin
delete from cliente
where codigocliente=_codigocliente;
end$$


    
drop procedure if exists adddireccion;

delimiter $$
create procedure adddireccion (
    in _colonia                 varchar(50),
    in _calle                   varchar(50),
    in _numero                  varchar(50),
    in _idpoblacion             int,    
    in _codigocliente           int
    )
begin
insert into direccionenvio(
    colonia,
    calle,
    numero,
    idpoblacion,    
    codigocliente   
    ) values (
    _colonia,
    _calle,
    _numero,
    _idpoblacion,    
    _codigocliente  
    );
end$$

drop procedure if exists editardireccion;

delimiter $$
create procedure editardireccion (
    in _codigodireccion         int,
    in _colonia                 varchar(50),
    in _calle                   varchar(50),
    in _numero                  varchar(50),
    in _idpoblacion             int,    
    in _codigocliente           int
    )
begin
update   direccionenvio set
    colonia=_colonia,
    calle=_calle,
    numero=_numero,
    idpoblacion=_idpoblacion,    
    codigocliente=_codigocliente
    where codigodireccion=_codigodireccion;
end$$


drop procedure if exists eliminardireccion;

delimiter $$
create procedure eliminardireccion (
    in _codigodireccion         int
    )
begin
delete from   direccionenvio 
    where codigodireccion=_codigodireccion;
end$$



   
   
   
      drop procedure if exists addproveedor;
  delimiter $$

create procedure addproveedor(
    in _nombreproveedor         varchar(50),
    in _telefono                varchar(50),
    in _alternativo             int)
begin
insert into proveedor(
     nombreproveedor ,
     telefono,
     totalarticulosqueprovee,
     alternativo    
    ) values (
     _nombreproveedor ,
     _telefono,
     0,
     _alternativo
     );
end$$

    
      drop procedure if exists editarproveedor;
  delimiter $$

create procedure editarproveedor(
    in _codigoproveedor             int,
    in _nombreproveedor         varchar(50),
    in _telefono                varchar(50),
    in _alternativo             int)
begin
update  proveedor set
     nombreproveedor=_nombreproveedor ,
     telefono=_telefono,
     alternativo=_alternativo   
where codigoproveedor=_codigoproveedor;
end$$


   drop procedure if exists eliminarproveedor;
  delimiter $$

create procedure eliminarproveedor(
    in _codigoproveedor             int)
begin
delete from  proveedor 
where codigoproveedor=_codigoproveedor;
end$$



drop procedure if exists addpedido;
delimiter $$
create procedure addpedido (
    in _codigocliente           int,
    in _codigodireccion         int,
    in _codigoarticulo          varchar(4),
    in _descripcionarticulo     text,
    in _cantidadarticulos       int,
    in _descuento               float
)
begin

declare importetotall float;
set importetotall= (select precioventa from articulo where codigoarticulo=_codigoarticulo);
set importetotall=importetotall*_cantidadarticulos;
insert into pedido(
     codigocliente,
     codigodireccion,
     fechapedido,
     codigoarticulo,
     descripcionarticulo,
     cantidadarticulos,
     importetotal,
     descuento  
) values (
     _codigocliente,
     _codigodireccion,
     CURDATE(),
     _codigoarticulo,
     _descripcionarticulo,
     _cantidadarticulos,
     importetotall,
     _descuento 
); 
end$$
drop procedure if exists editarpedido;
delimiter $$
create procedure editarpedido (
    in _codigopedido            int,
    in _codigocliente           int,
    in _codigodireccion         int,
    in _codigoarticulo          varchar(4),
    in _descripcionarticulo     text,
    in _cantidadarticulos       int,
    in _descuento               float
)
begin
declare importetotall float;
set importetotall= (select precioventa from articulo where codigoarticulo=_codigoarticulo);
set importetotall=importetotall*_cantidadarticulos;
update pedido set
     codigocliente=_codigocliente,
     codigodireccion=_codigodireccion,
     codigoarticulo=_codigoarticulo,
     descripcionarticulo=_descripcionarticulo,
     cantidadarticulos=_cantidadarticulos,
     importetotal=importetotall,
     descuento=_descuento  
where codigopedido=_codigopedido;
end$$

drop procedure if exists eliminarpedido;
delimiter $$
create procedure eliminarpedido (
    in _codigopedido            int
)
begin

delete from pedido 
where codigopedido=_codigopedido;
end$$


create table usuarios(
	usuario varchar(20) not null,
    pass varchar(20) not null,
    primary key (usuario)
);

insert into usuarios values ('admin','admin');
    
delimiter $$
create procedure login(in _u varchar(20),in _p varchar(20))
begin 
	select count(usuario) from usuarios where usuario=_u and pass=_p;
end 
$$