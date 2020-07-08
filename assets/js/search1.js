function gpt_blog(city, hospital) {
    let keyword = $('.searc-wrap input[name="s"]').val();
    let str = [];
    if ($.trim(keyword) != '') {
        str.push(keyword);
    }
    if ($.trim(city) != '') {
        str.push(city);
    }
    if ($.trim(hospital) != '') {
        str.push(hospital);
    }

    //window.open('http://blog.global-patienttransfer.com/?s='+str.join(','), '_blank');
    window.location = 'http://blog.global-patienttransfer.com/?s=' + str.join(',');
    return false;

}
$(document).ready(function () {

    /* Filters */

    page_limit = 6;
    $iso = null;

    Array.prototype.unique = function () {
        return this.filter(function (value, index, self) {
            return self.indexOf(value) === index;
        });
    }

    function attachLoadMoreEvent() {
        $('button.btn-load-more').addClass('d-none').click(function () {
            $container = $(this).siblings('div.container-result');
            $container.children('.filtered.d-none').slice(0, page_limit).removeClass('d-none');
            if ($container.children('.filtered.d-none').length == 0) {
                $(this).addClass('d-none');
            } else {
                $(this).removeClass('d-none');
            }
            $iso.isotope('layout');
        });
    }

    function displayResults() {
        $container = $('div.container-result');
        $container.show().children().addClass('d-none');
        $container.siblings('button').click();
        $iso.isotope('layout');
    }

    function prepareFilters() {
        // Cities
        let cities = [];
        $('div.container-result').find('.block-location').children('a[data-city],span[data-city]').each(function () {
            cities.push($(this).data('city'));
        });
        optCities = '<option value="">-- All cities --</option>';
        cities.sort().unique().forEach(function (city) {
            optCities += `<option value="${city}">${city}</option>`;
        });
        $('select#filter_city').html(optCities);
        // End Cities

        // Max Price
        let max_price = 0;
        $('div.container-result').find('.block-services').children('span').each(function () {
            price = Number($(this).data('maxPrice'));
            max_price = (price > max_price) ? price : max_price;
        });

        max_price = Math.ceil(max_price);

        let $minSelector = $('input#filter_price_min'),
            $maxSelector = $('input#filter_price_max'),
            $priceDisplay = $('span#selected-price-range');


        $minSelector.attr('max', max_price);
        $maxSelector.attr('max', max_price).attr('value', max_price);
        // End Max Price

        $('input#filter_price_min,input#filter_price_max').change(function () {
            let minValue = $minSelector.val();
            let maxValue = $maxSelector.val();

            $priceDisplay.html(`$ ${minValue} - $ ${maxValue}`);
        });
    }

    function initialize() {
        $('div#loading').show();
        attachLoadMoreEvent();

        $iso = $('.search_grid').isotope({
            // set itemSelector so .grid-sizer is not used in layout
            itemSelector: '.search_grid_item',
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $iso.isotope('layout');
        })
        prepareFilters();
        resetFilters();

        $('input#btn_filter_reset').click(resetFilters);
        $('input#btn_filter_apply').click(applyFilters);
        $('div#loading').hide();

    }

    function resetFilters() {

        $('input#filter_price_min').val(0);
        $('input#filter_price_max').val($('input#filter_price_max').attr('max')).change();
        $('select#filter_city').val('');

        //Reset all filters here
        applyFilters();
    }

    // apply filters after capturing selected filters
    function applyFilters() {


        $filters = [];
        $filters.push($('select#filter_city').val()); //0 = city
        $filters.push($('input#filter_price_min').val()); //1 = min price
        $filters.push($('input#filter_price_max').val()); //2 = max price

        $('div.container-result').each(function () {
            $children = $(this).children();
            if ($children.length > 0) {
                if ($filters.length == 0) {
                    $children.addClass('filtered');
                } else {
                    $children.removeClass('filtered').filter(function () {
                        let returnValue = true;
                        if ($filters[0] !== '') {
                            cityServices = $(this).find('.block-location').children('a,span').filter(function () {
                                return ($(this).data('city') === $filters[0]);
                            });
                            returnValue = (cityServices.length > 0);
                        }
                        let rangedServices = $(this).find('.block-services').children('span').filter(function () {
                            let min = Number($(this).data('minPrice')),
                                max = Number($(this).data('maxPrice'));

                            //return (min >= $filters[1] && max <= $filters[2]);
                            return ((min >= $filters[1] && min <= $filters[2]) || (max >= $filters[1] && max <= $filters[2]));
                        });

                        if (returnValue && rangedServices.length > 0) {
                            $(this).addClass('filtered');
                            return true;
                        }

                    });
                }
            }
        });

        displayResults();
    }

    // initialize the search results
    initialize();

    /* End Filters */
    favoriteEntities = favoriteEntities || [];

    let clsFavorite = 'fa-heart';

    let clsNotFavorite = 'fa-heart-o';

    function toggleClass(el, from, to) {
        $(el).removeClass(from).addClass(to);
    }

    $('i.icon-favorite').click(function () {

        let id = $(this).data('id');
        let type = $(this).data('type');
        let ref = this;
        if ($(ref).hasClass(clsFavorite)) {
            favorite('unmark', id, type, function () {
                toggleClass(ref, clsFavorite, clsNotFavorite);
            });

        } else {
            favorite('mark', id, type, function () {
                toggleClass(ref, clsNotFavorite, clsFavorite);
            });
        }
    });

    $(favoriteEntities).each(function (j, i) {
        toggleClass($(`i.icon-favorite.${clsNotFavorite}[data-id="${i.id}"][data-type="${i.type}"]`), clsNotFavorite, clsFavorite);
    });

    function favorite(action, reference_id, type, cb) {
        let token = $('input[name="csrf_token"]').eq(0).val();
        make_call(
            '/my-account/ajax',
            $.param([{
                name: 'type',
                value: type
            }, {
                name: 'reference_id',
                value: reference_id
            }, {
                name: "action",
                value: `${action}_favorite`
            }, {
                name: 'csrf_token',
                value: token
            }]),
            function (response) {
                cb();
            }
        );
    }

    function make_call(endpoint, data, success) {
        $.post(
            endpoint,
            data,
            success
        ).fail(function (response) {
            console.log(response);
        });
    }


});