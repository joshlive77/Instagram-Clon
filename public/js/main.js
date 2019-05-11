var url = 'http://proyecto-laravel.com.devel';

window.addEventListener("load", function () {
    $('.like').css('cursor', 'pointer');
    $('.dislike').css('cursor', 'pointer');

    function like(){
        $('.like').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('text-secondary').removeClass('text-danger');
            $(this).addClass('dislike').removeClass('like');
            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('haz dado dislike a la publicacion');
                    } else {
                        console.log('Error al dar dislike');
                    }
                }
            });
            dislike();
        });
    }
    like();

    function dislike(){
        $('.dislike').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('text-danger').removeClass('text-secondary');
            $(this).addClass('like').removeClass('dislike');
            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('haz dado like a la publicacion');
                    } else {
                        console.log('Error al dar like');
                    }
                }
            });
            like();
        });
    }
    dislike();

    // buscador
    $('#buscador').submit(function () {
       $(this).attr('action',url+'/gente/'+$('#buscador #search').val());
    });
});