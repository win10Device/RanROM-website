    <?php if (!isset($_SESSION['auth'])) { ?>

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm p-2">

        <?php } else { ?>

            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm p-2">


            <?php } ?>


            <div class="container">
                <a class="navbar-brand" href="../home">

                    <?php if (!isset($_SESSION['auth'])) { ?>
                        <!img src="../assets/images/logonotext.png" alt="" width="50" height="50" class="mr-3">
                        <img src="../assets/images/chip1.png" alt="" width="50" height="50" class="mr-3">
                        
                    <?php } else { ?>
                        <!img src="../assets/images/logonotextwhite.png" alt="" width="50" height="50" class="mr-3">
                        <img src="../assets/images/chip1.png" alt="" width="50" height="50" class="mr-3">
                        
                    <?php } ?>

                    <!?php echo APP_NAME; ?>
                    <b> <?php echo APP_NAME; ?> </b>
                   
                </a>
                 <?php if (!isset($_SESSION['auth'])) { ?>
                  <!a class="mt-4 mb-3 text-muted" target="_blank" href="https://akenodev.xyz/">
                   	<!b style="font-family:fantasy; font-size:12px; color:light_blue; position: relative; left: 25px; bottom: 8.5px;" > <!Special Thanks to akeno!</b>
                    	<?php } ?>
                    </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="../welcome">Welcome</a>
                        </li>

                        <?php if (!isset($_SESSION['auth'])) { ?>

                            <li class="nav-item">
                                <a class="nav-link" href="../contact">Contact Us</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="../login">Login</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="../register">Signup</a>
                            </li>

                        <?php } else { ?>

                            <li class="nav-item">
                                <a class="nav-link" href="../dashboard">Dashboard</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="../home">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="../contact">Contact Us</a>
                            </li>

                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="imgdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    
                                    <?php if ($_SESSION['username'] == 'wibbo'){ ?>
<img class="navbar-img" src="https://cdn.discordapp.com/avatars/829506642696470558/ef00ec35ca1f0c256bf4b7cc0a75576a.png?size=256 class='card-img-profile">
                            <?php } else{ ?>
<img class="navbar-img" src="../assets/uploads/users/<?php echo $_SESSION['profile_image'] ?>">
<?php } ?>
                                    <span class="caret"></span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="imgdropdown">
                                    <a class="dropdown-item text-muted" href="../profile"><i class="fa fa-user pr-2"></i> Profile</a>
                                    <a class="dropdown-item text-muted" href="../profile-edit"><i class="fa fa-pencil-alt pr-2"></i> Edit Profile</a>
                                    <a class="dropdown-item text-muted" href="../logout"><i class="fa fa-running pr-2"></i> Logout</a>
                                </div>
                            </div>

                        <?php } ?>





                    </ul>
                </div>
            </div>
            </nav>
