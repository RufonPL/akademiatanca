(function() {
    tinymce.PluginManager.add('rfs_signup_btn', function( editor, url ) {
        editor.addButton( 'rfs_signup_btn', {
            title: 'Wstaw przycisk - Zapisz się',
            icon: 'icon dashicons-edit',
            onclick: function() {
				var selected_text = editor.selection.getContent();
                var return_text = '';
				return_text = selected_text ? '<h6 class="btn btn-primary signup-btn">' + selected_text + '</h6>' : '';
				editor.execCommand('mceInsertContent', 0, return_text);
            }
        });
    });
})();