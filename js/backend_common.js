//REFACTORED!!!
addEventListener('DOMContentLoaded', () => {
    const logo = document.getElementById('logo');
    const profileDropdownContent = document.getElementById('profile-dropdown-content');
    const profile = document.getElementById('profile');
    const languageSelect = document.getElementById('languages');

    logo.addEventListener('click', () => {
        window.location.href = '/student023/shop/backend/index.php'
    })

    languageSelect?.addEventListener('change', () => {
      fetchDataPost(`/student023/shop/backend/endpoints/language_cookie.php?language=${languageSelect.value}`, false);
    });

    profile.addEventListener('click', () => {
        if(profileDropdownContent.classList.contains('hidden')){
            profileDropdownContent.classList.remove('hidden')
            profileDropdownContent.classList.add('flex');
        } else {
            profileDropdownContent.classList.add('hidden')
        }
        
    })
})