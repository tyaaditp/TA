// Variable declaration
var _via_img_count    = 0;    // count of the loaded images
var _via_img_metadata = {};   // data structure to store loaded images metadata
var _via_img_fileref  = {};   // reference to local images selected by using browser file selector
var _via_image_index    = -1; // index
var _via_image_id_list  = []; // array of all image id (in order they were added by user)
var _via_image_filename_list  = []; // array of all image filename
var _via_img_fn_list_img_index_list    = []; // image index list of images show in img_fn_list
var _via_img_fn_list_html              = []; // html representation of image filename list
var _via_attributes   = { 'region':{}, 'file':{} };
var _via_display_area_content_name          = ''; // describes what is currently shown in display area
var VIA_DISPLAY_AREA_CONTENT_NAME = {IMAGE:'image_panel',
                                     IMAGE_GRID:'image_grid_panel',
                                     SETTINGS:'settings_panel',
                                     PAGE_404:'page_404',
                                     PAGE_USER_GUIDE:'page_user_guide',
                                     PAGE_GETTING_STARTED:'page_getting_started',
                                     PAGE_ABOUT:'page_about',
                                     PAGE_START_INFO:'page_start_info',
                                     PAGE_LICENSE:'page_license'
                                    };
var _via_image_grid_page_img_index_list = []; // list of all image index in current page of image grid
var img_fn_list = document.getElementById('img_fn_list');


//
// Handlers for top navigation bar
//
function _via_get_image_id(filename, size) {
  if ( typeof(size) === 'undefined' ) {
    return filename;
  } else {
    return filename + size;
  }
}

function project_add_new_file(filename, size) {
  if ( typeof(size) === 'undefined' ) {
    size = -1;
  }

  var img_id = _via_get_image_id(filename, size);

  if ( ! _via_img_metadata.hasOwnProperty(img_id) ) {
    _via_img_metadata[img_id] = new file_metadata(filename, size);
    _via_image_id_list.push(img_id);
    _via_image_filename_list.push(filename);
    _via_img_count += 1;
  }
  return img_id;
}

function set_file_annotations_to_default_value(image_id) {
  var attr_id;
  for ( attr_id in _via_attributes['file'] ) {
    var attr_type = _via_attributes['file'][attr_id].type;
    switch( attr_type ) {
    case 'text':
      var default_value = _via_attributes['file'][attr_id].default_value;
      _via_img_metadata[image_id].file_attributes[attr_id] = default_value;
      break;
    case 'image':    // fallback
    case 'dropdown': // fallback
    case 'radio':
      _via_img_metadata[image_id].file_attributes[attr_id] = '';
      var default_options = _via_attributes['file'][attr_id].default_options;
      _via_img_metadata[image_id].file_attributes[attr_id] = Object.keys(default_options)[0];
      break;
    case 'checkbox':
      _via_img_metadata[image_id].file_attributes[attr_id] = {};
      var default_options = _via_attributes['file'][attr_id].default_options;
      var option_id;
      for ( option_id in default_options ) {
        var default_value = default_options[option_id];
        _via_img_metadata[image_id].file_attributes[attr_id][option_id] = default_value;
      }
      break;
    }
  }
}

function get_filename_from_url( url ) {
  return url.substring( url.lastIndexOf('/') + 1 );
}

function jump_to_image(image_index) {
  if ( _via_img_count <= 0 ) {
    return;
  }
}

function img_fn_list_ith_entry_html(i) {
  var htmli = '';
  var filename = _via_image_filename_list[i];
  if ( is_url(filename) ) {
    filename = filename.substr(0,4) + '...' + get_filename_from_url(filename);
  }

  htmli += '<li id="fl' + i + '"';
  if ( _via_display_area_content_name === VIA_DISPLAY_AREA_CONTENT_NAME.IMAGE_GRID ) {
    if ( _via_image_grid_page_img_index_list.includes(i) ) {
      // highlight images being shown in image grid
      htmli += ' class="sel"';
    }

  } else {
    if ( i === _via_image_index ) {
      // highlight the current entry
      htmli += ' class="sel"';
    }
  }
  htmli += ' onclick="jump_to_image(' + (i) + ')" title="' + _via_image_filename_list[i] + '">[' + (i+1) + '] ' + filename + '</li>';
  return htmli;
}

function img_fn_list_scroll_to_file(file_index) {
  if( _via_img_fn_list_img_index_list.includes(file_index) ) {
    var sel_file     = document.getElementById( 'fl' + file_index );
    var panel_height = img_fn_list.clientHeight - 20;
    var window_top    = img_fn_list.scrollTop;
    var window_bottom = img_fn_list.scrollTop + panel_height
    if ( sel_file.offsetTop > window_top ) {
      if ( sel_file.offsetTop > window_bottom ) {
        img_fn_list.scrollTop = sel_file.offsetTop;
      }
    } else {
      img_fn_list.scrollTop = sel_file.offsetTop - panel_height;
    }
  }
}

