function render() {
    if ( _via_display_area_content_name !== VIA_DISPLAY_AREA_CONTENT_NAME['IMAGE'] ) {
      show_message('This functionality is only available in single image view mode');
      return;
    } else {
      var c = document.createElement('canvas');
  
      // ensures that downloaded image is scaled at current zoom level
      c.width  = _via_reg_canvas.width;
      c.height = _via_reg_canvas.height;
  
      var ct = c.getContext('2d');
      // draw current image
      ct.drawImage(_via_current_image, 0, 0, _via_reg_canvas.width, _via_reg_canvas.height);
      // draw current regions
      
  
      var cur_img_mime = 'image/jpeg';
      if ( _via_current_image.src.startsWith('data:') )  {
        var c1 = _via_current_image.src.indexOf(':', 0);
        var c2 = _via_current_image.src.indexOf(';', c1);
        cur_img_mime = _via_current_image.src.substring(c1 + 1, c2);
      }
  
      // extract image data from canvas
      var saved_img_ori = c.toDataURL(cur_img_mime);                    // masih ori
      saved_img_ori.replace(cur_img_mime, "image/octet-stream");
      
      var img_blob = dataURItoBlob(saved_img_ori);


      ct.drawImage(_via_reg_canvas, 0, 0);                          //tambahan anotasi
      var saved_img = c.toDataURL(cur_img_mime);                    // masih ori
      saved_img.replace(cur_img_mime, "image/octet-stream");

      var img_anotated_blob = dataURItoBlob(saved_img);

      saveToDatabase(img_blob, img_anotated_blob) ;
      // -> image_id
    //   var image_id = 0;
    //   saveToDatabaseAnotated(img_blob, image_id) ;
      
    //   // simulate user click to trigger download of image
    //   var a      = document.createElement('a');
    //   a.href     = saved_img;
    //   a.target   = '_blank';
    //   a.download = _via_current_image_filename;
  
    //   // simulate a mouse click event
    //   var event = new MouseEvent('click', {
    //     view: window,
    //     bubbles: true,
    //     cancelable: true
    //   });
  
    //   a.dispatchEvent(event);
    }
  }

function save_anotation_only () {
    if ( _via_display_area_content_name !== VIA_DISPLAY_AREA_CONTENT_NAME['IMAGE'] ) {
        show_message('This functionality is only available in single image view mode');
        return;
      } else {
        var c = document.createElement('canvas');
    
        // ensures that downloaded image is scaled at current zoom level
        c.width  = _via_reg_canvas.width;
        c.height = _via_reg_canvas.height;
    
        var ct = c.getContext('2d');
        // draw current image
        ct.drawImage(_via_current_image, 0, 0, _via_reg_canvas.width, _via_reg_canvas.height);
        // draw current regions
        
    
        var cur_img_mime = 'image/jpeg';
        if ( _via_current_image.src.startsWith('data:') )  {
          var c1 = _via_current_image.src.indexOf(':', 0);
          var c2 = _via_current_image.src.indexOf(';', c1);
          cur_img_mime = _via_current_image.src.substring(c1 + 1, c2);
        }
    
        // extract image data from canvas
        var saved_img_ori = c.toDataURL(cur_img_mime);                    // masih ori
        saved_img_ori.replace(cur_img_mime, "image/octet-stream");
        
  
  
        ct.drawImage(_via_reg_canvas, 0, 0);                          //tambahan anotasi
        var saved_img = c.toDataURL(cur_img_mime);                    // masih ori
        saved_img.replace(cur_img_mime, "image/octet-stream");
  
        var img_anotated_blob = dataURItoBlob(saved_img);
        var image_url = document.getElementById('image_original_id').value;

        saveAnotationOnlyToDatabase(image_url, img_anotated_blob) ;
      }
}

  function dataURItoBlob (dataURI) {
    // convert base64/URLEncoded data component to raw binary data held in a string
    var byteString;
    if (dataURI.split(',')[0].indexOf('base64') >= 0)
        byteString = atob(dataURI.split(',')[1]);
    else
        byteString = unescape(dataURI.split(',')[1]);

    // separate out the mime component
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

    // write the bytes of the string to a typed array
    var ia = new Uint8Array(byteString.length);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }

    return new Blob([ia], {type: mimeString});
    }
  function saveAnotationOnlyToDatabase(image_url, imageAnotated) {
    var data = new FormData();
    data.append('image_url', image_url);
    data.append('images[]', imageAnotated);
    if (data) {
        $.ajax({
            url: "/TA/upload/upload-anotated.php",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function (res) {
                console.log(res)
            }
        })
    }
  }

  function saveToDatabase(imageOri, imageAnotated) {
    var data = new FormData();
    data.append('images[]', imageOri);
    if (data) {
    $.ajax({
      url: "/TA/upload/upload.php",
      type: "POST",
      data: data,
      processData: false,
      contentType: false,
      success: function (res) {
            console.log(res);
            var data = new FormData();
            data.append('images[]', imageAnotated);
            data.append('image_id', res);
            console.log(data);
            if (data) {
            $.ajax({
                url: "/TA/upload/upload-anotated.php",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
            success: function (res) {
                console.log('succes');

            }});
        }
      }
    });
  }
};

function loadImages() {
    var e = document.getElementById('user_list_select');
    var value = e.options[e.selectedIndex].value;
    var text = e.options[e.selectedIndex].text;
    console.log(value, text);
    $.post('/TA/user-images.php', { user_id: value}, (data) => {
      buildImages(data);
    });
  }
  
  function selectImage(data) {
    //ketika select images, juga hide menu save all
    console.log(data);
    var e = document.getElementById('url');
    e.value = data;
    var f = document.getElementById('image_original_id');
    f.value = data;
    console.log('adasdasd');
    
    
  }
  function buildImages(data) {
    console.log(data);
    var p = document.getElementById('user_images');
    var c = document.createElement('div');
    c.setAttribute("style", "overflow-y: scroll; max-height: 200px;")
    var html = [];
    html.push(data);
    c.innerHTML = html.join('');
    p.innerHTML = '';
    p.appendChild(c);
  }
  
  function loadUser() {
    $('#save-anotation-and-original').hide();
    $('#save-only-anotation').show();
    $.get('/TA/user.php', (data)=> {
      buildData(data);
    })
  }
  
  
  function buildData(data) {
    console.log(data);
    var p = document.getElementById('user_list');
    var c = document.createElement('select');
    c.setAttribute("id", "user_list_select");
    var html = [];
    html.push(data);
    c.innerHTML = html.join('');
    p.innerHTML = '';
    p.appendChild(c);
  }
