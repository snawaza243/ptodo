document.addEventListener('DOMContentLoaded', function () {
    var contactForm = document.getElementById('contactForm');
    var statusMessage = document.getElementById('statusMessage');

    contactForm.addEventListener('submit', function (event) {
        event.preventDefault();

        var formData = new FormData(contactForm);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'send_email.php', true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                statusMessage.textContent = 'Message sent successfully!';
                contactForm.reset();
            } else {
                statusMessage.textContent = 'An error occurred. Please try again later.';
            }
        };
        xhr.send(formData);
    });
});
