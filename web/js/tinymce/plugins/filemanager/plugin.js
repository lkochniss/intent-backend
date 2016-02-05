tinymce.PluginManager.add('filemanager', function(editor) {

    tinymce.activeEditor.settings.file_browser_callback = filemanager;

    function filemanager_onMessage(event){
        if(editor.settings.external_filemanager_path.toLowerCase().indexOf(event.origin.toLowerCase()) === 0){
            if(event.data.sender === 'responsivefilemanager'){
                tinymce.activeEditor.windowManager.getParams().setUrl(event.data.url);
                tinymce.activeEditor.windowManager.close();

                if(window.removeEventListener){
                    window.removeEventListener('message', filemanager_onMessage, false);
                } else {
                    window.detachEvent('onmessage', filemanager_onMessage);
                }
            }
        }
    }

    function filemanager (id, value, type, win) {
        var width = window.innerWidth-30;
        var height = window.innerHeight-60;
        if(width > 1800) width=1800;
        if(height > 1200) height=1200;
        if(width>600){
            var width_reduce = (width - 20) % 138;
            width = width - width_reduce + 10;
        }

        var title="Filemanager";

        tinymce.activeEditor.windowManager.open({
            title: title,
            file: window.location.origin+'/app_dev.php/filemanager/1',
            width: width,
            height: height,
            resizable: true,
            maximizable: true,
            inline: 1
        }, {
            setUrl: function (url) {
                var fieldElm = win.document.getElementById(id);
                fieldElm.value = editor.convertURL(url);
                if ("fireEvent" in fieldElm) {
                    fieldElm.fireEvent("onchange")
                } else {
                    var evt = document.createEvent("HTMLEvents");
                    evt.initEvent("change", false, true);
                    fieldElm.dispatchEvent(evt);
                }
            }
        });
    };
    return false;
});