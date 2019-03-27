<div class="material-datatables table-responsive" id="advertiser_ads">
    <table id="advertisement" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Date</th>
                <th>Business Name</th>
                <th>Title</th>
                <th>Image</th>
                <th>Country</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
<!--        <tbody>
            <?php
            if ($advertiser_ads) {
                $i = 1;
                foreach ($advertiser_ads as $count => $value):
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $value->BusinessName; ?></td>
                        <td><?= $value->CaptionLine; ?></td>
                        <td><?= $value->Country; ?></td>
                        <td><button class="btn btn-sm <?php
                                    if ($value->sID == 2) {
                                        echo 'btn-danger';
                                    } else if ($value->sID == 1) {
                                        echo 'btn-success';
                                    }
                                    ?>" data-id="<?= $value->ID; ?>" data-status="<?= $value->sID; ?>" onclick="change_status(this)" type="button"><?php if ($value->sID == 2) {
                                        echo 'Inactive';
                                    } else if ($value->sID == 1) {
                                        echo 'Active';
                                    } ?></button>
                        </td>
                        <td class="text-right">
                            <a href="<?= site_url('/' . $value->ID); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                            <a href="#" class="btn btn-link btn-danger btn-just-icon "><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                endforeach;
            }
            ?>
        </tbody>-->
        <tbody>
                <?php
                if($advertiser_ads){
                    $i = 1;
                    foreach ($advertiser_ads as $count=>$row):
                      if(!empty($duepay)){
                          $ads_view = ($row->StatusID != 6);
                      }else{
                          $ads_view = ($row->StatusID == 6);
                      }
                        if($ads_view){
                        ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= date('d-M-Y', strtotime($row->CreatedDT)); ?></td>
                    <td><?= $row->BusinessName; ?></td>
                    <td><?= $row->CaptionLine; ?></td>
                    <td>
                        <?php
                        if(!empty($row->image)){
                            $thumb_img = base_url().'uploads/ads/_thumb/'.$row->image;
                        }else{
                            $thumb_img = base_url().'theme/web/images/banner_design.png';
                        }
                        ?>
                        <img src="<?= $thumb_img; ?>" class="img img-responsive" style="width: 70px; height: 70px; object-fit: cover;">
    <!--                                                <video style="width: 150px; height: auto;" controls>
                            <source src="<?= $video; ?>" >
                        </video>-->
                    </td>
                    <td><?= $row->Country; ?></td>
                    <td>
                        <div class="dropdown">
                            <?php if($row->StatusID == 1)
                            {
                                $btn = 'btn-success';
                                $text = 'Active';
                            }else if($row->StatusID == 2){
                                $btn = 'btn-warning';
                                $text = 'Inactive';
                            }else if($row->StatusID == 4){
                                $btn = 'btn-danger';
                                $text = 'Disapprove';
                            }else if($row->StatusID == 5){
                                $btn = 'btn-default';
                                $text = 'Expired';
                            }else if($row->StatusID == 0){
                                $btn = 'btn-info';
                                $text = 'Pending';
                            }else if($row->StatusID == 6){
                                $btn = 'btn-info';
                                $text = 'Due Amount';
                            }
                            ?>
                          <button class="dropdown-toggle btn1 <?= $btn; ?> btn-round" id="cbtn<?= $row->ID; ?>" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $text; ?>
                          </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="dropbtn<?= $row->ID; ?>">
                            
                            <?php
                            if($row->StatusID != 6){
                                echo '<h6 class="dropdown-header">Change Status</h6>';
                                if($text != 'Active' && $text != 'Pending'){
                                    echo '<a class="dropdown-item" data-id='.$row->ID.' data-status="1" href="#" onclick="change_status(this)">Active</a>';
                                }

                                if($text != 'Inactive' && $text != 'Pending'){
                                    echo '<a class="dropdown-item" data-id='.$row->ID.' data-status="2" href="#" onclick="change_status(this)">Inactive</a>';
                                }

                                if($text == 'Pending'){
                                    echo '<a class="dropdown-item" data-id='.$row->ID.' data-status="1" href="#" onclick="change_status(this)">Approve</a>';
                                }

                                if($text != 'Disapprove'){
                                    echo '<a class="dropdown-item" data-id='.$row->ID.' data-status="4" href="#" onclick="change_status(this)">Disapprove</a>';
                                }
                            }else{
                                echo '<h6 class="dropdown-header">No action</h6>';
                            }
                            ?>

                          </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <a href="<?= site_url('admin/advertisement/edit/'.$row->ID); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                        <a href="javascript:void(0)" class="btn btn-link btn-danger btn-just-icon" data-id='<?= $row->ID; ?>' data-status="3" onclick="change_status(this)"><i class="material-icons">delete</i></a>
                    </td>
                </tr>
                <?php
                    $i++;
                        }//statusid 6 wala data show nahi krwana he
                    endforeach;
                }
                ?>


            </tbody>
    </table>
