<!--Data Table Use-->
            <div class="row">
                <!--Category Table show on left-->
                <div class="col-md-12" id="category-table">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">folder</i>
                            </div>
                            <h4 class="card-title"><?= $table_name; ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <!--filter start-->
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div style="background-color: #eee; padding: 1px; color: black;">
                                        <div class="row">
                                            <div class="col-lg-1 col-md-1 col-sm-3 col-xs-12 ">
                                                <!--id select column-->
                                                <div class="dropdown">
                                                    <a style="color: black;" class="nav-link" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <!--<i class="material-icons">mail</i>-->
                                                        <span class="notification">Filter</span>
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="col-md-11 col-xs-12 col-sm-9">
                                                <div class="row">
                                                    <div class="col-md-1 col-xs-12 col-sm-4">
                                                        <!--id select column-->
                                                        <div class="dropdown">
                                                            <a style="color: black;" class="nav-link" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <!--<i class="material-icons">mail</i>-->
                                                                <span class="notification">ID &nbsp;<i class="fa fa-caret-down"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink2">
                                                                <!--<a class="dropdown-item" href="#">Mike John responded to your email</a>-->
                                                                <div class="input-group input-group-sm" style="padding-left: 10px; padding-right: 10px;">
                                                                    <input type="text" class="form-control" placeholder="ID">&nbsp;&nbsp;
                                                                    <div class="input-group-prepend" >
                                                                        <span class="input-group-text" style="cursor: pointer; color: skyblue;"><i class="fa fa-close"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-xs-12 col-sm-4">
                                                        <!--datepicker column-->
                                                        <div class="dropdown">
                                                            <a style="color: black;" class="nav-link" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <!--<i class="material-icons">mail</i>-->
                                                                <span class="notification">Date Range &nbsp;<i class="fa fa-caret-down"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink2" style="min-width: 200%;">
                                                                <!--<a class="dropdown-item" href="#">Mike John responded to your email</a>-->
                                                                <div class="input-group input-group-sm" style="padding-left: 10px; padding-right: 10px;">
                                                                    <small style="margin-top: 5px;">From</small> &nbsp;&nbsp; <input type="text" class="form-control datepicker" value="10/06/2018">&nbsp;&nbsp;
                                                                    <small style="margin-top: 5px;">To</small>&nbsp;&nbsp;
                                                                    <input type="text" class="form-control datepicker" value="10/06/2018">
                                                                    <div class="input-group-prepend" >
                                                                        <span class="input-group-text" style="cursor: pointer; color: skyblue;"><i class="fa fa-arrow-right"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-md-2 col-xs-12 col-sm-4">
                                                        <!--id select column-->
                                                        <div class="dropdown">
                                                            <a style="color: black;" class="nav-link" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <!--<i class="material-icons">mail</i>-->
                                                                <span class="notification">TXT ID &nbsp;<i class="fa fa-caret-down"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink2">
                                                                <!--<a class="dropdown-item" href="#">Mike John responded to your email</a>-->
                                                                <div class="input-group input-group-sm" style="padding-left: 10px; padding-right: 10px;">
                                                                    <input type="text" class="form-control" placeholder="TXT ID">&nbsp;&nbsp;
                                                                    <div class="input-group-prepend" >
                                                                        <span class="input-group-text" style="cursor: pointer; color: skyblue;"><i class="fa fa-close"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-2 col-xs-1 col-sm-1">
                                                        <div class="dropdown">
                                                            <a style="color: black;" class="nav-link" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <!--<i class="material-icons">mail</i>-->
                                                                <span class="notification">Status &nbsp;<i class="fa fa-caret-down"></i></span>
                                                            </a>
                                                            <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink2" style="min-width: 180%;">
                                                                <!--<a class="dropdown-item" href="#">Mike John responded to your email</a>-->
                                                                <div class="input-group input-group-sm" style="padding-left: 10px; padding-right: 10px;">
                                                                    <ul class="list-group">
                                                                        <li class="list-group-item">Pending</li>
                                                                        <li class="list-group-item">Success</li>
                                                                        <li class="list-group-item">Rejected</li>
                                                                        <li class="list-group-item">All</li>
                                                                        
                                                                    </ul>
<!--                                                                    <div class="input-group-prepend" >
                                                                        <span class="input-group-text" style="cursor: pointer; color: skyblue;"><i class="fa fa-close"></i></span>
                                                                    </div>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--filter end-->
                            <div class="material-datatables">
                                <table id="transition" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Advertiser ID</th>
                                            <th>Advertisement ID</th>
                                            <th>TXT ID</th>
                                            <th>Amount</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if($refund){
                                            foreach ($refund as $count=>$row):
                                                ?>
                                        <tr>
                                            <td><?= $count+1; ?></td>
                                            <td><?= $row->UserID; ?></td>
                                            <td><?= $row->AdsID; ?></td>
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
                                            <td class="text-right">
                                                <a href="#" class="btn btn-link btn-success btn-just-icon "><i class="material-icons">edit</i></a>
                                                <a href="#" class="btn btn-link btn-danger btn-just-icon "><i class="material-icons">delete</i></a>
                                            </td>
                                        </tr>
                                        <?php
                                            endforeach;
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-md-6 -->

            </div>
            <!-- end row -->
            


            
<!--Datatable scripting useing at dashboard-->
<script>
  $(document).ready(function() {
    $('#transition').DataTable({
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