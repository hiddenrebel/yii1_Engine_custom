<!-- required div layout begins -->
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
    <!-- <button id='select_file' class='ok_button'>Select File(s)</button> -->
    <button id='delete_file' class='delete_button'>Delete Selected File(s)</button>
    <button id='close_window' class='cancel_button'>Close Window</button>
</div>
<!-- required div layout ends -->
 
 
<?php
    // the widget
    //
    $this->widget('application.components.MyYiiFileManViewer'
    ,array(
        // layout selectors:
        // 'launch_selector'=>'#file-picker',
        'list_selector'=>'#file-picker-viewer',
        'uploader_selector' => '#myuploader',
        // messages:
        'delete_confirm_message' => 'Confirm deletion ?',
        'select_confirm_message' => 'Confirm selected items ?',
        'no_selection_message' => 'You are required to select some file',
        // events:
        'onBeforeAction'=>
            "function(viewer,action,file_ids) { return true; }",
        'onAfterAction'=>
            "function(viewer,action,file_ids, ok, response) { 
                if(action == 'select'){ 
                  // actions: select | delete
                 /* $.each(file_ids, function(i, item){ 
                  $('#logger').append('file_id='+item.file_id 
                  + ', <img src=\''+item.url+'&size=full\'><br/>');
                });*/
            }
        }",
        // 'onBeforeLaunch'=>"function(_viewer){ }",
        'onClientSideUploaderError'=>
            "function(messages){ 
                $(messages).each(function(i,m){  alert(m); }); 
            }
        ",
        'onClientUploaderProgress'=>"function(status, progress){
            $('#logger').append(
                'progress: '+status+' '+progress+'%<br/>');
            }",
        ));
?>