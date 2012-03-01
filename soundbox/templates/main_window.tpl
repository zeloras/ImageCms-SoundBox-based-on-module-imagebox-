<div id="soundbox_main_tabs">

<h4>Загрузка аудио файла</h4>
<div>
    <form id="sound_upload_form" style="width:100%;" method="post" enctype="multipart/form-data" action="{site_url('admin/components/run/soundbox/upload')}">
        <div class="form_text">Выберите файл:</div>
        <div class="form_input"><input type="file" name="userfile" id="file" size="30" /></div>
        <div class="form_overflow"></div>

        <div class="form_input" style="display: none;">
            <input type="text" class="textbox_long" name="file_url" />
        </div>
        <div class="form_overflow"></div>

        <div class="form_text"></div>
        <div class="form_input">
            <input type="submit" name="action" value="Загрузить файл" class="button_silver_130" />
            <input type="button" value="Отмена"  class="button_silver_130" onclick="MochaUI.closeWindow($('soundbox_module_main_w')); return false;" />
        </div>
        <div class="form_overflow"></div>

        <iframe id="soundbox_upload_target" name="soundbox_upload_target" src="" style="width:0;height:0;border:0px solid #fff;display:none;"></iframe>
    {form_csrf()}</form>
</div>


</div> <!-- /main tabs -->

{literal}
<script>
		window.addEvent('domready', function() {
		    var soundbox_tabs = new SimpleTabs('soundbox_main_tabs', {
		    selector: 'h4'
		    });

            document.getElementById('sound_upload_form').onsubmit = function() 
            {
                document.getElementById('sound_upload_form').target = 'soundbox_upload_target';
                document.getElementById("soundbox_upload_target").onload = soundbox_uploadCallback; 
            }
        });
</script>
{/literal}
