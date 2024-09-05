<style>
    #content-wrapperr {
    margin-top: 100px;
    position: fixed;
    right: 0;
    width: 35%;
    height: 100%; /* Set height to fill the entire viewport */
    overflow-y: auto; /* Enable vertical scrolling */
    overflow-x: hidden;
    display: none;
    z-index: 1000;
}

#cart-content {
    padding: 20px;
    overflow-y: auto; /* Enable scrolling for cart content */
}
</style>

<?php 

echo'<div id="content-wrapperr">';
        echo'<div id="cart-content">';
            echo'<!-- Cart content will be loaded here via AJAX -->';
            echo '<iframe id="profile-frame" frameborder="0" src="profile_staff.php"></iframe>';
        echo'</div>';
        echo'<!-- Button to close the cart -->';
echo'</div>';

?>