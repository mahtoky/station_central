<div class="row">
  <div class="d-flex justify-content-center align-items-center w-100">
    <div class="card w-25">
      <div class="card-header">
        Importer les donnees
      </div>
      <div class="card-body bg-dark text-white">
        <?php echo form_open_multipart('import');?>
          <div class="form-group">
            <label for="exampleFormControlFile1">Le fichier a importer</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="csvfile">
          </div>
          <div class="text-center">
            <input type="submit" value="Importer" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
