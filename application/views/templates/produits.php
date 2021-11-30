<div class="row">
  <div class="col-md-12">
    <a href="<?php echo site_url('produits/ajout'); ?>" class="btn btn-success" width="30" height="30">Ajouter un produit</a>
    <h3 class="text-center">Liste des produits</h3>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom du produits</th>
          <th scope="col">Prix de revient</th>
          <th scope="col">Prix de vente</th>
          <th scope="col">Pourcentage d'evaporation</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(count($produits) > 0){
          foreach ($produits as $value): ?>
          <tr>
            <th scope="row"><?php echo $value->idproduct; ?></th>
            <td><?php echo $value->productname; ?></td>
            <td><?php echo $value->returnprice; ?> Ariary</td>
            <td><?php echo $value->sellprice; ?> Ariary</td>
            <td><?php echo $value->evaporation; ?> %</td>
            <td scope="row">
              <a href="<?php echo site_url('produits/update/'.$value->idproduct); ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
            </td>
          </tr>
        <?php endforeach;
      } else { ?>
          <tr>
            <td colspan="5" class="text-center">No data founded</td>
          </tr>
      </tbody>
      <?php } ?>
    </table>
  </div>
</div>
