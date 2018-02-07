function readURL(input, insertDiv) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(insertDiv).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#fos_user_registration_form_picture_pictureUpload").change(function() {
    readURL(this, "#previewPictureProfil");
});

$("#appbundle_event_picture_pictureUpload").change(function() {
    readURL(this, "#previewPictureEvent");
});

$("#appbundle_event_picture_pictureUpload").change(function() {
    readURL(this, "#previewPictureEditEvent");
});





