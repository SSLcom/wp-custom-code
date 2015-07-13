jQuery(window).resize(function() {
    hpanelHelper()
});

jQuery(window).load(function(){
    hpanelHelper()
});

function hpanelHelper(){
    jQuery(".hpanel").each(function(){
        jQuery(this).find('[class*="col-"]').css("min-height", '');
        jQuery(this).find('.panel-heading').css("min-height", '');
    });
    if (jQuery(window).width() > 752) {
        jQuery(".hpanel").each(function(){
            jQuery(this).find('[class*="col-"]').each(function() {
                jQuery(this).css("min-height", jQuery(this).parent().height());
            });
            jQuery(this).find('.panel-heading').each(function() {
                jQuery(this).css("min-height", jQuery(this).parent().height());
            });
        });
    }
}