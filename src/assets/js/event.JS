document.addEventListener("DOMContentLoaded", function () {
  const overlay = document.getElementById("event-overlay");
  const popupImg = document.getElementById("event-popup-img");
  const popupTitle = document.getElementById("event-popup-title");
  const popupDesc = document.getElementById("event-popup-desc");
  const popupPrice = document.getElementById("event-popup-price");
  const popupDate = document.getElementById("event-popup-date");
  const closeBtn = document.getElementById("close-popup-event");

  document.querySelectorAll(".event-card").forEach((card) => {
    card.addEventListener("click", function () {
      popupImg.src = card.getAttribute("data-img");
      popupImg.alt = card.getAttribute("data-title");
      popupTitle.textContent = card.getAttribute("data-title");
      popupDesc.textContent = card.getAttribute("data-desc");
      popupPrice.textContent = card.getAttribute("data-price");
      popupDate.textContent = card.getAttribute("data-date");

      overlay.classList.add("visible");
    });
  });

  closeBtn.addEventListener("click", function () {
    overlay.classList.remove("visible");
  });
  overlay.addEventListener("mousedown", function (e) {
    if (e.target === overlay) overlay.classList.remove("visible");
  });
  window.addEventListener("keydown", function (e) {
    if (e.key === "Escape") overlay.classList.remove("visible");
  });
});
