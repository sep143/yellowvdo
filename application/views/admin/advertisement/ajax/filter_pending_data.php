<table id="advertisementPendingTable" class="table table-striped table-no-bordered table-hover dt-responsive" cellspacing="0" width="100%" style="width:100%">
    <thead>
        <tr>
            <th class="disabled-sorting text-left">S.No</th>
            <th>Date</th>
            <th>Title</th>
            <th>Video</th>
            <th>User Name</th>
            <th>City</th>
            <th>Country</th>
            <!--<th>Verify</th>-->
            <th>Status</th>
            <!--<th class="disabled-sorting text-right">Actions</th>-->
        </tr>
    </thead>

    <tbody>
                                        <?php
                                        if($ads_list){
                                            foreach ($ads_list as $count=>$row):
                                                ?>
                                        <tr>
                                            <td><?= $count+1; ?></td>
                                            <td><?= date('d-M-Y', strtotime($row->CreatedDT)); ?></td>
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
                                            <td>
                                                <?= $row->FirstName.' '.$row->LastName; ?>
                                            </td>
                                            <td>
                                                <?= $row->City; ?>
                                            </td>
                                            <td><?= $row->Country; ?></td>
                                            <td class="text-right">
                                                <a href="<?= site_url('admin/advertisement/edit/'.$row->ID); ?>" class="btn btn-link btn-success btn-just-icon" title="Edit"><i class="material-icons">edit</i></a>
                                                <a href="<?= site_url('admin/view_ad/'.$row->ID); ?>" target="_blank" class="btn btn-link btn-info btn-just-icon" title="View ad"><i class="material-icons">visibility</i></a>
                                                <span class="btn btn-link btn-success btn-just-icon" title="Approve" onclick="change_status(this)" data-status="1" data-id='<?= $row->ID; ?>'><i class="material-icons">done</i></span>
                                                <span class="btn btn-danger btn-link btn-just-icon" title="Disapprove" onclick="change_status(this)" data-status="4" data-id='<?= $row->ID; ?>'><i class="material-icons">clear</i></span>
                                            </td>
<!--                                              
                                            </td>
<!--                                            <td class="text-right">
                                                <a href="<?= site_url('admin/advertisement/edit/'.$row->ID); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                                                <a href="#" class="btn btn-link btn-danger btn-just-icon" data-id='<?= $row->ID; ?>' data-status="3" onclick="change_status(this)"><i class="material-icons">delete</i></a>
                                            </td>-->
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
        $('#advertisementPendingTable').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            destroy: true,
            retrieve:true,
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
                            columns: [ 0, 1, 2,4, 5,6]
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
    