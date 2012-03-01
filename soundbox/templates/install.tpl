<div style="padding:10px;">
<h2>Установка</h2>

<ul>

<li>Скопируйте содержимое архива в директорию <b>./application/modules/</b>. Через панель управления установите модуль.</li>

<li>Создайте директории <b>./uploads/soundbox</b>, и установите права на запись(chmod 0777)</li>

<li>Откройте файл <b>./application/libraries/lib_editor.php</b> и найдите там следующий код(примерно 62 строка)

<pre>$code =  "
	
{htmlspecialchars('<!-- TinyMCE -->')}</pre>

измените его на следующий код:
<pre>$code =  "
&lt;script type=\"text/javascript\" src=\"".media_url('application/modules/soundbox/templates/js/soundbox.js')."\"&gt;&lt;/script&gt;
{htmlspecialchars('<!-- TinyMCE -->')}</pre>
</li>

<li>
Далее найдите строку "<b>relative_urls : false,</b>" и после неё вставте следующий код <br />
<pre>{literal}      setup : function(ed) {
                    ed.addButton('soundbox', {
                    title : 'SoundBox',
                    image : '/application/modules/soundbox/templates/images/button.png',
                    onclick : function() {
                                show_main_window_soundbox();
                            }
                    });
                },{/literal}</pre>
</li>

<li>
    Далее перед <b>setup: function(ed) {literal}}{/literal}</b> 
    Пропишите:
    <pre>extended_valid_elements : 'object[declare|classid|codebase|data|type|codetype|archive|standby|height|width|usemap|name|tabindex|align|border|hspace|vspace]',</pre>
    Эта строка позволит вставлять flash обекты 
</li>

<li>В нужной вам теме пропишите имя кнопки soundbox.
<br/>Например:  <b>theme_advanced_buttons1 : "bold,italic,underline,strikethrough, soundbox</b>
</li>

</ul>

</div>
