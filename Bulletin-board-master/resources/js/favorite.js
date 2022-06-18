$(function () {
  alert('hello');
  let favorite = $('.favorite-toggle'); //favorite-toggleのついたiタグを取得し代入。
  let favoritePostId; //変数を宣言（なんでここで？）
  favorite.on('click', function () { //onはイベントハンドラー
    let $this = $(this); //this=イベントの発火した要素＝iタグを代入
    favoritePostId = $this.data('post-id'); //iタグに仕込んだdata-post-idの値を取得
    //ajax処理スタート
    $.ajax({
      headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
      url: '/favorite', //通信先アドレスで、このURLをあとでルートで設定します
      method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
      data: { //サーバーに送信するデータ
        'post_id': favoritePostId //いいねされた投稿のidを送る
      },
    })
      //通信成功した時の処理
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
