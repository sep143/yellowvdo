<style>
    
.progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
.bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }

.ajax-loader {
    visibility: hidden;
    background-color: rgba(10,10,10,0.7);
    position: fixed;
    z-index: +100 !important;
    right: 0px; 
    top: 0px; 
    width: 100%;
    height:100%;
    margin: 0px; 
    padding: 0px;
}

.ajax-loader img {
    position: absolute;
    top:30%;
    left:45%;
}

#default-tree .node-disabled {
    display: none;
}

div.video-timer-div {
  position: absolute; /*background-color: #807b7b47;*/ 
  background-color: #807b7ba3; 
  height: 40px; width: 100%; 
  top: 210px; right: 0;
  padding: 10px 15px;
}

div.video-timer-div:hover {
  background-color: #807b7bbf;
}

div.video-timer-div > span{
  color: #fff;
  font-size: 14px;
}

.ui-slider-track-pos {
    position: relative;
}

a.ui-slider-handle {
  /*background: black!important;*/
  width: 10px!important;
  border:0px!important;
   /*width: 0!important;*/
  /*height: 50!important;*/
  margin-left:-8px!important;
  /*border-left: 0px transparent!important;*/
  border-left: 8px solid transparent!important;
  border-right: 8px solid transparent!important;
  border-bottom: 10px solid #555!important;
  /*border-top: 10px solid #555!important;*/
  margin-top: -13px !important;
  background: transparent!important;
  color: none!important;
  box-shadow: none!important;
}

.ui-btn-active {
  background-color: #f4c501!important;
  text-shadow:0 1px 0 #dcb40b!important;
}

.ui-slider-track .ui-slider-bg {
    /*height: 100%;*/
    width: 100%;
}

/*a.ui-slider-handle-left {
  margin-left: -5px!important;
}

a.ui-slider-handle-right {
  margin-right: -5px!important;
}*/

.theme-color {
  color: #f4c501!important;
}

/*.rotated { 
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
}*/

.rotate-90 { 
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
}

.rotate-180 { 
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  transform: rotate(180deg);
}

.rotate-270 { 
  -webkit-transform: rotate(270deg);
  -moz-transform: rotate(270deg);
  -o-transform: rotate(270deg);
  -ms-transform: rotate(270deg);
  transform: rotate(270deg);
}

.rotate-360 { 
  -webkit-transform: rotate(360deg);
  -moz-transform: rotate(360deg);
  -o-transform: rotate(360deg);
  -ms-transform: rotate(360deg);
  transform: rotate(360deg);
}


</style>

<!-- Cropping modal -->
<div id="crop-avatar">
    <div class="modal fade" id="avatar-video" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content panel-primary">
                <form class="avatar-form" action="<?php print site_url(); ?>crop/upload" enctype="multipart/form-data" method="post">
                    <div class="modal-header panel-heading">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Change Avatar Video crop</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Upload image and data -->
                        <div class="login-body">
          
          <form action="<?php site_url('video_input'); ?>" id="video-form" name="video-form" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                      <span class="">
                           <span class="fileinput-new">Add Video</span>
                           <input type="file" name="video" id="video" class="file_multi_video" accept="video/*"/>
                       </span>
                    </div>
                </div>
          </form>      
          <form action="<?php site_url('video_edit'); ?>" method="post" id="video-details" enctype="multipart/form-data">
               <div class="form-group">  
                 <div class="row">
                     <div class="col-md-6">
                         <p id="demo"></p>
                         <div class="video-container" id="videoContainer" style="border:solid; overflow: hidden; position: relative; height: auto; width: 100%;">
                            <video id="myvideo" controls>
                                 <source src="" id="video_here">
                             </video>
                             <div class="video-timer-div hidden">
                                  <span id="v-time">00:00:00</span>
                                  <span style="float: right;" id="v-time-stop">00:00:00</span>
                              </div>
                         </div>
                         <input type="hidden" name="videoname" id="videoname">

                         <!--Range Slider Start -->
                         <div>
                         <div style="width: 100%;" class="ui-content">

                             <div data-role="rangeslider">
                                  <input type="range" name="range-1a" class="hidden" id="range-1a" min="0" max="" value="" data-popup-enabled="true" data-show-value="true" title="">
                                  <input type="range" name="range-1b" class="hidden" id="range-1b" min="0" max="" value="" data-popup-enabled="true" data-show-value="true" title="">
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="startVideo" id="videoStartTime" value="">
                        <input type="hidden" name="videoSize" id="videoEndTime" value="">
                        <input type="text" name="videoRotateVal" id="videoRotateVal" value="" data-rotate-val="4">
                          <!-- Range Slider End -->
                     </div>
                 </div>
                 
                 <div class="row">
                      <div class="col-md-1">
                           <button type="button" class="btn btn-primary" id="btnPlayPause"></button>
                      </div>
                      <div class="col-md-2">
                            <!-- <button type="button" id="btnCheck">Check</button> -->
                            <button type="button" id="term_chk" class="btn btn-primary"><i class="fa fa-lg fa-cut theme-color"></i> Create</button>
                      </div>
                      <div class="col-md-2">
                            <button type="button" class="btn bt-success vid-rotate" id="vidrotateL"><i class="fa fa-rotate-left theme-color"></i> Rotate</button>
                      </div>
                      <div class="col-md-2">
                            <button type="button" class="btn bt-success vid-rotate" id="vidrotateR"><i class="fa fa-rotate-right theme-color"></i> Rotate</button>
                      </div>
                      <div class="col-md-3">
                            <button type="button" class="btn bt-success vid-rotate" id="createVideo"><i class="fa fa-save theme-color"></i> Create Video</button>
                      </div>

                      <!-- <div class="col-md-4">
                            <input type="hidden" name="test-3" class="circle-range-select" data-auto-init data-single-value>
                      </div> -->
                  </div>
             </div>
         
         </form>
      </div>

                    </div>
                    <div class="modal-footer panel-footer">
                        <button type="button" class="avatar-btns btn btn-primary" data-method="rotate" data-option="-90" title="Rotate the image 9 degree to the left"><i class="fa fa-rotate-left"></i> Rotate</button>
                        <button type="button" class="avatar-btns btn btn-primary" data-method="rotate" data-option="-90" title="Rotate the image 9 degree to the right"><i class="fa fa-rotate-right"></i> Rotate</button>
                        <button type="submit" class="btn btn-primary avatar-save">Crop & Save</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    </div> 
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
</div>
<!-- Loading state -->
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>