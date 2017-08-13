<?php $month = $this->input->get('month'); ?>
<?php $year = $this->input->get('year'); ?>
<div class="container">

<div class="row">
  <div class="col-md-12"><h1 class="text-center"><?php echo $month."-".$year; ?></h1></div>
</div>

<!-- <div class="row">
<div class="col-md-9 col-md-offset-3">
  <form class="form-inline" method="get" action="<?php echo base_url('reload-report')?>">
  <div class="form-group">
    <label for="month">Select list:</label>
    <select class="form-control" id="month" name="month">
      <option value="01" <?php if($month=='01'){echo"selected";}?>>Jan - 01</option>
      <option value="02" <?php if($month=='02'){echo"selected";}?>>Feb - 02</option>
      <option value="03" <?php if($month=='03'){echo"selected";}?>>Mar - 03</option>
      <option value="04" <?php if($month=='04'){echo"selected";}?>>Apr - 04</option>
      <option value="05" <?php if($month=='05'){echo"selected";}?>>May - 05</option>
      <option value="06" <?php if($month=='06'){echo"selected";}?>>Jun - 06</option>
      <option value="07" <?php if($month=='07'){echo"selected";}?>>Jul - 07</option>
      <option value="08" <?php if($month=='08'){echo"selected";}?>>Aug - 08</option>
      <option value="09" <?php if($month=='09'){echo"selected";}?>>Sep - 09</option>
      <option value="10" <?php if($month=='10'){echo"selected";}?>>Oct - 10</option>
      <option value="11" <?php if($month=='11'){echo"selected";}?>>Nov - 11</option>
      <option value="12" <?php if($month=='12'){echo"selected";}?>>Dec - 12</option>
    </select>
  </div>
  <div class="form-group">
    <label for="year">Select list:</label>
    <select class="form-control" id="year" name="year">
      <option value="2016" <?php if($year=='2016'){echo"selected";}?>>2016</option>
      <option value="2017" <?php if($year=='2017'){echo"selected";}?>>2017</option>
      <option value="2018" <?php if($year=='2018'){echo"selected";}?>>2018</option>
      <option value="2019" <?php if($year=='2019'){echo"selected";}?>>2019</option>
      <option value="2020" <?php if($year=='2020'){echo"selected";}?>>2020</option>
      <option value="2021" <?php if($year=='2021'){echo"selected";}?>>2021</option>
      <option value="2022" <?php if($year=='2022'){echo"selected";}?>>2022</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Search</button>
</form>
</div>
</div> -->
  <div class="row">

    <div class="col-md-12">
    <h2 class="text-center"></h2>
    <?php foreach ($reload_report as $mbr => $v): ?>
      <table class="table table-bordered">      
        <thead>
          <tr>
            <th colspan="2" class="text-center">
              <?= $mbr; ?><br>
              <?= $v['name']; ?><br>              
            </th>
          </tr>
        </thead>
        <tbody> 
        <tr>
          <td class="col-xs-6">
          <table class="table table-bordered"><th colspan="3">TOTAL Reload</th>
          <?php $customer_reload = $this->pages->customer_reload($v['customer_id']) ?>
          <?php foreach ($customer_reload as $key => $value): ?>
            <tr>
            <td><?= $key+1 ?>.</td>
              <td>
                Amount : <?= $value['amount'] ?><br>
                Desc : <?= $value['description'] ?><br>
                Create : <?= $value['create_date'] ?><br>
                Exp : <?= $value['expire_date'] ?><br>                
              </td>
            </tr>
          <?php endforeach ?>            
          </table>
          </td>
          <td class="col-xs-6">
          <table class="table table-bordered"><th colspan="3">MONTHLY Spent</th>
        <?php if (isset($v['expenses'])): ?>
          <?php foreach ($v['expenses'] as $key => $data): ?>
              <tr>
              <td><?= $key+1; ?>.</td>
                <td>
                Amount : <?= $data['amount'] ?><br>
                Desc : <?= $data['description'] ?><br> 
                Create : <?= $data['create_date'] ?><br>                
                </td>
              </tr>            
          <?php endforeach ?>
          <?php else: ?> 
              <tr>
                <td>No Spending</td>
              </tr>           
        <?php endif ?>
          </table>
          </td>
        </tr>






        </tbody>        
      

        

      </table>
      <?php endforeach ?>
    </div>


  </div>
</div>