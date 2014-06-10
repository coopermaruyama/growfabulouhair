(function ($) {

    /***
     * Video.js
     */
    videojs('vid1', { "techOrder": ["vimeo"], "src": "https://vimeo.com/63186969" }).ready(function() {

    });


    /***
     * Graph
     */

    var chart = c3.generate({
        size: {
            height: 358,
            width: 425
        },
        data: {
            columns: [
            ]
        },
        axis: {
            y: {
                label: 'Growth Score'
            },
            x: {
                type: 'categorized',
                categories: ['BT', '4W', '8W', '9W']
            }
        }
    });
    $('#chart').one('inview', function(event, isInView, visiblePartX, visiblePartY) {
        if (isInView) {
            chart.load({
                columns: [
                        ['A', 0, 0.1, 0.1, 0.1],
                        ['B', 0, 0.4, 0.5, 0.6],
                        ['C', 0, 1.3, 2.0, 2.3]
                    ]
                });
        }
    });


    /***
     * Before & After 
     */
    $(".controls ul li").first().addClass("active");
    $(".controls .left-arrow a, .controls .right-arrow a").click(function(event) {
        run = true;
        event.preventDefault();
        $(this).parent().data("executing",true);
        direction = /right-arrow/.test($(this).parent().attr("class")) ? "next" : "previous";
        $currentThumbnail = $(this).closest(".controls").find("ul li.active").first();
        currentVisibleArray = $.grep($("#before-after-list .before-after-list-item"), function(element,index) {
            return $(element).is(":visible");
        });
        $currentVisible = $(currentVisibleArray[0]);

        
        if (direction == "next") {
            if ($currentVisible[0] == $("#before-after-list .before-after-list-item").last()[0]) {
                run = false;
                return;
            };
            $currentVisible.next(".before-after-list-item").addClass("moving").css('left','100%');
            $currentVisible.animate({
                left: '-=100%',
            }, 'slow', function() {
                    $(this).hide();
            });
            $currentVisible.next(".before-after-list-item").animate({
                left: '0%'
            }, 'slow', function() {
                $(this).removeClass("moving").show();
            });
            if ( run == true ) {
                $currentThumbnail.removeClass("active").next("li").addClass("active");
            }
        } else {
            if ($currentVisible[0] == $("#before-after-list .before-after-list-item:eq(0)")[0]) {
                run = false;
                return;
            }
            $currentVisible.prev(".before-after-list-item").addClass("moving").css('left','-100%');
            $currentVisible.animate({
                left: '+=100%',
            }, 'slow', function() {
                    $(this).hide();
            });
            $currentVisible.prev(".before-after-list-item").animate({
                left: '0%'
            }, 'slow', function() {
                $(this).removeClass("moving").show();
            });
            if ( run == true ) {
                $currentThumbnail.removeClass("active").prev("li").addClass("active");
            }
        }
        $(this).parent().data("executing", false);
    });

})(jQuery);