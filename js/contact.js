document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById("contact-form");
    var status = document.getElementById("form-status");

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();

        xhr.open("POST", form.action);
        xhr.setRequestHeader("Accept", "application/json");

        xhr.onreadystatechange = function () {
            if (xhr.readyState !== XMLHttpRequest.DONE) return;

            if (xhr.status === 200) {
                form.reset();
                status.innerHTML = "Your message has been sent!";
            } else {
                status.innerHTML = "There was a problem sending your message.";
            }
        };

        xhr.send(formData);
    });
});
