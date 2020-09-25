CREATE TABLE Materiales
(
	Clave numeric(5),
	Descripcion varchar(50),
	Costo numeric(8,2)
)

CREATE TABLE Proovedores
(
	RFC CHAR(13),
	RazonSocial VARCHAR(50)
)


CREATE TABLE Proyectos
(
	Numero NUMERIC(5),
	Denominacion VARCHAR(50)
)

CREATE TABLE Entregan
(
	Clave NUMERIC(5),
	RFC CHAR(13),
	Numero NUMERIC(5),
	Fecha DATETIME,
	Cantidad NUMERIC(8,2)
)