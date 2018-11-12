$('form#log-form').on('submit', function (e) {
    e.preventDefault();
    console.log($(this).serialize());
    submitForm($(this));
});

$('form#reg-form').on('submit', function (e) {
    e.preventDefault();
    console.log($(this).serialize());
    submitForm($(this));
});

function submitForm(form) {
    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: form.serialize(),
        success: function (response) {
            console.log(response);
        },
        error: function (response) {
            console.log(response);
        }
    });
}
