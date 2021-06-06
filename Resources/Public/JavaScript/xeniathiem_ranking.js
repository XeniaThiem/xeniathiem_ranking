$(document).ready(function() {

  function colorCheckbox(e) {
    let checkbox;
    let area;

    checkbox = $(e.target).find(':checkbox');
    area = $(e.target);
    checkbox.prop('checked', !checkbox.prop('checked'));

    if (area.css('background-color') === 'rgb(131, 111, 255)') {
      area.css('background-color', '#fff');
    } else {
      area.css('background-color', '#836FFF');
    }
  }

  function uncheckRankingpair(pairUid, clickedOption) {
    let allPairs = $('#form-rankingtool-pairs').find('.rankingpair-single-value-area');

    allPairs.each(function() {
      if($(this).attr('data-rankingpair') === pairUid && $(this).find('.rankingpair-radio').val() !== clickedOption) {
        $(this).find(':checkbox').prop('checked', false);
        $(this).css('background-color', '#fff');
      }
    });
  }

  let count = 0;
  $('.rankingoptions-table').on('click', '.rankingoptions-table-singlevalue', function(e) {
    $('.rankingtool-counter-phase-one').show();
    colorCheckbox(e);
    let checkbox = $(e.target).find(':checkbox');
    if (checkbox.prop('checked') === true) {
      count++;
    } else {
      count--;
    }
    $('.counter-phase-one').html(count);
  });

  function countPairCheckboxes() {
    let checkboxes = $('.all-rankingoptions-form').find('.rankingpair-radio');
    let rankingpaircount = 0;
    checkboxes.each(function() {
      if ($(this).prop('checked') === true) {
        rankingpaircount++;

      }
    });
    return rankingpaircount;
  }

  $('.all-rankingoptions-form').on('click', '.rankingpair-single-value-area', function(e) {
    let total = $('.all-rankingoptions-form').find('.rankingpair-row').length;

    $('.rankingtool-counter-phase-two').show();
    colorCheckbox(e);

    let pairUid = $(e.target).attr('data-rankingpair');
    let clickedOption = $(e.target).find('.rankingpair-radio').val();

    if ($(e.target).find(':checkbox').prop('checked') === true) {
      uncheckRankingpair(pairUid, clickedOption);
    }

    let checkcount = countPairCheckboxes();

    $('.totalcount').html(total);
    $('.counter-phase-two').html(checkcount);
    if (checkcount < total) {
      $('#rankingwinner-submit').prop('disabled', true);
    } else {
      $('#rankingwinner-submit').prop('disabled', false);
    }

  });


  $('.all-rankingoptions-form').on('click', '#rankingoptions-submit', function(e) {

    e.preventDefault();

    let form = $('#form-rankingtool-basic-selection');
    $.ajax({
          url: form.attr('action'),
          cache: false,
          type: 'POST',
          dataType: 'json',
          data: form.serialize(),
          success: function (response) {
              $('.all-rankingoptions-form').html(response['html']);
              $('.rankingtool-description-phase-two').show();
              $('.rankingtool-description-phase-one').hide();
              $('.rankingtool-counter-phase-one').hide();
              $('.rankingtool-counter-phase-two').show();
              let totalcount = $('.all-rankingoptions-form').find('.rankingpair-row').length;
              $('.totalcount').html(totalcount);
              $('html, body').animate({
                    scrollTop: $("#form-rankingtool-pairs").offset().top - 40
                }, 150);
          },
          error: function (error) {
            console.log(error);
          }
      });
  });

  $('.all-rankingoptions-form').on('click', '#rankingwinner-submit', function(e) {

    e.preventDefault();

    let form = $('#form-rankingtool-pairs');

    $.ajax({
      url: form.attr('action'),
      cache: false,
      type: 'POST',
      dataType: 'json',
      data: form.serialize(),
      success: function (response) {
          $('.all-rankingoptions-form').html(response['html']);
          $('.rankingtool-description-phase-two').hide();
          $('.rankingtool-description-phase-three').show();
          $('.rankingtool-counter-phase-two').hide();
      },
      error: function (error) {
        console.log(error);
      }
    });

  });

});
