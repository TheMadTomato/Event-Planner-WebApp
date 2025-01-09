document.querySelectorAll('form').forEach(form => {
  form.addEventListener('submit', event => {
    event.preventDefault();
    alert('Thank you for your feedback!');
    form.reset();
  });
});
