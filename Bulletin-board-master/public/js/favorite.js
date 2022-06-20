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
        $this.toggleClass('favorited'); //favoritedクラスのON/OFF切り替え。
        $this.next().html(data.review_favorites_count);
      })
      //通信失敗した時の処理
      .fail(function () {
        console.log('fail');
      });
  });
});

// function favorite(postId) {
//   $.ajax({
//     headers: {
//       "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//     },
//     url: `/favorite/${postId}`,
//     type: "POST",
//   })
//     .done(function (data, status, xhr) {
//       console.log(data);
//     })
//     .fail(function (xhr, status, error) {
//       console.log();
//     });
// }
