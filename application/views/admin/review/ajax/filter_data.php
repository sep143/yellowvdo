<table id="reviewTable" class="table table-striped table-no-bordered table-hover dt-responsive" cellspacing="0" width="100%" style="width:100%">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Date</th>
            <th>Ads ID</th>
            <th>Advertiser</th>
            <th>Rating</th>
            <th>Comment</th>
            <th>Status</th>
            <th class="disabled-sorting text-right">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if ($review_list) {
            foreach ($review_list as $count => $value):
                ?>
                <tr>
                    <td><?= $count + 1; ?></td>
                    <td><?= date('d-M-Y', strtotime($value->CreatedDT)); ?></td>
                    <td><?= $value->AdsID; ?></td>
                    <td id="name<?= $value->AdsID; ?>"><!--Advertiser ka name dikhane ke liye ID se via ajax se data get kr raha hu-->
                        <?= $value->FirstName.' '.$value->LastName; ?>
<!--                        <script>
                            $(document).ready(function () {
                                var adsID = <?= $value->AdsID; ?>;
                                //alert(adsID);
                                $.ajax({
                                    url: '<?= site_url('advertisername'); ?>',
                                    type: 'post',
                                    data: {adsID: adsID},
                                    success: function (data) {
                                        //  alert(data);
                                        $('#name<?= $value->AdsID; ?>').text(data);
                                    }
                                });
                            });
                        </script>-->
                    </td>
                    <td><?= $value->Rating; ?></td>
                    <td><?= $value->Comment; ?></td>
                    <td>
                        <button class="btn btn-sm <?php
                        if ($value->StatusID == 0) {
                            echo 'btn-danger';
                        } else if ($value->StatusID == 1) {
                            echo 'btn-success';
                        }
                        ?>" data-id="<?= $value->ID; ?>" data-status="<?= $value->StatusID; ?>" onclick="change_status(this)" type="button"><?php
                                    if ($value->StatusID == 0) {
                                        echo 'Disapprove';
                                    } else if ($value->StatusID == 1) {
                                        echo 'Approve';
                                    }
                                    ?>
                        </button>
                    </td>
                    <td class="text-right">
                        <a href="<?= site_url('admin/review/edit/' . $value->ID); ?>" class="btn btn-link btn-success btn-just-icon "><i class="material-icons">edit</i></a>
                        <a href="<?= site_url('admin/review/show/' . $value->ID); ?>" class="btn btn-link btn-info btn-just-icon "><i class="material-icons">visibility</i></a>
                        <a href="#" class="btn btn-link btn-danger btn-just-icon" data-id='<?= $value->ID; ?>' data-status="3" onclick="change_status(this)"><i class="material-icons">delete</i></a>
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
        $(document).ready(function () {
            $('#reviewTable').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
               // responsive: true,
                "scrollX": true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                },
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Data export',
                        text:'Export data',
                        exportOptions: {
                            columns: [ 0, 1, 2,3,4, 5,6 ]
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
                url:'<?= site_url('change_review_status'); ?>',
                type:'post',
                data:{id:id, value: '0'},
                success:function(data){
                   // alert(data);
                    $(current).removeClass('btn-success');
                    $(current).addClass('btn-danger');
                    $(current).text('Disapprove');
                    $(current).data('status',0);
                   var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                                notify.update({'type': 'danger', 'message': '<strong>Success</strong> Status Inactive'});
                        }, 1000);
                }
            });
        }else if(status == 0){
            $.ajax({
                url:'<?= site_url('change_review_status'); ?>',
                type:'POST',
                data:{id:id, value: '1'},
                success:function(data){
                   // alert('data');
                    $(current).removeClass('btn-danger');
                    $(current).addClass('btn-success');
                    $(current).text('Approve');
                    $(current).data('status',1);
                   var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                                notify.update({'type': 'success', 'message': '<strong>Success</strong> Status Active'});
                        }, 1000);
                }
            });
        //delete
        }else if(status == 3){
                  // alert('delete');     
            $.confirm({
                //animation: 'zoom',
                icon:'fa fa-warning',
                title: 'Delete Review',
                content: 'This Review and all associated data will be deleted. This is not reversible.',
                theme: 'modern',
                buttons: {
                    confirm: function () {
                       
                       $.ajax({
                            url:'<?= site_url('change_review_status'); ?>',
                            type:'POST',
                            data:{id:id, value: '3'},
                            success:function(data){
                               // alert('delete');
                                $.confirm({
                                   //animation: 'zoom',
                                    icon:'fa fa-check-circle',
                                    title: 'Review Deleted',
                                    content: 'The selected Review and associated data was deleted.',
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