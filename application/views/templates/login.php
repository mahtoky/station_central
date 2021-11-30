<div class="row">
  <div class="d-flex justify-content-center align-items-center w-100">
    <div class="card w-25">
      <div class="card-header">
        <?php echo $label; ?>
      </div>
      <div class="card-body bg-dark">
        <?php if(isset($login_error)){ ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $login_error; ?>
          </div>
        <?php } ?>
        <form class="text-white" action="<?php echo $form_url ?>" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Nom d'utilisateur</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrer votre nom d'utilisateur" value="itokiana">
            <?php if(isset($form_errors) && $form_errors['username_error'] != ''){
              echo $form_errors['username_error'];
            }else{ ?>
              <small id="emailHelp" class="form-text text-muted">Votre nom d'utilisateur ne sera pas public.</small>
            <?php } ?>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" value="123">
            <?php if(isset($form_errors) && $form_errors['password_error'] != ''){
              echo $form_errors['password_error'];
            }?>
          </div>
          <button type="submit" class="btn btn-primary"><?php echo $label ?></button>
        </form>
      </div>
    </div>
  </div>
</div>
