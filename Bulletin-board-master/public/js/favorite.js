$(function () {
  $('.favorite-toggle').on('click', function () {
    $(this).toggleClass('favorited');

    if ($(this).hasClass('favorited')) {
      $('.far fa-heart').addClass('fas fa-heart');
    } else {
      $('.fas fa-heart').removeClass('fas fa-heart');
    }

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
        // let d = JSON.parse(data);
        // if ((d.name === 'far' || d.name === 'fas')) {
        //   favorited.target.innerHTML =
        //     `<i class=\"${d.name} fa-heart\"></i>`;
        // }
        // favorited.target.disabled = false;
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
