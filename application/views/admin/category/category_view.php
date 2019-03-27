<link rel="stylesheet" href="<?= base_url(); ?>theme/backend/dataTables/multi-level/css/tabelizer.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!--Tree view pattern use in add category time-->
<link href="<?= base_url(); ?>/theme/backend/tree-view/css/bootstrap-treeview.css" rel="stylesheet" />


<style>
.fileinput .thumbnail {
    max-width: 166px;
}


#default-tree .node-disabled {
    display: none;
}
</style>

<div class="content">
    <div class="content">
        <div class="container-fluid">
            <!--Button click then open table-->
            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-success" id="cat-button"><?= $category_category; ?></button>
                    <button type="button" class="btn btn-rose" id="sub-button"><?= $category_sub_category; ?></button>
                    <button type="button" class="btn btn-rose" id="form-button"><?= $category_add; ?></button>
                </div>
                <div class="col-md-6">
                    <span class="pull-right"><?= AlertMsg(); ?></span> <!--Category add then view msg -->
                </div>
            </div>

            <!--Data Table Use-->
            <div class="row">
                <!--Category Table show on left-->
                <div class="col-md-12" id="category-table">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">folder</i>
                            </div>
                            <h4 class="card-title">Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div class="material-datatables">
                                <table id="category" class="table table-striped table-no-bordered table-hover dt-responsive" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><?= $category_column_1; ?></th><!--S.No-->
                                            <th><?= $category_column_2; ?></th><!--Name-->
                                            <th><?= $category_column_3; ?></th><!--Image/icon-->
                                            <th><?= $category_column_4; ?></th><!--Created Date-->
                                            <th><?= $category_column_5; ?></th><!--Updated Date-->
                                            <th><?= $category_column_6; ?></th><!--Status-->
                                            <th class="disabled-sorting text-right"><?= $category_column_7; ?></th><!--Action-->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <!--Get data for category via DB-->
                                        <?php
                                        if($category_list){
                                            $i=0;
                                        foreach ($category_list as $count=> $value):
                                            if($value->ParentID == 0){
                                            ?>
                                        <tr>
                                            <td><?= $i+1; ?></td>
                                            <td><?= $value->Name; ?></td>
                                            <td>
                                                <img src="<?= base_url(); ?>./uploads/category/<?= $value->Icon; ?>" alt="Category Image" style="width: 100px; height: auto;">
                                            </td>
                                            <td><?= date('h:i A, d-M-Y', strtotime($value->CreatedDT)); ?></td>
                                            <td><?php if(!empty($value->LastModifiedDT)) echo date('h:i A, d-M-Y', strtotime($value->LastModifiedDT)); ?></td>
                                            <td><button class="btn btn-sm <?php if($value->StatusID == 0)
                                                {
                                                        echo 'btn-danger';
                                                }else if($value->StatusID == 1){
                                                    echo 'btn-success';
                                                }
                                                ?>" data-id="<?= $value->ID; ?>" data-status="<?= $value->StatusID; ?>" onclick="change_status(this)" type="button"><?php if($value->StatusID == 0){ echo 'Inactive'; } else if($value->StatusID == 1){ echo 'Active';}?></button>
                                            </td>
                                            <td class="text-right">
                                                <a href="<?= site_url('category_edit/'.$value->ID); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                                                <!--<a href="#" class="btn btn-link btn-danger btn-just-icon" data-id='<?= $value->ID; ?>' data-status="3" onclick="change_status(this)"><i class="material-icons">delete</i></a>-->
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                            } //parent id NULL hone pr category me dikhaye
                                        endforeach;
                                        } //before check condition then data view
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
              

                <!--Sub Category Table show on right-->
                <div class="col-md-12" style="display: none;" id="sub-category-table">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">list_alt</i>
                            </div>
                            <h4 class="card-title">Sub Category</h4>
                        </div>
                        <div class="card-body">
                            <table id="demo" class="controller table table-hover dt-responsive table-bordered">
                               
                                <tr data-level="header" class="header">
                                    <td>Name</td>
                                    <td>Icon</td>
                                    <td>Created Date</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                                
                                 <!--Category Name for rows-->
                                <?php
                                    if($json){
                                        $decode_joson = json_decode($json, true);
                                        $parent_key = 0;
                                        $data_level = 1;
                                        
                                    //  First loop
                                        foreach ($decode_joson as $jc=>$vc):
                                            echo '<tr data-level='.$data_level.' id='.$vc['id'].'>';
                                            echo '<td>'.$vc['name'].'</td>';
                                            if(!empty($vc['Icon'])){
                                                echo '<td> <img src="'.  base_url().'./uploads/category/'.$vc['Icon'].'" alt="Category Image" style="width: 80px; height: auto;"></td>';
                                            }else{
                                                echo '<td></td>';
                                            }
                                            echo '<td>'.date('h:i A, d-M-Y', strtotime($vc['CreatedDT'])).'</td>';
                                         ?>
                                            <td><button class="btn btn-sm <?php if($vc['StatusID'] == 0)
                                                {   echo 'btn-danger';   }
                                                else if($vc['StatusID'] == 1){
                                                    echo 'btn-success';
                                                }
                                                ?>" data-id="<?= $vc['id']; ?>" data-status="<?= $vc['StatusID']; ?>" onclick="change_status(this)" type="button"><?php if($vc['StatusID'] == 0){ echo 'Inactive'; } else if($vc['StatusID'] == 1){ echo 'Active';}?></button>
                                            </td>
                                            <td class="text-right">
                                                <a href="<?= site_url('category_edit/'.$vc['id']); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                                                
                                            </td>
                                        <?php
                                            //echo '<td></td>';
                                            echo '</tr>';
                                    // First condition check
                                            if(!empty($decode_joson[$jc]['nodes'])){
                                                $data_level++;
                                    //second loop
                                                foreach ($decode_joson[$jc]['nodes'] as $count => $jvalue):
                                                    //echo $jvalue['id'].'<br>';
                                                    echo '<tr data-level='.$data_level.' id='.$decode_joson[$jc]['nodes'][$count]['id'].'>';
                                                    echo '<td>'.$decode_joson[$jc]['nodes'][$count]['name'].'</td>';
                                                    if(!empty($decode_joson[$jc]['nodes'][$count]['Icon'])){
                                                        echo '<td> <img src="'.  base_url().'./uploads/category/'.$decode_joson[$jc]['nodes'][$count]['Icon'].'" alt="Category Image" style="width: 60px; height: auto;"></td>';
                                                    }else{
                                                        echo '<td></td>';
                                                    }
                                                    echo '<td>'.date('h:i A, d-M-Y', strtotime($decode_joson[$jc]['nodes'][$count]['CreatedDT'])).'</td>';
                                                 ?>
                                                    <td><button class="btn btn-sm <?php if($decode_joson[$jc]['nodes'][$count]['StatusID'] == 0)
                                                        {   echo 'btn-danger';   }
                                                        else if($decode_joson[$jc]['nodes'][$count]['StatusID'] == 1){
                                                            echo 'btn-success';
                                                        }
                                                        ?>" data-id="<?= $decode_joson[$jc]['nodes'][$count]['id']; ?>" data-status="<?= $decode_joson[$jc]['nodes'][$count]['StatusID']; ?>" onclick="change_status(this)" type="button"><?php if($decode_joson[$jc]['nodes'][$count]['StatusID'] == 0){ echo 'Inactive'; } else if($decode_joson[$jc]['nodes'][$count]['StatusID'] == 1){ echo 'Active';}?></button>
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="<?= site_url('category_edit/'.$decode_joson[$jc]['nodes'][$count]['id']); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                                                    </td>
                                                <?php
                                                    echo '</tr>';
                                    //second condition check
                                                            if(!empty($decode_joson[$jc]['nodes'][$count]['nodes'])){
                                                                $data_level++;
                                            //third loop
                                                                foreach ($decode_joson[$jc]['nodes'][$count]['nodes'] as $count2 => $jvalue2):
                                                                    echo '<tr data-level='.$data_level.' id='.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['id'].'>';
                                                                    echo '<td>'.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['name'].'</td>';
                                                                    if(!empty($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['Icon'])){
                                                                        echo '<td> <img src="'.  base_url().'./uploads/category/'.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['Icon'].'" alt="Category Image" style="width: 40px; height: auto;"></td>';
                                                                    }else{
                                                                        echo '<td></td>';
                                                                    }
                                                                    echo '<td>'.date('h:i A, d-M-Y', strtotime($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['CreatedDT'])).'</td>';
                                                                 ?>
                                                                    <td><button class="btn btn-sm <?php if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['StatusID'] == 0)
                                                                        {   echo 'btn-danger';   }
                                                                        else if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['StatusID'] == 1){
                                                                            echo 'btn-success';
                                                                        }
                                                                        ?>" data-id="<?= $decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['id']; ?>" data-status="<?= $decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['StatusID']; ?>" onclick="change_status(this)" type="button"><?php if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['StatusID'] == 0){ echo 'Inactive'; } else if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['StatusID'] == 1){ echo 'Active';}?></button>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <a href="<?= site_url('category_edit/'.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['id']); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                                                                    </td>
                                                                <?php
                                                                    echo '</tr>';
                                                //third condition check
                                                                            if(!empty($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'])){
                                                                                $data_level++;
                                                                                foreach ($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'] as $count3 => $jvalue3):
                                                                //fourth loop
                                                                                    echo '<tr data-level='.$data_level.' id='.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['id'].'>';
                                                                                    echo '<td>'.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['name'].'</td>';
                                                                                    if(!empty($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['Icon'])){
                                                                                        echo '<td> <img src="'.  base_url().'./uploads/category/'.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['Icon'].'" alt="Category Image" style="width: 30px; height: auto;"></td>';
                                                                                    }else{
                                                                                        echo '<td></td>';
                                                                                    }
                                                                                    echo '<td>'.date('h:i A, d-M-Y', strtotime($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['CreatedDT'])).'</td>';
                                                                                 ?>
                                                                                    <td><button class="btn btn-sm <?php if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['StatusID'] == 0)
                                                                                        {   echo 'btn-danger';   }
                                                                                        else if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['StatusID'] == 1){
                                                                                            echo 'btn-success';
                                                                                        }
                                                                                        ?>" data-id="<?= $decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['id']; ?>" data-status="<?= $decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['StatusID']; ?>" onclick="change_status(this)" type="button"><?php if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['StatusID'] == 0){ echo 'Inactive'; } else if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['StatusID'] == 1){ echo 'Active';}?></button>
                                                                                    </td>
                                                                                    <td class="text-right">
                                                                                        <a href="<?= site_url('category_edit/'.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['id']); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                                                                                    </td>
                                                                                <?php
                                                                                    echo '</tr>';
                                                                    
                                                                                    //fourth condition check
                                                                                               if(!empty($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'])){
                                                                                                   $data_level++;
                                                                                                   foreach ($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'] as $count4 => $jvalue4):
                                                                                   //fivth loop
                                                                                                       echo '<tr data-level='.$data_level.' id='.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['id'].'>';
                                                                                                       echo '<td>'.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['name'].'</td>';
                                                                                                       if(!empty($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['Icon'])){
                                                                                                           echo '<td> <img src="'.  base_url().'./uploads/category/'.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['Icon'].'" alt="Category Image" style="width: 30px; height: auto;"></td>';
                                                                                                       }else{
                                                                                                           echo '<td></td>';
                                                                                                       }
                                                                                                       echo '<td>'.date('h:i A, d-M-Y', strtotime($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['CreatedDT'])).'</td>';
                                                                                                    ?>
                                                                                                       <td><button class="btn btn-sm <?php if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['StatusID'] == 0)
                                                                                                           {   echo 'btn-danger';   }
                                                                                                           else if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['StatusID'] == 1){
                                                                                                               echo 'btn-success';
                                                                                                           }
                                                                                                           ?>" data-id="<?= $decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['id']; ?>" data-status="<?= $decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['StatusID']; ?>" onclick="change_status(this)" type="button"><?php if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['StatusID'] == 0){ echo 'Inactive'; } else if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['StatusID'] == 1){ echo 'Active';}?></button>
                                                                                                       </td>
                                                                                                       <td class="text-right">
                                                                                                           <a href="<?= site_url('category_edit/'.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['id']); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                                                                                                       </td>
                                                                                                   <?php
                                                                                                       echo '</tr>';
                                                                            
                                                                                                    //fiveth condition check
                                                                                                                    if(!empty($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'])){
                                                                                                                        $data_level++;
                                                                                                                        foreach ($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'] as $count5 => $jvalue5):
                                                                                                        //six loop
                                                                                                                            echo '<tr data-level='.$data_level.' id='.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'][$count5]['id'].'>';
                                                                                                                            echo '<td>'.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'][$count5]['name'].'</td>';
                                                                                                                            if(!empty($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'][$count5]['Icon'])){
                                                                                                                                echo '<td> <img src="'.  base_url().'./uploads/category/'.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'][$count5]['Icon'].'" alt="Category Image" style="width: 30px; height: auto;"></td>';
                                                                                                                            }else{
                                                                                                                                echo '<td></td>';
                                                                                                                            }
                                                                                                                            echo '<td>'.date('h:i A, d-M-Y', strtotime($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'][$count5]['CreatedDT'])).'</td>';
                                                                                                                         ?>
                                                                                                                            <td><button class="btn btn-sm <?php if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'][$count5]['StatusID'] == 0)
                                                                                                                                {   echo 'btn-danger';   }
                                                                                                                                else if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'][$count5]['StatusID'] == 1){
                                                                                                                                    echo 'btn-success';
                                                                                                                                }
                                                                                                                                ?>" data-id="<?= $decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'][$count5]['id']; ?>" data-status="<?= $decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'][$count5]['StatusID']; ?>" onclick="change_status(this)" type="button"><?php if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'][$count5]['StatusID'] == 0){ echo 'Inactive'; } else if($decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'][$count5]['StatusID'] == 1){ echo 'Active';}?></button>
                                                                                                                            </td>
                                                                                                                            <td class="text-right">
                                                                                                                                <a href="<?= site_url('category_edit/'.$decode_joson[$jc]['nodes'][$count]['nodes'][$count2]['nodes'][$count3]['nodes'][$count4]['nodes'][$count5]['id']); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                                                                                                                            </td>
                                                                                                                        <?php
                                                                                                                            echo '</tr>';
                                                                                                        endforeach;
                                                                                                        $data_level--;
                                                                                                    }
                                                                                        endforeach;
                                                                                        $data_level--;
                                                                                    }
                                                                        endforeach;
                                                                        $data_level--;
                                                                    }
                                                            endforeach;
                                                            $data_level--;
                                                        }
                                                endforeach;
                                                $data_level--;
                                            }
                                        
                                        endforeach;
                                    }
                                ?>
                              
                            </table>
                            
                            
                        </div>
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-md-6 -->
            </div>
            <!-- end row -->
            <!--Category Form new add category-->
            <div class="row" id="two-form" style="display: none;">
                <div class="col-md-12">
                    <label>Category and Sub Category Create Form</label>
                </div>
                <div class="col-md-12">
                    <!--Category Add form-->
                    <form action="<?= site_url('category_add'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="card ">
                            <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">folder</i>
                                </div>
                                <h4 class="card-title"><?= $category_add_category; ?>
                                    
                                </h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating"> <?= $category_add_placeholder_name; ?></label>
                                                    <input type="text" class="form-control" name="category" required="">
                                                    <div style="color:red;"><?= form_error('category'); ?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 mt-3">
                                                <div class="form-check form-check-inline pull-right" id="popular">
                                                    <label class="form-check-label">
                                                        <input type="hidden" name="popular" value="0">
                                                        <input class="form-check-input" type="checkbox" name="popular" value="1"> <?= $category_add_checkbox; ?>
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--using popup box open-->
                                        &nbsp;<br>
                                        <div class="row">
                                            <div class="col-md-11">
                                               <div class="form-group">
                                                    <label class="bmd-label-floating"> Category Select </label>
                                                    <input type="hidden" id="category_id" name="category_id">
                                                    <input type="text" class="form-control" id="category_view" data-target="#bootstrap-modal" data-toggle="modal" readonly="" style="background-color: white;">
                                                </div>
<!--                                                <button type="button" class="btn btn-rose btn-round"  data-target="#bootstrap-modal" data-toggle="modal"><i class="material-icons">folder</i> Select Category</button>-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--Image div start-->
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="bmd-label-floating"><?= $category_image; ?></label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput" >
                                                            <div class="fileinput-new thumbnail">
                                                                <img src="<?= base_url(); ?>theme/backend/assets/img/image_placeholder.jpg" alt="Category Image" style="height: 100px; width: auto;">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                            <div>
                                                                <span class="btn btn-rose btn-round btn-file">
                                                                    <span class="fileinput-new">Select image</span>
                                                                    <span class="fileinput-exists">Change</span>
                                                                    <input type="file" name="category_image" id="category_image" required="" accept="image/x-png,image/gif,image/jpeg"/>
                                                                </span>
                                                                <a href="#" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Image div end-->
                                </div>
                               
                                <div class="category form-category"> <?= $category_add_required_field; ?> </div>
                                
                            </div>
                            <div class="card-footer text-right">
                                
                                <button type="submit" class="btn btn-rose"><?= $category_submit; ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--Category Form new add category-->

        </div>
    </div>
</div>

<!--Category select popup div start-->
            <div id="bootstrap-modal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3>Select Category</h3>
                        </div>
                        
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="input" class="form-control" id="input-search" placeholder="Search Category..." value="">
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-sm btn-default" id="btn-clear-search">Clear</button>
                                </div>
                            </div>
                            <br>
                            
                            <div style="width: 100%; height: 350px; border: 1px solid lightgray; overflow-y: scroll; overflow-x: hidden;">
                                
                            <!--tree view pattern start div-->
                                <div id="default-tree" class="treeview"></div>
                            <!--tree view pattern end div-->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>-->
                            <button type="button" class="btn btn-default ok" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Category select popup div end-->

<!--   Core JS Files   -->
<script src="<?= base_url(); ?>theme/backend/assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>theme/backend/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>theme/backend/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/perfect-scrollbar.jquery.min.js" ></script>
<!-- Plugin for the momentJs  -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery.validate.min.js"></script>
<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/bootstrap-selectpicker.js" ></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery.dataTables.min.js"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/bootstrap-tagsinput.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/fullcalendar.min.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery-jvectormap.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/nouislider.min.js" ></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/arrive.min.js"></script>
<!--  Google Maps Plugin    -->
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="http://buttons.github.io/buttons.js"></script>
<!-- Chartist JS -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= base_url(); ?>theme/backend/assets/js/material-dashboard.min40a0.js?v=2.0.2" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?= base_url(); ?>theme/backend/assets/demo/demo.js"></script>


<!--tree view table script-->
<script src="<?= base_url(); ?>theme/backend/dataTables/multi-level/js/jquery.tabelizer.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>  
<!--Category Table in Active and deactive ajax-->
<script>
function change_status(current){
        var id = $(current).data('id');
        var status = $(current).data('status');
        //alert(status);
        if(status == 1){
            $.ajax({
                url:'<?= site_url('category_change_st'); ?>',
                type:'post',
                data:{id:id, value: '0'},
                success:function(data){
                   // alert(data);
                    $(current).removeClass('btn-success');
                    $(current).addClass('btn-danger');
                    $(current).text('Inactive');
                    $(current).data('status',0);
                   var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                              notify.update({'type': 'danger', 'message': '<strong>Success</strong> Category Inactive'});
                                //window.location.reload();
                        }, 1000);
                }
            });
        }else if(status == 0){
            $.ajax({
                url:'<?= site_url('category_change_st'); ?>',
                type:'POST',
                data:{id:id, value: '1'},
                success:function(data){
                   // alert('data');
                    $(current).removeClass('btn-danger');
                    $(current).addClass('btn-success');
                    $(current).text('Active');
                    $(current).data('status',1);
                   var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                              notify.update({'type': 'success', 'message': '<strong>Success</strong> Category Active'});
                                //window.location.reload();
                        }, 1000);
                }
            });
         //delete
        }
//        else if(status == 3){
//                  // alert('delete');     
//            $.confirm({
//                //animation: 'zoom',
//                icon:'fa fa-warning',
//                title: 'Delete Category',
//                content: 'This Category and all associated data will be deleted. This is not reversible.',
//                theme: 'modern',
//                buttons: {
//                    confirm: function () {
//                       
//                       $.ajax({
//                            url:'<?= site_url('advertiser_change_status'); ?>',
//                            type:'POST',
//                            data:{id:id, value: '3'},
//                            success:function(data){
//                               // alert('delete');
//                                $.confirm({
//                                   //animation: 'zoom',
//                                    icon:'fa fa-check-circle',
//                                    title: 'Category Deleted',
//                                    content: 'The selected Category and associated data was deleted.',
//                                    theme: 'modern',
//                                    buttons:{
//                                        Ok: function(){
//                                            window.location.reload();
//                                        }
//                                    }
//                               });
//                            }
//                        });
//                       
//                    },
//                    cancel: function () {
//                        //$.alert('Canceled!');
//                    },
//                    
//                }
//            });
//        }
    }
