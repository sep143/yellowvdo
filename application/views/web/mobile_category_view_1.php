<!-- Bootstrap CSS -->
        <link href="<?= base_url(); ?>theme/web/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= base_url(); ?>theme/web/css/style.css" rel="stylesheet">
        <link href="<?= base_url(); ?>theme/web/css/custome.css" rel="stylesheet">
        <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">-->
        <link href="https://cdn.jsdelivr.net/npm/patternfly-bootstrap-treeview@2.1.5/dist/bootstrap-treeview.css" rel="stylesheet">
       
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="<?= base_url(); ?>theme/web/plugins/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="<?= base_url(); ?>theme/web/plugins/owl-carousel/owl.theme.css">

        <!-- Font Awesome -->
        <link href="<?= base_url(); ?>theme/web/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        <style>
            #default-tree .node-disabled {
                display: none;
            }
            body{
                zoom: 80%;
                    color: #1f1f1f;
                    font-family: 'Lato', sans-serif;
                    font-size: 18px;
                    line-height: 25px;
            }
            .list-group-item {
                padding-left: 20px;
                padding-right: 20px;
            }
            .fa{
                font-size: 20px;
            }
            
         .loader,
        .loader:after {
            border-radius: 50%;
            width: 7em;
            height: 7em;
        }
        .loader {    
            margin: 250px auto;
            font-size: 5px;
           // position: relative;
            text-indent: -9999em;
            border-top: 0.5em solid rgba(255, 255, 255, 0.2);
            border-right: 0.5em solid rgba(255, 255, 255, 0.2);
            border-bottom: 0.5em solid rgba(255, 255, 255, 0.2);
            border-left: 0.5em solid #526f38;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
        }
        .btn-primary1{
            color: #000;
            background-color: #fbd800;
            border-color: transparent;
            font-weight: 800;
        }
        .btn{
            border-radius: 0px;
            //height: 40px;
            //font-weight: 990;
            font-size: 18px;
            vertical-align: middle;
        }
        
        @-webkit-keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        #loadingDiv {
            position:absolute;;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background-color: #FFF;
        }
        </style>
        
        <body>
            
            <section class="single-detail">
                <div class="container">
                    <div class="row">
                        <div class="">

                            <div class="col-sm-12 col-xs-12">
                                <form action="" method="get" id="catid">
                                    <input type="hidden" name="catid" id="category_id">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <input type="input" class="form-control" id="input-search" placeholder="Search Category..." value="" aria-describedby="basic-addon1">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <!--<button type="button" class="btn btn-default" id="btn-clear-search">&nbsp;<i class="fa fa-close"></i> &nbsp;</button>-->
<!--                                                        <button type="button" class="btn btn-default ok" data-dismiss="modal">OK</button>-->
                                                    </div>
                                                </div>
                                                
                                             
                                              <!--<input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">-->
                                            </div>
                                            
                                        </div>
                                        <br>

                                        <div style="width: 100%; height: 550px; border: 1px solid lightgray; overflow-y: scroll; overflow-x: hidden;">
                                            <!--tree view pattern start div-->
                                            <div id="default-tree" class="treeview" ></div>
                                            <!--tree view pattern end div-->
                                        </div>
                                        <div class="row" style="margin-top: 5px;">
                                            <div class="col-xs-12">
                                                <button type="button" class="btn btn-primary1 btn-block ok" data-dismiss="modal">OK</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>-->
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </section>
            
            
        </body>      
        
        <script>
            
        $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
        $(window).on('load', function(){
          setTimeout(removeLoader, 2000); //wait for page load PLUS two seconds.
        });
        function removeLoader(){
            $( "#loadingDiv" ).fadeOut(500, function() {
              // fadeOut complete. Remove the loading div
              $( "#loadingDiv" ).remove(); //makes page more lightweight 
          });  
        }
        </script>
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/patternfly-bootstrap-treeview@2.1.5/dist/bootstrap-treeview.js"></script>-->
        <script src="<?= base_url(); ?>theme/backend/tree-view/js/bootstrap-treeview-v2.js"></script>
        <!--<script src="<?= base_url(); ?>theme/backend/tree-view/js/bootstrap-treeview.js"></script>-->
<script>
$(document).ready(function(){
   var tree;
   $.ajax({
        type: "GET",  
        url: "<?= site_url('getItem'); ?>",
        dataType: "json",       
        success: function(response)  
        {
           initTree(response);
        }   
  });
    
function initTree(tree) {
    var onTreeNodeSelected = function (event, data) {
        console.log("onTreeNodeSelected"+data+'other E - '+event);
        var tree1 = $('#default-tree').treeview(true);
        var tree2 = tree1.expandNode(data);
        console.log(tree2);
    }
    
    var onTreeNodeExpanded = function (e, node) {
	console.log("onTreeNodeExpanded"+node+'other E - '+e);
        var tree1 = $('#default-tree').treeview(true);
        var expanded = tree1.getExpanded();
        console.log(" expanded count is " + expanded.length);
    }
        
     // return tree;
    $('#default-tree').treeview({
        data: tree,
        levels: 1,
        highlightSelected: true,
        onNodeSelected: onTreeNodeSelected,
//        onNodeExpanded: onTreeNodeExpanded,
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
   // var vt = $("#default-tree ul li.node-selected").text();
    var id = $("#default-tree ul li.node-selected i").data('id');
    //var vt = $("#default-tree ul li.node-selected").text();
   // $('#category_view').val(vt);
//    $('#category_view').prop('readonly', true);
    $('#category_id').val(id);
    document.getElementById("catid").submit();
    //alert(id);
});

</script>


<!-- Custom js -->
<script src="<?= base_url(); ?>theme/web/js/custom.js"></script>

<!-- Bootstrap JavaScript -->
<script src="<?= base_url(); ?>theme/web/js/bootstrap.min.js"></script>

<!-- Owl Carousel -->
<script src="<?= base_url(); ?>theme/web/plugins/owl-carousel/owl.carousel.js"></script>