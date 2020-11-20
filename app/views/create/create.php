<?php require APPROOT . '/views/components/header.php';?>

<div class="wrapper d-flex align-items-stretch">

       <?php include(APPROOT.'/views/components/sidebar.php'); ?>

      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
      <?php include(APPROOT.'/views/components/menu.php'); ?>

        <span><?php echo date("jS \of F Y ( l )"); ?></span>
        <div class="row mt-5">
        <div class="col-md-4"></div>
         
        <form class="col-md-8 ajaxform" id="expense" name="expense" method="POST">

            <h2 class="mb-3">New Income</h2>
            <div class="form-group">
                <label>Choose Type</label>
                <select class="form-control" id="myselect" name="category_id">
                <?php 
                foreach($data['types'] as $type)
                {
                ?>
                <option value="<?php  echo $type['name'] ?>">
                    <?php  echo $type['name'] ?>
                </option>

                <?php
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label >Amount</label>
                <input type="number" class="form-control"  id="amount" name="amount" placeholder="enter amount here">
            </div>
            <div class="form-group" id="qty" style="display: none;">
                <label for="qty">Quantity</label>
                <input type="number" class="form-control"  id="qty" name="qty" placeholder="enter quantity here">
            </div>
            <div class="form-group">
                <label >Category</label>
                <select class="form-control" name="category_id" id="category" >
                
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
                    <button type="submit" class="btn btn-primary float-right btn-block" id="addnew">Add</button>
                </div>
            </div>
        </form> 
        </div>  <!-- end of row -->
      </div>
</div>
<?php require APPROOT . '/views/components/footer.php';?>
<script>
$(function(){
    $('#myselect').on('change',function(){
        if( $(this).val()=="expense"){
            $("#qty").show()
            $('h2').text('New Expense');
        }
        else{
            $("#qty").hide();
            $('h2').text('New Income');
        }
    });

    $('#addnew').click(function() {
          // e.preventDefault();
          var form_url = $('#myselect').val();
        // alert(form_url);
        var url = '<?php echo URLROOT ?>/' + form_url + '/store';
        var redirect_url = '<?php echo URLROOT ?>/' + form_url;
        // console.log(url);
          $.ajax({
            type: 'POST',
            url: url,
            data: $('form').serialize(),
            success: function (url) {
                // console.log(url);
                $('.ajaxform')[0].reset();
                window.location = redirect_url;
            }
          });
    });

});
</script>