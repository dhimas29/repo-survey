<footer class="ftco-footer ftco-bg-dark ftco-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-6 col-lg-6">
        <div class="ftco-footer-widget mb-5">
          <h2 class="ftco-heading-2"><img src="" alt="">KAP-AAFA</h2>
          <div class="block-23 mb-3">
            <p>Pemimpin : Fiby Ariza</p>
            <p>No.Reg.Izin AP.0940</p>
            <p>Alamat : </p>
            <p>Jl. Matahari 3 blok i 1 No. 24. Komplek Bumi </p>
            <p>Malaka Asri 3. Malaka Sari, Duren Sawit. </p>
            <p>Jakarta Timur 13460</p>
            <p>Telp: 021-86601005</p>
            <p>Info@kap-aafa.co.id,</p>
            <p>kap.fibyariza@gmail.com</p>
            <br>
            <p>Pusat :</p>
            <p>Pemimpin : Abdul Aziz MN</p>
            <p>No.Reg.Izin AP.0514</p>
            <p>Alamat : </p>
            <p>jl flamboyan raya H 1 No 9. Komplek bumi </p>
            <p>malaka asri 3. Malaka Sari, Duren sawit. </p>
            <p>Jakarta timur 13460</p>
            <p>Telp: 021-86601005, 8632184</p>
            <p>Email: kap_azizabdul@yahoo.com</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="ftco-footer-widget mb-5 ml-md-4">
          <h2 class="ftco-heading-2">Layanan</h2>
          <ul class="list-unstyled">
            <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Jasa Penyusunan Pembukuan</a></li>
            <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Jasa Kompilasi Laporan Keuangan</a></li>
            <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Jasa Review Laporan Keuangan</a></li>
            <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Jasa Audit Khusus</a></li>
            <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Jasa Audit Laporan Keuangan</a></li>
          </ul>
        </div>
      </div>

    </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center">

      <p>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>
          document.write(new Date().getFullYear());
        </script> All rights reserved | Created By Dhimas
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
    </div>
  </div>
  </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
  </svg></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  var tileLayer = new L.TileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
  });
  var map = new L.Map('map', {
    'center': [-6.2447769, 106.9236091],
    'zoom': 100,
    'layers': [tileLayer]
  });

  var latlngs = Array();

  var marker = L.marker([-6.2447769, 106.9236091], {
    draggable: true
  }).addTo(map);
  marker.on('dragend', function(e) {
    document.getElementById('lat').value = marker.getLatLng().lat;
    document.getElementById('lng').value = marker.getLatLng().lng;
  });
  latlngs.push(marker.getLatLng());
</script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/scrollax.min.js"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> -->
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>

</body>

</html>