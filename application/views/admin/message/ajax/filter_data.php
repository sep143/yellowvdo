<table id="message" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <!--<th>Advertiser ID</th>-->
            <th>Email</th>
            <th>Country</th>
            <th>Phone No.</th>
            <th>Status</th>
            <th>Received</th>
            <!--<th class="disabled-sorting text-right">Actions</th>-->
        </tr>
    </thead>

    <tbody>
        <?php
        if ($chat) {
            foreach ($chat as $count => $row):
                ?>
                <tr class="click-msg" style="cursor: pointer;" data-id="<?= $row->chatID; ?>" data-adid="<?= $row->AdsID; ?>" 
                    data-name='<?= $row->FirstName . ' ' . $row->LastName; ?>'
                    data-userid='<?= $row->user_id; ?>'>
                    <td><?= $count + 1; ?></td>
                    <td><?= $row->FirstName . ' ' . $row->LastName; ?></td>
                    <td><?= $row->UserName; ?></td>
                    <td><?= $row->Country; ?></td>
                    <td>+<?= $row->CountryCode . '-' . $row->Phone; ?></td>

                    <td><button class="btn btn-sm <?php
                        if ($row->stID == 0) {
                            echo 'btn-danger';
                        } else if ($row->stID == 1) {
                            echo 'btn-success';
                        }
                        ?>" type="button"><?php if ($row->stID == 0) {
                            echo 'Inactive';
                        } else if ($row->stID == 1) {
                            echo 'Active';
                        } ?></button>
                    </td>
                    <td>
                        <?php
                        if ($row->NotifyAdmin == 0) {
                            $btn = 'btn-primary';
                            $text = 'Read';
                        } else if ($row->NotifyAdmin == 1) {
                            $btn = 'btn-success';
                            $text = 'Unread';
                        }
                        ?>
                        <span class="<?= $btn; ?>" style="border-radius: 10px; padding: 5px;"> &nbsp;<?= $text; ?>&nbsp; </span>
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
            $('#message').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }
            });

        });
    </script>
    
    <script>
$(document).ready(function(){
    $('.click-msg').click(function(){
        var id = $(this).data('id');
        var adid = $(this).data('adid');
        var name = $(this).data('name');
        var userID = $(this).data('userid');
       // alert('user-'+userID);
        $.ajax({
           url:'<?= site_url('chatting'); ?>',
           type:'post',
           data:{chat:'chat', name:name, user_id:userID},
           success:function(data){
               //alert('hello');
               $('#starting').hide();
               $('#chatUser').hide();
               $('#back').show();
               $('#dataAjax').html(data);
           }
        });
    });
});
</script>