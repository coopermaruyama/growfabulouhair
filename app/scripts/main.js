(function ($){

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
})(jQuery);