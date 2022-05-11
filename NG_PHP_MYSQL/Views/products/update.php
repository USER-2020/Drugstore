<!-- Formulario para edicion de productos  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UpdateProduct</title>
</head>
<body>
<div class="container_fluid">
  <div class="card">
    <div class="card-header">Update Product</div>
  <div class="card-body">
  <form action="" method="post">
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="Id_" class="form-label">ID</label>
          <input name="Id_" type="text" class="form-control" id="Id_" value="<?php echo $product->Id; ?>" required readonly>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="Nombre_prod">Name Product</label>
          <input name="Nombre_prod" type="text" class="form-control" id="Nombre_prod" value="<?php echo $product->Nombre_prod; ?>" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="Description">Description</label>
          <input name="Description" type="text" class="form-control" id="Description" value="<?php echo $product->Description; ?>" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="Stock">Stock</label>
          <input name="Stock" type="text" class="form-control" id="Stock" value="<?php echo $product->Stock; ?>" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="Pricing">Pricing</label>
          <input name="Pricing" type="text" class="form-control" id="Pricing" value="<?php echo $product->Pricing; ?>" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
      </div>

      <button class="btn btn-primary" type="submit">Upate Product</button>
      <a class="btn btn-warning" href="?controller=products&action=introduction">Cancel</a>
      </form>
  </div>

  </div>
</div>

  

</body>
</html>