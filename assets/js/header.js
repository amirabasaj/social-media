$(document).ready(function () {
  $('.header-operation_bell').on('click', function () {
    $('.header-operation-request-box').toggle('fast', 'linear');
  });
  let settimeoutId;
  $('.header-searchbox-input').on('input', function () {
    const input = $(this);
    $('.header-searchbox-result ul').html('');
    if (input.val() !== '') {
      clearTimeout(settimeoutId);
      settimeoutId = setTimeout(function () {
        console.log('running set timeout');
        $.ajax({
          url: './controllers/searchUser.php',
          data: JSON.stringify({ search_string: input.val() }),
          method: 'POST',
          contentType: 'application/json',
          success: function (result) {
            result = JSON.parse(result, 2, null);
            $('.header-searchbox-result ul').html('');
            if (input.val() !== '') {
              result.data.map((r) => {
                const liElement = document.createElement('li');
                liElement.innerHTML = `<a href="./user_profile.php?userid=${r.username}" class='header-searchbox-result-profile'>
              <img src="./images/${r.profile_pic}">
              <span>${r.username}</span>
            </a>`;
                $('.header-searchbox-result ul').append(liElement);
              });
            } else {
              $('.header-searchbox-result ul').html('');
            }
          },
        });
      }, 200);
    }
  });
});
