/**
 * Created by tegos on 16.05.2017.
 */

function readURL(input) {

	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			var img = $('#preview_image');
			img.attr('src', e.target.result);
			img.show();
		};

		reader.readAsDataURL(input.files[0]);
	}
}

$("#imgInp").change(function () {
	readURL(this);
});