</script>

<!--Click button then open required-->
<script>
    $(document).ready(function () {
        $('#cat-button').click(function () {
            $('#category-table').show('slow');
            $('#sub-category-table').hide('slow');
            $('#two-form').hide('slow');
            $(this).removeClass('btn-rose');
            $('#sub-button').removeClass('btn-success');
            $('#sub-button').addClass('btn-rose');
            $('#form-button').removeClass('btn-success');
            $('#form-button').addClass('btn-rose');
            $(this).addClass('btn-success');
        });

        $('#sub-button').click(function () {
            $('#category-table').hide('slow');
            $('#sub-category-table').show('slow');
            $('#two-form').hide('slow');
            $(this).removeClass('btn-rose');
            $(this).addClass('btn-success');
            $('#cat-button').removeClass('btn-success');
            $('#cat-button').addClass('btn-rose');
            $('#form-button').removeClass('btn-success');
            $('#form-button').addClass('btn-rose');
        });

        $('#form-button').click(function () {
            $('#category-table').hide('slow');
            $('#sub-category-table').hide('slow');
            $('#two-form').show('slow');
            $(this).removeClass('btn-rose');
            $(this).addClass('btn-success');
            $('#cat-button').removeClass('btn-success');
            $('#cat-button').addClass('btn-rose');
            $('#sub-button').removeClass('btn-success');
            $('#sub-button').addClass('btn-rose');
        });
    });
