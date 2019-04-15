<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Trial page</title>
    <meta name="author" content="TA-L">
    <meta name="description" content="Optan is a standalone image annotator application">

    <!-- CSS link -->
    <link rel="stylesheet" type="text/css" href="optancss.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>

  <body onload="_via_init()" onresize="_via_update_ui_components()">
    <input type="hidden" id="image_original_id" />
    <!-- used by invoke_with_user_inputs() to gather user inputs -->
    <div id="user_input_panel"></div>

    <!-- to show status messages -->
    <div id="message_panel">
      <div id="message_panel_content" class="content"></div>
    </div>

    <!-- spreadsheet like editor for annotations -->
    <div id="annotation_editor_panel" style="display: none;">
      <div class="button_panel">
        <span class="text_button" onclick="edit_region_metadata_in_annotation_editor()" id="button_edit_region_metadata" title="Manual annotations of regions">Region Annotations</span>
        <span class="text_button" onclick="edit_file_metadata_in_annotation_editor()" id="button_edit_file_metadata" title="Manual annotations of a file">File Annotations</span>

        <span class="button" style="float:right;margin-right:0.2rem;" onclick="annotation_editor_toggle_all_regions_editor()" title="Close this window of annotation editor">&times;</span>
        <span class="button" style="float:right;margin-right:0.2rem;" onclick="annotation_editor_increase_panel_height()" title="Increase the height of this panel">&uarr;</span>
        <span class="button" style="float:right;margin-right:0.2rem;" onclick="annotation_editor_decrease_panel_height()" title="Decrease the height of this panel">&darr;</span>
        <span class="button" style="float:right;margin-right:0.2rem;" onclick="annotation_editor_increase_content_size()" title="Increase size of contents in annotation editor">&plus;</span>
        <span class="button" style="float:right;margin-right:0.2rem;" onclick="annotation_editor_decrease_content_size()" title="Decrease size of contents in annotation editor">&minus;</span>
      </div>
      <!-- here, a child div with id="annotation_editor" is added by javascript -->
    </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container" id="ui_top_panel">
      <!-- menu bar -->
      <!-- <div class="menubar">
        <img src="minilogo.png" alt="minilogo optan" style="width:5em;">
        <ul> -->
      <div class="menubar collapse navbar-collapse" id="navbarSupportedContent">
        <img src="minilogo.png" alt="minilogo optan" class="mr-2" style="width:5em;">
        <ul class="navbar-nav mr-auto" style="color: white;">  
          <!-- <li onclick="show_home_panel()" style="cursor:pointer; font-family: Helvetica; font-size:175%; color:rgb(230, 199, 28)"><b>OPTAN</b></li> -->
          <li class="nav-item active">Project
            <ul>
              <!-- <li onclick="project_open_select_project_file()" title="Load a VIA project (from a JSON file)">Load</li> -->
              <li id="save-anotation-and-original" onclick="saving()" title="save to database">Save All</li> <!-- (as a JSON file)-->
              <li id="save-only-anotation" onclick="saving_annotation()" title="save to database">Save Anotation Only</li> <!-- (as a JSON file)-->
              <!-- <li onclick="settings_panel_toggle()" title="Show/edit project settings">Settings</li> -->
              <!-- <li class="submenu_divider"></li> -->
              <li class="submenu_divider"></li>
              <li onclick="sel_local_images()" title="Add images locally stored in this computer">Add local files</li>
              <!-- <li onclick="sel_local_images()" title="Add images from reference expert">Select Reference</li> -->
              <li onclick="project_file_add_url_with_input()" title="Select Reference">Select Reference</li>
              <!-- <li onclick="project_file_add_abs_path_with_input()" title="Add images using absolute path of file (e.g. /home/abhishek/image1.jpg)">Add file using absolute path</li> -->
              <!-- <li onclick="sel_local_data_file('files_url')" title="Add images from a list of web url or absolute path stored in a text file (one url or path per line)">Add url or path from text file</li> -->
              <!-- <li onclick="project_file_remove_with_confirm()" title="Remove selected file (i.e. file currently being shown)">Remove file</li> -->
              <!-- <li onclick="sel_local_data_file('attributes')" title="Import region and file attributes from a JSON file">Import region/file attributes</li> -->
              <!-- <li onclick="project_save_attributes()" title="Export region and file attributes to a JSON file">Export region/file attributes</li> -->
            </ul>
          </li>

          <li class="nav-item active">Annotation
            <ul>
              <!-- <li onclick="download_all_region_data('csv')" title="Export annotations to a CSV file">Export Annotations (as csv)</li> -->
              <!-- <li onclick="download_all_region_data('json')" title="Export annotaitons to a JSON file">Export Annotations (as json)</li>
              <li onclick="" class="submenu_divider"></li> -->
              <!-- <li onclick="sel_local_data_file('annotations')" title="Import annotations from a CSV file">Import Annotations (from csv)</li> -->
              <!-- <li onclick="sel_local_data_file('annotations')" title="Import annotations from a JSON file">Import Annotations (from json)</li> -->
              <!-- <li class="submenu_divider"></li> -->
              <li onclick="show_annotation_data()" title="Show a preview of annotations (opens in a new browser windows)">Preview Annotations</li>
              <li onclick="download_as_image()" title="Download an image containing the annotations">Download as Image</li>
              <li class="submenu_divider"></li>
              <li  title="Compare the image to check similarity"> <a href= "/TA/perbandingan/hasilPerbandingan.php"> Check the Similarity </a> </li>
            </ul>
          </li>

          <li class="nav-item active">View
            <ul>
              <!-- <li onclick="image_grid_toggle()" title="Toggle between single image view and image grid view">Toggle image grid view</li>
              <li onclick="leftsidebar_toggle()" title="Show or hide the sidebar shown in left hand side">Toggle left sidebar</li>
