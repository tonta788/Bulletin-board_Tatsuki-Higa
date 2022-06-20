// $(function () {
//   let favorite = $('.favorite-toggle'); //favorite-toggleのついたiタグを取得し代入。
//   let favoritePostId; //変数を宣言（なんでここで？）
//   favorite.on('click', function () { //onはイベントハンドラー
//     let $this = $(this); //this=イベントの発火した要素＝iタグを代入
//     favoritePostId = $this.data('post-id');
//     $.ajax({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       },
//       url: '/favorite',
//       method: 'POST',
//       data: {
//         'post_id': favoritePostId
//       },
//     })
//       .done(function (data) {
//         $this.toggleClass('favorited');
//         $this.next().html(data.post_favorites_count);
//       })
//       .fail(function () {
//         console.log('fail');
//       });
//   });
// });
