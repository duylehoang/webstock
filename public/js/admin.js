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
    // Chuy???n h???t sang ch??? th?????ng
	str = str.toLowerCase();     
 
	// x??a d???u
	str = str
	    .normalize('NFD') // chuy???n chu???i sang unicode t??? h???p
		.replace(/[\u0300-\u036f]/g, ''); // x??a c??c k?? t??? d???u sau khi t??ch t??? h???p
 
	// Thay k?? t??? ????
	str = str.replace(/[????]/g, 'd');
	
	// X??a k?? t??? ?????c bi???t
	str = str.replace(/([^0-9a-z-\s])/g, '');
 
	// X??a kho???ng tr???ng thay b???ng k?? t??? -
	str = str.replace(/(\s+)/g, '-');
	
	// X??a k?? t??? - li??n ti???p
	str = str.replace(/-+/g, '-');
 
	// x??a ph???n d?? - ??? ?????u & cu???i
	str = str.replace(/^-+|-+$/g, '');
 
	// return
	return str;
}