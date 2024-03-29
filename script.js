$(document).ready(function () {
    /* Favorites */
    $('.favor').on('click', function (e) {
        var favorID = $(this).attr('data-item');
        if ($(this).hasClass('active'))
            var doAction = 'delete';
        $('.fav_page').find('.favor[data-item="' + favorID + '"]').parents('.cat_list').remove(); // Моментальное удаление, если мы на странице избранного
    else
        var doAction = 'add';
        addFavorite(favorID, doAction);
    });
    /* Favorites */
});

/* Избранное */
function addFavorite(id, action) {
    var param = 'id=' + id + "&action=" + action;
    $.ajax({
        url: '/local/ajax/favorites.php', // URL отправки запроса
        type: "GET",
        dataType: "html",
        data: param,
        success: function (response) {
            var result = $.parseJSON(response);
            if (result == 1) { // Если всё хорошо, то выполняем действия, которые показывают, что данные отправлены
                $('.favor[data-item="' + id + '"]').addClass('active');
                var wishCount = parseInt($('#want .col').html()) + 1;
                $('#want .col').html(wishCount); // Визуально меняем количество у иконки
            }
            if (result == 2) {
                $('.favor[data-item="' + id + '"]').removeClass('active');
                var wishCount = parseInt($('#want .col').html()) - 1;
                $('#want .col').html(wishCount); // Визуально меняем количество у иконки
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error: ' + errorThrown);
        }
    });
}

/* Избранное */
