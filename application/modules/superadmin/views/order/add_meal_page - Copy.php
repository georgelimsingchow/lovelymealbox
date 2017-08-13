
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
          <form ng-submit="doSearch()">
          <div class="box-body">
          
            <div class="form-group">
              <label for="chineseName">Choose Date</label>
              <input class="form-control" id="that_day_date" type="text">
            </div>
            <div class="form-group">
              <label for="food-status">Session</label>
              <div class="radio">
                <label>
                  <input type="radio" value="lunch" ng-model="search.session">LUNCH</label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" value="dinner" ng-model="search.session">DINNER</label>
              </div>

            </div>
            
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">NEXT</button>
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
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="cart in cartData">
              <td>{{cart.selected_menu}}</td>
                <td>{{cart.quantity}}</td>
                <td>{{cart.unit}}</td>
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
    
    $scope.search = {};
    $scope.count = 1;
    $scope.price = 0;
    $scope.datas = [];
    $scope.boxValidation = <?= $this->settings->box_validation(); ?>;
    $scope.mealcheck = [];
    $scope.limit = 4;
    $scope.checked = 0;
    $scope.code = '';
    $scope.cartData = [];
    $scope.codeMeat = [];
    $scope.codeVege = [];

    $scope.doSearch = function ()
    {
      // console.log($scope.mealcheck);
      // console.log($scope.checked);
      $scope.mealcheck = []; 
      $scope.checked = [];
      $scope.codeMeat = [];
      $scope.codeVege = [];
      $scope.count = 1;
      $scope.price = 0;

      $scope.search.date = $("#that_day_date").val();
      var config = {
       params: {date: $scope.search.date ,session: $scope.search.session},
       headers : {'Accept' : 'application/json'}
      };
      $http.get('<?= base_url('superadmin/dailymenu/json_dailymenu'); ?>',config)
        .then(function (res){
          $scope.datas = res.data.picked_menu;
      });

      $http.get('<?= base_url('superadmin/dailymenu/json_dailymenu'); ?>',config)
        .then(function (res){
          $scope.datas = res.data.picked_menu;
      });

    }

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
       params: {date: $scope.search.date ,session: $scope.search.session},
       headers : {'Accept' : 'application/json'}        
      }

      var data = {
        date: $scope.search.date,
        session: $scope.search.session,
        selected_menu: $scope.mealcheck,
        unit : $scope.price,
        quantity : $scope.count,
      }


      $http.post('<?= base_url('superadmin/dailymenu/json_add_to_cart'); ?>',JSON.stringify(data))
        .then(function (response){

          if (response.data.status == 'success') {

            $http.get('<?= base_url('superadmin/dailymenu/json_get_cart'); ?>',config2)
              .then(function (res){
                console.log(res);
                $scope.cartData = res.data;

            });            

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