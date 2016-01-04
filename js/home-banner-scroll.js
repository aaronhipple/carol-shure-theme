(function () {
    function scrolledInto(el) {
        var rect = el.getBoundingClientRect();

        return (
            rect.top < 0
        );
    }

    function testScrolling() {
        var elMain = document.getElementById('content');

        console.log(window.scrollY);

        if ( scrolledInto(elMain) ) {
            changeHeaderIfScrolled();
        }
    }

    function changeHeaderIfScrolled() {
        var elBody = document.querySelector('body'),
            elHeader = document.querySelector('header'),
            height = {
                before: elHeader.offsetHeight,
                after: 0
            };

        elBody.classList.remove('unscrolled');
        elBody.classList.add('scrolled');

        height.after = elHeader.offsetHeight;

        console.log(height);
        console.log(window.scrollY);
        window.scrollTo(window.scrollX, window.scrollY - (height.before - height.after));
        console.log(window.scrollY);

        window.removeEventListener('scroll', testScrolling);
    }

    window.addEventListener('scroll', testScrolling);
}());