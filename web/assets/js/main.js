$(document).ready(function() {

    google.maps.event.addDomListener(window, 'load', initialize);
    invite();

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
            alert('Définis tes dates de recherche')
        } else if (new Date(dateEnd) < new Date("Y m d")){
            alert('Définis des dates correctes')
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

function initMap() {

    var options = {
        zoom: 10,
        center: {lat: 48.856614, lng: 2.3522219000000177}
    };

    var map = new google.maps.Map(document.getElementById('map'), options);

    var markers = JSON.parse($('#markers_locations').text());

    for (i = 0; i < markers.private.length; i++) {
        new google.maps.Marker({
            position: new google.maps.LatLng(markers.private[i].lat, markers.private[i].lng),
            map: map
        });
    }
    for (i = 0; i < markers.public.length; i++) {
        new google.maps.Marker({
            position: new google.maps.LatLng(markers.public[i].lat, markers.public[i].lng),
            map: map
        });
    }

}

function invite(){
    $('#add-email').click(function(event){
        event.preventDefault()
       $('#inputs-email').append("<input class='row' type='email' name='emails[]'>")
    })

}
