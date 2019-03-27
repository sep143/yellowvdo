<table id="advertisementTable" class="table table-striped table-no-bordered table-hover dt-responsive" cellspacing="0" style="width:100%">
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
            <th class="disabled-sorting text-right">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if ($ads_list) {
            foreach ($ads_list as $count => $row):
                ?>
                <tr>
                    <td><?= $count + 1; ?></td>
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
                        <img src="<?= $thumb_img; ?>" class="img img-responsive" style="width: 70px; height: 50px; object-fit: cover;">
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
                    <td>
                        <div class="dropdown">
                            <?php
                            $btn = '';
                            $text ='';
                            if ($row->StatusID == 1) {
                                $btn = 'btn-success';
                                $text = 'Active';
                            } else if ($row->StatusID == 2) {
                                $btn = 'btn-warning';
                                $text = 'Inactive';
                            } else if ($row->StatusID == 4) {
                                $btn = 'btn-danger';
                                $text = 'Disapprove';
                            } else if ($row->StatusID == 5) {
                                $btn = 'btn-default';
                                $text = 'Expired';
                            } else if ($row->StatusID == 0) {
                                $btn = 'btn-info';
                                $text = 'Pending';
                            }
                            ?>
                            <button class="dropdown-toggle btn1 <?= $btn; ?> btn-round" id="cbtn<?= $row->ID; ?>" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $text; ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="dropbtn<?= $row->ID; ?>">
                                <h6 class="dropdown-header">Change Status</h6>
                                <?php
                                if ($text != 'Active' && $text != 'Pending') {
                                    echo '<a class="dropdown-item" data-id=' . $row->ID . ' data-status="1" href="#" onclick="change_status(this)">Active</a>';
                                }

                                if ($text != 'Inactive' && $text != 'Pending') {
                                    echo '<a class="dropdown-item" data-id=' . $row->ID . ' data-status="2" href="#" onclick="change_status(this)">Inactive</a>';
                                }

                                if ($text == 'Pending') {
                                    echo '<a class="dropdown-item" data-id=' . $row->ID . ' data-status="1" href="#" onclick="change_status(this)">Approve</a>';
                                }

                                if ($text != 'Disapprove') {
                                    echo '<a class="dropdown-item" data-id=' . $row->ID . ' data-status="4" href="#" onclick="change_status(this)">Disapprove</a>';
                                }
                                ?>

                            </div>
                        </div>
                    </td>
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
        $(document).ready(function () {
            $('#advertisementTable').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                destroy: true,
                retrieve:true,
                responsive: true,
               // "scrollX": true,
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
                            columns: [ 0, 1, 2,4, 5,6 ]
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