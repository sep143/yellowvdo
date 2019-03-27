<div class="material-datatables table-responsive" id="advertiser_ads">
    <table id="advertisement" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Date</th>
                <th>TextID</th>
                <th>Amount</th>
                <th>Business Name</th>
                <th>Status</th>
                <th>Invoice</th>
                <!--<th>Action</th>-->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($advertiser_trans) {
                foreach ($advertiser_trans as $count => $value):
                    ?>
                    <tr>
                        <td><?= $count + 1; ?></td>
                        <td><?= date('d-M-Y', strtotime($value->date)); ?></td>
                        <td><?= $value->TxtID; ?></td>
                        <td><?= $value->Amt; ?></td>
                        <td><?= $value->BusinessName; ?></td>
                        <td><?= $value->Phone; ?></td>
                        <td>
                            <?php
                            if($value->Phone == 'Completed'){
                            ?>
                            <a href="<?= site_url('admin/invoice/'.$value->transID); ?>" target="_blank"><i class="fa fa-download"></i></a>
                            <?php
                            }
                            ?>
                        </td>
                        <!--<td>-</td>-->
                    </tr>
                    <?php
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