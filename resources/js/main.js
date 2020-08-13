const apiUrl = './api';

function countText(elem) {
  $(elem).next().children('.count-text').text($(elem).val().length + '/' + $(elem).attr('maxlength'));
}

function loadComments(page) {
  $.ajax({
    method: 'GET',
    url: apiUrl + '/comments',
    dataType: 'json',
    beforeSend: () => {

    },
    success: (comments) => {
      const $commentTemplate = $('.comment').clone();
      $('.comments__container').html('');
      $commentTemplate.removeClass('template');
      comments.forEach(comment => {
        const $comment = $commentTemplate.clone();
        $comment.find('.comment__author').text(comment.author);
        $comment.find('.comment__date').text(comment.createdAt)  ;
        $comment.find('.comment__text').text(comment.text);
        $('.comments__container').append($comment);
      });
    },
    error: () => {

    },
    complete: () => {

    }
  });
}

$(() => {
  $('body').removeClass('loading');

  loadComments(0);

  $('.counter-text').each((k, elem) => {
    countText(elem);
  });
  $('.counter-text').on('input', (e) => {
    countText(e.target);
  });

  $('body').on('input', '.is-invalid', (e) => {
    $(e.target).removeClass('is-invalid').next().children('.help-text').text('');
  });

  $('#commentForm').on('submit', (e) => {
    e.preventDefault();

    const $form = $(e.target);
    let hasError = false;

    $form.find('.has-error,.is-invalid').removeClass('has-error is-invalid');
    $form.find('.help-text').text('');

    $form.find('.required').toArray().forEach((elem) => {
      console.log(elem);
      if ($(elem).val().length === 0) {
        $(elem).addClass('is-invalid').parents('.form-row').addClass('has-error');
        $(elem).next().children('.help-text').text('To pole jest wymagane');
        hasError = true;
      }
    });

    if (hasError) {
      return;
    }


  });

  $('#commentModal').on('hidden.bs.modal', (e) => {
    $(e.target).find('.has-error,.is-invalid').removeClass('has-error is-invalid');
    $('#commentForm').trigger('reset');
  });
});
