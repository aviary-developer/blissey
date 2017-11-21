$(document).on("ready", function () {

    $("#logo_hospital").on("change", function (evt) {

        var files = evt.target.files;

        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {
                    document.getElementById('list').innerHTML = ['<img style="height: 200px; width: 200px; object-fit: contain;" src = "', e.target.result, '"/>'].join("");
                };
            })(f);
            reader.readAsDataURL(f);
        }
    });

    $("#logo_laboratorio").on("change", function (evt) {

        var files = evt.target.files;

        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {
                    document.getElementById('list2').innerHTML = ['<img style="height: 200px; width: 200px; object-fit: contain;" src = "', e.target.result, '"/>'].join("");
                };
            })(f);
            reader.readAsDataURL(f);
        }
    });

    $("#logo_clinica").on("change", function (evt) {

        var files = evt.target.files;

        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {
                    document.getElementById('list3').innerHTML = ['<img style="height: 200px; width: 200px; object-fit: contain;" src = "', e.target.result, '"/>'].join("");
                };
            })(f);
            reader.readAsDataURL(f);
        }
    });

    $("#logo_farmacia").on("change", function (evt) {

        var files = evt.target.files;

        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {
                    document.getElementById('list4').innerHTML = ['<img style="height: 200px; width: 200px; object-fit: contain;" src = "', e.target.result, '"/>'].join("");
                };
            })(f);
            reader.readAsDataURL(f);
        }
    });
});