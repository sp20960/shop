addEventListener('DOMContentLoaded', () => {
    const logo = document.getElementById('logo');
    const profileDropdownContent = document.getElementById('profile-dropdown-content');
    const profile = document.getElementById('profile');
    const languageSelect = document.getElementById('languages');

    logo.addEventListener('click', () => {
        window.location.href = '/student023/shop/backend/index.php'
    })

    languageSelect?.addEventListener('change', () => {
      let params = 'language=' + (languageSelect.value);

      let xhttp = new XMLHttpRequest();
      xhttp.open('POST', '/student023/shop/backend/endpoints/language_cookie.php', true);

      xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhttp.onreadystatechange = function (){
        if(xhttp.readyState == 4 && xhttp.status == 200){
          console.log(xhttp);
        }
      }

      xhttp.send(params);
    });

    profile.addEventListener('click', () => {
        console.log("object");
        console.log(profileDropdownContent);
        if(profileDropdownContent.classList.contains('hidden')){
            profileDropdownContent.classList.remove('hidden')
            profileDropdownContent.classList.add('flex');
        } else {
            profileDropdownContent.classList.add('hidden')
        }
        
    })
})