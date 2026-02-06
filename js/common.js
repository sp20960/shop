document.addEventListener('DOMContentLoaded', () => {
    const barsMenu = document.querySelector('.fa-bars');
    const iconCloseMenu = document.getElementById('icon-close-menu');
    const nav = document.querySelector('header nav');
    const dropwDownMenuCaret = document.getElementById('dropdown-menu-caret');
    const dropDownMenu = document.getElementById('dropdown-content');

    barsMenu.addEventListener('click', () => {  
        nav.style.display = 'flex'
    });

    iconCloseMenu.addEventListener('click', () => {
        nav.style.display = 'none'
    });

    dropwDownMenuCaret.addEventListener('click', () => { 
        if(dropDownMenu.style.display === 'none' || dropDownMenu.style.display === 'none'){
            dropDownMenu.style.display = 'flex'
        } else {
            dropDownMenu.style.display = 'none '
        }
    });

    dropwDownMenuCaret.addEventListener('mouseover', () => { 
            dropDownMenu.style.display = 'flex'
          
    });

    dropwDownMenuCaret.addEventListener('mouseleave', () => { 
            dropDownMenu.style.display = 'none '
        
    });

    dropDownMenu.addEventListener('mouseover', () => { 
            dropDownMenu.style.display = 'flex'
          
    });

    dropDownMenu.addEventListener('mouseleave', () => { 
            dropDownMenu.style.display = 'none '
        
    });
});