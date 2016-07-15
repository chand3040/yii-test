/*
Copyright 2015 Google Inc. All Rights Reserved.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

  http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/

 window.signinCallback = function (result){
  if(result.access_token) {
    var uploadVideo = new UploadVideo();
    uploadVideo.ready(result.access_token);
  }
};

var STATUS_POLLING_INTERVAL_MILLIS = 60 * 1000; // One minute.

var nid=null;
/**
 * YouTube video uploader class
 *
 * @constructor
 */
var UploadVideo = function() {
  /**
   * The array of tags for the new YouTube video.
   *
   * @attribute tags
   * @type Array.<string>
   * @default ['google-cors-upload']
   */
  this.tags = ['youtube-cors-upload'];

  /**
   * The numeric YouTube
   * [category id](https://developers.google.com/apis-explorer/#p/youtube/v3/youtube.videoCategories.list?part=snippet&regionCode=us).
   *
   * @attribute categoryId
   * @type number
   * @default 22
   */
  this.categoryId = 22;

  /**
   * The id of the new video.
   *
   * @attribute videoId
   * @type string
   * @default ''
   */
  this.videoId = '';

  this.uploadStartTime = 0;
};

 console.log(this,"this")


var Base64 = {


    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",


    encode: function(input) {
            var output = "";
            var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
            var i = 0;

            input = Base64._utf8_encode(input);

            while (i < input.length) {

                chr1 = input.charCodeAt(i++);
                chr2 = input.charCodeAt(i++);
                chr3 = input.charCodeAt(i++);

                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;

                if (isNaN(chr2)) {
                    enc3 = enc4 = 64;
                } else if (isNaN(chr3)) {
                    enc4 = 64;
                }

                output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

            }

            return output;
    },
    _utf8_encode: function(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    }
}


UploadVideo.prototype.ready = function(accessToken) {
  this.accessToken = accessToken;
  this.gapi = gapi;
  this.authenticated = true;
  this.gapi.client.request({
    path: '/youtube/v3/channels',
    params: {
      part: 'snippet',
      mine: true
    },
    callback: function(response) {
      if (response.error) {
        console.log(response.error.message);
      } else {
        //$('#channel-name').text(response.items[0].snippet.title);
        //$('#channel-thumbnail').attr('src', response.items[0].snippet.thumbnails.default.url);

        $('.pre-sign-in').hide();
        $('.post-sign-in').show();
      }
    }.bind(this)
  });
  var _self=this;

   $('.g_upload_btn').click(_self.handleUploadClicked.bind(_self));
  /*$('.g_upload_btn').click(function(){
        //  nid=$(this).data("nid");

          _self.handleUploadClicked.bind(_self);
         // $(this).on("click", _self.handleUploadClicked.bind(_self))
  });*/
};

/**
 * Uploads a video file to YouTube.
 *
 * @method uploadFile
 * @param {object} file File object corresponding to the video to upload.
 */
UploadVideo.prototype.uploadFile = function(file,filename,selector) {
      var wrapper= selector.parents('.sl-photo-box');
  var metadata = {
    snippet: {
      title:filename,
      description: "description",
      tags: this.tags,
      categoryId: this.categoryId
    },
    status: {
      privacyStatus: "public"
    }
  };


  

  var uploader = new MediaUploader({
    baseUrl: 'https://www.googleapis.com/upload/youtube/v3/videos',
    file: file,
    token: this.accessToken,
    metadata: metadata,
    params: {
      part: Object.keys(metadata).join(',')
    },
    onError: function(data) {
      var message = data;
      // Assuming the error is raised by the YouTube API, data will be
      // a JSON string with error.message set. That may not be the
      // only time onError will be raised, though.
      try {
        var errorResponse = JSON.parse(data);
        message = errorResponse.error.message;
      } finally {
        alert(message);
      }
    }.bind(this),
    onProgress: function(data) {
      var currentTime = Date.now();
      var bytesUploaded = data.loaded;
      var totalBytes = data.total;
      // The times are in millis, so we need to divide by 1000 to get seconds.
      var bytesPerSecond = bytesUploaded / ((currentTime - this.uploadStartTime) / 1000);
      var estimatedSecondsRemaining = (totalBytes - bytesUploaded) / bytesPerSecond;
      var percentageComplete = (bytesUploaded * 100) / totalBytes;

      wrapper.find('#upload-progress').attr({
        value: bytesUploaded,
        max: totalBytes
      });

       wrapper.find('#percent-transferred').text(percentageComplete);
       wrapper.find('#bytes-transferred').text(bytesUploaded);
       wrapper.find('#total-bytes').text(totalBytes);

       wrapper.find('.during-upload').show();
    }.bind(this),
    onComplete: function(data) {
      var uploadResponse = JSON.parse(data);
      this.videoId = uploadResponse.id;

        selector.text("upload video").attr('disabled','disabled');
       wrapper.find(".youtubepath").val(this.videoId);
       wrapper.find('#video-id').text(this.videoId);
       wrapper.find('.post-upload').show();
      this.pollForVideoStatus();
    }.bind(this)
  });
  // This won't correspond to the *exact* start of the upload, but it should be close enough.
  this.uploadStartTime = Date.now();
  uploader.upload();
};

