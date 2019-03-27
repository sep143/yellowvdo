<style>
    @media screen and (max-width: 768px){
        .mobile-cont {
            width: 100%;
            margin-top: 13px;
        }
    }

</style>
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
                                <button type="button" class="btn btn-sm btn-primary1" id="btn-clear-search">Clear</button>
                            </div>
                        </div>
                        <br>

                        <div style="width: 100%; height: 350px; border: 1px solid lightgray; overflow-y: scroll; overflow-x: hidden;">

                        <!--tree view pattern start div-->
                        <div id="default-tree" class="treeview" ></div>
                        <!--tree view pattern end div-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>-->
                        <button type="button" class="btn btn-primary1 ok" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Category select popup div end-->

        
         <!--<script src="<?= base_url(); ?>theme/backend/assets/js/core/jquery.min.js" type="text/javascript"></script>-->
<script src="<?= base_url(); ?>theme/backend/tree-view/js/bootstrap-treeview.js"></script>
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
    $('#category_view').val(vt);
    $('#category_view').prop('readonly', true);
    $('#category_id').val(id);
    //alert(id);
});

</script>


<!-- Footer -->
<footer>
         <section class="footer-Content">
             <div class="container" style="margin-top: -35px;">
         <div class="row">
<!--            <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="footer-widget">
                  <h3 class="block-title">About</h3>
                  <div class="textwidget">
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lobortis tincidunt est, et euismod purus suscipit quis. Etiam euismod ornare elementum. Sed ex est,  Sed ex est, consectetur eget consectetur, Lorem ipsum dolor sit amet...</p>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="footer-widget">
                  <h3 class="block-title">Categories</h3>
                  <ul class="menu">
                     <li><a href="#"><span>562</span> Restaurant</a></li>
                     <li><a href="#"><span>451</span> Real Estate</a></li>
                     <li><a href="#"><span>352</span> Cars</a></li>
                     <li><a href="#"><span>312</span> Shopping</a></li>
                     <li><a href="#"><span>262</span> Job</a></li>
                     <li><a href="#"><span>152</span> Hotels</a></li>
                     <li><a href="#"><span>102</span> Services</a></li>
                     <li><a href="#"><span>100</span> Pets</a></li>
                     <li><a href="#"><span>95</span> Cars</a></li>
                     <li><a href="#"><span>85</span> Shopping</a></li>
                     <li><a href="#"><span>50</span> Job</a></li>
                     <li><a href="#"><span>25</span> Hotels</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="footer-widget">
                  <h3 class="block-title">Latest Post</h3>
                  <ul class="blog-footer">
                     <li>
                        <a href="#">Lorem ipsum dolor sit amet, quem...</a>
                        <span class="post-date"><i class="fa fa-calendar" aria-hidden="true"></i> March 12, 2017</span>
                     </li>
                     <li>
                        <a href="#">Full Width Media Post Lorem ipsum..</a>
                        <span class="post-date"><i class="fa fa-calendar" aria-hidden="true"></i> September 25, 2017</span>
                     </li>
                     <li>
                        <a href="#">Perfect Video Post Lorem ipsum..</a>
                        <span class="post-date"><i class="fa fa-calendar" aria-hidden="true"></i> November 19, 2017</span>
                     </li>
                  </ul>
               </div>
            </div>-->
<div class="col-md-4 col-sm-6 col-xs-12"></div>
            <div class="col-md-4 col-sm-6 col-xs-12">
               <div class="footer-widget">
                  <!--<h3 class="block-title">Quick Links</h3>-->
<!--                  <ul class="menu">
                     <li><a href="#">Home</a></li>
                     <li><a href="#">About</a></li>
                     <li><a href="#">FAQ</a></li>
                     <li><a href="#">Careers</a></li>
                     <li><a href="#">Pricing Plans</a></li>
                     <li><a href="#">Categories</a></li>
                     <li><a href="#">Services</a></li>
                     <li><a href="#">Team</a></li>
                     <li><a href="#">Contact</a></li>
                     <li><a href="#">Blog</a></li>
                     <li><a href="#">Help</a></li>
                     <li><a href="#">Advertise With Us</a></li>
                  </ul>-->
                  <div class="bottom-social-icons social-icon text-center">  
                        <a href="#" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a> 
                        <a href="#" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" target="_blank" class="dribble"><i class="fa fa-dribbble"></i></a>
                        <a href="#" target="_blank" class="youtube"><i class="fa fa-youtube"></i></a>
                        <a href="#" target="_blank" class="google-plus"><i class="fa fa-google-plus"></i></a>
                        <a href="#" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    </div>
                  <div class="row ">
                        <div class="col-md-6 col-xs-6">
                            <a href="#" class="app-store">
                                <img src="<?= base_url(); ?>theme/web/images/google-play.png" alt="Google play" class="img img-center img-responsive">
