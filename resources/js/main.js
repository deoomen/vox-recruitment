const comments = [];
for (let i = 0; i < 10; i++) {
  comments.push({
    author: 'nick',
    date: '2020-08-06 02:07',
    text: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries"
  });
}

function countText(elem) {
  $(elem).next().children('.count-text').text($(elem).val().length + '/' + $(elem).attr('maxlength'));
}

$(() => {
  $('body').removeClass('loading');

  const $commentTemplate = $('.comment').clone();
  $('.comments__container').html('');
  comments.forEach(comment => {
    const $comment = $commentTemplate.clone();
    $comment.find('.comment__author').text(comment.author);
    $comment.find('.comment__date').text(comment.date);
    $comment.find('.comment__text').text(comment.text);
    $('.comments__container').append($comment);
  });

  $('.counter-text').each((k, elem) => {
    countText(elem);
  });
  $('.counter-text').on('input', (e) => {
    countText(e.target);
  });
});
