BULK INSERT a1704320.a1704320.[Proyectos]
   FROM 'e:\wwwroot\a1704320\proyectos.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = '\n'
      )
