document.querySelectorAll("form").forEach(form => {
  form.addEventListener("submit", event => {
    event.preventDefault();
    alert("Form submitted successfully!");
    form.reset();
  });
});
