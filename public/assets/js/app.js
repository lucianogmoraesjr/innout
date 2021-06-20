function toggleSidebar() {
  document.querySelector('body').classList.toggle('hide-sidebar')
}

setTimeout(function () {
  // Closing the alert
  $('#alert').alert('close');
}, 5000);