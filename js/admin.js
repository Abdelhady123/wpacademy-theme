/**
 * file admin.js
 * 
 * helps with uploading images
 */
jQuery(document).ready(function ($) {
     // Functionality for "Upload" button
     $('.upload_image_button').click(function() {
        var button = $(this);
        var imagePreview = button.closest('div').find('img#preview');
        var hiddenInput = button.closest('div').find('input#admin_logo_url');

        wp.media.editor.send.attachment = function(props, attachment) {
            imagePreview.attr('src', attachment.url);
            hiddenInput.val(attachment.url);
            wp.media.editor.send.attachment = send_attachment;
        }

        wp.media.editor.open(button);

        return false;
     })

     // Functionality for "Remove" button
     $('.remove_image_button').click(function() {
        var answer = confirm('Are you sure?');
        if(answer = true) {
            var imagePreview = $(this).closest('div').find('img#preview');
            var hiddenInput = $(this).closest('div').find('input#admin_logo_url');
            var defaultSrc = imagePreview.attr('data-src');
            imagePreview.attr('src', defaultSrc);
            hiddenInput.val(defaultSrc);
        }
        return false;
     })
})