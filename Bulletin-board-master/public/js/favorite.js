$(function () {
  $('.favorite-toggle').on('click', function () {
    $this = $(this);
    favoritePostId = $this.data('post-id');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/favorite',
      method: 'POST',
      data: {
        'post_id': favoritePostId
      },
    })

      .done(function (data) {
        // $(this).toggleClass('favorited');

        if ($this.hasClass('favorited')) {
          $this.removeClass('favorited');
          $this.removeClass('fas');
          $this.addClass('far');
        } else {
          $this.addClass('favorited');
          $this.removeClass('far');
          $this.addClass('fas');
        }
        $this.next('.favorite-counter').html(data.favorite_count);
      })
      //通信失敗した時の処理
      .fail(function () {
        console.log('fail');
      });
  });
});
