<table id="allTransitionTable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Advertiser ID</th>
            <th>Ads ID</th>
            <th>txt_id</th>
            <th>Amount</th>
            <!--<th>Mode</th>-->
            <th>Date</th>
            <th>Status</th>
            <th>Invoice</th>
<!--<th class="disabled-sorting text-right">Actions</th>-->
        </tr>
    </thead>

    <tbody>
        <?php
        if($transition){
            foreach ($transition as $count=>$row):
                ?>
            <tr>
                <td><?= $count+1; ?></td>
                <td><?= $row->UserID; ?></td>
                <td><?= $row->AdsID; ?></td>
                <td><?= $row->TxtID; ?></td>
                <td><?= $row->TotalAmt; ?></td>
                <td><?= date('d-M-Y', strtotime($row->CreatedDT)); ?></td>
                <td><?= $row->Phone; ?></td>
                <td>
                    <?php
                    if($row->Phone == 'Completed'){
                    ?>
                        <a href="<?= site_url('admin/invoice/'.$row->ID); ?>" target="_blank"><i class="fa fa-download"></i></a>
                    <?php
                    }
                    ?>
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
  $(document).ready(function() {
    $('#allTransitionTable').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      responsive: true,
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