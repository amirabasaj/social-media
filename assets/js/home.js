const postLikesBtn = [
	...document.querySelectorAll('.container-main-posts-item_footer_icon'),
];

postLikesBtn.forEach((postLike) => {
	postLike.addEventListener('click', handleClickLike);
});

function handleClickLike() {
	const postId = this.dataset.postid;

	fetch('../../social-media/app/controllers/increment_like.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify({
				post_id: postId,
			}),
		})
		.then((data) => {
			return data.json();
		})
		.then((res) => {
			if (res.success === 'YES') {
				const span = this.querySelector('.post-likes');
				let value = parseInt(span.textContent);
				value = value + 1;
				span.textContent = value;
			}
		});
}