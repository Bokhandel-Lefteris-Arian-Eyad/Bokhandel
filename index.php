<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="sv">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Bokhandel</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<section class="top-banner">
  <!-- Popup-modal för förstoring -->
<div id="image-modal" class="image-modal">
  <span class="close-modal">&times;</span>
  <img class="modal-content" id="modal-img" />
</div>
  <div class="banner-content one-book">
    <div class="book-left">
      <img src="book.png" alt="Lär dig PHP bok" class="book-cover" />
    </div>
    <div class="book-right">
      <h1>Lär dig PHP</h1>
      <h3>Författare: Lefteris, Arian och Eyad</h3>
      <p class="book-price"><strong>Pris:</strong> 199 kr</p>
      <p class="book-desc">
        En komplett guide för nybörjare som vill lära sig PHP från grunden. Du lär dig allt från variabler,
        funktioner, formulärhantering och hur du kopplar upp dig mot databaser. <br /><br />
        Perfekt för dig som vill komma igång med backendutveckling och jobba med riktiga projekt.
      </p>
      <button id="checkout-button">Köp nu</button>
    </div>
  </div>
</section>

<!-- Popup för större bokbild -->
<div id="image-modal" class="image-modal">
  <span class="close-modal">&times;</span>
  <img class="modal-content" id="modal-img" />
</div>

<footer>
  <p>© <?php echo date("Y"); ?> Bokhandel. Alla rättigheter förbehållna.</p>
</footer>

<!-- JS för Stripe + bild popupen -->
<script>
  // Stripe Checkout
  const checkoutBtn = document.getElementById("checkout-button");
  checkoutBtn.addEventListener("click", async () => {
    const response = await fetch("create-checkout-session.php", {
      method: "POST",
    });

    try {
      const data = await response.json();
      if (data.url) {
        window.location.href = data.url;
      } else {
        alert("Något gick fel med betalningen.");
      }
    } catch (error) {
      alert("Kunde inte ansluta till Stripe.");
      console.error(error);
    }
  });

  // Bild popup
  const modal = document.getElementById("image-modal");
const modalImg = document.getElementById("modal-img");
const bookImage = document.querySelector(".book-cover");
const closeModal = document.querySelector(".close-modal");

// Öppna bild-popup
bookImage.addEventListener("click", () => {
  modal.classList.add("active");
  modalImg.src = bookImage.src;
});

// Stäng när man klickar på x
closeModal.addEventListener("click", () => {
  modal.classList.remove("active");
});

// Stäng när man klickar utanför bilden
window.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.classList.remove("active");
  }
});


</script>

</body>
</html>
