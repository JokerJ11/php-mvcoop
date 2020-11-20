  
<?php require APPROOT . '/views/components/header.php';?>
  <!-- for csrf protect -->
  <?php require APPROOT . '/protect/csrf-protect.php';?>
    <!-- /for csrf protect -->
    <!-- for url-jump protect -->
<?php require APPROOT . '/protect/url-jump-protect.php';?>
    <!-- /for url-jump protect -->

<div class="wrapper d-flex align-items-stretch">

	   <?php include(APPROOT.'/views/components/sidebar.php'); ?>

      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
      <?php include(APPROOT.'/views/components/menu.php'); ?>
      
      <h2 class="mb-4">New Income</h2>
        <span><?php echo date("jS \of F Y ( l )"); ?></span>
        <div class="row mt-5">
        <form class="col-md-8" action="<?php echo URLROOT ?>/income/store" method="POST">
            <div class="form-group">
                <label>Amount</label>
                <input type="number" class="form-control" name="amount" id="amount" placeholder="enter amount here">
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" id="category" name="category_id">
                  
                    <?php 
                        foreach($data['categories'] as $category)
                        {
                    ?>
                        <option value="<?php  echo $category['id'] ?>">
                        <?php  echo $category['name'] ?>
                        </option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <input type="reset" class="btn btn-secondary float-right btn-block" value="Reset">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary float-right btn-block">Add</button>
                </div>
                <!-- for csrf protect -->
                <input type="hidden" name="csrf" value="<?php echo $_SESSION['input_token'] ?>">
                <!-- /for csrf protect -->
                
            </div> 
        </form>    
        </div>  <!-- end of row -->
      </div>
</div>


<?php require APPROOT . '/views/components/footer.php';?>
