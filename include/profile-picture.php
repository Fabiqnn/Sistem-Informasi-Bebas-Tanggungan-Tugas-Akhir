<?php 

    $profilePath = "../assets/uploaded-file/profile-picture/";
    
    if (isset($_SESSION['profil']) && !empty($_SESSION['profil'])) {
        $fileName = $_SESSION['profil'];
        $pfp = $profilePath . $fileName;
    } else {
        $pfp = '../assets/images/img-profile/profildummy1.jpg';
    }
    
?>
<img src="<?= $pfp ?>" alt="profile picture">