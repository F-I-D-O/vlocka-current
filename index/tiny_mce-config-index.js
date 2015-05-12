tinyMCE.init({
        mode : "specific_textareas",
        editor_selector : "mceEditor",
        language : "cs",
        plugins : "paste",
        entity_encoding : "raw",
        width : "460",
        height : "200",
        theme_advanced_layout_manager : "SimpleLayout",        
        theme_advanced_buttons1 : "undo,redo,separator,bold,italic,underline,strikethrough,separator," + 
        							"bullist,numlist,separator,link,unlink,separator,code",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : ""
});
