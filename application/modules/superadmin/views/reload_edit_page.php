<?php 
  $customer_id = $this->input->get('customer_id');
  $reload_id = $this->input->get('reload_id');
  $reload = $this->reload->find_by_id($reload_id);
?>
<section class="content-header">
  <h1>
    Edit <strong><?= $customer_name; ?></strong> Reload
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Forms</a></li>
    <li class="active">General Elements</li>
  </ol>
</section>
<!-- Main content -->
<section class="content" ng-app="myApp">
  <div class="row" ng-controller="ReloadController">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit <strong><?= $customer_name; ?></strong> Reload</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        
          <div class="box-body">
<div class="alert alert-success alert-dismissible" ng-show="showSuccessAlert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Success Edited
              </div>
<form ng-submit="submit()" name="reloadForm" novalidate>
            <div class="form-group" ng-class="{ 'has-error' : reloadForm.amount.$invalid && !reloadForm.amount.$pristine }">
              <label>Reload amount (RM)</label>
              <input type="text" class="form-control" ng-model="amount" name="amount" placeholder="Enter amount e.g 250.50" required>
              <p ng-show="reloadForm.amount.$invalid && !reloadForm.amount.$pristine" class="help-block">Amount is required.</p>

            </div>

            <div class="form-group" ng-class="{ 'has-error' : reloadForm.real_amount.$invalid && !reloadForm.real_amount.$pristine }">
              <label>Actual Amount</label>
              <input type="text" class="form-control" ng-model="real_amount" name="real_amount" placeholder="Enter amount e.g 250.50" required>
              <p ng-show="reloadForm.real_amount.$invalid && !reloadForm.real_amount.$pristine" class="help-block">Amount is required.</p>

            </div>
            <div class="form-group" ng-class="{ 'has-error' : reloadForm.description.$invalid && !reloadForm.description.$pristine }">
              <label>Description</label>
              <textarea class="form-control" ng-model="description" name="description" required>
                
              </textarea>
              <p ng-show="reloadForm.description.$invalid && !reloadForm.description.$pristine" class="help-block">Description is required.</p> 

            </div>

          </div><!-- /.box-body -->

          <div class="box-footer">
            <a href="<?= base_url();?>superadmin/reload/add_balance?customer_id=<?= $customer_id;?>" class="btn btn-danger">Back</a>
            <button type="submit" class="btn btn-primary pull-right" name="submit" value="submit" ng-disabled="reloadForm.$invalid">Submit</button>
          </div>
        </form>
      </div><!-- /.box -->

    </div><!--/.col (left) -->
    <!-- right column -->
  </div>   <!-- /.row -->
</section><!-- /.content -->

<script>
  var app = angular.module('myApp',[]);

  app.controller('ReloadController', function($scope,$http){
  
    // initialize    
    $scope.reload_id = '<?= $reload_id; ?>';
    $scope.customer_id = '<?= $customer_id; ?>';
    $scope.amount = '<?= $reload->amount; ?>';
    $scope.real_amount = '<?= $reload->real_amount; ?>';
    $scope.description = '<?= $reload->description; ?>';
    $scope.reload = {};
    $scope.showSuccessAlert = false;

      $scope.submit = function() {
        // console.log($scope.amount);
        // console.log($scope.real_amount);
        // console.log($scope.description);
        var params = $.param({
          balance_id : $scope.reload_id,
          amount: $scope.amount,
          real_amount: $scope.real_amount,
          description: $scope.description          
        });

        $http({
          method :'POST',
          url : '<?= base_url('superadmin/reload/json_do_edit_balance') ?>',
          data : params,
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response){
          if (response.data.status == 'success') 
          {
            $scope.showSuccessAlert = true;
          }
      });

      };    


  })

</script>