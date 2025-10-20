// Sidebar Navigation Loader
const links = document.querySelectorAll(".sidebar a");
const mainContent = document.getElementById("main-content");

links.forEach(link => {
  link.addEventListener("click", e => {
    e.preventDefault();
    const page = e.target.getAttribute("data-page");

    // Remove active class
    links.forEach(l => l.classList.remove("active"));
    e.target.classList.add("active");

    // Load content dynamically
    fetch("pages/" + page)
      .then(res => res.text())
      .then(data => {
        mainContent.innerHTML = data;
      })
      .catch(() => {
        mainContent.innerHTML = "<p>Error loading page.</p>";
      });
  });
});
