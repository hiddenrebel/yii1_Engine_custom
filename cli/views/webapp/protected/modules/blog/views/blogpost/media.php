 <div id='file-picker-viewer'>
    <div class='body row'></div>
    <hr/>
    <div id='myuploader'>
        <label rel='pin'><b>Upload Files
            <img style='float: left;' src='<?=Yii::App()->baseUrl;?>/images/pin.png'></b></label>
        <br/>
        <div class='files'></div>
        <div class='progressbar'>
            <div style='float: left;'>Uploading your file(s), please wait...</div>
            <img style='float: left;' src='<?=Yii::App()->baseUrl;?>/images/progressbar.gif'/>
            <div style='float: left; margin-right:10px;' class='progress'></div>
            <img style='float: left;' class='canceljob' src='<?=Yii::App()->baseUrl;?>/images/delete.png' title='cancel the upload'/>
        </div>
    </div>
    <hr/>
   <!--  <button id='select_file' class='ok_button'>Select File(s)</button>
    <button id='delete_file' class='delete_button'>Delete Selected File(s)</button>
    <button id='close_window' class='cancel_button'>Close Window</button> -->
</div>


<?php
        // -- example using jquery ui ---
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery.ui');
        // download a theme and install in your myapplication/themes/ directory
        // $cs->registerCssFile("themes/sunny/jquery-ui.min.css"); // REQUIRE A THEME
        // --

        $this->widget('application.components.MyYiiFileManViewer'
            ,array(
            // layout selectors:
                'launch_selector'=>'#file-picker',
                'list_selector'=>'#file-picker-viewer',
                'uploader_selector' => '#myuploader',
                'allow_multiple_selection'=>false,
            // messages:
                'delete_confirm_message' => 'Confirm deletion ?',
                // 'select_confirm_message' => 'Confirm selected items ?',
                'no_selection_message' => 'You are required to select some file',
            // events:
                'onBeforeAction'=>"function(viewer,action,file_ids) { return true; }",
                'onAfterAction'=>"function(viewer,action,file_ids, ok, response) { 
                    if(action == 'select'){
                        $.each(file_ids, function(i, item){ 
                            $('#logger').empty();
                            $('#logger').append('<img width=\\'100%\\' src=\''+item.url+'&size=full\'><br/>');
                            $('#BlogPost_img_post').val(item.url);
                        });
                    // required for jqueryUI
 viewer.dialog('close');// remove this line if you're not using jqueryui
}
}",

'onBeforeLaunch'=>"function(_viewer){
                // example: using jQueryUI to present into a dialog box.
    _viewer.dialog({ 
        width: '800px',
        heigth: '800px',
        position: { my: 'center' , at: 'top' , of: window },
        buttons: [ 
        { text: 'Select' , click: $.fn.yiiFilemanDialog_select },
        { text: 'Delete' , click: $.fn.yiiFilemanDialog_delete },
        { text: 'Cancel' , click: function(){ $(this).dialog('close'); } }
        ] 
    });
 $('#myuploader input[name=submit]').button();
}",

'onClientSideUploaderError'=>
"function(messages){ 
    $(messages).each(function(i,m){ 
        alert(m); 
    }); 
}
",
'onClientUploaderProgress'=>"function(status, progress){
    $('#logger').append('progress: '+status+' '+progress+'%<br/>');
}",

));
 ?>