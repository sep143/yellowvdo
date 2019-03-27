<table id="role_user2" class="table table-hover dt-responsive" cellspacing="0" width="100%" style="width:100%">
    <thead>
        <tr>
            <th>S.No. &nbsp;</th>
            <th>Date</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role </th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($user_role) {
            foreach ($user_role as $count => $value):
                ?>
                <tr>
                    <td><?= $count + 1; ?></td>
                    <td><?= date('h:i A, d-M-Y', strtotime($value->CreatedDT)); ?></td>
                    <td><?= $value->FirstName . ' ' . $value->LastName; ?></td>
                    <td><?= $value->UserName; ?></td>
                    <td><?= $value->Role; ?></td>
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
                        <a href="<?= site_url('admin/setting/edit_role_user/' . $value->ID); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                        <a href="#" class="btn btn-link btn-danger btn-just-icon" data-id='<?= $value->ID; ?>' data-status="3" onclick="change_status(this)"><i class="material-icons">delete</i></a>
                    </td>
                </tr>
        <?php
    endforeach;
}
?>

    </tbody>
</table>


<script>
        $(document).ready(function () {
            $('#role_user2').DataTable({
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
                }
            });

        });
    </script>