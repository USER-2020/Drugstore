<!-- Formulario para creacion de productos  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreateProduct</title>
</head>
<body>
<div class="card">
    <div class="card-header">Add Product</div>
  <div class="card-body">
  <form action="" method="post">
    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label for="Nombre_prod">Name Product</label>
        <input name="Nombre_prod" type="text" class="form-control" id="Nombre_prod" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <label for="Description">Description</label>
        <input name="Description" type="text" class="form-control" id="Description"  required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label for="Stock">Stock</label>
        <input name="Stock" type="text" class="form-control" id="Stock" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <label for="Pricing">Pricing</label>
        <input name="Pricing" type="text" class="form-control" id="Pricing"  required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="submit">Add Product</button>
    <a class="btn btn-warning" href="?controller=products&action=introduction">Cancel</a>
    </form>
  </div>
   
</div> 
  

</body>
</html>