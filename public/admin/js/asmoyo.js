(function ( $ ) {

	/**
    * Asmoyo Helper
    */
	$.fn.asmoyoHelper = function(options)
    {
        var settings 	= $.extend({
            field: $(this),
            fieldTarget: $('#slug'),
        }, options ),
        	funcName 	= 'asmoyo'+settings.field.attr('asmoyo-helper'),
    	 	runFunction = window[funcName];

	 	if(typeof runFunction !== 'function') {
	 		return console.log('a helper : '+ funcName +' is not available');
	 	}
	 	return runFunction(settings);
    };
    /**
    * End Asmoyo Helper
    */


    /**
    * Asmoyo Media Modal
    */
    var asmoyoMediaModalParam = {field_id:"", field_file:"", preview:""};
    $.fn.asmoyoMediaModal = function(options, is_initialize)
    {
        var is_initialize = (is_initialize) ? true : false;
        if (is_initialize){
            return $( this ).click(function()
            {    
                var settings = $.extend({
                    field_id: false, // "#media_id"
                    field_file: false, // "#media_file",
                    field_file_url: false, // "#media_file_url",
                    preview: false, // "#media_preview",
                }, options );

                asmoyoMediaModalParam = settings;
                // console.log(asmoyoMediaModalParam);
            });
        };

        return $(this).click(function() {

            var mediaSelectedId     = $(this).attr('data-id'),
                mediaSelectedFile   = $(this).attr('data-image'),
                mediaSelectedUrlOri = $(this).attr('data-image-url-ori'),
                mediaSelectedUrl    = $(this).attr('data-image-url');

            if (asmoyoMediaModalParam.field_id) {
                $( asmoyoMediaModalParam.field_id ).val(mediaSelectedId);
            };

            if (asmoyoMediaModalParam.field_file) {
                $( asmoyoMediaModalParam.field_file ).val(mediaSelectedFile);
            };

            if (asmoyoMediaModalParam.field_file_url) {
                $( asmoyoMediaModalParam.field_file_url ).val(mediaSelectedUrlOri);
            };

            if (asmoyoMediaModalParam.preview) {
                $( asmoyoMediaModalParam.preview ).css('background', 'url("'+ mediaSelectedUrl +'") center no-repeat');
            };
        });
    };
    /**
    * End Asmoyo Media Modal
    */

}( jQuery ));

// Generate Slug
function asmoyoGenerateSlug(options)
{
	var title  	= options.field,
		slug 	= options.fieldTarget;

	title.keyup(function(){
		var defValue = $(this).val();
		var value = convertToSlug(defValue); 
		slug.val(value);
	});

	slug.keydown(function(e){
		if (e.which === 32)
			return false;
	});

	slug.change(function(){
		var defValue = $(this).val();
		var value = convertToSlug(defValue); 
		slug.val(value);
	});
}

function convertToSlug(Text)
{
    return Text.toLowerCase().replace("/+/g", '').replace(/\s+/g, '-').replace(/[^a-z0-9-]/gi, '');
}
// End Generate Slug