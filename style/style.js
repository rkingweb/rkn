const menuItems = document.querySelectorAll('.sidebar li');

menuItems.forEach(item => {
  const submenu = item.querySelector('.submenu');
  
  item.addEventListener('click', () => {
    submenu.classList.toggle('show-submenu');
  });
});
