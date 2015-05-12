tinyMCE.init({
        mode : "specific_textareas",
        editor_selector : "mceEditor",
        language : "cs",
        entity_encoding : "raw",
        width : "610",
        height : "300",
        theme_advanced_layout_manager : "SimpleLayout",
        plugins : "paste",
        theme_advanced_buttons1 : "undo,redo,separator,bold,italic,underline,strikethrough,separator," + 
        							"bullist,numlist,separator,indent,outdent,separator,link,unlink,separator,code",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : ""
});
