var YELLOWVDO = YELLOWVDO || {};
YELLOWVDO.Video = function(base_url) {
    this.base_url = base_url;
    this.video = document.getElementById('myvideo');
    this.initialize();
};

YELLOWVDO.Video.prototype = {
    initialize: function () {
        var oldValue, minVal, maxValue, newValueoldVal, maxVal, newVal, rangeb, rangel;
        var durationTime, videoStartTime, currentTime;
        this.video_status = false;
        this.isConnected = true;
        // var video = document.getElementById('myvideo');
        this.videoCutRotateHandle();
        this.videoDuration();
        this.onLoadVideo();
        this.editVideoSubmit();
        this.removeControl();
        this.videoPlayPause();
        this.onloadChange();
        // this.isOnline();
        this.rotateVideoHandle();
    },
    
    isOnline:function () {
        // Register listeners
        window.addEventListener("online", function(){
            this.isConnected = true;
        });
        window.addEventListener("offline", function(){
            this.isConnected = false;
            return isConnected;
            // console.log(isConnected);
            if(isConnected==false) {
                var notify = $.notify('<strong>WARNING:</strong> Network Error', {
                     allow_dismiss: false,
                     showProgressbar: false
                });
     
                setTimeout(function() {
                     notify.update({'type': 'info', 'message': 'WARNING: Internet connection has been lost.', 'progress': 25});
                }, 1000);         
            }
        });
    },

    onloadChange:function () {
        $("#btnPlayPause").html("<i class='fa fa-play theme-color'></i>");
        $(".ui-slider-track").addClass("ui-slider-track-pos");
        /**ON PAGE LOAD SET VIDEO SLIDER RANGE START**/ 
        $(".ui-slider-track .ui-slider-bg").attr("style","width:0%!important;");   
        $("a.ui-slider-handle").attr("aria-labelledby", function(){
            if($(this).attr("aria-labelledby")=="range-1b-label") {
                $(this).attr("style","left:100%!important");
                $(".ui-slider-track .ui-slider-bg").attr("style","width:100%!important;");
                $(".ui-slider-track .ui-slider-bg").attr("ctrl-width","100");
            }else {
                $(this).attr("style","left:0%!important");
            }
        });
        /**ON PAGE LOAD SET VIDEO SLIDER RANGE END**/ 
    },

    videoCutRotateHandle : function () {
        var rotateVal = $("#videoRotateVal").val();
        var transposeVal = $("#videoRotateVal").attr('data-rotate-val');

        $("#vidrotateR").click(function(){
            alert(transposeVal);
            if(rotateVal=="360" || rotateVal =="" || rotateVal == "0") {
                rotateVal = parseInt("90");
                transposeVal = parseInt("4");
                $("#videoRotateVal").val(rotateVal);
                $("#videoRotateVal").attr("data-rotate-val",transposeVal);    
            }
            else {
                rotateVal = parseInt(rotateVal)+parseInt("90");
                transposeVal = parseInt(transposeVal)-parseInt("1");
                $("#videoRotateVal").val(rotateVal);
                $("#videoRotateVal").attr("data-rotate-val",transposeVal);
            }

            $("#myvideo").css({ "-webkit-transform": "rotate("+rotateVal+"deg)", 
                                "-moz-transform": "rotate("+rotateVal+"deg)", 
                                "-o-transform": "rotate("+rotateVal+"deg)", 
                                "-ms-transform": "rotate("+rotateVal+"deg)", 
                                "transform": "rotate("+rotateVal+"deg)", 
                                "object-fit": "cover", 
                                "width": "100%",
                                "height": "100%",
                              });
            
        });

        $("#vidrotateL").click(function(){
            if(rotateVal=="360" || rotateVal =="" || rotateVal == "0") {
                rotateVal = parseInt("270");
                transposeVal = parseInt("1");
                $("#videoRotateVal").val(rotateVal);
                $("#videoRotateVal").attr("data-rotate-val",transposeVal);    
            }
            else {
                rotateVal = parseInt(rotateVal)-parseInt("90");
                transposeVal = parseInt(transposeVal)+parseInt("1");
                $("#videoRotateVal").val(rotateVal);  
                $("#videoRotateVal").attr("data-rotate-val",transposeVal);
            }

            $("#myvideo").css({ "-webkit-transform": "rotate("+rotateVal+"deg)", 
                                "-moz-transform": "rotate("+rotateVal+"deg)", 
                                "-o-transform": "rotate("+rotateVal+"deg)", 
                                "-ms-transform": "rotate("+rotateVal+"deg)", 
                                "transform": "rotate("+rotateVal+"deg)", 
                                "object-fit": "cover", 
                                "width": "100%",
                                "height": "100%",
                              });
        });

        // if($("#videoRotateVal").val()=="360" && $("#videoRotateVal").val()=="0") {
        //     $("#videoRotateVal").attr("data-rotate-val","4");
        // } else if($("#videoRotateVal").val()=="90") {
        //     $("#videoRotateVal").attr("data-rotate-val","3");
        // } else if($("#videoRotateVal").val()=="180") {
        //     $("#videoRotateVal").attr("data-rotate-val","2");
        // } else if($("#videoRotateVal").val()=="270") {
        //     $("#videoRotateVal").attr("data-rotate-val","1");
        // }
       

        $("#createVideo").click(function(){            
            alert("create video");
             var degreeR = $("#videoRotateVal").val();   
             var data = new FormData(document.getElementById("video-form")); //your form ID
            $.ajax({ /**AJAX CALLING START**/ 
                  type: "POST",
                  url: 'video_input',
                  data:  data,
                  enctype: 'multipart/form-data',
                  processData: false,  // tell jQuery not to process the data
                  contentType: false,   // tell jQuery not to set contentType
                  dataType: "json",
                  error: function(data)
                  {   
                      console.log("Error Calling :: "+data.status);
                  },
                  success: function(data)
                  {

                    video_status = true;
                    $('#video_here').attr("src","<?= site_url('ffmpeg/input/'); ?>"+data.video_name);
                    $('#videoname').val(data.video_name);
                      if(data.video_name!="") {
                        dt = data.video_name;
                        $.ajax({
                              url: "video_rotate",
                              type: "POST",
                              dataType: 'JSON',
                              enctype: 'multipart/form-data',
                              data: {
                                    degree: degreeR,
                                    vname: $('#videoname').val()
                              },
                              beforeSend: function () {
                                    $('.ajax-loader').css("visibility", "visible");
                              },
                              error: function (data) {
                                    console.log(data);
                              },
                              success: function (data) {
                                    console.log(data);
                                    if(data.status == '200') {
                                        var notify = $.notify('<strong>SUCCESS:</strong> File Error...', {
                                            allow_dismiss: false,
                                            showProgressbar: false
                                        });

                                        setTimeout(function() {
                                            notify.update({'type': 'success', 'message': 'Video Rotate Successfully!', 'progress': 25});
                                        }, 1000);
                                    }
                              },
                              complete: function () {
                                    $('.ajax-loader').css("visibility", "hidden");
                              }
                          });
                      }
                      // some code after succes from php
                  }

              });/**AJAX CALLING END**/ 

        });
    },


    rotateVideoHandle : function () {
        var rotateVal = $("#videoRotateVal").val();
        $("#vidrotateR").click(function(){
            if(rotateVal=="360" || rotateVal =="" || rotateVal == "0") {
                rotateVal = parseInt("90");
                $("#videoRotateVal").val(rotateVal);
            }
            else {
                rotateVal = parseInt(rotateVal)+parseInt("90");
                $("#videoRotateVal").val(rotateVal);
            }
            $("#myvideo").css({ "-webkit-transform": "rotate("+rotateVal+"deg)", 
                                "-moz-transform": "rotate("+rotateVal+"deg)", 
                                "-o-transform": "rotate("+rotateVal+"deg)", 
                                "-ms-transform": "rotate("+rotateVal+"deg)", 
                                "transform": "rotate("+rotateVal+"deg)", 
                                "object-fit": "cover", 
                                "width": "100%",
                                "height": "100%",
                              });
            
        });

        $("#vidrotateL").click(function(){
            if(rotateVal=="360" || rotateVal =="" || rotateVal == "0") {
                rotateVal = parseInt("270");
                $("#videoRotateVal").val(rotateVal);
            }
            else {
                rotateVal = parseInt(rotateVal)-parseInt("90");
                $("#videoRotateVal").val(rotateVal);  
            }

            $("#myvideo").css({ "-webkit-transform": "rotate("+rotateVal+"deg)", 
                                "-moz-transform": "rotate("+rotateVal+"deg)", 
                                "-o-transform": "rotate("+rotateVal+"deg)", 
                                "-ms-transform": "rotate("+rotateVal+"deg)", 
                                "transform": "rotate("+rotateVal+"deg)", 
                                "object-fit": "cover", 
                                "width": "100%",
                                "height": "100%",
                              });
        });

       

        $("#createVideo").click(function(){           
            alert("create video");
             var degreeR = $("#videoRotateVal").val();   
             var data = new FormData(document.getElementById("video-form")); //your form ID
            $.ajax({ /**AJAX CALLING START**/ 
                  type: "POST",
                  url: 'video_input',
                  data:  data,
                  enctype: 'multipart/form-data',
                  processData: false,  // tell jQuery not to process the data
                  contentType: false,   // tell jQuery not to set contentType
                  dataType: "json",
                  error: function(data)
                  {   
                      console.log("Error Calling :: "+data.status);
                  },
                  success: function(data)
                  {

                    video_status = true;
                    $('#video_here').attr("src","<?= site_url('ffmpeg/input/'); ?>"+data.video_name);
                    $('#videoname').val(data.video_name);
                      if(data.video_name!="") {
                        dt = data.video_name;
                        $.ajax({
                              url: "video_rotate",
                              type: "POST",
                              dataType: 'JSON',
                              enctype: 'multipart/form-data',
                              data: {
                                    degree: degreeR,
                                    vname: $('#videoname').val()
                              },
                              beforeSend: function () {
                                    $('.ajax-loader').css("visibility", "visible");
                              },
                              error: function (data) {
                                    console.log(data);
                              },
                              success: function (data) {
                                    console.log(data);
                                    if(data.status == '200') {
                                        var notify = $.notify('<strong>SUCCESS:</strong> File Error...', {
                                            allow_dismiss: false,
                                            showProgressbar: false
                                        });

                                        setTimeout(function() {
                                            notify.update({'type': 'success', 'message': 'Video Rotate Successfully!', 'progress': 25});
                                        }, 1000);
                                    }
                              },
                              complete: function () {
                                    $('.ajax-loader').css("visibility", "hidden");
                              }
                          });
                      }
                      // some code after succes from php
                  }

              });/**AJAX CALLING END**/ 

        });
    },

    videoPlayPause:function () {
        var video = document.getElementById('myvideo');
        $("#btnPlayPause").click(function(){
            // video.paused ? video.play() : video.pause();
            if(video.paused) {
              video.play();
              $("#btnPlayPause").html("<i class='fa fa-pause theme-color'></i>");
            }
            else {
              video.pause();
              $("#btnPlayPause").html("<i class='fa fa-play theme-color'></i>");
            }
        });
    },

    editVideoSubmit:function () {
        $("#term_chk").click(function(){
            console.log('create link click');
            var data = new FormData(document.getElementById("video-form")); //your form ID
            $.ajax({
                  type: "POST",
                  url: 'video_input',
                  data:  data,
                  enctype: 'multipart/form-data',
                  processData: false,  // tell jQuery not to process the data
                  contentType: false,   // tell jQuery not to set contentType
                  dataType: "json",
                  error: function(data)
                  {
                      console.log("Error Calling :: "+data.status);
                  },
                  success: function(data)
                  {

                    video_status = true;
                    $('#video_here').attr("src","<?= site_url('temp/input/'); ?>"+data.video_name);
                    $('#videoname').val(data.video_name);
                      if(data.video_name!="") {
                        dt = data.video_name;
						console.log(dt);
                        $.ajax({
                              url: "video_edit",
                              type: "POST",
                              dataType: 'JSON',
                              enctype: 'multipart/form-data',
                              data: {
                                    stime:$('#videoStartTime').val(),
                                    vtime: $('#videoEndTime').val(),
                                    vname: $('#videoname').val()
                              },
                              beforeSend: function () {
                                    $('.ajax-loader').css("visibility", "visible");
                              },
                              error: function (data) {
                                    console.log(data);
                              },
                              success: function (data) {
                                    console.log(data);
                                    if(data.status == '200') {
                                        var notify = $.notify('<strong>SUCCESS:</strong> File Error...', {
                                            allow_dismiss: false,
                                            showProgressbar: false
                                        });

                                        setTimeout(function() {
                                            notify.update({'type': 'success', 'message': 'Video Created Successfully!', 'progress': 25});
                                        }, 1000);
                                    }
                              },
                              complete: function () {
                                    $('.ajax-loader').css("visibility", "hidden");
                              }
                          }); 
                      }
                      // some code after succes from php
                  }

              });
        });
    },
    
    rotateVideoHandlebkp : function () {
        //  $("div.handle1").mouseup(function(){
        //     var havdle1Val = $(this).attr("data-value");
        //     $("#myvideo").css({ "-webkit-transform": "rotate("+havdle1Val+"deg)", 
        //                         "-moz-transform": "rotate("+havdle1Val+"deg)", 
        //                         "-o-transform": "rotate("+havdle1Val+"deg)", 
        //                         "-ms-transform": "rotate("+havdle1Val+"deg)", 
        //                         "transform": "rotate("+havdle1Val+"deg)", 
        //                         "object-fit": "cover", 
        //                         "width": "100%",
        //                         "height": "100%",
        //                       });
        // });
         
        // $("#vid-rotate").click(function(){
            
        //     // $(this).attr("data-value");
        //     // $("#myvideo").css({ "-webkit-transform": "rotate(90deg)", 
        //     //                     "-moz-transform": "rotate(90deg)", 
        //     //                     "-o-transform": "rotate(90deg)", 
        //     //                     "-ms-transform": "rotate(90deg)", 
        //     //                     "transform": "rotate(90deg)", 
        //     //                     "object-fit": "cover", 
        //     //                   });
                
                
        //          // $('#myvideo').css({"top":"92px", "left" : "10px", "height":"200px!important","width":"220px!important"});
        //          // $('#myvideo').css({});

        //          // $('video').css('position', 'absolute')
        //          // var px = $(container).width() / 2
        //          // var py = $(container).height() / 2
        //          // $('video').css('left', px-py).css('top', py-px);


        //          //$("video").css({"transform":"rotate(90deg)"})
        //         // var videoTag = $('#myvideo').get(0);
        //         // videoTag.addEventListener("loadedmetadata", function(event) {
        //         //    videoRatio = videoTag.videoWidth / videoTag.videoHeight;
        //         //    targetRatio = $(videoTag).width() / $(videoTag).height();
        //         //     if (videoRatio < targetRatio) {
        //         //       $(videoTag).css("transform", "scaleX(" + (targetRatio / videoRatio) + ")");
        //         //     } else if (targetRatio < videoRatio) {
        //         //       $(videoTag).css("transform", "scaleY(" + (videoRatio / targetRatio) + ")");
        //         //     } else {
        //         //       $(videoTag).css("transform", "");
        //         //     }
        //         // });
        //      var degreeR = $("div.handle1").attr("data-value");   
        //      var data = new FormData(document.getElementById("video-form")); //your form ID
        //     $.ajax({ *AJAX CALLING START* 
        //           type: "POST",
        //           url: 'video_input',
        //           data:  data,
        //           enctype: 'multipart/form-data',
        //           processData: false,  // tell jQuery not to process the data
        //           contentType: false,   // tell jQuery not to set contentType
        //           dataType: "json",
        //           error: function(data)
        //           {   
        //               console.log("Error Calling :: "+data.status);
        //           },
        //           success: function(data)
        //           {

        //             video_status = true;
        //             $('#video_here').attr("src","<?= site_url('ffmpeg/input/'); ?>"+data.video_name);
        //             $('#videoname').val(data.video_name);
        //               if(data.video_name!="") {
        //                 dt = data.video_name;
        //                 $.ajax({
        //                       url: "video_rotate",
        //                       type: "POST",
        //                       dataType: 'JSON',
        //                       enctype: 'multipart/form-data',
        //                       data: {
        //                             degree: degreeR,
        //                             vname: $('#videoname').val()
        //                       },
        //                       beforeSend: function () {
        //                             $('.ajax-loader').css("visibility", "visible");
        //                       },
        //                       error: function (data) {
        //                             console.log(data);
        //                       },
        //                       success: function (data) {
        //                             console.log(data);
        //                             if(data.status == '200') {
        //                                 var notify = $.notify('<strong>SUCCESS:</strong> File Error...', {
        //                                     allow_dismiss: false,
        //                                     showProgressbar: false
        //                                 });

        //                                 setTimeout(function() {
        //                                     notify.update({'type': 'success', 'message': 'Video Rotate Successfully!', 'progress': 25});
        //                                 }, 1000);
        //                             }
        //                       },
        //                       complete: function () {
        //                             $('.ajax-loader').css("visibility", "hidden");
        //                       }
        //                   });
        //               }
        //               // some code after succes from php
        //           }

        //       });/**AJAX CALLING END**/ 

        // });
    },

    onLoadVideo : function () {
        $('input[type=file]').change(function (evt) {
              var file = this.files[0]; 
              var f_size = formatFileSize(file.size,decimalPoint=2);
              var self = this;
              var data = new FormData(document.getElementById("video-form")); //your form ID
              
              

              if(f_size>=200){
                  var notify = $.notify('<strong>WARNING:</strong> File Error...', {
                      allow_dismiss: false,
                      showProgressbar: false
                  });

                  setTimeout(function() {
                      notify.update({'type': 'danger', 'message': 'Invalid Video file Size', 'progress': 25});
                  }, 1000);
                  
              } else {
                    /**ON VIDEO SELECT LOAD VIDEO IN VIDEO TAG START**/ 
                    var $source = $('#video_here');
                    $source[0].src = URL.createObjectURL(this.files[0]);
                    $source.parent()[0].load();
                    var myVideoPlayer = document.getElementById('myvideo');
                    /**ON VIDEO SELECT LOAD VIDEO IN VIDEO TAG END**/ 

                    /** GET VIDEO LENGTH COUNT START **/ 
                    myVideoPlayer.addEventListener('loadedmetadata', function () {
                        var tot_video_sec = myVideoPlayer.duration;  
                        $("#v-time-stop").html(toTimeString(tot_video_sec));

                        var stime = toTimeString(0); // On Video Load
                        var etime = toTimeString(tot_video_sec); // On Video Load
                        $("#range-1a").attr("value",0);
                        $("#range-1a").attr("max",tot_video_sec);
                        $("#range-1b").attr("value",tot_video_sec);
                        $("#range-1b").attr("max",tot_video_sec);
                        $("#v-time-stop").html(toTimeString(tot_video_sec)); //
                        $(".ui-slider-handle").attr("aria-valuemax",tot_video_sec);
                        $("#videoStartTime").val(0);
                        this.diffVal = tot_video_sec - 0;
                        $("#videoEndTime").val(tot_video_sec);
                        loadMetadata();
                    });

                    /** GET VIDEO LENGTH COUNT END **/ 

                    $(".video-timer-div").removeClass("hidden");
              }

        });
    },

    removeControl : function () {
        this.video.removeAttribute('controls');
    },

    videoDuration : function (video_status) {
        
            $("#range-1a").on("change",function(video_status) {
                    // console.log("video Status:; " + video_status);
                     var oldVal = $("#range-1a").val();
                     var maxVal = $("#range-1b").attr("max");
                     var newVal = $(this).val();
                     if ((newVal >= oldVal)) {
                         $(this).attr("rangeL",newVal);
                         $("#videoStartTime").val(newVal);
                         $("#range-1a").attr("value",newVal);
                     }
                     else {
                         $(this).attr("rangeL",newVal);
                         $("#videoStartTime").val(newVal);
                         $("#range-1a").attr("value",newVal);
                     }
                     oldVal = newVal;
                     if($("#range-1b").attr('rangeb')) {
                         var rangeb = $("#range-1b").attr('rangeb');    
                     }
                     var endtime = rangeb;
                     var diffVal = rangeb-oldVal;
                     $("#videoStartTime").val(oldVal);
                     // $("#videoEndTime").val(rangeb);
                     $("#videoEndTime").val(diffVal);
                     $("#range-1a").attr("value",newVal);
                     
                     var rangeMax = $(".ui-slider-handle").attr("aria-valuemax");
                      var ctrlWidth = diffVal/rangeMax*100;
                      $(".ui-slider-track .ui-slider-bg").attr("ctrl-width",parseInt(ctrlWidth));

                     loadMetadata();
                });
            
        
            $("#range-1b").on("change",function() {
               // var rangeb;
                var oldVal = $("#range-1b").val();
                var maxVal = $("#range-1b").attr("max");
                var newVal = $(this).val();
                if ((newVal >= oldVal)) {
                    $(this).attr("rangeB",newVal);
                    $("#videoEndTime").val(newVal);
                    $("#range-1b").attr("value",newVal);
                }
                else {
                    $(this).attr("rangeB",newVal);
                    $("#videoEndTime").val(newVal);
                    $("#range-1b").attr("value",newVal);
                }
                oldVal = newVal;
                // var rangel = $("#range-1a").attr('rabgel');
                if($("#range-1a").attr('rangel')) {
                      rangel = $("#range-1a").attr('rangel');  
                  }else {
                    rangel = 0;
                  }
                endtime = oldVal;
                $("#v-time-stop").html(toTimeString(oldVal));
                var diffVal = oldVal-rangel;
                $("#videoStartTime").val(rangel);
                $("#videoEndTime").val(diffVal);
                $(".ui-slider-handle").removeClass("ui-shadow");
                
                var rangeMax = $(".ui-slider-handle").attr("aria-valuemax");
                var ctrlWidth = diffVal/rangeMax*100;
                $(".ui-slider-track .ui-slider-bg").attr("ctrl-width",parseInt(ctrlWidth));

                // $("#range-1b").attr("value",newVal);
                loadMetadata();
                
            });
    },


     
}

