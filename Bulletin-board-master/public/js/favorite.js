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
        $(this).toggleClass('favorited');

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


let comment_id = 0;

//0以上の自然数かチェックする関数
const isNum = function (v) {
  return ((typeof v === 'number') && (isFinite(v)) && v >= 0);
};

//「いいね」ボタンがクリックされた時
$('.fav').on('click', function (event) {
  event.target.disabled = true; //処理が終了するまでボタンを無効化
  event.preventDefault();
  comment_id = event.target.dataset.fav;

  $.ajax({
    type: 'POST',
    url: '',
    dataType: 'text',
    data: {
      comment_id: comment_id,
    }
  }).done(function (data) {
    //console.log(data);　{"name":"far","cnt":13} エラー時は空文字
    let d = JSON.parse(data);
    if ((d.name === 'fas' || d.name === 'far') && isNum(d.cnt)) {
      event.target.innerHTML =
        `<i class=\"${d.name} fa-heart\"></i> ${d.cnt}`;
    }
    event.target.disabled = false;  //ボタンを有効化
  });
});
