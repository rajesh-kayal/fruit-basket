$(document).ready(function(){
    $("#images").change(function(){
        $('#preview').html('');
        if (this.files && this.files[0]) {
            for(let i=0; i<this.files.length; i++) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview').append(`<img src="${e.target.result}" width="100px" height="100px" class="img-thumbnail mr-2">`);
                }
                reader.readAsDataURL(this.files[i]);
            }
        }
    });
});
