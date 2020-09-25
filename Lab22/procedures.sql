--CREAR Materiales, Proyectos, Proveedores y Entregan
DELIMITER //

CREATE PROCEDURE creaMaterial (
	p_uclave NUMERIC(5,0),
	p_udescripcion VARCHAR(50),
	p_ucosto NUMERIC(8,2),
	p_uimpuesto NUMERIC(6,2))

	BEGIN
		INSERT INTO Materiales VALUES(p_uclave, p_udescripcion, p_ucosto, p_uimpuesto);
	END;
//

CREATE PROCEDURE creaProyecto (
        p_unumero NUMERIC(5,0),
        p_udenominacion VARCHAR(50))

    	BEGIN
        	INSERT INTO Proyectos VALUES(p_unumero, p_udenominacion);
	    END;
//

CREATE PROCEDURE creaProveedor (
        p_urfc CHAR(13),
        p_urazonsocial VARCHAR(50))

    	BEGIN
        	INSERT INTO Proveedores VALUES(p_urfc, p_urazonsocial);
	    END;
//

CREATE PROCEDURE creaEntrega (
        p_uclave NUMERIC(5,0),
        p_urfc CHAR(13),
        p_unumero NUMERIC(5,0),
        p_ucantidad NUMERIC(8,0))

    	BEGIN
        	INSERT INTO Entregan VALUES(p_uclave, p_urfc, p_unumero, p_ucantidad);
	    END;
//

--MODIFICAR
CREATE PROCEDURE modificaMaterial (
	p_uclave NUMERIC(5,0),
	p_udescripcion VARCHAR(50),
	p_ucosto NUMERIC(8,2),
	p_uimpuesto NUMERIC(6,2))

	BEGIN
        UPDATE Materiales
        SET clave=p_uclave, descripcion=p_udescripcion, costo=p_ucosto, impuesto=p_uimpuesto
        WHERE clave = p_uclave;
	END;
//

CREATE PROCEDURE modificaProyecto (
        p_unumero NUMERIC(5,0),
        p_udenominacion VARCHAR(50))

    	BEGIN
        	UPDATE proyectos
            SET numero = p_unumero, denominacion = p_udenominacion
            WHERE numero = p_unumero;
	    END;
//

CREATE PROCEDURE modificaProveedor (
        p_urfc CHAR(13),
        p_urazonsocial VARCHAR(50))

    	BEGIN
        	UPDATE proveedores
            SET rfc = p_urfc, RazonSocial = p_urazonsocial
            WHERE rfc = p_urfc;
	    END;
//

CREATE PROCEDURE modificaEntrega (
        p_uclave NUMERIC(5,0),
        p_urfc CHAR(13),
        p_unumero NUMERIC(5,0),
        p_ucantidad NUMERIC(8,0))

    	BEGIN
            UPDATE entregan
            SET clave = p_uclave, rfc = p_urfc, numero = p_unumero, cantidad = p_ucantidad
            WHERE clave = p_uclave;
	    END;
//

--ELIMINAR
CREATE PROCEDURE eliminaMaterial (
	p_uclave NUMERIC(5,0),
	p_udescripcion VARCHAR(50),
	p_ucosto NUMERIC(8,2),
	p_uimpuesto NUMERIC(6,2))

	BEGIN
        DELETE FROM Materiales
        WHERE clave = p_uclave;
	END;
//

CREATE PROCEDURE eliminaProyecto (
        p_unumero NUMERIC(5,0),
        p_udenominacion VARCHAR(50))

    	BEGIN
            DELETE FROM Proyectos
            WHERE numero = p_unumero;
	    END;
//

CREATE PROCEDURE eliminaProveedor (
        p_urfc CHAR(13),
        p_urazonsocial VARCHAR(50))

    	BEGIN
            DELETE FROM Proveedores
            WHERE rfc = p_urfc;
	    END;
//

CREATE PROCEDURE eliminaEntrega (
        p_uclave NUMERIC(5,0),
        p_urfc CHAR(13),
        p_unumero NUMERIC(5,0),
        p_ucantidad NUMERIC(8,0))

    	BEGIN
            DELETE FROM Proveedores
            WHERE clave = p_uclave;
	    END;
//