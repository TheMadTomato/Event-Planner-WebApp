document.querySelector("form").addEventListener("submit", function(event) {
  event.preventDefault();
  const email = document.getElementById("email").value.trim();

  if (email === "") {
    alert("Please enter your email.");
  } else {
    alert("A password reset link has been sent to your email.");
    // Redirect or handle backend logic here
  }
});
