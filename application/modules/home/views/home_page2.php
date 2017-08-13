<style>


.slide1, .slide2, .slide3 {
  width: 100%;
  position:relative;
  background-position:center;
  background-size:cover;
  background-repeat:no-repeat;
  height:100%;

  /*
    fixed = parallax
    scroll = normal
  */
  background-attachment:scroll;
}
  
.slide1{
  background-image:url('<?php echo base_url();?>assets/images/lucky-draw.jpg');
  
}

.slide2{
  background-image:url('<?php echo base_url();?>assets/images/alacarte.jpg');

}

.slide3{
  background-image:url('<?php echo base_url();?>assets/images/package.jpg');

}

#search_order{
  position: relative;
}

.search_box {
  position:absolute;
  text-align:center;
  top: 20%;
}

/* Portrait tablets and small desktops */
@media (max-width: 991px) {
.slide1, .slide2, .slide3{
      height:500px;
}

/* Landscape phones and portrait tablets */
@media (max-width: 767px) {
.slide1, .slide2, .slide3{
      height:400px;
}

/* Portrait phones and smaller */
@media (max-width: 480px) {
.slide1, .slide2, .slide3{
      height:190px;
}

</style>

<section id="head-slider">
  <div id="owl-example1" class="owl-carousel">
    <div class="slide1"></div>
    <div class="slide2"></div>
    <div class="slide3"></div>             
  </div>
</section>

<section id="search_order">
  <div class="search_box">
    <div class="container">
<div class="row">
    <div class="col-md-3 col-sm-3 col-xs-3"></div>
    <div class="col-md-3 col-sm-3 col-xs-3 sec"><select class="form-control">
  <option>District</option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-3 sec"><select class="form-control">
  <option>Town</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select></div>
    <div class="col-md-3 col-sm-3 col-xs-3"></div>
</div>
    <br>
        <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-3"></div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <input type="search" class="form-control" placeholder="what are you looking for">
            
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5 col-sm-5 col-xs-5"></div>
            <div class="col-md-2 col-sm-2 col-xs-3"><button type="button" class="btn btn-primary">Primary</button></div>
            <div class="col-md-5 col-sm-5 col-xs-35"></div>
        </div>
    </div>

  </div>

</section>