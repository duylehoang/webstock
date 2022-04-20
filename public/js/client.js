$(document).ready(function(){
    // Popup hình ảnh
    $(".animation-page img").click(function(){
        console.log('dsdads');
        $("#full-image").attr("src", $(this).attr("src"));
        $('#image-viewer').show();
    });
    
    $("#image-viewer .close").click(function(){
        $('#image-viewer').hide();
    });
});