document.querySelector("form").addEventListener("submit", function(event) {
  event.preventDefault();
  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm-password").value;

  if (name === "" || email === "" || password === "" || confirmPassword === "") {
    alert("Please fill in all fields.");
  } else if (password !== confirmPassword) {
    alert("Passwords do not match.");
  } else {
    alert("Signup successful!");
    // Redirect to another page or perform server-side signup here
  }
});
