IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Entregan')
DROP TABLE Entregan

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Materiales')
DROP TABLE Materiales


IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Proveedores')
DROP TABLE Proveedores

IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Proyectos')
DROP TABLE Proyectos



CREATE TABLE Materiales
(
  Clave numeric(5) not null,
  Descripcion varchar(50),
  Costo numeric (8,2)
)

CREATE TABLE Proveedores
(
  RFC char(13) not null,
  RazonSocial varchar(50)
)

CREATE TABLE Proyectos
(
  Numero numeric(5) not null,
  Denominacion varchar(50)
)

CREATE TABLE Entregan
(
  Clave numeric(5) not null,
  RFC char(13) not null,
  Numero numeric(5) not null,
  Fecha DateTime not null,
  Cantidad numeric (8,2)
)

ALTER TABLE Materiales add constraint llaveMateriales PRIMARY KEY (Clave)
ALTER TABLE Proveedores add constraint llaveProveedores PRIMARY KEY (RFC)
ALTER TABLE Proyectos add constraint llaveProyectos PRIMARY KEY (Numero)
ALTER TABLE Entregan add constraint llaveEntregan PRIMARY KEY (Clave,RFC,Numero,Fecha)


ALTER TABLE entregan add constraint cfEntreganClave foreign key (Clave) references Materiales(clave);
ALTER TABLE entregan add constraint cfEntreganRfc foreign key (RFC) references Proveedores(RFC);
ALTER TABLE entregan add constraint cfEntreganNumero foreign key (Numero) references Proyectos(Numero);


ALTER TABLE Materiales add constraint costoMin check (Costo > 0);
ALTER TABLE Entregan add constraint cantidadMin check (Cantidad > 0);


BULK INSERT Lab11.dbo.Materiales
  FROM 'E:\DAW\DAW-A01704320\Lab11\archivos\materiales.csv' 
  WITH
  (
    CODEPAGE = 'ACP',
    FIELDTERMINATOR = ',',
    ROWTERMINATOR = '0x0a'
  )
  
BULK INSERT Lab11.dbo.Proveedores
  FROM 'E:\DAW\DAW-A01704320\Lab11\archivos\proveedores.csv' 
  WITH
  (
    CODEPAGE = 'ACP',
    FIELDTERMINATOR = ',',
    ROWTERMINATOR = '0x0a'
  )
  
BULK INSERT Lab11.dbo.Proyectos
  FROM 'E:\DAW\DAW-A01704320\Lab11\archivos\proyectos.csv' 
  WITH
  (
    CODEPAGE = 'ACP',
    FIELDTERMINATOR = ',',
    ROWTERMINATOR = '0x0a'
  )
  
SET DATEFORMAT dmy -- especificar formato de la fecha

BULK INSERT Lab11.dbo.Entregan
  FROM 'E:\DAW\DAW-A01704320\Lab11\archivos\entregan.csv' 
  WITH
  (
    CODEPAGE = 'ACP',
    FIELDTERMINATOR = ',',
    ROWTERMINATOR = '0x0a'
  )


-- SELECT * FROM Materiales
-- SELECT * FROM Proveedores
-- SELECT * FROM Proyectos
-- SELECT * FROM Entregan