function img_fn_list_scroll_to_current_file() {
  img_fn_list_scroll_to_file( _via_image_index );
}

function img_fn_list_generate_html(regex) {
  _via_img_fn_list_html = [];
  _via_img_fn_list_img_index_list = [];
  _via_img_fn_list_html.push('<ul>');
  for ( var i=0; i < _via_image_filename_list.length; ++i ) {
    var filename = _via_image_filename_list[i];
    if ( filename.match(regex) !== null ) {
      _via_img_fn_list_html.push( img_fn_list_ith_entry_html(i) );
      _via_img_fn_list_img_index_list.push(i);
    }
  }
  _via_img_fn_list_html.push('</ul>');
}

function update_img_fn_list() {
  var regex = document.getElementById('img_fn_list_regex').value;
  var p = document.getElementById('filelist_preset_filters_list');
  if ( regex === '' || regex === null ) {
    if ( p.selectedIndex === 0 ) {
      // show all files
      _via_img_fn_list_html = [];
      _via_img_fn_list_img_index_list = [];
      _via_img_fn_list_html.push('<ul>');
      for ( var i=0; i < _via_image_filename_list.length; ++i ) {
        _via_img_fn_list_html.push( img_fn_list_ith_entry_html(i) );
        _via_img_fn_list_img_index_list.push(i);
      }
      _via_img_fn_list_html.push('</ul>');
      img_fn_list.innerHTML = _via_img_fn_list_html.join('');
      img_fn_list_scroll_to_current_file();
    } else {
      // filter according to preset filters
      img_fn_list_onpresetfilter_select();
    }
  } else {
    img_fn_list_generate_html(regex);
    img_fn_list.innerHTML = _via_img_fn_list_html.join('');
    img_fn_list_scroll_to_current_file();
  }
}

function project_file_add_local(event) {
    var user_selected_images = event.target.files;
    
    var original_image_count = _via_img_count;
  
    var new_img_index_list = [];
    var discarded_file_count = 0;
    for ( var i = 0; i < user_selected_images.length; ++i ) {
      var filetype = user_selected_images[i].type.substr(0, 5);
      if ( filetype === 'image' ) {
        var filename = user_selected_images[i].name;
        var size     = user_selected_images[i].size;
        var img_id1  = _via_get_image_id(filename, size);
        var img_id2  = _via_get_image_id(filename, -1);
        var img_id   = img_id1;
  
        if ( _via_img_metadata.hasOwnProperty(img_id1) || _via_img_metadata.hasOwnProperty(img_id2) ) {
          if ( _via_img_metadata.hasOwnProperty(img_id2) ) {
            img_id = img_id2;
          }
          _via_img_fileref[img_id] = user_selected_images[i];
          if ( _via_img_metadata[img_id].size === -1 ) {
            _via_img_metadata[img_id].size = size;
          }
        } else {
          img_id = project_add_new_file(filename, size);
          _via_img_fileref[img_id] = user_selected_images[i];
          set_file_annotations_to_default_value(img_id);
        }
        new_img_index_list.push( _via_image_id_list.indexOf(img_id) );
      } else {
        discarded_file_count += 1;
      }
    }
  
    if ( _via_img_metadata ) {
      var status_msg = 'Loaded ' + new_img_index_list.length + ' images.';
      if ( discarded_file_count ) {
        status_msg += ' ( Discarded ' + discarded_file_count + ' non-image files! )';
      }
      show_message(status_msg);
  
      if ( new_img_index_list.length ) {
        // show first of newly added image
        _via_show_img( new_img_index_list[0] );
      } else {
        // show original image
        _via_show_img ( _via_image_index );
      }
      update_img_fn_list();
    } else {
      show_message("Please upload some image files!");
    }
}

function file_metadata(filename, size) {
  this.filename = filename;
  this.size     = size;         // file size in bytes
  this.regions  = [];           // array of file_region()
  this.file_attributes = {};    // image attributes
}

  // Add local images
function sel_local_images() {
    // source: https://developer.mozilla.org/en-US/docs/Using_files_from_web_applications
    if (invisible_file_input) {
      invisible_file_input.setAttribute('multiple', 'multiple')
      invisible_file_input.accept   = '.jpg,.jpeg,.png,.bmp';
      invisible_file_input.onchange = project_file_add_local;
      invisible_file_input.click();
    }
}