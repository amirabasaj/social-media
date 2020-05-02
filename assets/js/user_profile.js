const allTabLinks = [...document.querySelectorAll('.profile-tab-nav a')];
const allTab = [...document.querySelectorAll('.profile-tab')];
allTabLinks.forEach((tabLink) => {
  tabLink.addEventListener('click', tabLinkClickHandler);
});

function tabLinkClickHandler(e) {
  if (this.classList.contains('active')) return;

  const activeTab = document.querySelector('#' + this.dataset.box);

  allTabLinks.forEach((link) => {
    if (link.classList.contains('active')) {
      link.classList.remove('active');
    }
  });

  allTab.forEach((tab) => {
    if (tab.classList.contains('show')) {
      tab.classList.remove('show');
    }
  });

  this.classList.add('active');
  activeTab.classList.add('show');
}

new SlimSelect({
  select: '#mySelect',
  placeholder: 'تگ ها را انتخاب کنید...',
  showSearch: false,
  searchText: 'پیدا نشد!',
});
