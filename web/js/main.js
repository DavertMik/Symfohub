/**
 * Created by IntelliJ IDEA.
 * User: davert
 * Date: 3 лист 2010
 * Time: 13:04:19
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function()
{

    $('#repository_check').click(function() {
      $(this).fadeTo('slow', 0.3);
      $('#indicator').show();
        $.ajax({
            type: "POST",
            data: 'url='+$('#repository_url').val(),
            url: $(this).attr('data-url'),
            context: document.body,
            complete: function() {
              $('#indicator').hide();
            },
            error: function(data) {
              $('#extra_form').html('<span style="color: #990000; font-weight: bold;">Error. Please check your URL if it is valid GitHub repository</span>');
            },
            success: function(data) {
                $('#extra_form').prepend('<span style="color: #006400;  font-weight: bold;">Success!</span>');
                $('#extra_form').html(data);
            }
        });
    });

    $('.search input[name=q]').focus(function() {
      if ($(this).val() == 'Search for repositories') $(this).val('');
      if ($(this).val() == 'Search for plugins') $(this).val('');
      if ($(this).val() == 'Search for bundles') $(this).val('');
    });

    $('#rate').raty({
        path:			'/images/',
        start:     $('#rate').attr('data-value'),
        readOnly: ($('#rate').attr('data-disabled') == 'true'),
        number: 4,
        showHalf:  true,
        onClick: function(score) {
            $.ajax({
                type: 'POST',
                url: $('#rate').attr('data-url'),
                data: 'rate='+score,
                success: function(data){
                    data = $.parseJSON(data);
                    $('#rate').raty.start(data.rate);
                    $('#rate_message').text('Thank you for your vote! Current rate is '+data.rate);
                }
            });

        }
    });

    if ($('#works').attr('data-disabled') == 'true' ) {
      $('#works .works').CreateBubblePopup({ innerHtml: 'Does it work for you? Make your assertion.', themePath: '/images/', themeName: 'all-grey' });
    } else {
      $('#works .works').CreateBubblePopup({ innerHtml: $('#user_assertion').html(), selectable: true, position: 'bottom', themePath: '/images/', themeName: 'all-grey',
        afterShown: function() {
          $('.assertion a').click(function() {
            $('#works .works').SetBubblePopupInnerHtml('Thank your for your assertion!');
            var form = $(this).parent().parent().parent();
            $.ajax({
              type: 'POST',
              url: form.attr('action'),
              data: form.serialize()+'&works='+$(this).attr('data-value')
            });
            setTimeout(function() { $('#works .works').HideBubblePopup(); } ,2100);
          });
        }
      });
    }
    
    if ($('#rate').attr('data-disabled') == 'true' ) $('#rate').CreateBubblePopup({ innerHtml: 'Please login with your GitHub account to rate this repository', themePath: '/images/', themeName: 'all-grey' });


    $('#repository_url').focusin(function() {
        if ($(this).val() == 'https://github.com/') $(this).val('');
    });

  $('.tags_save').click(function() {
    $.ajax({
      type: 'POST',
      url: $(this).parent().attr('action'),
      data: $(this).parent().serialize(),
      success: function(){
      }
    });
    $(this).parent().html('Tags were saved');
    return false;
  });

});