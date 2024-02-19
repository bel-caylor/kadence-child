document.addEventListener('DOMContentLoaded', function() {
    const sermonBlanks = document.querySelectorAll('.sermon-blank');
    sermonBlanks.forEach(function(span) {
        span.addEventListener('click', function() {
            span.classList.add('visible');
        });
    });
});