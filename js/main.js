const links = document.querySelectorAll(".sidebar a");
const mainContent = document.getElementById("main-content");

links.forEach(link => {
  link.addEventListener("click", e => {
    e.preventDefault();
    const page = e.target.getAttribute("data-page");

    links.forEach(l => l.classList.remove("active"));
    e.target.classList.add("active");

    // Load content dynamically via AJAX
    fetch("pages/" + page)
      .then(res => res.text())
      .then(data => {
        mainContent.innerHTML = data;

        // After loading page, check user role and limit actions
        const role = "<?php echo $_SESSION['role']; ?>";

        if (role === "user") {
          // Disable edit/delete buttons for user
          document.querySelectorAll(".btn-edit, .btn-delete").forEach(btn => {
            btn.remove();
          });

          // Optional: Disable any forms except add attendance/schedule
          document.querySelectorAll(".admin-form").forEach(form => {
            form.remove();
          });
        }
      })
      .catch(() => {
        mainContent.innerHTML = "<p>LOADING, PLEASE WAIT.</p>";
      });
  });
});
