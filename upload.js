function imagesUpdate(target, operation) {
	jQuery(operation).click(function() {
		formfield = jQuery(target).attr('name');
        // show Wordpress' uploader modal box
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        
	window.send_to_editor = function(html) {
         // this will execute automatically when a image uploaded and then clicked to 'insert to post' button
         imgurl = jQuery('img',html).attr('src');
         // put uploaded image's url to #upload_image
         jQuery(target).val(imgurl);
         tb_remove();
        }

	return false;
    });
};


