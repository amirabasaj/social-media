const loginFormBtn = document.querySelector(
	'.loginRegister-container-box_loginForm_registerLink'
);

const registerFormBtn = document.querySelector(
	'.loginRegister-container-box_registerForm_loginLink'
);

const loadingBox = document.querySelector('.loader');

const errorBoxParagraph = document.querySelector(
	'.loginRegister-container-box_loginForm_errorBox p'
);

const rememberMe = document.querySelector('#rememberMe');

const registerForm = document.querySelector(
	'.loginRegister-container-box_registerForm'
);
const loginForm = document.querySelector(
	'.loginRegister-container-box_loginForm'
);

$(document).ready(function () {
	$('.loginRegister-container-box_loginForm_registerLink').on(
		'click',
		function () {
			$('.loginRegister-container-box_loginForm').slideUp('slow', function () {
				$('.loginRegister-container-box_registerForm').slideDown('slow');
			});
		}
	);

	$('.loginRegister-container-box_registerForm_loginLink').on(
		'click',
		function () {
			$('.loginRegister-container-box_registerForm').slideUp(
				'slow',
				function () {
					$('.loginRegister-container-box_loginForm').slideDown('slow');
				}
			);
		}
	);
});

rememberMe.addEventListener('click', () => {
	if (rememberMe.value == '0') {
		rememberMe.setAttribute('value', 1);
	} else {
		rememberMe.setAttribute('value', 0);
	}
});

loginForm.addEventListener('submit', function (e) {
	e.preventDefault();

	loadingBox.classList.add('loader--active');
	const usernameField = this.querySelector('input[name="login_user"]').value;
	const passwordField = this.querySelector('input[name="login_password"]')
		.value;

	fetch('../../app/auth/login_handler.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify({
				login_username: usernameField,
				login_password: passwordField,
				rememberMe: rememberMe.value,
			}),
		})
		.then((data) => {
			return data.json();
		})
		.then((res) => {
			window.setTimeout(() => {
				loadingBox.classList.remove('loader--active');

				if (res.success === 'YES') {
					location.replace(
						'http://' +
						location.hostname +
						':' +
						location.port +
						'/social-media/app/home.php'
					);
				} else {
					errorBoxParagraph.parentElement.classList.add(
						'loginRegister-container-box_loginForm_errorBox--active'
					);
					errorBoxParagraph.textContent = res.error;
				}
			}, 1000);
		});
});