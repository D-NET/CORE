(function ($) {
    
    var async = (function () {
      
      var time = [];
      
      var init = function () {
        $(document).ajaxSend(function (event, request, settings) {
          $('#loading').removeClass('hidden');
          global.async.time[btoa(settings.url)] = new Date().getTime();
        });

        $(document).ajaxComplete(function (event, request, settings) {
          $('#loading').addClass('hidden');
          global.async.time[btoa(settings.url)] = (new Date().getTime() - global.async.time[btoa(settings.url)]) / 1000;
          $('#async').html($('#async').html().replace('{2}', global.async.time[btoa(settings.url)]));
          delete global.async.time[btoa(settings.url)];
        });
      
        $(document.body).on('click', '[data-toggle="async"]', function (e) {
          e.preventDefault();
          var loadurl = $(this).attr('data-query');
          var target = $($(this).attr('data-target'));
          $.get(loadurl, function (data) {
            try {
              var obj = $.parseJSON(data);
              if (obj.status == 200) {
                if (obj.event.length > 0) {
                  if (obj.data.length > 0) {
                    global.message.toast('success', false, obj.data);
                  }
                  eval(obj.event);
                } else {
                  var data = $('<textarea/>').html(obj.data).val();
                  target.html(data);
                  global.validator.init();
                  global.form.init();
                }
              } else if (obj.status == 500) {
                global.message.toast('danger', false, obj.data);
              } else {
                global.message.toast('danger', true, obj.data);
              }
            } catch (e) {
              global.message.infobox('danger', 0, e.message + '<br>' + data);
            }
          });
          $('.dropdown.open .dropdown-toggle').dropdown('toggle');
          return false;
        });
        
        $(document.body).on('click', '[data-toggle="tab"]', function (e) {
          e.preventDefault();
          $('.nav').children('li').each(function () {
            $(this).removeClass('active');
          });
          $(this).parent().addClass('active');
          var loadurl = $(this).attr('data-query');
          var target = $($(this).attr('data-target'));
          $.get(loadurl, function (data) {
            try {
              var obj = $.parseJSON(data);
              if (obj.status == 200) {
                if (obj.event.length > 0) {
                  if (obj.data.length > 0) {
                    global.message.toast('success', false, obj.data);
                  }
                  eval(obj.event);
                } else {
                  var data = $('<textarea/>').html(obj.data).val();
                  target.html(data);
                  global.validator.init();
                  global.form.init();
                }
              } else if (obj.status == 500) {
                global.message.toast('danger', false, obj.data);
              } else {
                global.message.toast('danger', true, obj.data);
              }
            } catch (e) {
              global.message.infobox('danger', 0, e.message + '<br>' + data);
            }
          });
          return false;
        });
        
        $('[data-toggle="select"]').on('change', function (e) {
          e.preventDefault();
          var loadurl = $(this).attr('data-query') + encodeURIComponent($(this).val());
          var target = $($(this).attr('data-target'));
          $.get(loadurl, function (data) {
            try {
              var obj = $.parseJSON(data);
              if (obj.status == 200) {
                if (obj.event.length > 0) {
                  if (obj.data.length > 0) {
                    global.message.toast('success', false, obj.data);
                  }
                  eval(obj.event);
                } else {
                  var data = $('<textarea/>').html(obj.data).val();
                  target.html(data);
                  global.validator.init();
                  global.form.init();
                }
              } else if (obj.status == 500) {
                global.message.toast('danger', false, obj.data);
              } else {
                global.message.toast('danger', true, obj.data);
              }
            } catch (e) {
              global.message.infobox('danger', 0, e.message + '<br>' + data);
            }
          });
          return false;
        });
        
        $(document.body).on('submit', '[data-toggle="post"]', function (e) {
          e.preventDefault();
          var loadurl = $(this).attr('data-query');
          var target = $($(this).attr('data-target'));
          $.post(loadurl, $(this).serialize(), function (data) {
            try {
              var obj = $.parseJSON(data);
              if (obj.status == 200) {
                if (obj.event.length > 0) {
                  if (obj.data.length > 0) {
                    global.message.toast('success', false, obj.data);
                  }
                  eval(obj.event);
                } else {
                  var data = $('<textarea/>').html(obj.data).val();
                  target.html(data);
                }
              } else if (obj.status == 500) {
                global.message.toast('danger', false, obj.data);
              } else {
                global.message.toast('danger', true, obj.data);
              }
            } catch (e) {
              global.message.infobox('danger', 0, e.message + '<br>' + data);
            }
            $('button[data-validate="post"]').prop('disabled', true);
          });
          return false;
        });
        
        $(document.body).on('submit', '[data-toggle="form"]', function (e) {
          e.preventDefault();
          var loadurl = $(this).attr('data-query');
          var target = $($(this).attr('data-target'));
          
          var dataset = [];
          $(this).find('tr').each(function () {
            if ($(this).attr('id')) {
              var tmp = new Object();
              tmp['id'] = $(this).attr('id');
              $(this).find('input').each(function () {
                tmp[$(this).attr('id')] = $(this).val();
              });
              dataset.push(tmp);
            }
          });
          
          $.post(loadurl, {data: JSON.stringify(dataset)}, function (data) {
            try {
              var obj = $.parseJSON(data);
              if (obj.status == 200) {
                if (obj.event.length > 0) {
                  if (obj.data.length > 0) {
                    global.message.toast('success', false, obj.data);
                  }
                  eval(obj.event);
                } else {
                  var data = $('<textarea/>').html(obj.data).val();
                  target.html(data);
                }
              } else if (obj.status == 500) {
                global.message.toast('danger', false, obj.data);
              } else {
                global.message.toast('danger', true, obj.data);
              }
            } catch (e) {
              global.message.infobox('danger', 0, e.message + '<br>' + data);
            }
            $('button[data-validate="form"]').prop('disabled', true);
          });
          return false;
        });
      };
      
      return {
        init: init,
        time: time
      };
    })();

    $.extend(true, window, {
      global: {
        async: async
      }
    });

    $(function () {
        global.async.init();
    });

}(jQuery));
