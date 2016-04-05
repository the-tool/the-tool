$(document).ready(function() {
    $('input[readonly]').on('click', function() {
        $(this).select();
    });
    $('textarea[readonly]').on('click', function() {
        $(this).select();
    });


    $.fn.extend({
        limiter: function (limit, elem) {
            $(this).on("keyup focus", function () {
                setCount(this, elem);
            });
            function setCount(src, elem) {
                var chars = src.value.length;
                if (chars > limit) {
                    src.value = src.value.substr(0, limit);
                    chars = limit;
                }
                elem.html(limit - chars);
            }
            setCount($(this)[0], elem);
        },

        characterCount: function (elem, ignoreSpace) {
            $(this).on("keyup focus", function () {
                setCount(this, elem);
            });

            function setCount(src, elem) {
                if (ignoreSpace) {
                    var chars = src.value.replace(/[ ]/g, '').length;
                } else {
                    var chars = src.value.length;
                }
                elem.html(chars);
            }
            setCount($(this)[0], elem);
        },

        wordCount: function (elem) {
            $(this).on("keyup focus", function () {
                setCount(this, elem);
            });

            function setCount(src, elem) {
                var string = src.value;
                var words = 0;
                string = string.replace(/\s/g, ' ');
                string = string.split(' ');
                for (i = 0; i < string.length; i++) {
                    if (string[i].length > 0) words++;
                }
                elem.html(words);
            }
            setCount($(this)[0], elem);
        }
    });
});
