<div class="row">
  <div class="d-flex justify-content-center align-items-center w-100">
    <div class="card w-25">
      <div class="card-header">
        Ajouter ou modifier un produit
      </div>
      <div class="card-body">
        <form action="<?php echo site_url('ajout_produit') ?>" method="post">
          <div class="form-group">
            <label for="name">Nom du produit</label>
            <input type="text" name="productname" class="form-control" id="name"
            <?php if(isset($produit)){ echo 'value="'.$produit->productname.'"'; } ?> >
            <?php if(isset($form_errors) && $form_errors['name_error'] != ''){
              echo $form_errors['name_error'];
            }?>
          </div>
          <div class="form-group">
            <label for="evap">Pourcentage d'evaporation</label>
            <input type="number" name="evaporation" id="evap" class="form-control" <?php if(isset($produit)){ echo 'value="'.$produit->evaporation.'"'; } ?> >
            <?php if(isset($form_errors) && $form_errors['evaporation_error'] != ''){
              echo $form_errors['evaporation_error'];
            }?>
          </div>
          <div class="form-group">
            <label for="previent">Prix de revient</label>
            <input type="number" name="returnprice" id="previent" class="form-control" <?php if(isset($produit)){ echo 'value="'.$produit->returnprice.'"'; } ?> >
            <?php if(isset($form_errors) && $form_errors['rPrice_error'] != ''){
              echo $form_errors['rPrice_error'];
            }?>
          </div>
          <div class="form-group">
            <label for="pvente">Prix de vente</label>
            <input type="number" name="sellprice" id="pvente" class="form-control" <?php if(isset($produit)){ echo 'value="'.$produit->sellprice.'"'; } ?> >
            <?php if(isset($form_errors) && $form_errors['vPrive_error'] != ''){
              echo $form_errors['vPrive_error'];
            }?>
          </div>
          <?php if(isset($produit)){ ?>
            <input type="hidden" name="idproduct" value="<?php echo $produit->idproduct; ?>">
          <?php } ?>
          <div class="text-center">
            <input type="submit" value="Ajouter" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
