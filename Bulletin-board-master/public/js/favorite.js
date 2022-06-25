$(function () {
  $('.favorite-toggle').on('click', function () {
    $this = $(this);
    favoritePostId = $this.data('post-id');
    // $('.favorite-toggle').html('<i class="fas fa-heart"></i>');
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
        let d = JSON.parse(data);
        if ((d.name === 'far' || d.name === 'fas')) {
          favorited.target.innerHTML =
            `<i class=\"${d.name} fa-heart\"></i>`;
        }
        favorited.target.disabled = false;
        // $this.toggleClass('favorited'); //favoritedクラスのON/OFF切り替え。
        $this.next().html(data.review_favorites_count);
      })
      //通信失敗した時の処理
      .fail(function () {
        console.log('fail');
      });
  });
});










$("#star").on("click", function () {
  $(this).toggleClass("on");
  if ($('#star').hasClass('on')) {
    // ハンバーガーアイコンを管理
    $('.far fa-star').hide();
    $('.fas fa-star').show();
  } else {
    // ハンバーガーアイコンを管理
    $('.fas fa-star').hide();
    $('.far fa-star').show();
  }
});
