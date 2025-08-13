
<div class="row pt-md-3 pb-md-3 mb-3 border-md-0 border-bottom border-dark-primary-2">
    <div class="col-6 border-md-0 border-end border-dark-primary-2 px-md-3 px-4">
        <div class="dropdown ">
            <button class="btn border-0 text-primary text-uppercase text-small px-0 d-flex align-items-center " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Refine by <i class="fa-equalizer fs-5 ms-3"></i>
            </button>
            <div class="dropdown-menu bg-dark-bg rounded-0 border-dark-primary-2">
                <ul class="dropdown-list">
                    <li><a class="dropdown-item text-small d-inline-block pe-3 position-relative" href="#">Action</a></li>
                    <li><a class="dropdown-item text-small d-inline-block pe-3 position-relative" href="#">Another action</a></li>
                    <li><a class="dropdown-item text-small d-inline-block pe-3 position-relative" href="#">Something else here</a></li>
                    <li><a class="dropdown-item text-small d-inline-block pe-3 position-relative" href="#">Action</a></li>
                    <li><a class="dropdown-item text-small d-inline-block pe-3 position-relative" href="#">Another action</a></li>
                    <li><a class="dropdown-item text-small d-inline-block pe-3 position-relative" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-6 d-md-flex justify-content-md-end px-md-3 px-4">
        <div class="dropdown">
            <button class="btn border-0 text-primary text-uppercase text-small px-0 d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Show All <span class="arrow-bottom arrow-bottom-xl arrow-bottom-primary ms-3 mb-2"></span>
            </button>
            <div class="dropdown-menu bg-dark-bg rounded-0 border-dark-primary-2">
                <ul class="dropdown-list">
                    <li><a class="dropdown-item text-small d-inline-block pe-3 position-relative" href="#">Action</a></li>
                    <li><a class="dropdown-item text-small d-inline-block pe-3 position-relative" href="#">Another action</a></li>
                    <li><a class="dropdown-item text-small d-inline-block pe-3 position-relative" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
        
<div class="row">
    <div class="col-md-4 col-lg-3 col-6 mb-4 pb-md-2 px-md-2 px-1 gallery-item">
        <a href="./single-profile.php">
            <span class="media-holder d-block position-relative">
                <img src="./images/staff/staff.jpeg" alt="Staff Image">
                <span class="position-absolute top-0 start-0 mt-1 batch-abailable">
                    <img src="./images/available.svg" width="72" height="32" loading="lazy" alt="">
                </span>
            </span>
        </a>
        <span class="d-block text-center mt-3 position-relative px-md-5 px-4">
            <span class="d-block f300 mb-1"><a class="h3" href="#">Olivia</a></span>
            <span class="d-block text-small text-uppercase text-white lh-1 mb-1 tagline">Fashion model</span>
            <span class="text-small text-white-5 lh-1 text-uppercase d-block location">Paddington</span>
            <span class="favourites d-flex justify-content-center align-items-center top-0 end-0 me-md-2 position-absolute">                            
                <i class="fa-heart-f fs-4 save-favourite"></i>
                <span class="favourites-message">
                    <span class="text"></span>
                    <span class="favourites-close"></span>
                </span>
            </span>
        </span>
    </div>
    <div class="col-md-4 col-lg-3 col-6 mb-4 pb-md-2 px-md-2 px-1 gallery-item">
        <a href="./single-profile.php">
            <span class="media-holder d-block position-relative">
                <img src="./images/staff/staff.jpeg" alt="Staff Image">
                <span class="position-absolute top-0 start-0 batch-notAbailable w-100 d-flex justify-content-center">
                    <img src="./images/not-available.svg" width="144" height="14" loading="lazy" alt="">
                </span>
            </span>
        </a>
        <span class="d-block text-center mt-3 position-relative px-md-5 px-4">
            <span class="d-block f300 mb-1"><a class="h3" href="#">Olivia</a></span>
            <span class="d-block text-small text-uppercase text-white lh-1 mb-1 tagline">Fashion model</span>
            <span class="text-small text-white-5 lh-1 text-uppercase d-block location">Paddington</span>
            <span class="favourites d-flex justify-content-center align-items-center top-0 end-0 me-md-2 position-absolute">                            
                <i class="fa-heart-f fs-4 save-favourite"></i>
                <span class="favourites-message">
                    <span class="text"></span>
                    <span class="favourites-close"></span>
                </span>
            </span>
        </span>
    </div>
    <div class="col-md-4 col-lg-3 col-6 mb-4 pb-md-2 px-md-2 px-1 gallery-item">
        <a href="./single-profile.php">
            <span class="media-holder d-block position-relative stm">
                <img src="./images/staff/staff.jpeg" alt="Staff Image">
                <span class="position-absolute start-50 bottom-0 translate-middle-x batch-stm">
                    <img src="./images/scort-of-the-month.svg" width="165" height="19" loading="lazy" alt="">
                </span>
            </span>
        </a>
        <span class="d-block text-center mt-3 position-relative">
            <span class="d-block f300 mb-1"><a class="h3" href="#">Olivia</a></span>
            <span class="d-block text-small text-uppercase text-white lh-1 mb-1 tagline">Fashion model</span>
            <span class="text-small text-white-5 lh-1 text-uppercase d-block location">Paddington</span>
            <span class="favourites d-flex justify-content-center align-items-center top-0 end-0 me-md-2 position-absolute">                            
                <i class="fa-heart-f fs-4 save-favourite"></i>
                <span class="favourites-message">
                    <span class="text"></span>
                    <span class="favourites-close"></span>
                </span>
            </span>
        </span>
    </div>
    <?php for ($i = 0; $i < 15; $i++) { ?>
        <div class="col-md-4 col-lg-3 col-6 mb-4 pb-md-2 px-md-2 px-1 gallery-item">
            <a href="./single-profile.php">
                <span class="media-holder d-block position-relative">
                    <img src="./images/staff/staff.jpeg" alt="Staff Image">
                </span>
            </a>
            <span class="d-block text-center mt-3 position-relative">
                <span class="d-block f300 mb-1"><a class="h3" href="#">Olivia</a></span>
                <span class="d-block text-small text-uppercase text-white lh-1 mb-1 tagline">Fashion model</span>
                <span class="text-small text-white-5 lh-1 text-uppercase d-block location">Paddington</span>
                <span class="favourites d-flex justify-content-center align-items-center top-0 end-0 me-md-2 position-absolute">                            
                    <i class="fa-heart-f fs-4 save-favourite"></i>
                    <span class="favourites-message">
                        <span class="text"></span>
                        <span class="favourites-close"></span>
                    </span>
                </span>
            </span>
        </div>
    <?php } ?>    
</div>