const apiUrl = './api';
let $commentTemplate = null;
let ajaxed = false;
let commentsPage = 0;

function countText(elem, value) {
  $(elem).next().children('.count-text').text(value + '/' + $(elem).attr('maxlength'));
}

function loadComments() {
  if (ajaxed) {
    return;
  }

  $.ajax({
    method: 'GET',
    url: apiUrl + '/comments?page=' + commentsPage,
    dataType: 'json',
    beforeSend: () => {
      ajaxed = true;
    },
    success: (comments) => {
      comments.forEach(comment => {
        const $comment = $commentTemplate.clone();
        $comment.hide();
        $comment.find('.comment__author').text(comment.author);
        $comment.find('.comment__date').text(comment.createdAt)  ;
        $comment.find('.comment__text').text(comment.text);
        $('.comments__container').append($comment);
        $comment.fadeIn(300);
      });

      commentsPage++;
    },
    error: () => {

    },
    complete: () => {
      ajaxed = false;
    }
  });
}

$(() => {
  $('body').removeClass('loading');

  // comments
  $commentTemplate = $('.comment').clone();
  $('.comments__container').html('');
  $commentTemplate.removeClass('template');
  loadComments();
  $(window).scroll(() => {
    if ($(window).scrollTop() >= ($(document).height() - $(window).height() - $('footer').height())) {
      loadComments();
    }
  });

  // comment modal
  $('.counter-text').each((k, elem) => {
    countText(elem, $(elem).val().length);
  });

  $('.counter-text').on('input', (e) => {
    countText(e.target, $(e.target).val().length);
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
      if ($(elem).val().length === 0) {
        $(elem).addClass('is-invalid').parents('.form-row').addClass('has-error');
        $(elem).next().children('.help-text').text('To pole jest wymagane');
        hasError = true;
      }
    });

    if ($('[name="hp"]').val().length > 0) {
      hasError = true;
    }

    if ($('[name="nick"]').val().length > 30 ) {
      $('[name="nick"]').addClass('is-invalid').parents('.form-row').addClass('has-error');
      $('[name="nick"]').next().children('.help-text').text('To pole jest wymagane');
      hasError = true;
    }

    if ($('[name="text"]').val().length > 500) {
      $('[name="text"]').addClass('is-invalid').parents('.form-row').addClass('has-error');
      $('[name="text"]').next().children('.help-text').text('To pole jest wymagane');
      hasError = true;
    }

    if (hasError) {
      return;
    }

    $.ajax({
      method: 'POST',
      url: apiUrl + '/comments',
      dataType: 'json',
      data: $form.serialize(),
      beforeSend: () => {
        $('#commentModal').find('.has-error,.is-invalid').removeClass('has-error is-invalid');
        $('#commentForm .form-control').next().children('.help-text').text('');
        $('.commentModal__loader').css('opacity', 1);
        $('.commentModal__status').text('Zapisywanie komentarza...');
        $form.find('.form-control').attr('disabled', 'disabled');
      },
      success: (data) => {
        if (data.status) {

          $('#commentForm').trigger('reset');
        } else {
          data.messages.forEach(msg => {
            $(`[name="${msg.field}"]`).addClass('is-invalid').parents('.form-row').addClass('has-error');
            $(`[name="${msg.field}"]`).next().children('.help-text').text(msg.message);
          });
          $('.commentModal__status').text('Formularz zawiera błędy!');
        }
      },
      error: () => {
        $('.commentModal__status').text('Wystąpił problem podczas zapisu komentarza. Proszę spróbować ponownie później.');
      },
      complete: () => {
        $('.commentModal__loader').css('opacity', 0);
        $form.find('.form-control').removeAttr('disabled');
      }
    })
  });

  $('#commentModal').on('hidden.bs.modal', (e) => {
    $(e.target).find('.has-error,.is-invalid').removeClass('has-error is-invalid');
    $('#commentForm .form-control').next().children('.help-text').text('');
    $('.commentModal__status').text('');
    $('#commentForm').trigger('reset');
    $('#commentForm .form-control').trigger('input');
  });
});