</div>

 <!--Datatable scripting useing at dashboard-->
    <script>
        $(document).ready(function () {
            $('#advertisement').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                //responsive: true,
                "scrollX": true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }
            });

        });
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
 <!--Category Table in Active and deactive ajax-->
<script>
function change_status(current){
        var id = $(current).data('id');
        var status = $(current).data('status');
        
        //Active & Approve
        if(status == 1){
            $.ajax({
                url:'<?= site_url('free-ads-change_status'); ?>',
                type:'post',
                data:{id:id, value: '1'},
                success:function(data){
                   // alert(data);
                    $('#cbtn'+id).removeClass('btn-warning');
                    $('#cbtn'+id).removeClass('btn-danger');
                    $('#cbtn'+id).removeClass('btn-info');
                    $('#cbtn'+id).addClass('btn-success');
                    $('#cbtn'+id).text('Active');
                    $('#dropbtn'+id).html('<h6 class="dropdown-header">Change Status</h6>\n\
                            <a class="dropdown-item" data-id='+id+' data-status="2" href="#" onclick="change_status(this)">Inactive</a>\n\
                            <a class="dropdown-item" data-id='+id+' data-status="4" href="#" onclick="change_status(this)">Disapprove</a>\n\
                        ');
                    var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                                notify.update({'type': 'success', 'message': '<strong>Success</strong> Status Active'});
                        }, 1000);
//                    $(current).text('Inactive');
//                    $(current).data('status',2);
                }
            });
         //Inactive
        }else if(status == 2){
            $.ajax({
                url:'<?= site_url('free-ads-change_status'); ?>',
                type:'POST',
                data:{id:id, value: '2'},
                success:function(data){
                   // alert('data');
                    $('#cbtn'+id).removeClass('btn-success');
                    $('#cbtn'+id).removeClass('btn-danger');
                    $('#cbtn'+id).removeClass('btn-info');
                    $('#cbtn'+id).addClass('btn-warning');
                    $('#cbtn'+id).text('Inactive');
                    $('#dropbtn'+id).html('<h6 class="dropdown-header">Change Status</h6>\n\
                            <a class="dropdown-item" data-id='+id+' data-status="1" href="#" onclick="change_status(this)">Active</a>\n\
                            <a class="dropdown-item" data-id='+id+' data-status="4" href="#" onclick="change_status(this)">Disapprove</a>\n\
                        ');
                        var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                                notify.update({'type': 'warning', 'message': '<strong>Success</strong> Status Inactive'});
                        }, 1000);
                }
            });
        //disapprove
        }else if(status == 4){
            $.ajax({
                url:'<?= site_url('free-ads-change_status'); ?>',
                type:'POST',
                data:{id:id, value: '4'},
                success:function(data){
                   // alert('data');
                    $('#cbtn'+id).removeClass('btn-warning');
                    $('#cbtn'+id).removeClass('btn-info');
                    $('#cbtn'+id).removeClass('btn-success');
                    $('#cbtn'+id).addClass('btn-danger');
                    $('#cbtn'+id).text('Disapprove');
                    $('#dropbtn'+id).html('<h6 class="dropdown-header">Change Status</h6>\n\
                            <a class="dropdown-item" data-id='+id+' data-status="1" href="#" onclick="change_status(this)">Active</a>\n\
                            <a class="dropdown-item" data-id='+id+' data-status="2" href="#" onclick="change_status(this)">Inactive</a>\n\
                        ');
                        var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                                notify.update({'type': 'danger', 'message': '<strong>Success</strong> Status Disapprove'});
                        }, 1000);
                }
            });
        //delete
        }else if(status == 3){
        <?php
        if($this->session->userdata('log_role') == 1){
        ?>
                  // alert('delete');     
            $.confirm({
                //animation: 'zoom',
                icon:'fa fa-warning',
                title: 'Delete Advertiser',
                content: 'This Advertiser and all associated data will be deleted. This is not reversible.',
                theme: 'modern',
                buttons: {
                    confirm: function () {
                       
                       $.ajax({
                            url:'<?= site_url('advertiser_change_status'); ?>',
                            type:'POST',
                            data:{id:id, value: '3'},
                            success:function(data){
                               // alert('delete');
                                $.confirm({
                                   //animation: 'zoom',
                                    icon:'fa fa-check-circle',
                                    title: 'Advertiser Deleted',
                                    content: 'The selected Advertiser and associated data was deleted.',
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
         <?php
        }else{
            ?>
              $.alert({
                //animation: 'zoom',
                icon:'fa fa-warning',
                title: 'No authorise',
                content: 'This Advertiser and all associated data will be deleted. This is not reversible.',
                theme: 'modern',
                
            });          
        <?php
        }
         ?>
        }
        
    }
</script> 