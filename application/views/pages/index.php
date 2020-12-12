<marquee behavior="scroll" direction="left" vspace ="20" scrollamount = "10" class = "font-weight-bold" style = "font-size: 2rem; color: rgb(192, 40, 36);">

<?php foreach ($notice as $key => $value): ?>
  --||--&nbsp;&nbsp;&nbsp;&nbsp;<?=$value['title']?>&nbsp;&nbsp;&nbsp;&nbsp;--||--
<?php endforeach ?>


</marquee>

<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php foreach ($slider as $key => $value):
        // if ($key == 3){
        //   break;
        // }
        $active='';

        if ($key == 0) {
          $active = 'active';
        }
      ?>
      <li data-target="#carouselExampleCaptions" data-slide-to="<?=$key?>" class="<?=$active?>"></li>
      <!-- <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li> -->
    <?php endforeach ?>
  </ol>
  <div class="carousel-inner">
    <!-- role="listbox" style="width: 100%; max-height: 500px !important;" -->

    <?php foreach ($slider as $key => $value):
        // if ($key == 3){
        //   break;
        // }
        $active='';

        if ($key == 0) {
          $active = 'active';
        }
      ?>
      <div class="carousel-item <?=$active?>">
        <img src="<?php echo base_url(). $value['image'] ?>" style="height: 500px;" class="d-block w-100 img-fluid" alt="Image Alt">
        <div class="carousel-caption d-none d-md-block">
          <h5><?=$value['title']?></h5>
          <p><?=$value['note']?></p>
        </div>
      </div>
    <?php endforeach ?>

    
   <!--  <div class="carousel-item">
      <img src="<?php echo site_url(); ?>assets/images/JD1Pic1.jpg" style="height: 500px;" class="d-block w-100 img-fluid" alt="Image Alt">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="<?php echo site_url(); ?>assets/images/JD1Pic1.jpg" style="height: 500px;" class="d-block w-100 img-fluid" alt="Image Alt">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
      </div>
    </div> -->
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>