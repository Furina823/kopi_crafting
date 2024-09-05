var profileVisiblee = false;

function toggleProfileStaff() {
    if (profileVisiblee) {
        // Close the profile
        hideProfileStaff();
    } else {
        // Show the profile
        showProfileStaff();
    }
}

function showProfileStaff() {
    const container = document.getElementById('content-wrapperr');

    // Fetch profile.php content
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.responseText;
            container.style.display = 'block';
        }
    };
    xhttp.open("GET", "profile_staff.php", true);
    xhttp.send();

    profileVisiblee = true;
}

function hideProfileStaff() {
    const container = document.getElementById('content-wrapperr');
    container.style.display = 'none';
    profileVisiblee = false;
}
