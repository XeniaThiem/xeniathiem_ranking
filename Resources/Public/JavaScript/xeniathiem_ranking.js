$(document).ready(function() {

  $('#1section-divider').show();
  $('.rankingtool-section').find('.control-buttons').hide();

  $('.all-rankingoptions-form').on('click', '.sectiontab-buttons', function(e) {
    let sectionuid = parseInt($(this).attr('id'));
    let sectiondividers = $('#form-rankingtool-basic-selection').find('.rankingoption-section-divider');
    sectiondividers.each(function() {
      $(this).hide();
      if (parseInt($(this).attr('id')) === sectionuid) {
        $(this).show();
      }
    });
  });

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

  $('.rankingoptions-table').on('click', '.rankingoptions-table-singlevalue', function(e) {
    $('.rankingtool-counter-phase-one').show();
    colorCheckbox(e);

    let counter = countCheckboxes('.rankingoptions-checkbox');
    $('.counter-phase-one').html(counter);
  });

  function countCheckboxes(checkboxclass) {
    let checkboxes = $('.all-rankingoptions-form').find(checkboxclass);
    let counter = 0;
    checkboxes.each(function() {
      if ($(this).prop('checked') === true) {
        counter++;
      }
    });
    return counter;
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

    let checkcount = countCheckboxes('.rankingpair-radio');

    $('.totalcount').html(total);
    $('.counter-phase-two').html(checkcount);
    if (checkcount < total) {
      $('#rankingwinner-submit').prop('disabled', true);
    } else {
      $('#rankingwinner-submit').prop('disabled', false);
    }

  });

  $('.all-rankingoptions-form').on('click', '.select-all-rankingoptions', function(e) {

    e.preventDefault();
    let allBoxes = $('.rankingoptions-table').find('.rankingoptions-table-singlevalue');
    allBoxes.each(function() {
      $(this).find(':checkbox').prop('checked', true);
      $(this).css('background-color', '#836FFF');
    });

    let counter = countCheckboxes('.rankingoptions-checkbox');
    $('.counter-phase-one').html(counter);

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
              $('.rankingtool-section').find('.next-button').show();
              $('.rankingtool-section').find('.next-button').attr('data-page', 2);
              $('.rankingtool-section').find('#show-all').show();
              $('#rankingwinner-submit').prop('disabled', true);
              let rows = $('.all-rankingoptions-form').find('.rankingpair-row');
              rows.each(function() {
                $(this).hide();
              });
              $('.all-rankingoptions-form').find('#1pair').show();
              let totalcount = rows.length;
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


  function loadRankingPairRow(button) {
    let page = parseInt($(button).attr('data-page'));
    let rows = $('.all-rankingoptions-form').find('.rankingpair-row');
    let count = rows.length;
    rows.each(function() {
      $(this).hide();
    });
    $('.all-rankingoptions-form').find('#' + page + 'pair').show();

    let prev = $('.rankingtool-section').find('.prev-button');
    let next = $('.rankingtool-section').find('.next-button');
    if (page - 1 >= 1) {
      prev.show();
      prev.attr('data-page', page - 1);
    } else {
      prev.hide();
    }
    if (page + 1 <= count) {
      next.show();
      next.attr('data-page', page + 1);
    } else {
      next.hide();
    }
  }

  $('.rankingtool-section').on('click', '.next-button', function() {
    loadRankingPairRow(this);
  });

  $('.rankingtool-section').on('click', '.prev-button', function() {
    loadRankingPairRow(this);
  });

  $('.rankingtool-section').on('click', '.all-button', function() {
    let rows = $('.all-rankingoptions-form').find('.rankingpair-row');
    if ($(this).prop('id') === 'back-to-single') {
      let pairs;
      let single;
      let checked;
      rows.each(function() {
        pairs = $(this).find('.rankingpair-radio');
        pairs.each(function() {
          checked = $(this).prop('checked');
          if (checked === true) {
            return false;
          }
        });
        if (checked === false) {
          single = $(this);
          return false;
        }
      });
      rows.hide();
      single.show();
      $(this).hide();
      $('#show-all').show();
    } else {
      rows.show();
      $(this).hide();
      $('#back-to-single').show();
    }
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
          $('.rankingtool-section').find('.control-buttons').hide();
      },
      error: function (error) {
        console.log(error);
      }
    });

  });

});
