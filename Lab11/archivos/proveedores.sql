BULK INSERT a1704320.a1704320.[Proveedores]
   FROM 'e:\wwwroot\a1704320\proveedores.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = '\n'
      )
