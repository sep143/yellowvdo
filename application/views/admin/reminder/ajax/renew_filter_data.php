<table id="advertisementPendingTable" class="table table-striped table-no-bordered table-hover dt-responsive" cellspacing="0" width="100%" style="width:100%">
    <thead>
        <tr>
            <th>
                <input type="checkbox" name="select_all" value="1" id="example-select-all">
            </th>
            <th class="disabled-sorting text-left">S.No</th>
            <th>Date</th>
            <th>Title</th>
            <th>Picture</th>
            <th>User Name</th>
            <th>City</th>
            <th>Country</th>
            <!--<th>Status</th>-->
            <th class="disabled-sorting text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($ads_list) {
            foreach ($ads_list as $count => $row):
                ?>
                <tr>
                    <td>
                        <input type="checkbox" name="id[]" value="2">
                    </td>
                    <td><?= $count + 1; ?></td>
                    <td><?= date('d-M-Y', strtotime($row->CreatedDT)); ?></td>
                    <td><?= $row->CaptionLine; ?></td>
                    <td>
                        <?php
                        if (!empty($row->image)) {
                            $thumb_img = base_url() . 'uploads/ads/_thumb/' . $row->image;
                        } else {
                            $thumb_img = base_url() . 'theme/web/images/banner_design.png';
                        }
                        ?>
                        <img src="<?= $thumb_img; ?>" class="img img-responsive" style="width: 70px; height: 70px; object-fit: cover;">
                        <!--                                                <video style="width: 150px; height: auto;" controls>
                                                                            <source src="<?= $video; ?>" >
                                                                        </video>-->
                    </td>
                    <td>
                        <?= $row->FirstName . ' ' . $row->LastName; ?>
                    </td>
                    <td>
                        <?= $row->City; ?>
                    </td>
                    <td><?= $row->Country; ?></td>
        <!--                            <td>
                        <button class="btn btn-sm <?php
                    if ($row->StatusID == 0) {
                        echo 'btn-danger';
                    } else if ($row->StatusID == 1) {
                        echo 'btn-success';
                    }
                    ?>" data-id="<?= $row->ID; ?>" data-status="<?= $row->StatusID; ?>" onclick="change_status(this)" type="button"><?php
                    if ($row->StatusID == 0) {
                        echo 'Inactive';
                    } else if ($row->StatusID == 1) {
                        echo 'Active';
                    }
                    ?></button>
                    </td>-->
                    <td class="text-right">
                        <a href="<?= site_url('admin/advertisement/edit/' . $row->ID); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                        <a href="#" class="btn btn-link btn-danger btn-just-icon" data-id='<?= $row->ID; ?>' data-status="3" onclick="change_status(this)"><i class="material-icons">delete</i></a>
                    </td>
                </tr>
                <?php
            endforeach;
        }
        ?>

    </tbody>
</table>

  <!--Datatable scripting useing at dashboard-->

    <script>
    $(document).ready(function (){
   var table = $('#advertisementPendingTable').DataTable({
       destroy: true,
         retrieve:true,
//      'ajax': {
//         'url': '/lab/articles/jquery-datatables-how-to-add-a-checkbox-column/ids-arrays.txt'
//      },
      'columnDefs': [{
         'targets': 0,
         'searchable': false,
         'orderable': false,
         'className': 'dt-body-center',
       //  'render': function (data, type, full, meta){
       //      return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
        // }
      }],
      'order': [[1, 'asc']],
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Data export',
                        text:'Export data',
                        exportOptions: {
                            columns: [ 1, 2,3,5,6,7 ]
                        }
                }
//                    'copy', 'csv', 'excel', 'pdf', 'print'
//                    'excel'
                ]
//                dom: 'Bfrtip',
//                buttons: [
//                    'copy', 'csv', 'excel', 'pdf', 'print'
//                ]
            });
            $('.btn-group').css({
                'position':'absolute',
                'margin':'0px 0px',
            });
            $('#filter_data .btn-secondary').addClass('btn-success btn-sm');
       // });

   // Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
   //alert('all data'); //Top to select then all rows checked
      // Get all rows with search applied
      var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#advertisementPendingTable tbody').on('change', 'input[type="checkbox"]', function(){
       //alert('single row');
      // If checkbox is not checked
      if(!this.checked){
          
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
             
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });

   // Handle form submission event
   $('#sendReminder').on('click', function(e){
      
      var form = this;

      table.$('input[type="checkbox"]').each(function(){

            if(this.checked){
              var notify = $.notify('<strong>Send</strong> Reminder to selected advertiser', {
	                allow_dismiss: false,
	                showProgressbar: true
              });

                setTimeout(function() {
	                notify.update({'type': 'success', 'message': '<strong>Success</strong> Reminders send successfully', 'progress': 25});
                }, 1000);
               //alert("value::::"+this.value);
              /*  $(form).append(
                  $('<input>')
                     .attr('type', 'hidden')
                     .attr('name', this.name)
                     .val(this.value)
               ); */
            }
        // }
      });
   });

});
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
 <!--Category Table in Active and deactive ajax-->
<script>
function change_status(current){
        var id = $(current).data('id');
        var status = $(current).data('status');
        //alert(status);
        if(status == 1){
            $.ajax({
                url:'<?= site_url('free-ads-change_status'); ?>',
                type:'post',
                data:{id:id, value: '0'},
                success:function(data){
                   // alert(data);
                    $(current).removeClass('btn-success');
                    $(current).addClass('btn-danger');
                    $(current).text('Inactive');
                    $(current).data('status',0);
                   var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                              notify.update({'type': 'danger', 'message': '<strong>Success</strong> Advertisement Inactive'});
                                //window.location.reload();
                        }, 1000);
                }
            });
        }else if(status == 0){
            $.ajax({
               // url:'<?= site_url('free-ads-change_status'); ?>',
                type:'POST',
                data:{id:id, value: '1'},
                success:function(data){
                    alert('data');
                    $(current).removeClass('btn-danger');
                    $(current).addClass('btn-success');
                    $(current).text('Active');
                    $(current).data('status',1);
                   var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                              notify.update({'type': 'success', 'message': '<strong>Success</strong> Advertisement Active'});
                                //window.location.reload();
                        }, 1000);
                }
            });
        //delete
        }else if(status == 3){
                  // alert('delete');     
            $.confirm({
                //animation: 'zoom',
                icon:'fa fa-warning',
                title: 'Delete Advertisement',
                content: 'This Advertisement and all associated data will be deleted. This is not reversible.',
                theme: 'modern',
                buttons: {
                    confirm: function () {
                       
                       $.ajax({
                            url:'<?= site_url('free-ads-change_status'); ?>',
                            type:'POST',
                            data:{id:id, value: '3'},
                            success:function(data){
                               // alert('delete');
                                $.confirm({
                                   //animation: 'zoom',
                                    icon:'fa fa-check-circle',
                                    title: 'Advertisement Deleted',
                                    content: 'The selected Advertisement and associated data was deleted.',
                                    theme: 'modern',
                                    buttons:{
                                        Ok: function(){
                                            window.location.reload();
                                        }
                                    }
                               });
                            }
                        });
                       
                    },
                    cancel: function () {
                        //$.alert('Canceled!');
                    },
                    
                }
            });
        }
    }
</script>
    