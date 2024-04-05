<?php include 'app/views/Common/header.php' ?>

<div class="content">
    <!--CONTENT START-->
    <div class="page-wrapper">
        <div class="slideshow-container">
            <!--first slide content-->
            <div class="mySlides fade">
                <div class="image1"></div>
                <div class="text">
                    Welcome to
                    <h2 class="slide-text">HFESTS</h2>
                    Keeping Health Workers Safe During Pandemics
                </div>
            </div>
            <!--second slide content-->
            <div class="mySlides fade">
                <div class="image2"></div>
                <div class="text">
                    Here to
                    <h2 class="slide-text">TRACK AND MANAGE</h2>
                    Efficiently monitor health, vaccination, and scheduling.
                </div>
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
    </div>
    <div class="row1">
        <div class="section2">
            <!-- Image. -->
        </div>

        <div class="section3">
            <h2>ENSURE SAFETY AND WELLNESS</h2>
            <div>
                HFESTS is your comprehensive system for tracking health and vaccination statuses, managing employee
                schedules, and reducing disease spread within health facilities. It’s designed to help health
                organizations maintain a safe working environment during pandemics by facilitating informed
                decision-making and efficient communication among staff.
                <div class="hyphen">—</div>
            </div>
        </div>
    </div>

    <div class="section4">
        <div class="stats-container">
            <div class="stat-card">
                <h3>Vaccinated Employees</h3>
                <p class="stat-number">1,234</p> <!-- Dynamically update this number as needed -->
            </div>
            <div class="stat-card">
                <h3>Active Cases</h3>
                <p class="stat-number">56</p> <!-- Dynamically update this number as needed -->
            </div>
            <div class="stat-card">
                <h3>Total Employees</h3>
                <p class="stat-number">2,987</p> <!-- Dynamically update this number as needed -->
            </div>
            <div class="stat-card">
                <h3>Recovered Cases</h3>
                <p class="stat-number">678</p> <!-- Dynamically update this number as needed -->
            </div>
            <!-- Add more cards as needed for other stats -->
        </div>
    </div>
    <!-- CONTENT END-->

    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }
    </script>

    <?php include 'app/views/Common/footer.php' ?>