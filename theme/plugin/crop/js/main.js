(function (factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as anonymous module.
    define(['jquery'], factory);
  } else if (typeof exports === 'object') {
    // Node / CommonJS
    factory(require('jquery'));
  } else {
    // Browser globals.
    factory(jQuery);
  }
})(function ($) {
  'use strict';
  var console = window.console || { log: function () {} };

  function CropAvatar($element) {
    this.$container = $element;

    this.$avatarView = this.$container.find('.avatar-view');
    this.$avatar = this.$avatarView.find('img');
    this.$avatarModal = this.$container.find('#avatar-modal');
    this.$loading = this.$container.find('.loading');

    this.$avatarForm = this.$avatarModal.find('.avatar-form');
    this.$avatarUpload = this.$avatarForm.find('.avatar-upload');
    this.$avatarSrc = this.$avatarForm.find('.avatar-src');
    this.$avatarData = this.$avatarForm.find('.avatar-data');
    this.$avatarInput = this.$avatarForm.find('.avatar-input');
    this.$avatarSave = this.$avatarForm.find('.avatar-save');
    this.$avatarBtns = this.$avatarForm.find('button.avatar-btns');

    this.$avatarWrapper = this.$avatarModal.find('.avatar-wrapper');
    this.$avatarPreview = this.$avatarModal.find('.avatar-preview');

    this.init();
  }

  CropAvatar.prototype = {
    constructor: CropAvatar,

    support: {
      fileList: !!$('<input type="file">').prop('files'),
      blobURLs: !!window.URL && URL.createObjectURL,
      formData: !!window.FormData
    },

    init: function () {
      this.support.datauri = this.support.fileList && this.support.blobURLs;

      if (!this.support.formData) {
        this.initIframe();
      }

      this.initTooltip();
      this.initModal();
      this.addListener();
    },

    addListener: function () {
      this.$avatarView.on('click', $.proxy(this.click, this));
      this.$avatarInput.on('change', $.proxy(this.change, this));
      this.$avatarForm.on('submit', $.proxy(this.submit, this));
      this.$avatarBtns.on('click', $.proxy(this.rotate, this));
    },

    initTooltip: function () {
      this.$avatarView.tooltip({
        placement: 'bottom'
      });
    },

    initModal: function () {
      this.$avatarModal.modal({
        show: false
      });
    },

    initPreview: function () {
      var url = this.$avatar.attr('src');
      this.$avatarPreview.html('<img src="' + url + '">');
    },

    initIframe: function () {
      var target = 'upload-iframe-' + (new Date()).getTime();
      var $iframe = $('<iframe>').attr({
            name: target,
            src: ''
          });
      var _this = this;

      // Ready ifrmae
      $iframe.one('load', function () {

        // respond response
        $iframe.on('load', function () {
          var data;

          try {
            data = $(this).contents().find('body').text();
          } catch (e) {
            console.log(e.message);
          }

          if (data) {
            try {
              data = $.parseJSON(data);
            } catch (e) {
              console.log(e.message);
            }

            _this.submitDone(data);
          } else {
            _this.submitFail('Image upload failed!');
          }

          _this.submitEnd();

        });
      });

      this.$iframe = $iframe;
      this.$avatarForm.attr('target', target).after($iframe.hide());
    },

    click: function () {
      this.$avatarModal.modal('show');
      this.initPreview();
    },

    change: function () {
      var files;
      var file;

      if (this.support.datauri) {
        files = this.$avatarInput.prop('files');

        if (files.length > 0) {
          file = files[0];

          if (this.isImageFile(file)) {
            if (this.url) {
              URL.revokeObjectURL(this.url); // Revoke the old one
            }

            this.url = URL.createObjectURL(file);
            this.startCropper();
          }
        }
      } else {
        file = this.$avatarInput.val();

        if (this.isImageFile(file)) {
          this.syncUpload();
        }
      }
    },

    submit: function () {
      if (!this.$avatarSrc.val() && !this.$avatarInput.val()) {
        return false;
      }

      if (this.support.formData) {
        this.ajaxUpload();
        return false;
      }
    },

    rotate: function (e) {
      var data;

      if (this.active) {
        data = $(e.target).data();

        if (data.method) {
          this.$img.cropper(data.method, data.option);
        }
      }
    },

    isImageFile: function (file) {
      if (file.type) {
        return /^image\/\w+$/.test(file.type);
      } else {
        return /\.(jpg|jpeg|png|gif)$/.test(file);
      }
    },

    startCropper: function () {
      var _this = this;

      if (this.active) {
        this.$img.cropper('replace', this.url);
      } else {
        this.$img = $('<img src="' + this.url + '">');
        this.$avatarWrapper.empty().html(this.$img);
        this.$img.cropper({
         // aspectRatio: 16 / 9,
          preview: this.$avatarPreview.selector,
          crop: function (e) {
            var json = [
                  '{"x":' + e.x,
                  '"y":' + e.y,
                  '"height":' + e.height,
                  '"width":' + e.width,
                  '"rotate":' + e.rotate + '}'
                ].join();
                console.log(json);
            _this.$avatarData.val(json);
          }
        });

        this.active = true;
      }

      this.$avatarModal.one('hidden.bs.modal', function () {
        _this.$avatarPreview.empty();
        _this.stopCropper();
      });
    },

    stopCropper: function () {
      if (this.active) {
        this.$img.cropper('destroy');
        this.$img.remove();
        this.active = false;
      }
    },

    ajaxUpload: function () {
      var url = this.$avatarForm.attr('action');
      var data = new FormData(this.$avatarForm[0]);
      var _this = this;

      $.ajax(url, {
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,

        beforeSend: function () {
          _this.submitStart();
          jQuery('button.avatar-save').button('loading');
        },

        success: function (data) {
          _this.submitDone(data);
        },

        error: function (XMLHttpRequest, textStatus, errorThrown) {
          _this.submitFail(textStatus || errorThrown);
        },

        complete: function () {
          _this.submitEnd();
          jQuery('button.avatar-save').button('reset');
        }
      });
    },

    syncUpload: function () {
      this.$avatarSave.click();
    },

    submitStart: function () {
      this.$loading.fadeIn();
    },

    submitDone: function (data) {
      if ($.isPlainObject(data) && data.state === 200) {
        if (data.result) {
         if(ad_id != ''){
             var dataimgid = null;
             $.ajax({
                //url: baseurl + "crop/uploadCropImg",
                url: baseurl+"Crop/uploadCropImg",
                type: 'post',
                data: {image_url:data.thumb, member_id: data.ussid, upltype:data.upltype, urlPath:data.urlPath, type:'edit', ad_id:ad_id},
                dataType: 'json',
                beforeSend: function () {},
                complete: function () {},
                success: function (json) {
                    console.log(json);
                    dataimgid = json.return_img_id;
                    var i;
                    for(i=0;i<=image_limit;i++){
                        if(json.user_id == i){
                            jQuery('img#render-avatar'+i).attr('src', data.urlPath+data.thumb);
                            jQuery('img#render-avatar'+i).attr('data-toggle',0);
                            //jQuery('img#render-avatar1').data('target',0);
                            jQuery('#trash'+i).html('<a href="javascript:void(0)" onclick="img_unlink(this)" data-id="'+i+'" data-img="'+data.thumb+'"><i class="fa fa-trash"> Delete</i></a>');
                        }   
                    }
                    
//                    if(data.ussid == 'MQ=='){
//                    jQuery('img#render-avatar1').attr('src', data.urlPath+data.thumb);
//                    jQuery('img#render-avatar1').attr('data-toggle',0);
//                    //jQuery('img#render-avatar1').data('target',0);
//                    jQuery('#trash1').html('<a href="javascript:void(0)" onclick="img_unlink(this)" data-imgid="'+dataimgid+'" data-id="1" data-img="'+data.thumb+'"><i class="fa fa-trash"> Delete</i></a>');
//                    }
//                    if(data.ussid == 'Mg=='){
//                        jQuery('img#render-avatar2').attr('src', data.urlPath+data.thumb);
//                        jQuery('img#render-avatar2').attr('data-toggle',0);
//                        //jQuery('img#render-avatar1').data('target',0);
//                        jQuery('#trash2').html('<a href="javascript:void(0)" onclick="img_unlink(this)" data-imgid="'+dataimgid+'" data-id="2" data-img="'+data.thumb+'"><i class="fa fa-trash"> Delete</i></a>');
//                    }
//                    if(data.ussid == 'Mw=='){
//                        jQuery('img#render-avatar3').attr('src', data.urlPath+data.thumb);
//                        jQuery('img#render-avatar3').attr('data-toggle',0);
//                        //jQuery('img#render-avatar1').data('target',0);
//                        jQuery('#trash3').html('<a href="javascript:void(0)" onclick="img_unlink(this)" data-imgid="'+dataimgid+'" data-id="3" data-img="'+data.thumb+'"><i class="fa fa-trash"> Delete</i></a>');
//                    }
//                    if(data.ussid == 'NA=='){
//                        jQuery('img#render-avatar4').attr('src', data.urlPath+data.thumb);
//                        jQuery('img#render-avatar4').attr('data-toggle',0);
//                        //jQuery('img#render-avatar1').data('target',0);
//                        jQuery('#trash4').html('<a href="javascript:void(0)" onclick="img_unlink(this)" data-imgid="'+dataimgid+'" data-id="4" data-img="'+data.thumb+'"><i class="fa fa-trash"> Delete</i></a>');
//                    }
                }
            });
            //jugad
            
         //create ad time work this function       
         }else {
             $.ajax({
                //url: baseurl + "crop/uploadCropImg",
                url: baseurl+"Crop/uploadCropImg",
                type: 'post',
                data: {image_url:data.thumb, member_id: data.ussid, upltype:data.upltype, urlPath:data.urlPath, type:'create'},
                dataType: 'json',
                beforeSend: function () {},
                complete: function () {},
                success: function (json) {
                    console.log(json);
                    var i;
                    for(i=0;i<=image_limit;i++){
                        if(json.user_id == i){
                            jQuery('img#render-avatar'+i).attr('src', data.urlPath+data.thumb);
                            jQuery('img#render-avatar'+i).attr('data-toggle',0);
                            //jQuery('img#render-avatar1').data('target',0);
                            jQuery('#trash'+i).html('<a href="javascript:void(0)" onclick="img_unlink(this)" data-id="'+i+'" data-img="'+data.thumb+'"><i class="fa fa-trash"> Delete</i></a>');
                        }   
                    }
                }
            });
            //jugad
            
//                if(data.ussid == 'MQ=='){
//                    jQuery('img#render-avatar1').attr('src', data.urlPath+data.thumb);
//                    jQuery('img#render-avatar1').attr('data-toggle',0);
//                    //jQuery('img#render-avatar1').data('target',0);
//                    jQuery('#trash1').html('<a href="javascript:void(0)" onclick="img_unlink(this)" data-id="1" data-img="'+data.thumb+'"><i class="fa fa-trash"> Delete</i></a>');
//                }
//                if(data.ussid == 'Mg=='){
//                    jQuery('img#render-avatar2').attr('src', data.urlPath+data.thumb);
//                    jQuery('img#render-avatar2').attr('data-toggle',0);
//                    //jQuery('img#render-avatar1').data('target',0);
//                    jQuery('#trash2').html('<a href="javascript:void(0)" onclick="img_unlink(this)" data-id="2" data-img="'+data.thumb+'"><i class="fa fa-trash"> Delete</i></a>');
//                }
//                if(data.ussid == 'Mw=='){
//                    jQuery('img#render-avatar3').attr('src', data.urlPath+data.thumb);
//                    jQuery('img#render-avatar3').attr('data-toggle',0);
//                    //jQuery('img#render-avatar1').data('target',0);
//                    jQuery('#trash3').html('<a href="javascript:void(0)" onclick="img_unlink(this)" data-id="3" data-img="'+data.thumb+'"><i class="fa fa-trash"> Delete</i></a>');
//                }
//                if(data.ussid == 'NA=='){
//                    jQuery('img#render-avatar4').attr('src', data.urlPath+data.thumb);
//                    jQuery('img#render-avatar4').attr('data-toggle',0);
//                    //jQuery('img#render-avatar1').data('target',0);
//                    jQuery('#trash4').html('<a href="javascript:void(0)" onclick="img_unlink(this)" data-id="4" data-img="'+data.thumb+'"><i class="fa fa-trash"> Delete</i></a>');
//                }
         }
            
            jQuery('input#profile-avatar-url').val(data.thumb);
            //this.$avatar.attr('src', url+'assets/uploads/_thumb/'+data.thumb);
            this.url = data.result;
          if (this.support.datauri || this.uploaded) {
            this.uploaded = false;
            this.cropDone();
          } else {
            this.uploaded = true;
            this.$avatarSrc.val(this.url);
            this.startCropper();
          }

          this.$avatarInput.val('');
        } else if (data.message) {
          this.alert(data.message);
        }
      } else {
        this.alert('Failed to response');
      }
    },

    submitFail: function (msg) {
      this.alert(msg);
    },

    submitEnd: function () {
      this.$loading.fadeOut();
    },

    cropDone: function () {
      this.$avatarForm.get(0).reset();
      //this.$avatar.attr('src', this.url);
      this.stopCropper();
      this.$avatarModal.modal('hide');
    },

    alert: function (msg) {
      var $alert = [
            '<div class="alert alert-danger avatar-alert alert-dismissable">',
              '<button type="button" class="close" data-dismiss="alert">&times;</button>',
              msg,
            '</div>'
          ].join('');

      this.$avatarUpload.after($alert);
    }
  };

  $(function () {
    return new CropAvatar($('#crop-avatar'));
  });
  // image_limit variable use to loop at use
  var i;
  for(i=0;i<=image_limit;i++){
      jQuery(document).on('click','img#render-avatar'+i, function(){
          jQuery('input#ussmid').val(jQuery(this).data('ussuid'));  
          jQuery('input#upltypeid').val(jQuery(this).data('upltype'));
      });
  }
//  jQuery(document).on('click','img#render-avatar1', function(){
//    jQuery('input#ussmid').val(jQuery(this).data('ussuid'));  
//    jQuery('input#upltypeid').val(jQuery(this).data('upltype'));
//  });
//  jQuery(document).on('click','img#render-avatar2', function(){
//    jQuery('input#ussmid').val(jQuery(this).data('ussuid'));  
//    jQuery('input#upltypeid').val(jQuery(this).data('upltype'));
//  });
//  jQuery(document).on('click','img#render-avatar3', function(){
//    jQuery('input#ussmid').val(jQuery(this).data('ussuid'));  
//    jQuery('input#upltypeid').val(jQuery(this).data('upltype'));
//  });
//  jQuery(document).on('click','img#render-avatar4', function(){
//    jQuery('input#ussmid').val(jQuery(this).data('ussuid'));  
//    jQuery('input#upltypeid').val(jQuery(this).data('upltype'));
//  });

});