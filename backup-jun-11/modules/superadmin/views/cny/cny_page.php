<section class="content-header">
          <h1>
            Contact Table
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li>
          </ol>
        </section>

<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Contact</h3>
                  <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                      <li><a href="#">«</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">»</a></li>
                    </ul>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>SUSHI</th>
                      <th>CNY</th>
                      <th>Status</th>
                      <th>Pickup Date</th>
                    </tr>
                    <?php foreach ($contact_data as $key => $value) { ?>
                    <tr>
                      <td><?php echo $value['name'];?></td>
                      <td><?php echo $value['phone'];?></td>
                      <td><?php echo $value['email'];?></td>
                      <td class="text-center">
                        <?php 
                          $sushi_key = array(
                            'sushi1' => "Party Pack (L)",
                            'sushi2' => "Party Pack (S)",
                            'appetizer' => "Appetizer",
                            'yeeshang' => "Yee Shang",
                            'sashimi' => "Salmon Sashimi",
                            );

                          $sushi = json_decode($value['sushi_order'],TRUE);
                        ?>
                        <?php 
                        if ($sushi) {
                          foreach ($sushi as $key => $vs) {
                            if (!empty($vs)) {
                              echo $sushi_key[$key].": RM ".$vs."<br>";
                            }
                            
                          } 
                        }
                        ?>
                      </td>
                      <td>
                          新年配套: <?php echo $value['package'];?><br>
                          烧肉: <?php echo $value['pork_belly'];?><br>
                          叉烧: <?php echo $value['char_siew'];?><br>
                          烧鸭: <?php echo $value['roasted_duck'];?><br>
                          烧鸡: <?php echo $value['chicken'];?><br>      
                      </td>
                      <td><?php echo $value['order_status'];?></td>
                      <td><?php echo $value['pickup_date'];?></td>
                    </tr>                 	
                    <?php }?>
                  </tbody></table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                  </ul>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>