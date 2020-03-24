BULK INSERT a1704320.a1704320.[Materiales]
   FROM 'e:\wwwroot\a1704320\materiales.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = '\n'
      )
