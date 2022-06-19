<!-- Page Content -->
<div class="container">
  <div class="row">
    <?php 
    foreach ($menu as $m) { ?>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow">
          <img src="<?php echo base_url();?>assets/images/<?php echo $m->foto; ?>" class="card-img-top" style="object-fit:cover">
          <div class="card-body text-center">
            <a href="<?php echo base_url() .  $m->url_item; ?>"><h5 class="card-text text-black-50"><?php echo $m->nombre_item; ?></h5></a>
          </div>
        </div>
      </div>
    <?php }
    ?>
  </div>
</div>