UploadVideo.prototype.handleUploadClicked = function(e) {
     var URL = window.URL || window.webkitURL;

             var selector =  $(e.currentTarget);
             nid=selector.data("nid");

           
                   selector.text("uploading...");
           var _self =this;
           var id=$(e.target).data("nid");
           var uid=$(e.target).data("uid");  
          var filename=$("#Listings_drg_video"+id).val();
          var adr=filename.split("/");
          var nadr=filename;
         var reader  = new FileReader();

            //console.log(_self,this,reader,$('#fileName1').val());

               function base64ToFile(base64Data, tempfilename, contentType) {
                      contentType = contentType || '';
                      var sliceSize = 1024;

                      

                      var base64Data = base64Data.substring(base64Data.indexOf(',')+1);;
                      
                      var byteCharacters = atob(base64Data);
                      var bytesLength = byteCharacters.length;
                      var slicesCount = Math.ceil(bytesLength / sliceSize);
                      var byteArrays = new Array(slicesCount);

                      for (var sliceIndex = 0; sliceIndex < slicesCount; ++sliceIndex) {
                          var begin = sliceIndex * sliceSize;
                          var end = Math.min(begin + sliceSize, bytesLength);

                          var bytes = new Array(end - begin);
                          for (var offset = begin, i = 0 ; offset < end; ++i, ++offset) {
                              bytes[i] = byteCharacters[offset].charCodeAt(0);
                          }
                          byteArrays[sliceIndex] = new Uint8Array(bytes);
                      }
                      var file = new File(byteArrays, tempfilename, { type: contentType });
                        
                      _self.uploadFile(file,filename,selector);
                      return file;
                  } 
                           
             //http://webriderz.com/jag/www/admin/listings/listings/VideoPath

                  
              $.ajax({
                url:"/admin/listings/listings/Videopath/?id="+Base64.encode(nadr)+'&uid='+uid,
                //   url:FileUploadPath+"/?id="+Base64.encode(nadr),
                async :true,
                success:function(response){
                  base64ToFile(response,"kiran.mp4");
                  return false;
                  //_self.uploadFile(blob);
                }
              });

            /*  xhr.onload = function(e) {
                if (this.status == 200) {
                  // Note: .response instead of .responseText
                  var blob = new Blob([this.response]);
                        console.log(blob);

                  _self.uploadFile(blob);
                 
                }
              };

                         xhr.send();*/

        //  reader.readAsDataURL( $('#fileName1').val());

          return false;
    
  //this.uploadFile($('#file').get(0).files[0]);
  $(this).attr('disabled', true);
  return false;
  //this.uploadFile($('#file').get(0).files[0]);
};

UploadVideo.prototype.pollForVideoStatus = function() {
  this.gapi.client.request({
    path: '/youtube/v3/videos',
    params: {
      part: 'status,player',
      id: this.videoId
    },
    callback: function(response) {
      if (response.error) {
        // The status polling failed.
        console.log(response.error.message);
        setTimeout(this.pollForVideoStatus.bind(this), STATUS_POLLING_INTERVAL_MILLIS);
      } else {
        var uploadStatus = response.items[0].status.uploadStatus;
        switch (uploadStatus) {
          // This is a non-final status, so we need to poll again.
          case 'uploaded':
            $('#post-upload-status').append('<li>Upload status: ' + uploadStatus + '</li>');
            setTimeout(this.pollForVideoStatus.bind(this), STATUS_POLLING_INTERVAL_MILLIS);
            break;
          // The video was successfully transcoded and is available.
          case 'processed':
            //$('#player').append(response.items[0].player.embedHtml);
            $('#post-upload-status').append('<li>Final status.</li>');
            break;
          // All other statuses indicate a permanent transcoding failure.
          default:
            $('#post-upload-status').append('<li>Transcoding failed.</li>');
            break;
        }
      }
    }.bind(this)
  });
};