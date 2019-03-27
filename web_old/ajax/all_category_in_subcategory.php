<?php
//echo '<div class="widget-body">';
echo '<ul class="trends" >';
    $v = 0;
    
    foreach ($sub_category as $row):
        echo '<li><a href="'.site_url('category-wise/ads/' . $row->ID).'">'.$row->Name.' <small class="item-numbers1 pull-right" id="ads_count'.$row->ID.'"></small></a></li>';
       // echo '<li>'.$v.'</li>';
        $v++;
    endforeach;
    
    $limit = 7 - $v;
        if(sizeof($sub_category_count) >= 8){
           echo '<li><a href=" '. site_url('sub-category-view/'.$cat_id) .'">Show More <span class="item-numbers" ></span></a></li>';
       }         
//    
     for($i=0; $i<$limit; $i++){
                echo '<li><a href="javascript:void(0)">&nbsp;</a></li>';
            }
      if(sizeof($sub_category_count) < 8){
               echo '<li><a href="javascript:void(0)">&nbsp;</a></li>';
           } 
    
    echo '</ul>';
//    echo '</div>';
    
    foreach ($sub_category as $row):
        ?>
<script>
    $(document).ready(function(){
        var id = <?= $row->ID; ?>;
        $.ajax({
            url:'<?= site_url('ads_count'); ?>',
            type:'post',
            data:{id:id},
            success:function(data){
                $('#ads_count'+id).html(data);
            }
        });

    });
</script>
<?php
    endforeach;
?>