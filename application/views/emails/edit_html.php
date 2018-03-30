<?php
//Load Header
$this->load->view('layout/header');
?>
    <link href="<?php echo base_url(); ?>assets/css/demo.css?v=2" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/email-editor.bundle.min.css?<?php echo rand(10,1000)?>" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/colorpicker.css" rel="stylesheet" />

        <link href="<?php echo base_url(); ?>assets/css/editor-color.css" rel="stylesheet" />
        <!--for bootstrap-tour  -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-tour/build/css/bootstrap-tour.min.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/sweetalert2/dist/sweetalert2.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">

<body>
    <div class="email-builder-main-container" >
    <div class="email-editor-header">
        <div class="email-buttons">
            <button class="btn btn-email btn-sm">TEST</button>
            <button class="btn btn-email btn-sm">PREVIEW</button>
            <button class="btn btn-email save-button btn-sm">SAVE TEMPLATE</button>
            <button class="btn btn-primary pull-right btn-sm">REVIEW AND SEND</button>
            <div class="close-btn"><i class="fa fa-times"></i></div>
        </div>
        <div class="email-form">
            <div class="form-group">
                <input type="text" class="form-control email-control" placeholder="To:" >
                <button class="btn btn-email block btn-sm">NEW SEARCH</button>
            </div>
            <div class="form-group">
                <input type="text" class="form-control  email-control" placeholder="From:" >
            </div>
            <div class="form-group">
                <input type="text" class="form-control  email-control" placeholder="Subject:" >
                <button class="btn btn-email block btn-sm">MERGE</button>
            </div>
        </div>
    </div>
    <div class="bal-editor-demo">

    </div>


    <div id="previewModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Preview</h4>
            </div>
            <div class="modal-body">
            <div class="">
              <label for="">URL : </label> <span class="preview_url"></span>
            </div>
              <iframe id="previewModalFrame" width="100%" height="400px"></iframe>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!--for ace editor  -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.1.01/ace.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.1.01/theme-monokai.js" type="text/javascript"></script>

    <!--for tinymce  -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/email-editor.bundle.min.js?<?php echo rand(10,1000)?>"></script>
    <!-- <script src="assets/js/bal-email-editor-plugin.js"></script> -->


    <!--for bootstrap-tour  -->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>





                                <script>
        var _is_demo = true;

        function loadImages() {
            $.ajax({
                url: 'get-files.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.code == 0) {
                        _output = '';
                        for (var k in data.files) {
                            if (typeof data.files[k] !== 'function') {
                                _output += "<div class='col-sm-3'>" +
                                    "<img class='upload-image-item' src='" + data.directory + data.files[k] + "' alt='" + data.files[k] + "' data-url='" + data.directory + data.files[k] + "'>" +
                                    "</div>";
                                // console.log("Key is " + k + ", value is" + data.files[k]);
                            }
                        }
                        $('.upload-images').html(_output);
                    }
                },
                error: function() {}
            });
        }

    var _templateListItems;

    var  _emailBuilder=  $('.bal-editor-demo').emailBuilder({
                        //new features begin

                        showMobileView:true,
                        onTemplateDeleteButtonClick:function (e,dataId,parent) {

                            $.ajax({
                                    url: 'delete_template.php',
                                    type: 'POST',
                                    data: {
                                            templateId: dataId
                                    },
                                //  dataType: 'json',
                                    success: function(data) {
                                                parent.remove();
                                    },
                                    error: function() {}
                            });
                        },
                        //new features end

            lang: 'en',
            elementJsonUrl: '<?php echo base_url(); ?>assets/email_builder/elements-1.json',
            langJsonUrl: '<?php echo base_url(); ?>assets/email_builder/lang-1.json',
            loading_color1: 'red',
            loading_color2: 'green',
            showLoading: true,

            blankPageHtmlUrl: '<?php echo base_url(); ?>assets/email_builder/template-blank-page.html',
            loadPageHtmlUrl: 'load_html/<?php echo $id; ?>',

            //left menu
            showElementsTab: true,
            showPropertyTab: true,
            showCollapseMenu: true,
            showBlankPageButton: true,
            showCollapseMenuinBottom: true,

            //setting items
            showSettingsBar: true,
            showSettingsPreview: true,
            showSettingsExport: true,
            showSettingsSendMail: true,
            showSettingsSave: true,
            showSettingsLoadTemplate: true,

            //show context menu
            showContextMenu: true,
            showContextMenu_FontFamily: true,
            showContextMenu_FontSize: true,
            showContextMenu_Bold: true,
            showContextMenu_Italic: true,
            showContextMenu_Underline: true,
            showContextMenu_Strikethrough: true,
            showContextMenu_Hyperlink: true,

            //show or hide elements actions
            showRowMoveButton: true,
            showRowRemoveButton: true,
            showRowDuplicateButton: true,
            showRowCodeEditorButton: true,
            onElementDragStart: function(e) {
                console.log('onElementDragStart html');
            },
            onElementDragFinished: function(e,contentHtml) {
                console.log('onElementDragFinished html');
                //console.log(contentHtml);

            },

            onBeforeRowRemoveButtonClick: function(e) {
                console.log('onBeforeRemoveButtonClick html');

                /*
                  if you want do not work code in plugin ,
                  you must use e.preventDefault();
                */
                //e.preventDefault();
            },
            onAfterRowRemoveButtonClick: function(e) {
                console.log('onAfterRemoveButtonClick html');
            },
            onBeforeRowDuplicateButtonClick: function(e) {
                console.log('onBeforeRowDuplicateButtonClick html');
                //e.preventDefault();
            },
            onAfterRowDuplicateButtonClick: function(e) {
                console.log('onAfterRowDuplicateButtonClick html');
            },
            onBeforeRowEditorButtonClick: function(e) {
                console.log('onBeforeRowEditorButtonClick html');
                //e.preventDefault();
            },
            onAfterRowEditorButtonClick: function(e) {
                console.log('onAfterRowDuplicateButtonClick html');
            },
            onBeforeShowingEditorPopup: function(e) {
                console.log('onBeforeShowingEditorPopup html');
                //e.preventDefault();
            },
            onBeforeSettingsSaveButtonClick: function(e) {
                console.log('onBeforeSaveButtonClick html');
                //e.preventDefault();

                //  if (_is_demo) {
                //      $('#popup_demo').modal('show');
                //      e.preventDefault();//return false
                //  }
            },
            onPopupUploadImageButtonClick: function() {
                console.log('onPopupUploadImageButtonClick html');
                var file_data = $('.input-file').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                $.ajax({
                    url: 'upload', // point to server-side PHP script
                    dataType: 'text', // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(php_script_response) {
                        loadImages();
                    }
                });
            },

       
            onBeforeChangeImageClick: function(e) {
                console.log('onBeforeChangeImageClick html');
                loadImages();
            },
            onBeforePopupSelectTemplateButtonClick: function(e) {
                console.log('onBeforePopupSelectTemplateButtonClick html');

            },
            onBeforePopupSelectImageButtonClick: function(e) {
                console.log('onBeforePopupSelectImageButtonClick html');

            }
           
                 

        });

        $( ".save-button" ).click(function() {
            $.ajax({
                    url: 'save_html/<?php echo $id; ?>',
                    type: 'POST',
                    //dataType: 'json',
                    data: {
                        name: $('.template-name').val(),
                        content: $('.bal-content-wrapper').html()
                    },
                    success: function(data) {
                        window.location.replace("<?php echo base_url(); ?>emails?view=list");
                  
                    },
                    error: function(error) {
                        $('.input-error').text('Internal error');
                    }
                });
        });


    </script>



<style>


.bal-left-menu-container {position:absolute;}
.bal-settings {display:none;}
.bal-collapse {display:none;}
.sidebar-menu {height:30px !important;}
</style>