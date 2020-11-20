
<?php require APPROOT . '/views/components/header.php';?>
<!-- for url-jump protect -->
<?php require APPROOT . '/protect/url-jump-protect.php';?>
    <!-- /for url-jump protect -->

<div class="wrapper d-flex align-items-stretch">

	   <?php include(APPROOT.'/views/components/sidebar.php'); ?>

      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

      <?php include(APPROOT.'/views/components/menu.php'); ?>

      <h2 class="mb-4">Income</h2>

      <?php include(APPROOT.'/views/components/message.php'); ?>


      <table class="table table-light text-center w-100" id="myTable">
            <thead>
             <tr>
               <th>Id</th>
               <th>Category</th>
               <th>Amount</th>
               <th>Assigned By</th>
               <th>Date </th>
               <th></th>
               <th></th>
             </tr>
           </thead>
         </table>
         <a href="<?php echo URLROOT ?>/income/create" class="btn btn-primary float-right mt-5">Add New</a>

       </div>
      </div>


<?php require APPROOT . '/views/components/footer.php';?>
<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />

<script type="text/javascript">
  $(document).ready(function(){  
   $('#myTable').DataTable({  
    "processing": true,
          // "serverSide": true,
          "ajax"     :     "http://localhost/mvcoop/incomeApi",
          "columns"     :     [  
          {     "data"     :     "id"     },  
          {     "data"     :     "category_name"},  
          {     "data"     :     "amount"}, 
          {     "data"     :     "user_name"}, 
          {     "data"     :     "date"},
          {
            mRender: function (data, type, full) {
              return `<a href="<?php echo URLROOT ?>/incomeApi/edit/${full.id}" class="btn btn-primary">Edit</a>`;
            }
          },
          {
            mRender: function (data, type, full) {
              return '<button type="submit" class="remove btn btn-danger" value="'+full.id+'">Delete</button>'
            }
          }
        ]  
      });
      $(document).on('click','.remove',function(event){
       var id = $(this).val();
       swal({
         title: "Are you sure?",
         text: "You will not be able to recover this imaginary file!",
         type: "warning",
         showCancelButton: true,
         confirmButtonClass: "btn-danger",
         confirmButtonText: "Yes, delete it!",
         cancelButtonText: "No, cancel plx!",
         closeOnConfirm: false,
         closeOnCancel: false
       },
       function(isConfirm) {
         if (isConfirm) {
           $.ajax({
            url: 'http://localhost/mvcoop/incomeApi/destory/'+id,
            type: 'DELETE',
            error: function() {
             alert('Something is wrong');
           },
           success: function(data) {
             $("#"+id).remove();
             location.reload();
           }
         });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
     });
    });
   </script>

