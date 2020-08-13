const apiUrl = './api';
let $commentTemplate = null;
let ajaxed = false;
let commentsPage = 0;

function countText(elem) {
  $(elem).next().children('.count-text').text($(elem).val().length + '/' + $(elem).attr('maxlength'));
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
