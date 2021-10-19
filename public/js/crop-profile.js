$(document).ready(function(){
    $("#profile-pic").click(function(){
        $("#image-input").trigger('click');
    })
})

var $modal = $('#profileCropperModal');

var image = document.getElementById('image');

var cropper;


$("body").on("change", "#image-input", function(e){

    var files = e.target.files;

    var done = function (url) {

      image.src = url;
      $modal.modal('show')

    };

    var reader;
    var file;
    var url;

    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }

});

$modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
	  aspectRatio: 1,
	  viewMode: 3,
	  preview: '.preview'
    });
}).on('hidden.bs.modal', function () {
//    cropper.destroy();
//    cropper = null;
});

$("#crop").click(function(){
    console.log("Cropping...");

    canvas = cropper.getCroppedCanvas({
	    width: 250,
	    height: 250,
    });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
         reader.readAsDataURL(blob);
         reader.onloadend = function() {
            var base64data = reader.result;
            $modal.modal('hide')
            $("#pic-field").attr('value', base64data);
            $("#profile-pic").attr('src', base64data);
            $("#profile-pic-alert").css('display','block');
            cropper.destroy();
            cropper = null;
        }

    });
})