<!--                                <span>download on</span><br>
                                <strong>Google Play</strong>-->
                            </a>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <a href="#" class="app-store">
                                <img src="<?= base_url(); ?>theme/web/images/apple-app.png" alt="Apple store" class="img img-center img-responsive">
<!--                                <span>download on</span><br>
                                <strong>Apple Store</strong>-->
                            </a>
                        </div>
                  </div>&nbsp;<br>
               </div>
            </div>
<div class="col-md-4 col-sm-6 col-xs-12"></div>
         </div>
      </div>
   </section>
    <div class="copyright">
        
        <div class="container mobile-cont">
<!--            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center">
                                                <header>
                                                    <p><strong>DOWNLOAD</strong> MOBILE APP</p>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lobortis tincidunt est...</p>
                                                </header>
                    <div class="row inner app-icons">
                        <div class="col-md-6">
                            <a href="#" class="app-store">
                                <img src="<?= base_url(); ?>theme/web/images/android.png" alt="Google play" style="width: 40px; height: auto;">
                                <span>download on</span><br>
                                <strong>Google Play</strong>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="app-store">
                                <img src="<?= base_url(); ?>theme/web/images/apple.png" alt="Apple store" style="width: 40px; height: auto;">
                                <span>download on</span><br>
                                <strong>Apple Store</strong>
                            </a>
                        </div>
                    </div>




                </div>
                <div class="col-md-4"></div>
            </div>-->
            <!--&nbsp;<br>-->
            <div class="row">
                <div class="col-md-12">
<!--                    <div class="bottom-social-icons social-icon text-center">  
                        <a href="#" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a> 
                        <a href="#" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" target="_blank" class="dribble"><i class="fa fa-dribbble"></i></a>
                        <a href="#" target="_blank" class="youtube"><i class="fa fa-youtube"></i></a>
                        <a href="#" target="_blank" class="google-plus"><i class="fa fa-google-plus"></i></a>
                        <a href="#" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    </div>-->
                    <div class="site-info text-center">
                        <p>&copy; Copyright 2018 Yellow VDO . All Rights Reserved
                            <!--<br> Made with <i class="fa fa-heart"></i> by <a target="_blank" href="#"><strong>Osahan Studio</strong></a>-->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

<!-- Post Ad -->
<!--<a href="create_post.html" data-toggle="tooltip" data-placement="left" title="Post Your Ad" class="btn btn-danger btn-lg post-free-add-btn"><i class="fa fa-pencil"></i></a>-->
<!-- End Post Ad -->

<!-- Back To Top -->
<a href="#" id="back-to-top" data-toggle="tooltip" data-placement="left" title="Back To Top" class="btn btn-default btn-md"><i class="fa fa-chevron-up"></i></a>
<!-- End Back To Top -->

