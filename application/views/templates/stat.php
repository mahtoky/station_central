<div class="row">
  <div class="col-md-12">
    <h3 class="text-center">Statistiques</h3>
    <div class="d-flex justify-content-center align-item-center">
      <table class="table w-50 text-center">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Station</th>
            <th scope="col">Total vente</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(count($stat) > 0){
            foreach ($stat as $value): ?>
            <tr>
              <td> <a href="<?php echo site_url('statistiques/'.$value->idstation); ?>"><?php echo $value->ville; ?></a> </td>
              <td><?php echo $value->totalvente; ?> Ariary</td>
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
