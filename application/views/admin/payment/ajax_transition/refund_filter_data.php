<table id="refundPendingTable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Advertiser ID</th>
            <th>Advertisement ID</th>
            <th>TXT ID</th>
            <th>Amount</th>
            <th>Request Date</th>
            <th>Status</th>
            <?php
            if($done){
                ?>
            <th class="disabled-sorting text-right">Actions</th>
            <?php
            }
            ?>
        </tr>
    </thead>

    <tbody>
        <?php
        if($refund){
            foreach ($refund as $count=>$row):
                ?>
        <tr>
            <td><?= $count+1; ?></td>
            <td><?= $row->FirstName.' '.$row->LastName; ?></td>
            <td><?= $row->BusinessName; ?></td>
            <td><?= $row->TxtID; ?></td>
            <td><?= $row->Amt; ?></td>
            <td><?= date('h:i A, d-M-Y', strtotime($row->CreatedDT)); ?></td>
            <td>
                <?php
                if($row->Status == 0){
                    $btn = 'btn-warning';
                    $text = 'Pending';
                }else if($row->Status == 1){
                    $btn = 'btn-success';
                    $text = 'Success';
                }else if($row->Status == 2){
                    $btn = 'btn-danger';
                    $text = 'Rejected';
                }
                ?>
               <span class="<?= $btn; ?> btn" style="border-radius: 10px; padding: 5px;"> &nbsp;<?= $text; ?>&nbsp; </span>
            </td>
            <?php
            if($done){
                ?>
            <td class="text-right">
                <a href="<?= site_url('admin/view_ad/'.$row->adid); ?>" target="_blank" class="btn btn-link btn-info btn-just-icon" title="View ad"><i class="material-icons">visibility</i></a>
                <button class="btn btn-link btn-success btn-just-icon" 
                        data-target="#bootstrap-modal" 
                        data-toggle="modal" 
                        data-status="1"
                        data-payid="<?= $row->PayID; ?>"
                        data-id="<?= $row->ID; ?>"
                                                                                data-txtid="<?= $row->TxtID; ?>"
                        data-adname="<?= $row->BusinessName; ?>"
                        data-usermsg="<?= $row->UserMsg; ?>"
                        data-name="<?= $row->FirstName . ' ' . $row->LastName; ?>" onclick="submit_req(this)" type="button">
                    <i class="material-icons">done</i>
                </button>
                <button class="btn btn-link btn-danger btn-just-icon" 
                        data-target="#bootstrap-modal" 
                        data-toggle="modal" 
                        data-status="2"
                        data-payid="<?= $row->PayID; ?>"
                        data-id="<?= $row->ID; ?>"
                                                                                data-txtid="<?= $row->TxtID; ?>"
                        data-adname="<?= $row->BusinessName; ?>"
                        data-usermsg="<?= $row->UserMsg; ?>"
                        data-name="<?= $row->FirstName . ' ' . $row->LastName; ?>" onclick="submit_req(this)" type="button">
                    <i class="material-icons">close</i>
                </button>

                <!--<a href="#" class="btn btn-danger btn-just-icon "><i class="material-icons">close</i></a>-->
            </td>
            <?php
            }
            ?>
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
    $('#refundPendingTable').DataTable({
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