<?php
//if(!empty($sub_category)){
    echo '<div class="widget-body" >';
    echo '<ul class="trends" >';
    $v = 0;
        foreach ($sub_category as $count=> $row):
            echo '<li><b><a href="'.site_url('category-wise/ads/' . $row->ID).'">'.$row->Name.' <span class="item-numbers" id="ads_count'.$row->ID.'"></span></a></b></li>';
            $v++;
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
        $limit = 3 - $v;
        if(sizeof($sub_category_count) >= 4){
           echo '<li><b><a href=" '. site_url('sub-category-view/'.$cat_id) .'">Show More <span class="item-numbers" ></span></a></b></li>';
       }         
    ?>

<?php
     for($i=0; $i<$limit; $i++){
                echo '<li>&nbsp;</li>';
            }
      if(sizeof($sub_category_count) < 4){
               echo '<li>&nbsp;</li>';
           }      
    echo '</ul>';
    echo '</div>';
//}
?>
