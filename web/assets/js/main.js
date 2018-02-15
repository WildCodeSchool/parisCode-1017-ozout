$(document).ready(function() {

    google.maps.event.addDomListener(window, 'load', initialize);

    $("#fos_user_registration_form_picture_pictureUpload").change(function() {
        readURL(this, "#previewPictureProfil");
    });

    $("#appbundle_event_picture_pictureUpload").change(function() {
        readURL(this, "#previewPictureEvent");
    });

    $("#appbundle_event_picture_pictureUpload").change(function() {
        readURL(this, "#previewPictureEditEvent");
    });

    $('#searchFormEvent').submit(function (e) {
        e.preventDefault();
        var location = $("#appbundle_search_event_location").val();
        var dateEnd = $("#appbundle_search_event_dateEnd").val();
        var form = $(this);

        if (dateEnd === ''){
            alert('Veuillez definir vos dates de recherche')
        } else if (new Date(dateEnd) < new Date()){
            alert('Veuillez definir des dates correct')
        } else {
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: {"location" : location, "end": dateEnd},
                dataType: "json",
                success: function (response) {
                    $("#modalResultPrivateAndPublic").html(response.eventModal);
                    $("#eventResultPrivateAndPublic").html(response.eventDescription);
                }
            })
        }
    });

});

function initialize() {
    var options = {
        types: ['(cities)'],
        componentRestrictions: {country: "fr"}
    };
    var input = document.getElementById('appbundle_search_event_location');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
}

function readURL(input, insertDiv) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(insertDiv).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}






