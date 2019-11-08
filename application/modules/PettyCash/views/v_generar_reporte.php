<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de caja</title>
</head>
<body>
  <h1 class="text-center">Generar reporte de caja chica</h1>
<div class="shadow p-3 mb-5 bg-white rounded" style="width: 80%; margin: auto; margin-top: 20px;">
<form  action="pettyCash/generateReportePettyCash" method="POST">
  <div class="form-group">
    <label for="pettyCashSelect">Encargado</label>
    <select class="form-control" name="pettyCashResponsableSelect" onchange="bringPettyCashOfUser(this)"id="pettyCashResponsableSelect" required></select>

    <label for="pettyCashSelect">Cajas chicas</label>
    <select class="form-control" name="pettyCashSelect" id="pettyCashSelect" required>
        <option value="">No se ha elegido usuario</option>
    </select>
    <small id="emailHelp" class="form-text text-muted">Seleccione un  caja chica a la cual desea generar un reporte.</small>
  </div>
  <input type="submit" class="btn btn-primary" value="Generar">
</form>
</div>

</body>
</html>