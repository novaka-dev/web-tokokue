<?php
// maps.php — Ann's Bakehouse & Creamery Store Locator
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Our Stores — Ann's Bakehouse & Creamery</title>
  <link rel="stylesheet" href="maps.css" />
</head>
<body>

  <!-- NAVBAR -->


  <!-- PAGE HEADER -->
<?php include '../navbar/navbar.php'; 
?>

  <!-- STORES WRAPPER -->
  <div class="stores-wrapper">

    <!-- STORE LIST PANEL -->
    <aside class="store-list">
      <div class="store-list-header">
        <h2>6 Lokasi Tersedia</h2>
      </div>

      <div class="store-item active"
           data-lat="-6.2473975"
           data-lng="106.7952364"
           data-name="Ann's Bakehouse & Creamery — Barito"
           data-address="Jl. Sungai Sambas 3 No.12, Kramat Pela, Kebayoran Baru, Jakarta Selatan"
           data-hours="Senin – Minggu: 08:00 – 21:00 (GMT+7)"
           onclick="selectStore(this)">
        <span class="pin-icon">📍</span>
        <h3>Ann's Bakehouse & Creamery — Barito</h3>
        <p class="store-address">Jl. Sungai Sambas 3 No.12, Kramat Pela, Kebayoran Baru</p>
        <p class="store-hours">Senin – Minggu: 08:00 – 21:00 (GMT+7)</p>
      </div>

      <div class="store-item"
           data-lat="-6.270995"
           data-lng="106.764198"
           data-name="Ann's Bakehouse & Creamery — Kesehatan, Bintaro Jaya"
           data-address="Jl. Kesehatan Raya No.5A, Bintaro, Pesanggrahan, Jakarta Selatan"
           data-hours="Senin – Minggu: 08:00 – 19:00 (GMT+7)"
           onclick="selectStore(this)">
        <span class="pin-icon">📍</span>
        <h3>Ann's Bakehouse & Creamery — Kesehatan, Bintaro Jaya</h3>
        <p class="store-address">Jl. Kesehatan Raya No.5A, Bintaro, Pesanggrahan</p>
        <p class="store-hours">Senin – Minggu: 08:00 – 19:00 (GMT+7)</p>
      </div>

      <div class="store-item"
           data-lat="-6.2246048"
           data-lng="106.7989982"
           data-name="Ann's Bakehouse & Creamery — Plaza Senayan"
           data-address="Plaza Senayan, Jl. Asia Afrika No.8, Gelora, Tanah Abang, Jakarta Pusat"
           data-hours="Senin – Minggu: 10:00 – 22:00 (GMT+7)"
           onclick="selectStore(this)">
        <span class="pin-icon">📍</span>
        <h3>Ann's Bakehouse & Creamery — Plaza Senayan</h3>
        <p class="store-address">Plaza Senayan, Jl. Asia Afrika No.8, Gelora, Jakarta Pusat</p>
        <p class="store-hours">Senin – Minggu: 10:00 – 22:00 (GMT+7)</p>
      </div>

      <div class="store-item"
           data-lat="-6.2073728"
           data-lng="106.8212549"
           data-name="Ann's Bakehouse & Creamery — Menara Astra, Sudirman"
           data-address="Menara Astra L2 Unit i, Jl. Jenderal Sudirman No.06, Karet Tengsin, Jakarta Pusat"
           data-hours="Senin – Minggu: 08:00 – 19:00 (GMT+7)"
           onclick="selectStore(this)">
        <span class="pin-icon">📍</span>
        <h3>Ann's Bakehouse & Creamery — Menara Astra, Sudirman</h3>
        <p class="store-address">Menara Astra L2, Jl. Jenderal Sudirman No.06, Jakarta Pusat</p>
        <p class="store-hours">Senin – Minggu: 08:00 – 19:00 (GMT+7)</p>
      </div>

      <div class="store-item"
           data-lat="-6.3160493"
           data-lng="106.8138355"
           data-name="Ann's Bakehouse & Creamery — Jagakarsa"
           data-address="Jl. Paso No.12B, Kp. Kandang, Jagakarsa, Jakarta Selatan"
           data-hours="Senin – Minggu: 08:00 – 20:00 (GMT+7)"
           onclick="selectStore(this)">
        <span class="pin-icon">📍</span>
        <h3>Ann's Bakehouse & Creamery — Jagakarsa</h3>
        <p class="store-address">Jl. Paso No.12B, Kp. Kandang, Jagakarsa, Jakarta Selatan</p>
        <p class="store-hours">Senin – Minggu: 08:00 – 20:00 (GMT+7)</p>
      </div>

      <div class="store-item"
           data-lat="-6.1887079"
           data-lng="106.7331391"
           data-name="Ann's Bakehouse & Creamery — Puri Indah Mall 2"
           data-address="Puri Indah Mall 2, Jl. Puri Agung No.1, Kembangan Selatan, Jakarta Barat"
           data-hours="Senin – Minggu: 10:00 – 22:00 (GMT+7)"
           onclick="selectStore(this)">
        <span class="pin-icon">📍</span>
        <h3>Ann's Bakehouse & Creamery — Puri Indah Mall 2</h3>
        <p class="store-address">Puri Indah Mall 2, Jl. Puri Agung No.1, Kembangan, Jakarta Barat</p>
        <p class="store-hours">Senin – Minggu: 10:00 – 22:00 (GMT+7)</p>
      </div>

    </aside>

    <!-- MAP PANEL -->
    <div class="map-panel">
      <iframe
        id="map-frame"
        src="https://maps.google.com/maps?q=-6.2473975,106.7952364&z=15&output=embed"
        allowfullscreen
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Lokasi Toko">
      </iframe>

      <!-- FLOATING INFO CARD -->
      <div class="store-info-card visible" id="info-card">
        <h3 id="card-name">Ann's Bakehouse & Creamery — Barito</h3>
        <p id="card-address">Jl. Sungai Sambas 3 No.12, Kramat Pela, Kebayoran Baru, Jakarta Selatan</p>
        <span class="hours-badge" id="card-hours">08:00 – 21:00 (GMT+7)</span>
      </div>
    </div>

  </div>

  <!-- FOOTER -->
<?php include '../footer/footer.php'; ?>

  <script>
    function selectStore(el) {
      // Remove active from all
      document.querySelectorAll('.store-item').forEach(function(item) {
        item.classList.remove('active');
      });

      // Set active
      el.classList.add('active');

      // Get data
      var lat  = el.getAttribute('data-lat');
      var lng  = el.getAttribute('data-lng');
      var name = el.getAttribute('data-name');
      var addr = el.getAttribute('data-address');
      var hrs  = el.getAttribute('data-hours');

      // Update map
      document.getElementById('map-frame').src =
        'https://maps.google.com/maps?q=' + lat + ',' + lng + '&z=16&output=embed';

      // Update info card
      document.getElementById('card-name').textContent    = name;
      document.getElementById('card-address').textContent = addr;
      document.getElementById('card-hours').textContent   = hrs;
      document.getElementById('info-card').classList.add('visible');
    }
  </script>

</body>
</html>