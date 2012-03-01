
function show_main_window_soundbox()
{
        //tinyMCE.activeEditor.selection.setContent('asd'); // Insert image code

		new MochaUI.Window({
			id: 'soundbox_module_main_w',
			title: 'SoundBox',
			type: 'modal',
			loadMethod: 'xhr',
			contentURL: base_url + 'admin/components/cp/soundbox/main',
			width: 550,
			height: 450
		});
}

function soundbox_uploadCallback()
{
    var imgIFrame = document.getElementById('soundbox_upload_target');
    var data = imgIFrame.contentWindow.document.body.innerHTML;

    if (data.test('Error:') == true)
    {
        showMessage('Ошибка', data);
    }else{
        tinyMCE.activeEditor.selection.setContent( data );
        MochaUI.closeWindow($('soundbox_module_main_w'));
    }
}