<!-- Chat Popup -->
<!--	  <div id="accordion">
                        <div class="popup-box chat-popup">
                          <div class="popup-head">
                                 <div class="popup-head-left pull-left">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#popup">
                                        <img src="<?= base_url(); ?>theme/web/images/user.jpg" alt=""> John Doe
                                        <small>Online</small>
                                        </a>
                                 </div>
                                 <div class="popup-head-right pull-right">
                                        <div class="btn-group">
                                           <button class="chat-header-button" data-toggle="dropdown" type="button" aria-expanded="false">
                                           <i class="glyphicon glyphicon-cog"></i> </button>
                                           <ul role="menu" class="dropdown-menu pull-right">
                                                  <li><a href="#">Media</a></li>
                                                  <li><a href="#">Block</a></li>
                                                  <li><a href="#">Clear Chat</a></li>
                                                  <li><a href="#">Email Chat</a></li>
                                           </ul>
                                        </div>
                                        <button data-toggle="collapse" data-parent="#accordion" href="#popup" class="chat-header-button pull-right" type="button"><i class="glyphicon glyphicon-off"></i></button>
                                 </div>
                          </div>
                          <div id="popup" class="collapse">
                                 <div class="popup-messages">
                                        <div class="direct-chat-messages">
                                           <div class="chat-box-single-line">
                                                  <abbr class="timestamp">October 8th, 2015</abbr>
                                           </div>
                                            Message. Default to the left 
                                           <div class="direct-chat-msg doted-border">
                                                  <div class="direct-chat-info clearfix">
                                                         <span class="direct-chat-name pull-left">Osahan</span>
                                                  </div>
                                                   /.direct-chat-info 
                                                  <img alt="message user image" src="<?= base_url(); ?>theme/web/images/user.jpg" class="direct-chat-img"> /.direct-chat-img 
                                                  <div class="direct-chat-text">
                                                         Hey bro, how’s everything going ?
                                                  </div>
                                                  <div class="direct-chat-info clearfix">
                                                         <span class="direct-chat-timestamp pull-right">3.36 PM</span>
                                                  </div>
                                                  <div class="direct-chat-info clearfix">
                                                         <span class="direct-chat-img-reply-small pull-left">
                                                         </span>
                                                         <span class="direct-chat-reply-name">Singh</span>
                                                  </div>
                                                   /.direct-chat-text 
                                           </div>
                                            /.direct-chat-msg 
                                           <div class="chat-box-single-line">
                                                  <abbr class="timestamp">October 9th, 2015</abbr>
                                           </div>
                                            Message. Default to the left 
                                           <div class="direct-chat-msg doted-border">
                                                  <div class="direct-chat-info clearfix">
                                                         <span class="direct-chat-name pull-left">Osahan</span>
                                                  </div>
                                                   /.direct-chat-info 
                                                  <img alt="" src="<?= base_url(); ?>theme/web/images/user.jpg" class="direct-chat-img"> /.direct-chat-img 
                                                  <div class="direct-chat-text">
                                                         Hey bro, how’s everything going ?
                                                  </div>
                                                  <div class="direct-chat-info clearfix">
                                                         <span class="direct-chat-timestamp pull-right">3.36 PM</span>
                                                  </div>
                                                  <div class="direct-chat-info clearfix">
                                                         <img alt="" src="<?= base_url(); ?>theme/web/images/blog/user/a3.jpg" class="direct-chat-img big-round">
                                                         <span class="direct-chat-reply-name">Singh</span>
                                                  </div>
                                                   /.direct-chat-text 
                                           </div>
                                            /.direct-chat-msg 
                                        </div>
                                 </div>
                                 <div class="popup-messages-footer">
                                        <textarea id="status_message" placeholder="Type a message..." rows="10" cols="40" name="message"></textarea>
                                        <div class="btn-footer">
                                           <button class="bg_none"><i class="glyphicon glyphicon-film"></i> </button>
                                           <button class="bg_none"><i class="glyphicon glyphicon-camera"></i> </button>
                                           <button class="bg_none"><i class="glyphicon glyphicon-paperclip"></i> </button>
                                           <button class="bg_none pull-right"><i class="glyphicon glyphicon-thumbs-up"></i> </button>
                                        </div>
                                 </div>
                          </div>
                   </div>
                </div>-->
<!-- End Chat Popup -->

<!-- jQuery -->
<!--<script src="<?= base_url(); ?>theme/web/js/jquery.js"></script>-->
<!--<script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>-->

 
<!--search bar--> 
<script>
    function init() {
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
//            document.getElementById('city2').value = place.name;
//            document.getElementById('cityLat').value = place.geometry.location.lat();
//            document.getElementById('cityLng').value = place.geometry.location.lng();
            var lat = place.geometry.location.lat();
            var long = place.geometry.location.lng();
            var location = $('#autocomplete').val();
//            console.log('set location - '+location);
//            console.log('set lat - '+lat);
//            console.log('set long - '+long);
            $.ajax({
                url:'<?= site_url('Welcome/set_location')?>',
                type:'post',
                data:{location:location,lat:lat,long:long},
                success:function(data2){
                    console.log('set location - '+location);
                    console.log('set lat - '+lat);
                    console.log('set long - '+long);
                }
            });
        });
    }

    google.maps.event.addDomListener(window, 'load', init);
</script>

<!--<script>
// check for Geolocation support
if (navigator.geolocation) {
  console.log('Geolocation is supported!');
}
else {
  console.log('Geolocation is not supported for this Browser/OS.');
}


window.onload = function() {
  var startPos;
  var geoSuccess = function(position) {
    startPos = position;
//    document.getElementById('startLat').innerHTML = startPos.coords.latitude;
//    document.getElementById('startLon').innerHTML = startPos.coords.longitude;
    
//    console.log(startPos.coords.latitude);
//    console.log(startPos.coords.longitude);
   // console.log(startPos);
    //other api call to get data
<?php if(empty($this->session->userdata['web']['location'])) { ?>
$.ajax({
            url: "https://geoip-db.com/jsonp",
            jsonpCallback: "callback",
            dataType: "jsonp",
            success: function( location ) {
                 $('#autocomplete').val(location.city+', '+location.state+', '+location.country_name);
//                $('#state').html(location.state);
//                $('#city').html(location.city);
//                $('#latitude').html(location.latitude);
//                $('#longitude').html(location.longitude);
//                $('#ip').html(location.IPv4); 
       // console.log(location);
            }
        }); 
<?php } ?>
  };
  navigator.geolocation.getCurrentPosition(geoSuccess);
};