function toTimeString(seconds) {
        return (new Date(seconds * 1000)).toUTCString().match(/(\d\d:\d\d:\d\d)/)[0];
        // return (new Date(seconds * 1000)).toUTCString().match(/(\d\d:\d\d:\d\d)/)[0];
}

function loadMetadata () {
    var video = document.getElementById('myvideo');
    var st = $("#videoStartTime").val();
    var et = $("#videoEndTime").val();
    var rangeMax = $(".ui-slider-handle").attr("aria-valuemax");

    video.currentTime = parseInt(st); // SET VIDEO START TIME 
    endTime = parseInt(st)+parseInt(et);
    
    /** SET VIDEO PAUSE TIMING**/
    video.addEventListener("timeupdate",function(){
        var ct = video.currentTime;
        var sliderVal = ct/rangeMax*100;
        var diffTime = parseInt(et);
        var sliderWidth = diffTime/rangeMax*100;
        
        $("#v-time").html(toTimeString(video.currentTime));
        if(video.currentTime >= endTime ) {
            this.pause();
            $("#btnPlayPause").html("<i class='fa fa-play theme-color'></i>");
        }else {
          $("a.ui-slider-handle").attr("aria-labelledby", function(){
              var sliderBGWidth = $("div.ui-btn-active").attr("ctrl-width");

              // if (sliderBGWidth.length >= 0) {
              //     console.log(sliderBGWidth-1);
              // }

              if (!isNaN(sliderBGWidth)) {
                  console.log(sliderBGWidth-1);
                  // $("#qty" + value).val(currentVal + 1);
              }

              if($(this).attr("aria-labelledby")=="range-1a-label") {
                  $(this).attr("style","left:"+sliderVal+"%!important");
                  var newWidth = parseFloat(sliderWidth)-parseFloat(sliderVal);               
                  // console.log("Slider Width Inner %:: "+newWidth);

                  $("div.ui-slider-track .ui-slider-bg").attr("style","margin-left:"+(sliderVal)+"%!important; width:"+(newWidth)+"%!important; overflow:hidden;");
                  
              }
          });
        }

    },false);    
    /** SET VIDEO PAUSE TIMING**/
}

function formatFileSize(bytes,decimalPoint) {
   if(bytes == 0) return '0 Bytes';
   var k = 1024,
       dm = decimalPoint || 2,
       // sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
       i = Math.floor(Math.log(bytes) / Math.log(k));
   // return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
   return parseFloat((bytes / Math.pow(k, i)).toFixed(dm));
}