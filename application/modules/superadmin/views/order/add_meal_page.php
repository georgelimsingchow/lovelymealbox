<?php $date    = $this->input->get('date'); ?>
<?php $session = $this->input->get('session'); ?>
<?php $single_daily_menu = $this->daily->json_get_single_dailymenu($date,$session);  ?>
<?php $cart_data         = $this->cart->read_specific($date,$session);  ?>
        <!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Add Box</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Forms</a></li>
    <li class="active">General Elements</li>
  </ol>
</section>

<!-- Main content -->
<section class="content" ng-app="myApp" ng-controller="FormController">
  <div class="row">
    <!-- left column -->

    <div class="col-xs-3" >
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title" id="cart">CHOOSE DATE</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
          <form method="get" action="<?= base_url('superadmin/order/add_box')?>">
          <div class="box-body">
          
            <div class="form-group">
              <label>Choose Date</label>
              <input class="form-control" id="that_day_date" type="text" name="date" value="<?= $date ?>">
            </div>
            <div class="form-group">
              <label for="food-status">Session</label>
              <div class="radio">
                <label>
                  <input type="radio" value="lunch" name="session" <?= ($session == 'lunch' ? "checked" : "")?> />LUNCH
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" value="dinner" name="session" <?= ($session == 'dinner' ? "checked" : "")?> />DINNER
                </label>
              </div>

            </div>
            
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">SEARCH</button>
          </div>
          </form>


      </div><!-- /.box -->
    </div><!--/.col (left) -->

    <div class="col-xs-5">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">BUILD BOX</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form ng-submit="doAdd()">
          <div class="box-body">

            <table class="table table-bordered">
            <thead>
              <tr>
                <th></th>
                <th>Menu</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="meal in datas">
                <td class="text-center">
                    <input type="checkbox" value="{{meal.id}}" ng-model="meal.selected" ng-change="checkChanged(meal)" ng-disabled="checked==limit && !meal.selected">
                </td>
                <td>{{meal.menu_chinese}}</td>
                <td>{{meal.type}}</td>
              </tr>
              <tr>
              <td>Qty</td>
                <td colspan=2 class="text-center">            
                  <a href ng-click="decrement();" class="btn btn-primary" style="margin-right: 10%">
                    <i class="fa fa-minus"></i> 
                  </a>            
                  {{count}}
                  <a href ng-click="increment();"  class="btn btn-danger" ng-init="count=1" style="margin-left: 10%">
                    <i class="fa fa-plus"></i>                    
                  </a>
                </td>
              </tr>
              <tr>
                <td>Total</td>
                <td colspan=2 class="text-center">RM {{ price*count }}</td>
              </tr>
              
            </tbody>

            </table>
          </div><!-- /.box-body -->
          <div class="box-footer">
              <button type="submit" class="btn btn-danger pull-right" ng-disabled="price == 0">ADD</button>
          </div>
          </form>

      </div><!-- /.box -->
    </div><!--/.col (left) -->

    <div class="col-xs-4">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">CART</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">

            <table class="table table-bordered">
            <thead>
              <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="cart in cartData">
                <td>{{cart.selected_menu}}</td>
                <td>{{cart.quantity}}</td>
                <td>{{cart.unit}}</td>
                <td>
                  <a href  class="btn btn-danger" ng-click="remove(cart.id,$index)">
                    <i class="fa fa-times"></i>                    
                  </a>
                </td>
              </tr>
              
              
              
              
            </tbody>

            </table>
          </div><!-- /.box-body -->
          <div class="box-footer">
              <button type="submit" class="btn btn-danger pull-right">ADD</button>
          </div>

      </div><!-- /.box -->
    </div><!--/.col (left) -->
    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Count</h3>
        </div><!-- /.box-header -->
        <!-- form start -->

          <div class="box-body">


            <div class="form-group">
              <label>Order box</label>
              <textarea class="form-control" rows="3" placeholder="Cooked with tomato sauce" name="food_desc"></textarea>
            </div>


          </div><!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
          </div>

      </div><!-- /.box -->
    </div><!--/.col (left) -->
  </div>   <!-- /.row -->
</section><!-- /.content -->


<script>
  var app = angular.module('myApp',[]);

  app.controller('FormController', function($scope,$http){
    

    $scope.count = 1;
    $scope.price = 0;

    <?php if ((isset($date)) && (isset($session))): ?>
      $scope.date = '<?= $date;  ?>';
      $scope.session = '<?= $session;  ?>';
    <?php endif ?>

    <?php if (!empty($single_daily_menu)): ?>
      $scope.datas = <?=  json_encode($single_daily_menu['picked_menu']);?>;
    <?php endif ?>
    
    $scope.boxValidation = <?= $this->settings->box_validation(); ?>;
    $scope.mealcheck = [];
    $scope.limit = 4;
    $scope.checked = 0;
    $scope.code = '';

    <?php if (!empty($cart_data)): ?>
      $scope.cartData = <?=  json_encode($cart_data);?>;
    <?php endif ?>


    $scope.codeMeat = [];
    $scope.codeVege = [];

    $scope.checkChanged = function (meal){      

      if (meal.selected) $scope.checked++; else $scope.checked--;

      var index = $scope.mealcheck.indexOf(meal.id);
      if (index === -1) {
        $scope.mealcheck.push(meal.id);
        if (meal.type === 'meat') {
          $scope.codeMeat.push('m');
        }

        if (meal.type === 'vege') {
          $scope.codeVege.push('v');
        }
      }else{
        if (meal.type === 'meat') {
          $scope.codeMeat.splice('m',1);
        }

        if (meal.type === 'vege') {
          $scope.codeVege.splice('v',1);
        }
        $scope.mealcheck.splice(index, 1);
      }

      var meatLength = $scope.codeMeat.length;
      var vegeLength = $scope.codeVege.length;
      var mv_code = 'v'.repeat(vegeLength) + 'm'.repeat(meatLength);

      if ($scope.boxValidation.hasOwnProperty(mv_code)) {
        $scope.price = $scope.boxValidation[mv_code];
      }else{
        $scope.price = 0;
      }
    }

    $scope.doAdd = function ()
    {

      var config2 = {
       params: {date: $scope.date ,session: $scope.session},
       headers : {'Accept' : 'application/json'}        
      }

      var data = {
        date: $scope.date,
        session: $scope.session,
        selected_menu: $scope.mealcheck,
        unit : $scope.price,
        quantity : $scope.count,
      }


      $http.post('<?= base_url('superadmin/dailymenu/json_add_to_cart'); ?>',JSON.stringify(data))
        .then(function (response){

          if (response.data.status == 'success') {

            $http.get('<?= base_url('superadmin/dailymenu/json_get_cart'); ?>',config2)
              .then(function (res){
                $scope.cartData = res.data;

            });            

          }
      });

    }

    $scope.remove = function (cart_id,index)
    {    
      
      
      $http.delete('<?= base_url('superadmin/cart/delete').'/'; ?>' + cart_id).then(function (res){
        if (res.data.status === 'success') {
            $scope.cartData.splice(index,1);
        }
      });
    }


  $scope.increment = function() {
    $scope.count++;
  };

  $scope.decrement = function() {
    if ($scope.count <= 1) { return; }
    $scope.count--;
  };





  })

</script>