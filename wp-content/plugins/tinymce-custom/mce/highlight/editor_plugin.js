(function() {
    tinymce.create('tinymce.plugins.HighlightPlugin', {
        init : function(ed, url) {
            // Register commands
            ed.addCommand('mceHighlight', function() {
                ed.windowManager.open({
                    file : url + '/highlight.htm',
                    width : 350 + parseInt(ed.getLang('highlight.delta_width', 0)),
                    height : 450 + parseInt(ed.getLang('highlight.delta_height', 0)),
                    inline : 1
                }, {
                    plugin_url : url
                });
            });
 
            // Register buttons
            ed.addButton('highlight', {title : 'Highlight', cmd : 'mceHighlight', image: url + '/recipe.gif' });
        },
 
        getInfo : function() {
            return {
                longname : 'Highlight Section',
                author : 'Michael Bopp',
                authorurl : 'http://rapiddg.com',
                infourl : 'http://rapiddg.com',
                version : 'tinymce'
            };
        }
    });
 
    // Register plugin
    tinymce.PluginManager.add('highlight', tinymce.plugins.HighlightPlugin);
})();