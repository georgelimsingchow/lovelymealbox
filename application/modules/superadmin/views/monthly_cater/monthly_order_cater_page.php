<?php 
$cater_id = $this->input->get('id'); 
$cater_url = base_url('superadmin/monthly_cater/json_get_cater')."/".$cater_id;  
?>
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
<section class="content" ng-app="myApp" >
  <div class="row" ng-controller="CaterController">
    <!-- left column -->

    <div class="col-md-6" >
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
          <a href="<?= base_url('superadmin/monthly_cater');?>" class="btn btn-primary">BACK</a>
            <button type="submit" class="btn btn-primary pull-right">NEXT</button>
          </div>
          </form>


      </div><!-- /.box -->
    </div><!--/.col (left) -->

    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">CHOOSE MEAL</h3>
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
            </tbody>

            </table>
          </div><!-- /.box-body -->
          <div class="box-footer">
              <button type="submit" class="btn btn-danger pull-right" ng-disabled="!valid">ADD</button>
          </div>
          </form>

      </div><!-- /.box -->
    </div><!--/.col (left) -->


    <div class="col-xs-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Customer Order</h3>
        </div><!-- /.box-header -->
        <!-- form start -->

          <div class="box-body">

            <table class="table table-bordered">
            <thead>
              <tr>
                <th></th>
                <th>Order Date</th>
                <th>Picked Menu</th>
                <th>Credit Used</th>
                <th>Session</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="k in orderData">
                <td class="text-center">{{k.cater_id}}</td>
                <td>{{k.menu_date}}</td>
                <td>{{k.picked_menu}}</td>
                <td>{{k.quantity}}</td>
                <td>{{k.session}}</td>
                <td>{{k.order_status}}</td>
              </tr>              
            </tbody>

            </table>
          </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (left) -->
  </div>   <!-- /.row -->
</section><!-- /.content -->


<script>
  var app = angular.module('myApp',[]);

  app.controller('CaterController', function($scope,$http){
    
    $scope.search = {};
    $scope.datas = [];
    $scope.boxValidation = <?= $this->settings->box_validation(); ?>;
    $scope.mealcheck = [];
    $scope.limit = 4;
    $scope.checked = 0;
    $scope.code = '';
    $scope.codeMeat = [];
    $scope.codeVege = [];
    $scope.valid = false;

    $scope.orderData = <?= modules::load('superadmin/monthly_cater/')->json_get_cater($cater_id); ?>;
    


    $scope.doSearch = function ()
    {
      $scope.mealcheck = []; 
      $scope.checked  = [];
      $scope.codeMeat = [];
      $scope.codeVege = [];
      

      $scope.search.date = $("#that_day_date").val();
      var config = {
       params: {date: $scope.search.date ,session: $scope.search.session},
       headers : {'Accept' : 'application/json'}
      };

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
        $scope.valid = true;
      }else{
        $scope.valid = false;
      }
    }

    $scope.doAdd = function ()
    {
      var config2 = {
       params: {date: $scope.search.date ,session: $scope.search.session},
       headers : {'Accept' : 'application/json'}        
      }

      var data = {
        cater_id : '<?= $cater_id; ?>',
        date: $scope.search.date,
        session: $scope.search.session,
        selected_menu: $scope.mealcheck,
      }


      $http.post('<?= base_url('superadmin/monthly_cater/json_cater_order'); ?>',JSON.stringify(data))
        .then(function (response){


          if (response.data.status == 'success') {

            $http.get('<?= base_url('superadmin/monthly_cater/json_get_cater')."/".$cater_id; ?>',config2)
              .then(function (res){

                $scope.orderData = res.data;

            });            

          }
      });

    }
  })

</script>