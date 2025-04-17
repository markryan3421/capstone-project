document.addEventListener('DOMContentLoaded', () => {
  const contents = document.querySelectorAll('.tab-content');
  const links = document.querySelectorAll('.tab-link');

  function showTab(tab) {
      contents.forEach(content => content.classList.remove('tab-active'));
      links.forEach(link => link.classList.remove('active'));

      document.querySelector('.' + tab).classList.add('tab-active');

      links.forEach(link => {
          if (link.dataset.tab === tab) {
              link.classList.add('active');
          }
      });
  }

  links.forEach(link => {
      link.addEventListener('click', () => {
          const tab = link.dataset.tab;
          showTab(tab);
      });
  });
});
