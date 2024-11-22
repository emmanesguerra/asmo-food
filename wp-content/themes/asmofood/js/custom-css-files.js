
jQuery(document).ready(function($) {
    $('#custom_css_files_add').on('click', function(e) {
        e.preventDefault();
        var selectedFile = $('#custom_css_files_select').val();
        if (selectedFile) {
            var listItem = '<li data-url="' + selectedFile + '">' + selectedFile + ' <button class="remove-css-file">Remove</button></li>';
            $('#custom_css_files_list').append(listItem);
            updateCssField();
        }
    });

    $(document).on('click', '.remove-css-file', function(e) {
        e.preventDefault();
        $(this).parent().remove();
        updateCssField();
    });

    function updateCssField() {
        var cssFiles = [];
        $('#custom_css_files_list li').each(function() {
            cssFiles.push($(this).data('url'));
        });
        $('#custom_css_files_field').val(cssFiles.join(','));
    }
    
    
    $('#custom_css_files').insertAfter($('#summary'));
});