<?= $this->extend('adm/main') ?>
<?= $this->section('content') ?>

<div class="row">
  <div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3 id="cant_rel"></h3>

        <p>Comunicados</p>
      </div>
      <div class="icon">
        <i class="ion ion-speakerphone"></i>
      </div>
      <a href="<?= site_url('admin/releases')?>" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3 id="cant_evnt"></h3>

        <p>Eventos</p>
      </div>
      <div class="icon">
        <i class="ion ion-calendar"></i>
      </div>
      <a href="<?= site_url('admin/eventos')?>" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3 id="cant_noti"></h3>

        <p>Noticias</p>
      </div>
      <div class="icon">
        <i class="ion ion-document-text"></i>
      </div>
      <a href="<?= site_url('admin/noticias')?>" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3 id="cant_msg"></h3>

        <p>Mensajes</p>
      </div>
      <div class="icon">
        <i class="ion ion-email"></i>
      </div>
      <a href="<?= site_url('admin/messages')?>" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-12 d-flex justify-content-center">
      <img  class="img-fluid" src="<?= base_url('img/insignia-solo.png') ?>" alt="">
  </div>
  <!-- ./col -->
  </div><!--
  <div class="row pt-4">
    <div class="col-12 d-flex justify-content-center">
      <img  class="img-fluid" src="<?= base_url('img/insignia-solo.png') ?>" alt="">
    </div>
  </div>-->

</div>
<!-- /.row -->
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
  $(document).ready(function(){

    $.get('<?= route_to('get_count_release') ?>', function(data){
      if(data!=null){
        //console.log(data.message.rel);
        $('#cant_rel').text(data.message.rel);
        $('#cant_evnt').text(data.message.evnt);
        $('#cant_noti').text(data.message.noti);
        $('#cant_msg').text(data.message.msg);
      }
    })

  });
</script>

<?= $this->endSection() ?>