

<table id="advertiser" class="table table-striped table-no-bordered table-hover dt-responsive" cellspacing="0" width="100%" style="width:100%">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Date</th>
            <th>Name</th>
            <th>Email </th>
            <th>Country</th>
            <th>A/C Type</th>
            <!--<th>Verify Email</th>-->
            <th>Status</th>
            <th class="disabled-sorting text-right">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if ($advertiser_list) {
            foreach ($advertiser_list as $count => $value):
                ?>
                <tr>
                    <td><?= $count + 1; ?></td>
                    <td><?= date('d-M-Y', strtotime($value->CreatedDT)); ?></td>
                    <td> <?php echo $value->FirstName . ' ' . $value->LastName; ?></td>
                    <td><?= $value->UserName; ?></td>
                    <td><?= $value->Country; ?></td>
                    <td><?php 
                        if($value->AccountType == 1){
                            echo 'Paybal';
                        }else if($value->AccountType == 0){
                            echo 'Free';
                        }
                     ?></td>
                    <td><button class="btn btn-sm <?php
                        if ($value->StatusID == 0) {
                            echo 'btn-danger';
                        } else if ($value->StatusID == 1) {
                            echo 'btn-success';
                        }
                        ?>" data-id="<?= $value->ID; ?>" data-status="<?= $value->StatusID; ?>" onclick="change_status(this)" type="button"><?php if ($value->StatusID == 0) {
                            echo 'Inactive';
                        } else if ($value->StatusID == 1) {
                            echo 'Active';
                        } ?></button>
                    </td>
                    <td class="text-right">
                        <a href="<?= site_url('admin/advertiser/edit/' . $value->ID); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                        <a href="<?= site_url('admin/advertiser/view/' . $value->ID); ?>" class="btn btn-link btn-info btn-just-icon "><i class="material-icons">visibility</i></a>
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
            $('#advertiser').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                destroy: true,
                retrieve:true,
                //responsive: true,
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