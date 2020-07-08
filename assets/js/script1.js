(function ($, _w) {

  _w.onerror = function (e) {
    alert('Unexpected error happened on this device. \nPlease try again or use another device.');
  }

  $(document).ready(function () {
    // Highlight the current active location in Main navigation
    $('ul#mainNavigationBar > li > a[href="' + _w.location.href + '"]').addClass('active');

    $(document).ajaxStart(function () {
      $('div#loading').show();
    }).ajaxStop(function () {
      $('div#loading').hide();
    });

    new WOW().init();

    $.fn.countTo = function (options) {
      options = options || {};

      return $(this).each(function () {
        // set options for current element
        var settings = $.extend({}, $.fn.countTo.defaults, {
          from: $(this).data('from'),
          to: $(this).data('to'),
          speed: $(this).data('speed'),
          refreshInterval: $(this).data('refresh-interval'),
          decimals: $(this).data('decimals')
        }, options);

        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(settings.speed / settings.refreshInterval),
          increment = (settings.to - settings.from) / loops;

        // references & variables that will change with each update
        var self = this,
          $self = $(this),
          loopCount = 0,
          value = settings.from,
          data = $self.data('countTo') || {};

        $self.data('countTo', data);

        // if an existing interval can be found, clear it first
        if (data.interval) {
          clearInterval(data.interval);
        }
        data.interval = setInterval(updateTimer, settings.refreshInterval);

        // initialize the element with the starting value
        render(value);

        function updateTimer() {
          value += increment;
          loopCount++;

          render(value);

          if (typeof (settings.onUpdate) == 'function') {
            settings.onUpdate.call(self, value);
          }

          if (loopCount >= loops) {
            // remove the interval
            $self.removeData('countTo');
            clearInterval(data.interval);
            value = settings.to;

            if (typeof (settings.onComplete) == 'function') {
              settings.onComplete.call(self, value);
            }
          }
        }

        function render(value) {
          var formattedValue = settings.formatter.call(self, value, settings);
          $self.html(formattedValue);
        }
      });
    };

    $.fn.countTo.defaults = {
      from: 0, // the number the element should start at
      to: 0, // the number the element should end at
      speed: 1000, // how long it should take to count between the target numbers
      refreshInterval: 100, // how often the element should be updated
      decimals: 0, // the number of decimal places to show
      formatter: formatter, // handler for formatting the value before rendering
      onUpdate: null, // callback method for every time the element is updated
      onComplete: null // callback method for when the element finishes updating
    };

    function formatter(value, settings) {
      return value.toFixed(settings.decimals);
    }

    // custom formatting example
    $('.count-number').data('countToOptions', {
      formatter: function (value, options) {
        return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
      }
    });

    // start all the timers
    $('.timer').each(count);

    function count(options) {
      var $this = $(this);
      options = $.extend({}, options || {}, $this.data('countToOptions') || {});
      $this.countTo(options);
    }

    $(".count-wrap .bx").click(function (event) {
      $(".count-content").hide();
      $(this).next().show();
      event.stopPropagation();
    });

    $(document).click(function () {
      $(".count-content").hide();
    });
  });

  if ($.fn.pwstrength) {
    $('form#user_activation input#password, form#change_password input#password').pwstrength();
  }

  $('.tb-search-item a').click(function () {
    $('div#modal-search').modal('show');
  });

  $('form.search-form').submit(function () {
    var isFilled = false
    $(this).find('select, :text, [type=search]').each(function () {
      isFilled = isFilled || ($.trim(this.value) !== '');
    });
    return isFilled;
  });

  $('div.contact-form form').submit(function () {
    var form = $(this);
    var checkbox = form.find('input[name="term_of_use"]');
    if (checkbox.length > 0 && !checkbox.is(':checked')) {
      form.find('p#error_term_of_use').show();
      return false;
    }
    return true;
  });

})(jQuery, window);