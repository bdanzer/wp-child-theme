document.addEventListener('DOMContentLoaded', function() {
    var loadModal = document.querySelectorAll('.open-modal');

    if (loadModal.length) {
        var dpModalBtn = document.querySelector('.open-modal .danzerpress-button-modern.danzerpress-button-left'),
            dpModal = document.querySelector('.dp-modal'),
            dpModalBackground = document.querySelector('.modal-background'),
            close = document.querySelector('.dp-modal .fa.fa-times'),
            body = document.querySelector('body');

        dpModalBtn.addEventListener('click', (e) => {
            e.preventDefault();
            modalToggle();
        });

        dpModalBackground.addEventListener('click', function() {
            modalToggle();
        });

        close.addEventListener('click', (e) => {
            e.preventDefault();
            modalToggle();
        });

        function modalToggle() {
            body.classList.toggle('dp-stop');
            dpModal.classList.toggle('dp-show');
            dpModalBackground.classList.toggle('dp-show');
        }

        document.addEventListener( 'wpcf7mailsent', function( event ) {
            location = '/thank-you/#section-1';
        }, false );
    }
});