</script>-->

<script type="text/javascript">
<?php 

if($this->session->userdata('default_location') == '') { ?> 
//    $.ajax({
//            url: "https://geoip-db.com/jsonp",
//            jsonpCallback: "callback",
//            dataType: "jsonp",
//            success: function( location ) {
//                // $('#autocomplete').val(location.city+', '+location.state+', '+location.country_name);
////                $('#state').html(location.state);
////                $('#city').html(location.city);
////                $('#latitude').html(location.latitude);
////                $('#longitude').html(location.longitude);
////                $('#ip').html(location.IPv4); 
////        console.log(location.city+', '+location.state+', '+location.country_name);
//                transfer_data(location);
//            }
//        });
    
//    function transfer_data(data){
        navigator.geolocation.getCurrentPosition(success, error);
        function success(position) {
            //window.location.reload(true);
            console.log(position.coords.latitude);
            console.log(position.coords.longitude);
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
//            var location = data.city+', '+data.state+', '+data.country_name;
            var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyABhRG0XvZUaEsA45MW6PVVsf9cl8Uv3hU&latlng=' + position.coords.latitude + '%2C' + position.coords.longitude + '&language=en';
//
            $.getJSON(GEOCODING).done(function(location) {
                var set_location = location.results[0].formatted_address;
                $('#autocomplete').val(location.results[0].formatted_address);
                console.log(location.results[0].formatted_address);
                
                    $.ajax({
                        url:'<?= site_url('Welcome/set_location')?>',
                        type:'post',
                        data:{location:set_location,lat:lat,long:long},
                        success:function(data2){
                        }
                    });
            });
        }
        function error(err) {
           // console.log(err)
           var lat = '';
            var long = '';
            var location = '';
//            var lat = data.latitude;
//            var long = data.longitude;
            $.ajax({
                url:'<?= site_url('Welcome/set_location')?>',
                type:'post',
                data:{location:location,lat:lat,long:long},
                success:function(data2){
//                    console.log(data.city+', '+data.state+', '+data.country_name);
//                    console.log(lat);
//                    console.log(long);
//                    window.location.reload(true);
                }
            });
        }
//    }
<?php } ?>   

    </script>
    
    <!--<script src="<?= base_url(); ?>theme/plugin/nicEdit-latest.js"></script>-->
    <script src="<?= base_url(); ?>theme/plugin/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url(); ?>theme/plugin/tinymce/jquery.tinymce.min.js"></script>

 <!--<script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script>--> 
 <script type="text/javascript">
//<![CDATA[
//        bkLib.onDomLoaded(function() { 
////            nicEditors.allTextAreas() 
////            new nicEditor().panelInstance('area1');
////        new nicEditor({fullPanel : true}).panelInstance('area4');
////        new nicEditor({iconsPath : '../nicEditorIcons.gif'}).panelInstance('area4');
//        new nicEditor({buttonList : ['bold','italic','underline','strikeThrough','subscript','superscript','html','image','left','center','right','justify','ol','ul']}).panelInstance('editor2');
////        new nicEditor({maxHeight : 100}).panelInstance('area5');
//        });
  //]]>
  
  //tinymce
  
tinymce.init({
  selector: 'textarea#editor2',
  branding: false,
  height: 300,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ]
});

  </script>

<!--    <script type="text/javascript">
        navigator.geolocation.getCurrentPosition(success, error);

        function success(position) {

            var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyABhRG0XvZUaEsA45MW6PVVsf9cl8Uv3hU&latlng=' + position.coords.latitude + '%2C' + position.coords.longitude + '&language=en';

            $.getJSON(GEOCODING).done(function(location) {
                $('#country').html(location.results[0].address_components[5].long_name);
                $('#state').html(location.results[0].address_components[4].long_name);
                $('#city').html(location.results[0].address_components[2].long_name);
                $('#address').html(location.results[0].formatted_address);
                $('#latitude').html(position.coords.latitude);
                $('#longitude').html(position.coords.longitude);
            })

        }

        function error(err) {
            console.log(err)
        }
    </script>-->
    
<!-- Custom js -->
<script src="<?= base_url(); ?>theme/web/js/custom.js"></script>

<!-- Bootstrap JavaScript -->
<script src="<?= base_url(); ?>theme/web/js/bootstrap.min.js"></script>

<!-- Owl Carousel -->
<script src="<?= base_url(); ?>theme/web/plugins/owl-carousel/owl.carousel.js"></script>

</body>

<!-- Mirrored from askbootstrap.com/preview/obootstrap-classified/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 28 Nov 2018 05:50:56 GMT -->
</html>