</script>

<!--Datatable scripting useing at dashboard-->
<script>
    $(document).ready(function () {
        $('#category').DataTable({
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


<!--Tree view type table using-->
<script>
$(document).ready(function(){
$('#demo').tabelize({

  onRowClick : self.rowClicker,

  //must be set before init
  fullRowClickable : true,

  // callbacks
  onBeforeRowClick : null,
  onAfterRowClick : null,
  onReady : null

  }); 
});
</script>

<script src="<?= base_url(); ?>/theme/backend/tree-view/js/bootstrap-treeview.js"></script>
<!--Tree view pattern json-->
<script type="text/javascript">
$(document).ready(function(){
   var tree;
   $.ajax({
        type: "GET",  
        url: "<?= site_url('/getItem'); ?>",
        dataType: "json",       
        success: function(response)  
        {
           initTree(response);
        }   
  });
  
     
function initTree(tree) {
     // return tree;
    $('#default-tree').treeview({
        data: tree,
        levels: 1,
        
         // custom icons
  expandIcon: 'fa fa-plus',
  collapseIcon: 'fa fa-minus',
//  emptyIcon: 'fa',
//  nodeIcon: '',
//  selectedIcon: '',
//  checkedIcon: 'fa fa-check',
//  uncheckedIcon: 'fa fa-unchecked',
//
//  // colors
//  color: undefined, // '#000000',
//  backColor: undefined, // '#FFFFFF',
//  borderColor: undefined, // '#dddddd',
//  onhoverColor: '#F5F5F5',
//  selectedColor: '#FFFFFF',
//  selectedBackColor: '#428bca',
//  searchResultColor: '#D9534F',
//  searchResultBackColor: undefined, //'#FFFFFF',
    });
    
  }
  
  //search value
  var selectors = {
        'tree': '#default-tree',
        'input': '#input-search',
        'reset': '#btn-clear-search'
    };
    var lastPattern = ''; 
    // closure variable to prevent redundant operation

    // collapse and enable all before search //
    function reset(tree) {
        tree.collapseAll();
        tree.enableAll();
    }

    // find all nodes that are not related to search and should be disabled:
    // This excludes found nodes, their children and their parents.
    // Call this after collapsing all nodes and letting search() reveal.
    //
    function collectUnrelated(nodes) {
        var unrelated = [];
        $.each(nodes, function (i, n) {
            if (!n.searchResult && !n.state.expanded) { // no hit, no parent
                unrelated.push(n.nodeId);
            }
            if (!n.searchResult && n.nodes) { // recurse for non-result children
                $.merge(unrelated, collectUnrelated(n.nodes));
            }
        });
        return unrelated;
    }

    // search callback
    var search = function (e) {
        var pattern = $(selectors.input).val();
        //alert(pattern);
        if (pattern === lastPattern) {
            return;
        }
        lastPattern = pattern;
        var tree = $(selectors.tree).treeview(true);
       
        if (pattern.length < 2) { // avoid heavy operation
            reset(tree);
            tree.clearSearch();
        } else {
            tree.search(pattern);
            // get all root nodes: node 0 who is assumed to be
            //   a root node, and all siblings of node 0.
            var roots = tree.getSiblings(0);
            roots.push(tree.getNode(0));
            //first collect all nodes to disable, then call disable once.
             //  Calling disable on each of them directly is extremely slow! 
            var unrelated = collectUnrelated(roots);
            tree.disableNode(unrelated, {silent: true});
        }
    };

    // typing in search field
    $(selectors.input).on('keyup', search);

    // clear button
    $(selectors.reset).on('click', function (e) {
        $(selectors.input).val('');
        var tree = $(selectors.tree).treeview(true);
        reset(tree);
        tree.clearSearch();
    });
   
});
</script>

<!--Open popup box and slect category and sub category and ok button click then set value-->
<script>
$('.ok').on('click', function(e){
    //alert($("#default-tree ul li.node-selected").text());
    var vt = $("#default-tree ul li.node-selected").text();
    var id = $("#default-tree ul li.node-selected i").data('id');
    //var vt = $("#default-tree ul li.node-selected").text();
   // $('#category_view').val(vt);
    $('#category_id').val(id);
    //alert(id);
    $.ajax({
        url:'<?= site_url('brand_kram'); ?>',
        type:'post',
        data:{catid:id},
        success:function(data){
            $('#category_view').val(data);
            $('#category_image').removeAttr('required');
            $('#popular').empty();
        }
    });
});

</script>

 <!--popup box open start--> 
<script>
$("#bootstrap-modal").on("shown.bs.modal", function() {
  
  
}).on("hidden.bs.modal", function() {
  
});

</script>
<!--popup box open end--> 