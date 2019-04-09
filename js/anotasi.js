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
      ct.drawImage(_via_reg_canvas, 0, 0);
  
      var cur_img_mime = 'image/jpeg';
      if ( _via_current_image.src.startsWith('data:') )  {
        var c1 = _via_current_image.src.indexOf(':', 0);
        var c2 = _via_current_image.src.indexOf(';', c1);
        cur_img_mime = _via_current_image.src.substring(c1 + 1, c2);
      }
  
      // extract image data from canvas
      var saved_img = c.toDataURL(cur_img_mime);
      saved_img.replace(cur_img_mime, "image/octet-stream");
  
      // simulate user click to trigger download of image
      var a      = document.createElement('a');
      a.href     = saved_img;
      a.target   = '_blank';
      a.download = _via_current_image_filename;
  
      // simulate a mouse click event
      var event = new MouseEvent('click', {
        view: window,
        bubbles: true,
        cancelable: true
      });
  
      a.dispatchEvent(event);
    }
  }