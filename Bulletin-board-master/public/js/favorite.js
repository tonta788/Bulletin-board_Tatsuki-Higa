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

      .fail(function () {
        console.log('fail');
      });
  });
});

$(function () {
  $('.favorite-comment').on('click', function () {
    $this = $(this);
    favoriteCommentId = $this.data('comment-id');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/commentfavorite',
      method: 'POST',
      data: {
        'post_comment_id': favoriteCommentId
      },
    })

      .done(function (data) {

        if ($this.hasClass('favorited-comment')) {
          $this.removeClass('favorited-comment');
          $this.removeClass('fas');
          $this.addClass('far');
        } else {
          $this.addClass('favorited-comment');
          $this.removeClass('far');
          $this.addClass('fas');
        }
        $this.next('.favorite-counter').html(data.comment_favorite_count);
      })

      .fail(function () {
        console.log('fail');
      });
  });
});

$('.on').click(function () {
  alert('hello');
});
