// funcion para cambiar el nombre en el input de Bootstrap 

$(document).ready(function(){
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file label').html(fileName);
        readURL(this);
    });
});

// funcion para subir una vista previa de la imagen

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.img-fluid').css('display', 'block')
            $('.img-fluid').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}