<li onclick="toggle_img_fn_list_visibility()" title="Show or hide a panel to update annotations corresponding to file and region">Toggle image filename list</li>
              <li class="submenu_divider"></li>
              <li onclick="toggle_attributes_editor()" title="Show or hide a panel to update file and region attributes">Toggle attributes editor</li>
              <li onclick="annotation_editor_toggle_all_regions_editor()" title="Show or hide a panel to update annotations corresponding to file and region">Toggle annotation editor (Space)</li>
              <li class="submenu_divider"></li> -->
              <li onclick="toggle_region_boundary_visibility()" title="Show or hide the region boundaries">Show/hide region boundaries (b)</li>
              <li onclick="toggle_region_id_visibility()" title="Show or hide the region id labels">Show/hide region labels (l)</li>
            </ul>
          </li>

          <!--<li>Help
            <ul>
              <li onclick="set_display_area_content(VIA_DISPLAY_AREA_CONTENT_NAME.PAGE_GETTING_STARTED)" title="Show a guide to get started with this application">Getting Started</li>
              <li title="Visit the project page for this application"><a href="http://www.robots.ox.ac.uk/~vgg/software/via/" target="_blank">VGG Project Page</a></li>
              <li onclick="" title="Report an issue to the developers of this application (requires an account at gitlab.com)"><a href="https://gitlab.com/vgg/via/issues" target="_blank">Report issues</a></li>
              <li class="submenu_divider"></li>
              <li><a target="_blank" href="https://gitlab.com/vgg/via/blob/master/Contributors.md" title="List of people who have contributed towards the development of VIA">Contributors</a></li>
              <li onclick="set_display_area_content(VIA_DISPLAY_AREA_CONTENT_NAME.PAGE_LICENSE)" title="View license of this application">License</li>
              <li onclick="set_display_area_content(VIA_DISPLAY_AREA_CONTENT_NAME.PAGE_ABOUT)" title="Show more details about this application">About VIA</li>
            </ul>
          </li>-->
        </ul>
      </div> <!-- end of menubar -->

      <!-- Shortcut toolbar -->
      <div class="toolbar collapse navbar-collapse" id="navbarSupportedContent">
        <a><img src="svg/si-glyph-folder-open.svg" style="width:16px; height:16px;" title="Open File" id="icon_open" onclick="project_open_select_project_file()"></a>
        <!-- <a><img src="svg/si-glyph-floppy-disk.svg" style="width:16px; height:16px;" title="Save Project" id="icon_save" onclick="project_save_with_confirm()"></a> -->
        <!-- <a><img src="svg/si-glyph-floppy-disk.svg" style="width:16px; height:16px;" title="Save Project" id="icon_save" onclick="download_as_image()"></a> -->
        <!-- <a><img src="svg/si-glyph-gear.svg" style="width:16px; height:16px;" title="Setting" onclick="settings_panel_toggle()"></a> -->
        <!-- <a><img src="svg/si-glyph-arrow-thin-left.svg" style="width:16px; height:16px;" title="Previous Project" id="icon_prev" onclick="move_to_prev_image()"></a>
        <a><img src="svg/si-glyph-arrow-thin-right.svg" style="width:16px; height:16px;" title="Next Project" id="icon_next" onclick="move_to_next_image()"></a> -->
        <a><img src="svg/si-glyph-zoom-in.svg" style="width:16px; height:16px;" title="Zoom In" id="icon_zoomin" onclick="zoom_in()"></a>
        <a><img src="svg/si-glyph-zoom-out.svg" style="width:16px; height:16px;" title="Zoom Out" id="icon_zoomout" onclick="zoom_out()"></a>
        <a><img src="svg/si-glyph-document-copy.svg" style="width:16px; height:16px;" title="Copy Region" id="icon_copy" onclick="copy_sel_regions()"></a>
        <a><img src="svg/si-glyph-clipboard.svg" style="width:16px; height:16px;" title="Paste Region" id="icon_paste" onclick="paste_sel_regions_in_current_image()"></a>
        <a><img src="svg/si-glyph-square-eight-angle-point.svg" style="width:16px; height:16px;" title="Select Region" id="icon_selectall" onclick="sel_all_regions()"></a>
        <a><img src="svg/si-glyph-delete.svg" style="width:16px; height:16px;" title="Delete Selected Region" id="icon_close" onclick="del_sel_regions()"></a>
        <!-- <svg onclick="project_save_with_confirm()" viewbox="0 0 24 24"><use xlink:href="#icon_save"></use><title>Save Project</title></svg>
        <svg onclick="settings_panel_toggle()" viewbox="0 0 24 24"><use xlink:href="#icon_settings"></use><title>Update Project Settings</title></svg> -->
        <!--
        <svg onclick="" viewbox="0 0 24 24"><use xlink:href="#icon_checkbox"></use><title>Locate Files</title></svg>
        -->

        <!-- <svg onclick="sel_local_data_file('annotations')" style="margin-left:1rem;" viewbox="0 0 24 24"><use xlink:href="#icon_fileupload"></use><title>Import Annotations from CSV</title></svg>
        <svg onclick="download_all_region_data('csv')" viewbox="0 0 24 24"><use xlink:href="#icon_filedownload"></use><title>Download Annotations as CSV</title></svg> -->

        <!--<svg onclick="image_grid_toggle()" id="toolbar_image_grid_toggle" style="margin-left:1rem;" viewbox="0 0 24 24"><use xlink:href="#icon_gridon"></use><title>Switch to Image Grid View</title></svg>
        <svg onclick="annotation_editor_toggle_all_regions_editor()" viewbox="0 0 24 24"><use xlink:href="#icon_insertcomment"></use><title>Toggle Annotation Editor</title></svg>-->

        <!-- <svg onclick="move_to_prev_image()" style="margin-left:1rem;" viewbox="0 0 24 24"><use xlink:href="#icon_prev"></use><title>Previous</title></svg>
        <svg onclick="toggle_img_fn_list_visibility()" viewbox="0 0 24 24"><use xlink:href="#icon_list"></use><title>Toggle Filename List</title></svg>
        <svg onclick="move_to_next_image()" viewbox="0 0 24 24"><use xlink:href="#icon_next"></use><title>Next</title></svg>

        <svg onclick="zoom_in()" style="margin-left:1rem;" viewbox="0 0 24 24"><use xlink:href="#icon_zoomin"></use><title>Zoom In</title></svg>
        <svg onclick="zoom_out()" viewbox="0 0 24 24"><use xlink:href="#icon_zoomout"></use><title>Zoom Out</title></svg>

        <svg onclick="sel_all_regions()" viewbox="0 0 24 24" style="margin-left:1rem;"><use xlink:href="#icon_selectall"></use><title>Select All Regions</title></svg>
        <svg onclick="copy_sel_regions()" viewbox="0 0 24 24"><use xlink:href="#icon_copy"></use><title>Copy Regions</title></svg>
        <svg onclick="paste_sel_regions_in_current_image()" viewbox="0 0 24 24"><use xlink:href="#icon_paste"></use><title>Paste Regions</title></svg> -->
        <!--<svg onclick="paste_to_multiple_images_with_confirm()" viewbox="0 0 24 24"><use xlink:href="#icon_pasten"></use><title>Paste Region in Multiple Images</title></svg>
        <svg onclick="del_sel_regions_with_confirm()" viewbox="0 0 24 24"><use xlink:href="#icon_pasteundo"></use><title>Undo Regions Pasted in Multiple Images</title></svg>-->
        <!-- <svg onclick="del_sel_regions()" viewbox="0 0 24 24"><use xlink:href="#icon_close"></use><title>Delete Region</title></svg> -->
      
      <!-- Annotation Region Shape -->
        <a id="region_shape_rect" class="selected" onclick="select_region_shape('rect')" style="display: none;"><img src="svg/Rectangle_Stroked.svg" style="width:20px; height:20px; padding-left: 0.1rem;" title="Rectangle"></a>
        <a id="region_shape_circle" onclick="select_region_shape('circle')"><img src="svg/circle.svg" style="width:20px; height:20px; padding-left: 0.1rem;" title="Circle" id="shape_circle"></a>
        <a id="region_shape_ellipse" onclick="select_region_shape('ellipse')"><img src="svg/Ellipse.svg" style="width:30px; height:21px; padding-left: 0.1rem;" title="Ellipse" id="shape_ellipse"></a>
        <a id="region_shape_polygon" onclick="select_region_shape('polygon')"><img src="svg/Pentagon.svg" style="width:20px; height:20px; padding-left: 0.1rem;" title="Polygon" id="shape_polygon"></a>
        <a id="region_shape_point" onclick="select_region_shape('point')"><img src="svg/si-glyph-circle.svg" style="width:10px; height:10px; padding-left: 0.1rem;" title="Point" id="shape_point"></a>
        <a id="region_shape_polyline" onclick="select_region_shape('polyline')"><img src="svg/Polyline.svg" style="width:20px; height:20px; padding-left: 0.1rem;" title="Polyline" id="shape_polyline"></a>
        
      </div>
      <form action="" class="form-inline my-2 my-lg-0">
        <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="logout.php" style="color:beige;">Logout</a>
        <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="" style="color:beige;"><?php echo $_SESSION['username'] ?></a>
      </form>
      <!-- <a class="btn btn-outline-secondary d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="logout.php">Logout</a> -->
      <!-- <form class="form-inline my-2 my-lg-1" style="display: inline-block;">
        <input class="form-control mr-sm-2 pb-2" type="search" placeholder="Similarity" aria-label="Search">
        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" style="">Logout</button>
        <a class="btn btn-outline-secondary d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="logout.php">Logout</a>
      </form> -->
      
      <!-- <div class="user">
        <a>Logout</a>
      </div> -->

      <!-- end of shortcut toolbar -->
      <input type="file" id="invisible_file_input" name="files[]" style="display:none">
    </div> <!-- endof #top_panel -->
  </nav>

    <!-- Middle Panel contains a left-sidebar and image display areas -->
    <div class="middle_panel">
      <!-- this panel contains a button to shows the left side bar -->
      <div id="leftsidebar_collapse_panel">
        <span class="text_button" onclick="leftsidebar_toggle()" title="Show left sidebar">&rtrif;</span>
      </div>

      <div id="leftsidebar">
        <div class="leftsidebar_accordion_panel" style="float:right; border:2px solid #f2f2f2;">
          <span class="text_button" onclick="leftsidebar_decrease_width()" title="Reduce width of this toolbar panel">&larr;</span>
          <span class="text_button" onclick="leftsidebar_increase_width()" title="Increase width of this toolbar panel">&rarr;</span>
          <span class="text_button" onclick="leftsidebar_toggle()" title="Show/hide this toolbar panel">&ltrif;</span>
        </div>

        <!-- Project -->
        <button class="leftsidebar_accordion active" id="project_panel_title" style="display:none;">Project</button>
        <div class="leftsidebar_accordion_panel show" id="img_fn_list_panel" style="display:none;">
          <div id="project_info_panel">
            <div class="row">
              <span class="col"><label for="project_name">Name: </label></span>
              <span class="col"><input type="text" value="" onchange="project_on_name_update(this)" id="project_name" title="VIA project name"></span>
            </div>
          </div>
          <div id="project_tools_panel">
            <div class="button_panel" style="margin:0.1rem 0;" >
              <select style="width:48%" id="filelist_preset_filters_list" onchange="img_fn_list_onpresetfilter_select()" title="Filter file list using predefined filters">
                <option value="all">All files</option>
                <option value="files_without_region">Show files without regions</option>
                <option value="files_missing_region_annotations">Show files missing region annotations</option>
                <option value="files_missing_file_annotations">Show files missing file annotations</option>
                <option value="files_error_loading">Files that could not be loaded</option>
                <option value="regex">Regular Expression</option>
              </select>
              <input style="width:50%" type="text" placeholder="regular expression" oninput="img_fn_list_onregex()" id="img_fn_list_regex" title="Filter using regular expression">
            </div>
          </div>
          <div id="img_fn_list"></div>
          <p>
            <div class="button_panel">
              <span class="button" onclick="sel_local_images()" title="Add new file from local disk">Add Files</span>
              <span class="button" onclick="project_file_remove_with_confirm()" title="Remove selected file (i.e. file currently being shown) from project">Remove</span>
            </div>
          </p>
        </div>

        <!-- Attributes -->

	</div> <!-- end of leftsidebar -->

      <!-- Main display area: contains image canvas, ... -->
      <div id="display_area">
        <div id="image_panel" class="display_area_content display_none">
          <!-- buffer images using <img> element will be added here -->

          <!-- @todo: in future versions, this canvas will be replaced by a <svg> element -->
            <canvas id="region_canvas" width="1" height="1" tabindex="1">Sorry, your browser does not support HTML5 Canvas functionality which is required for this application.</canvas>
            <!-- here, a child div with id="annotation_editor" is added by javascript -->
        </div>
        <div id="image_grid_panel" class="display_area_content display_none">

          <div id="image_grid_group_panel">
            <span class="tool">Group by&nbsp; <select id="image_grid_toolbar_group_by_select" onchange="image_grid_toolbar_onchange_group_by_select(this)"></select></span>
          </div>

          <div id="image_grid_toolbar">
            <span>Selected</span>
            <span id="image_grid_group_by_sel_img_count">0</span>
            <span>of</span>
            <span id="image_grid_group_by_img_count">0</span>
            <span>images in current group, show</span>

            <span>
              <select id="image_grid_show_image_policy" onchange="image_grid_onchange_show_image_policy(this)">
                <option value="all">all images (paginated)</option>
                <option value="first_mid_last">only first, middle and last image</option>
                <option value="even_indexed">even indexed images (i.e. 0,2,4,...)</option>
                <option value="odd_indexed">odd indexed images (i.e. 1,3,5,...)</option>
                <option value="gap5">images 1, 5, 10, 15,...</option>
                <option value="gap25">images 1, 25, 50, 75, ...</option>
                <option value="gap50">images 1, 50, 100, 150, ...</option>
              </select>
            </span>

            <div id="image_grid_nav"></div>
          </div>

          <div id="image_grid_content">
            <div id="image_grid_content_img"></div>
            <svg xmlns:xlink="http://www.w3.org/2000/svg" id="image_grid_content_rshape"></svg>
          </div>

          <div id="image_grid_info">
          </div>
        </div> 
        <!-- end of image grid panel -->

        <div id="settings_panel" class="display_area_content display_none">
          <h2>Settings</h2>
          <div class="row">
            <div class="variable">
              <div class="name">Project Name</div>
            </div>

            <div class="value">
              <input type="text" id="_via_settings.project.name"/>
            </div>
          </div>

          <div class="row">
            <div class="variable">
              <div class="name">Default Path</div>
              <div class="desc">If all images in your project are saved in a single folder, set the default path to the location of this folder. The VIA application will load images from this folder by default. Note: a default path of <code>"./"</code> indicates that the folder containing <code>via.html</code> application file also contains the images in this project. For example: <code>/datasets/VOC2012/JPEGImages/</code> or <code>C:\Documents\data\</code>&nbsp;<strong>(note the trailing <code>/</code> and <code>\</code></strong>)</div>
            </div>

            <div class="value">
              <input type="text" id="_via_settings.core.default_filepath" placeholder="/datasets/pascal/voc2012/VOCdevkit/VOC2012/JPEGImages/"/>
            </div>
          </div>

          <div class="row">
            <div class="variable">
              <div class="name">Search Path List</div>
              <div class="desc">If you define multiple paths, all these folders will be searched to find images in this project. We do not recommend this approach as it is computationally expensive to search for images in multiple folders. <ol id="_via_settings.core.filepath"></ol></div>
            </div>

            <div class="value">
              <input type="text" id="settings_input_new_filepath" placeholder="/datasets/pascal/voc2012/VOCdevkit/VOC2012/JPEGImages"/>
            </div>
          </div>

          <div class="row">
            <div class="variable">
              <div class="name">Region Label</div>
              <div class="desc">By default, each region in an image is labelled using the region-id. Here, you can select a more descriptive labelling of regions.</div>
            </div>

            <div class="value">
              <select id="_via_settings.ui.image.region_label"></select>
            </div>
          </div>

          <div class="row">
            <div class="variable">
              <div class="name">Region Label Font</div>
              <div class="desc">Font size and font family for showing region labels.</div>
            </div>

            <div class="value">
              <input id="_via_settings.ui.image.region_label_font" placeholder="12px Arial"/>
            </div>
          </div>

          <div class="row">
            <div class="variable">
              <div class="name">Preload Buffer Size</div>
              <div class="desc">Images are preloaded in buffer to allow smoother navigation of next/prev images. A large buffer size may slow down the overall browser performance. To disable preloading, set buffer size to 0.</div>
            </div>
            <div class="value">
              <input type="text" id="_via_settings.core.buffer_size" />
            </div>
          </div>

          <div class="row">
            <div class="variable">
              <div class="name">On-image Annotation Editor</div>
              <div class="desc">When a single region is selected, the on-image annotation editor is gets activated which the user to update annotations of this region. By default, this on-image annotation editor is placed near the selected region.</div>
            </div>

            <div class="value">
              <select id="_via_settings.ui.image.on_image_annotation_editor_placement">
                <option value="NEAR_REGION">close to selected region</option>
                <option value="IMAGE_BOTTOM">at the bottom of image being annotated</option>
                <option value="DISABLE">DISABLE on-image annotation editor</option>
              </select>
            </div>
          </div>

          <div class="row" style="border:none;">
            <button onclick="settings_save()" value="save_settings" style="margin-top:2rem">Save</button>
            <button onclick="settings_panel_toggle()" value="cancel_settings" style="margin-left:2rem;">Cancel</button>
          </div>
        </div> <!-- end of settings panel -->

        <div id="page_404" class="display_area_content display_none narrow_page_content">
          <h2>File Not Found</h2>
          <p>Filename: <span style="font-family:Mono;" id="page_404_filename"></span></p>

          <p>We recommend that you update the default path in <span class="text_button" title="Show Project Settings" onclick="settings_panel_toggle()">project settings</span> to the folder which contains this image.</p>

          <p>A temporary fix is to use <span class="text_button" title="Load or Add Images" onclick="sel_local_images()">browser's file selector</span> to manually locate and add this file. We do not recommend this approach because it requires you to repeat this process every time your load this project in the VIA application.</p>
        </div> <!-- end of file not found panel -->

        <div id="page_start_info" class="display_area_content display_none narrow_page_content">
          <!--<ul>
            <li>To start annotation, select images by <span class="text_button" title="Load or Add Images" onclick="sel_local_images()">Add Files</span> (or, add images from <span class="text_button" title="Add images from a web URL (e.g. http://www.robots.ox.ac.uk/~vgg/software/via/images/swan.jpg)" onclick="project_file_add_url_with_input()">URL</span> or <span class="text_button" title="Add images using absolute path of file (e.g. /home/abhishek/image1.jpg)" onclick="project_file_add_abs_path_with_input()">absolute path</span>) and draw regions</li>
            <li>Use <span class="text_button" title="Toggle attributes editor panel" onclick="toggle_attributes_editor()">attribute editor</span> to define attributes (e.g. name) and <span class="text_button" title="Toggle annotations editor panel" onclick="annotation_editor_toggle_all_regions_editor()">annotation editor</span> to describe each region (e.g. cat) using these attributes.</li>
            <li>Remember to <span class="text_button" onclick="project_save_with_confirm()">save</span> your project before closing this application so that you can <span class="text_button" onclick="project_open_select_project_file()">load</span> it later to continue annotation.</li>
            <li>For help, see the <span class="text_button" onclick="set_display_area_content(VIA_DISPLAY_AREA_CONTENT_NAME.PAGE_GETTING_STARTED)">Getting Started</span> page and pre-loaded demo: <a href="http://www.robots.ox.ac.uk/~vgg/software/via/via_demo.html">image annotation</a> and <a href="http://www.robots.ox.ac.uk/~vgg/software/via/via_face_demo.html">face annotation</a>.</li>
          </ul>-->

        </div>

        <!-- <div id="page_getting_started" class="display_area_content display_none narrow_page_content">
          <p>A more detailed user guide (with screenshots and descriptions) is <a href="http://www.robots.ox.ac.uk/~vgg/software/via/docs/user_guide.html">available here</a>.</p>
          <ol>
            <li><strong>Load Images</strong>: The first step is to load all the images that you wish to annotate. There are multiple ways to add images to a VIA project. Choose the method that suits your use case.
              <ul>
                <li>Method 1: Selecting local files using browser's file selector
                  <ol>
                    <li>Click <span class="text_button" title="Load or Add Images" onclick="sel_local_images()"><code>Project &rarr; Add local files</code></span></li>
                    <li>Select desired images and click <code>Open</code></li>
                  </ol>
                </li>
                <li>Method 2: Adding files from URL or absolute path
                  <ol>
                    <li>Click <span class="text_button" title="Add images from a web URL (e.g. http://www.robots.ox.ac.uk/~vgg/software/via/images/swan.jpg)" onclick="project_file_add_url_with_input()"><code>Project &rarr; Add files from URL</code></span></li>
                    <li>Enter URL and click <code>OK</code></li>
                  </ol>
                </li>
                <li>Method 3: Adding files from list of url or absolute path stored in text file
                  <ol>
                    <li>Create a text file containing URL and absolute path (one per line)</li>
                    <li>Click <span class="text_button" title="Add images from a list of web url or absolute path stored in a text file (one url or path per line)" onclick="sel_local_data_file('files_url')"><code>Project &rarr; Add url or path from text file</code></span></li>
                    <li>Select the text file and click <code>Open</code></li>
                  </ol>
                </li>
              </ul>
            </li>
            <li><strong>Draw Regions</strong>: Select a region shape (<span class="text_button" onclick="select_region_shape('rect')">rectangle</span>, <span class="text_button" onclick="select_region_shape('circle')">circle</span>, <span class="text_button" onclick="select_region_shape('ellipse')">ellipse</span>, <span class="text_button" onclick="select_region_shape('polygon')">polygon</span>, <span class="text_button" onclick="select_region_shape('point')">point</span>, <span class="text_button" onclick="select_region_shape('polyline')">polyline</span>) from the left sidebar and draw regions as follows:

              <ul>
                <li>Rectangle, Circle and Ellipse
                  <ul>
                    <li>Press left mouse button, drag mouse cursor and release mouse button.</li>
                    <li>To define a point inside an existing region, click inside the region to select it (if not already selected), now press left mouse button, drag and release to draw region inside existing region.</li>
                    <li>To select, click inside the region. If the click point contains multiple regions, then clicking multiple times at that location shuffles selection through those regions.</li>
                  </ul>
                </li>
              </ul>

              <ul>
                <li>Point
                  <ul>
                    <li>Click to define points.</li>
                    <li>To draw a region inside existing region, click inside the region to select it (if not already selected), now click again to define the point.</li>
                    <li>To select, click on (or near) the existing point.</li>
                  </ul>
                </li>
              </ul>

              <ul>
                <li>Polygon and Polyline
                  <ul>
                    <li>Click to define vertices.</li>
                    <li>Press <strong>[Enter]</strong> to finish drawing the region or press [Esc] to cancel.</li>
                    <li>If the first vertex needs to be defined inside an existing region, click inside the region to select it (if not already selected), now click again to define the vertex.</li>
                    <li>To select, click inside the region. If the click point contains multiple regions, then clicking multiple times at that location shuffles selection through those regions.</li>
                  </ul>
                </li>
              </ul>
            </li>

            <li><strong>Create Annotations</strong>: For a more detailed description of this step, see <a href="http://www.robots.ox.ac.uk/~vgg/software/via/docs/creating_annotations.html">Creating Annotations : VIA User Guide</a>. Click the <span class="text_button" onclick="annotation_editor_toggle_all_regions_editor()"><code>View &rarr; Toggle attributes editor</code></span> to show attributes editor panel in left sidebar and add the desired file or region attributes (e.g. name). Now click <span class="text_button" onclick="annotation_editor_toggle_all_regions_editor()"><code>View &rarr; Toggle annotations editor</code></span> to show the annotation editor panel in the bottom side. Update the annotations for each region.</li>
            <li><strong>Export Annotations</strong>: To export the annotations in json or csv format, click <span class="text_button" onclick="download_all_region_data('csv')"><code>Annotation &rarr; Export annotations</code></span> in top menubar.</li>
            <li><strong>Save Project</strong>: To save the project, click <span class="text_button" onclick="project_save_with_confirm()"><code>Project &rarr; Save</code></span> in top menubar.</li>
          </ol>
        </div> -->

        <div id="page_load_ongoing" class="display_area_content narrow_page_content">
          <div style="text-align:center">
            <!-- <a href="http://www.robots.ox.ac.uk/~vgg/software/via/">
              <svg height="160" viewbox="0 0 400 160" style="background-color:#212121;">
                <use xlink:href="#via_logo"></use>
              </svg>
            </a> -->
            <div style="margin-top:4rem">Loading ...</div>
          </div>
        </div>

        <!-- <div id="page_about" class="display_area_content display_none" style="width:40rem !important">
          <div style="text-align:center">
            <a href="http://www.robots.ox.ac.uk/~vgg/software/via/">
              <svg height="160" viewbox="0 0 400 160" style="background-color:#212121;">
                <use xlink:href="#via_logo"></use>
              </svg>
            </a>
          </div>

          <p style="font-family:mono; font-size:0.8em;text-align:center;"><a href="https://gitlab.com/vgg/via/blob/master/CHANGELOG">Version 2.0.5</a></p>
          <p>VGG Image Annotator (VIA) is an image annotation tool that can be used to define regions in an image and create textual descriptions of those regions. VIA is an <a href="https://gitlab.com/vgg/via/">open source project</a> developed at the <a href="http://www.robots.ox.ac.uk/~vgg/">Visual Geometry Group</a> and released under the BSD-2 clause <a href="https://gitlab.com/vgg/via/blob/master/LICENSE">license</a>.</p>
          <p>Here is a list of some salient features of VIA:
            <ul>
              <li>based solely on HTML, CSS and Javascript (no external javascript libraries)</li>
              <li>can be used off-line (full application in a single html file of size &lt; 400KB)</li>
              <li>requires nothing more than a modern web browser (tested on Firefox, Chrome and Safari)</li>
              <li>supported region shapes: rectangle, circle, ellipse, polygon, point and polyline</li>
              <li>import/export of region data in csv and json file format</li>
            </ul>
          </p>
          <p>For more details, visit <a href="http://www.robots.ox.ac.uk/~vgg/software/via/">http://www.robots.ox.ac.uk/~vgg/software/via/</a>.</p>
          <p>&nbsp;</p>
          <p>Copyright &copy; 2016-2018, <a href="mailto:adutta-removeme@robots.ox.ac.uk">Abhishek Dutta</a>,Visual Geometry Group, Oxford University and <a target="_blank" href="https://gitlab.com/vgg/via/blob/master/Contributors.md">VIA Contributors</a>.</p>
        </div> end of page_about -->

        <div id="page_license" class="display_area_content display_none narrow_page_content">
          <pre>
Copyright (c) 2016-2018, Abhishek Dutta, Visual Geometry Group, Oxford University and VIA Contributors.
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this
list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice,
this list of conditions and the following disclaimer in the documentation
and/or other materials provided with the distribution.
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS &quot;AS IS&quot;
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
POSSIBILITY OF SUCH DAMAGE.
          </pre>
        </div>
      </div> <!-- end of display_area -->
    </div> <!-- end of middle_panel -->

    <!-- this vertical spacer is needed to allow scrollbar to show
         items like Keyboard Shortcut hidden under the attributes panel -->
    <div style="width: 100%;" id="vertical_space"></div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/via.js"></script>
    <script src="js/anotasi.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>