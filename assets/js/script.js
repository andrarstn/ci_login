const pass = document.querySelector('.pw');
const pass2 = document.querySelector('.pw2');
const flashData = $('.flash-data').data('flashdata');

function hideShowPw1() {
	if (pass.type == 'password') {
		pass.type = 'text';
	} else {
		pass.type = 'password';
	}
}

function hideShowPw2() {
	if (pass2.type == 'password') {
		pass2.type = 'text';
	} else {
		pass2.type = 'password';
	}
}

$('.custom-file-input').on('change', function () {
	let fileName = $(this).val().split('\\').pop();
	$(this).next('.custom-file-label').addClass("selected").html(fileName);
});

$('.btnDelete').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
})
$('.role-access').on('click', function () {
	const menuId = $(this).data('menu');
	const roleId = $(this).data('role');

	$.ajax({
		url: "http://localhost/ci-login/admin/changeaccess",
		type: 'post',
		data: {
			menuId: menuId,
			roleId: roleId
		},
		success: function () {
			document.location.href = "http://localhost/ci-login/admin/roleaccess/" + roleId;
		}
	})
})
