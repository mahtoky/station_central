<div class="row">
  <div class="col-md-12">
    <h3 class="text-center">Stocks globaux</h3>
    <div class="d-flex justify-content-center align-item-center">
      <table class="table w-50 text-center">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Produits</th>
            <th scope="col">Total stock</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(count($stock) > 0){
            foreach ($stock as $value): ?>
            <tr>
              <td><?php echo $value->productname; ?></td>
              <td><?php echo $value->stock; ?> litres</td>
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
    <h3 class="text-center m-3">Stocks globaux par produits</h3>
    <div class="d-flex justify-content-center align-item-center">
      <table class="table w-50 text-center">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Station</th>
            <th scope="col">Produits</th>
            <th scope="col">Total stock</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(count($stockProduit) > 0){
            foreach ($stockProduit as $value): ?>
            <tr>
              <td><?php echo $value->ville; ?></td>
              <td><?php echo $value->productname; ?></td>
              <td><?php echo $value->stock; ?> litres</td>
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
</div>
