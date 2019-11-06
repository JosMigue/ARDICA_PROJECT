<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de caja</title>
</head>
<body>
<div class="shadow p-3 mb-5 bg-white rounded" style="width: 80%; margin: auto; margin-top: 20px;">
<form  action="pettyCash/generateReportePettyCash" method="POST">
  <div class="form-group">
    <label for="pettyCashSelect">Caja chica</label>
    <select class="form-control" name="pettyCashSelect" id="pettyCashSelect"></select>
    <input type="checkbox" name="includeDetail" id="includeDetail"> <label for="includeDetail">¿Incluir detalles?</label>
    <small id="emailHelp" class="form-text text-muted">Seleccione la caja chica que desea sacar un reporte.</small>
  </div>
  <input type="submit" class="btn btn-primary" value="generar">
</form>
</div>

</body>
</html>