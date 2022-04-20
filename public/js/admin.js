$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $("#change_pass").change(function() {
        if(this.checked) {
            $('#password, #password_confirm').prop('disabled', false);
        } 
        else{
            $('#password, #password_confirm').prop('disabled', true);
        }
    });

    $('.convert-to-slug').focusout(function(){
        let slug = convertToSlug(this.value);
        $(this).val(slug);
    });

    $('.icon-delete').click(function(e){
        e.preventDefault();
        $("#data-delete").text($(this).data('delete'));
        $("#deleteButton").val($(this).attr('href'));
        $('#deleteModal').modal('show');
        
    });

    $("#deleteButton").click(function () {
        let url = $(this).val();
        $.ajax({
            url: url,
            type: 'DELETE',
            success: function (data) {
                $("#deleteModal").modal("hide");
                if (data.status === 'success') {
                    location.reload();
                } else {
                    iziToast.error({
                        title: "Error:",
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (xhr, status, error) {
                let errorMessage = xhr.status + ': ' + xhr.statusText;
                alert(errorMessage);
            }
        });
    });
});

var description =  document.getElementById('description');
if (typeof(description) !== undefined && description !== null)
{
    CKEDITOR.replace('description', {
        language: 'vi',
        height: '200px'
    });
}

var content =  document.getElementById('content');
if (typeof(content) !== undefined && content !== null)
{
    CKEDITOR.replace('content', {
        language: 'vi',
        height: '400px',
        filebrowserUploadUrl: document.getElementById('post-upload-file').value,
        filebrowserUploadMethod: 'form',
    });
}

function convertToSlug(str) {
    // Chuyển hết sang chữ thường
	str = str.toLowerCase();     
 
	// xóa dấu
	str = str
	    .normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
		.replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp
 
	// Thay ký tự đĐ
	str = str.replace(/[đĐ]/g, 'd');
	
	// Xóa ký tự đặc biệt
	str = str.replace(/([^0-9a-z-\s])/g, '');
 
	// Xóa khoảng trắng thay bằng ký tự -
	str = str.replace(/(\s+)/g, '-');
	
	// Xóa ký tự - liên tiếp
	str = str.replace(/-+/g, '-');
 
	// xóa phần dư - ở đầu & cuối
	str = str.replace(/^-+|-+$/g, '');
 
	// return
	return str;
}