const apiUrl = './api';
let $slideTemplate = null;
let $indicatorTemplate = null;
let $commentTemplate = null;
let ajaxed = false;
let commentsPage = 0;

function countText(elem, value) {
  $(elem).next().children('.count-text').text(value + '/' + $(elem).attr('maxlength'));
}

function pushComment(commentData, pushMethod) {
  const $comment = $commentTemplate.clone();
  $comment.hide();
  $comment.find('.comment__author').text(commentData.author);
  $comment.find('.comment__date').text(commentData.createdAt)  ;
  $comment.find('.comment__text').text(commentData.text);
  $('.comments__container')[pushMethod]($comment);
  $comment.fadeIn(300);
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
        pushComment(comment, 'append');
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

function copyToClipboard(elem) {
  $(elem).focus().select();
  document.execCommand('copy');
}

$(() => {
  $('body').removeClass('loading');

  $('.copyToClipboard').click((e) => {
    copyToClipboard(e.target.attributes['data-copy'].value);
  });

  // slider
  $slideTemplate = $('.carousel-item.template').clone();
  $('.carousel-inner').html('');
  $slideTemplate.removeClass('template');

  $indicatorTemplate = $('.slider__thumbs > .template').clone();
  $('.slider__thumbs').html('');
  $indicatorTemplate.removeClass('template');

  $('#sliderCarousel').on('slide.bs.carousel', (e) => {
    $('.slider__thumbs > li').removeClass('active').eq(e.to).addClass('active');
  });

  $.ajax({
    method: 'GET',
    url: apiUrl + '/slides',
    dataType: 'json',
    beforeSend: () => {

    },
    success: (slides) => {
      let index = 0;
      slides.forEach(slide => {
        let photoIndex = 1;
        const $slide = $slideTemplate.clone();
        $slide.find('.slide__title').text(slide.title);
        $slide.find('.slide__text').text(slide.text);
        slide.photos.forEach(photo => {
          $slide.find('.slide__photo--' + (photoIndex++) + ' img').attr('src', photo.filename);
        });
        $('.carousel-inner').append($slide);

        const $indicator = $indicatorTemplate.clone();
        $indicator.attr('data-slide-to', index++);
        $indicator.children('img').attr('src', slide.photos[0].filename);
        $('.slider__thumbs').append($indicator);
      });

      $('.carousel-item:first-child').addClass('active');
      $('.slider__thumbs > li:first-child').addClass('active');
    },
    error: () => {

    },
    complete: () => {

    }
  });

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
          $('.form-body').hide();
          $('[type="submit"]').hide();
          $('.voucher-body').fadeIn(300);
          $('#voucher').val(data.voucher);

          $('.commentModal__status').text('');

          pushComment(data.comment, 'prepend');
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
    $('.form-body').show();
    $('[type="submit"]').show();
    $('.voucher-body').hide();
  });
});
