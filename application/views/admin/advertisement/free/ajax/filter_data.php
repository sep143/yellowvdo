<table id="freeAds" class="table table-hover dt-responsive" cellspacing="0" width="100%" style="width:100%">
    <thead>
        <tr>
            <th>S.No. &nbsp;</th>
            <th>Date</th>
            <th>Title</th>
            <th>City</th>
            <th>Country &nbsp;</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($free_ads_list) {
            foreach ($free_ads_list as $count => $value):
                ?>
                <tr>
                    <td><?= $count + 1; ?></td>
                    <td><?= date('h:i A, d-M-Y', strtotime($value->CreatedDT)); ?></td>
                    <td><?= $value->CaptionLine; ?></td>
                    <td><?= $value->City; ?></td>
                    <td><?= $value->Country; ?></td>
                    <td>
                        <button class="btn btn-sm <?php
                        if ($value->StatusID == 2) {
                            echo 'btn-danger';
                        } else if ($value->StatusID == 1) {
                            echo 'btn-success';
                        }
                        ?>" data-id="<?= $value->ID; ?>" data-status="<?= $value->StatusID; ?>" onclick="change_status(this)" type="button"><?php if ($value->StatusID == 2) {
                            echo 'Inactive';
                        } else if ($value->StatusID == 1) {
                            echo 'Active';
                        } ?></button>
                    </td>
                    <td class="text-right">
                        <a href="<?= site_url('admin/advertisement/free-ad-edit/' . $value->ID); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
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
            $('#freeAds').DataTable({
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
                            columns: [ 0, 1, 2,4, 5 ]
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