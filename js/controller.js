document.addEventListener('DOMContentLoaded', function () {

    var windowHeight = window.innerHeight;

    var overlay = document.getElementById('menu-overlay');

    var searchButton = document.getElementById('busca');
    var menuButton = document.getElementById('hamburger');
    var menuButonIcon = document.getElementById('hamburger-botao');
    var closeSearchButton = document.getElementById('busca-fecha');
    var searchBar = document.getElementById('busca-barra');
    var menuBar = document.getElementById('desktop-menu');
    var menuButtons = document.getElementById('menu-buttons');
    var searchForm = document.getElementById('s');


    searchButton.addEventListener('click', buscaClick);
    closeSearchButton.addEventListener('click', buscaClick);
    menuButton.addEventListener('click', toggleMenuOverlay);

    function buscaClick() {
        searchBar.classList.toggle('hidden');
        menuBar.classList.toggle('hidden');
        menuButtons.classList.toggle('hidden');
        menuButton.classList.toggle('hidden');   
        overlay.classList.add('menu-hidden');
        document.body.classList.remove('stop-scrolling');
        menuButonIcon.classList.remove('fa-xmark');
        menuButonIcon.classList.add('fa-bars');
        searchForm.focus();
    }      

    window.addEventListener('resize', function (){
        windowHeight = window.innerHeight;
        
    })

    var menuNav = document.getElementById('menu-nav');    
    var cabecalho = document.getElementById('cabecalho-id');
    var offsetValue = cabecalho.offsetHeight;
    var menuHeight = menuNav.offsetHeight;    
    

    function toggleMenuOverlay() {  
        offsetValue = cabecalho.offsetHeight;     
        if (window.scrollY < offsetValue) {
            overlay.style.top = offsetValue + menuHeight - window.scrollY + 'px';
            var altura = windowHeight - offsetValue - menuHeight + window.scrollY + 'px';
            overlay.style.height = altura;
        } else {
            overlay.style.top = menuHeight + 'px';
            var altura = windowHeight - menuHeight + 'px';
            overlay.style.height = altura;
        }
        overlay.classList.toggle('menu-hidden');
        menuButonIcon.classList.toggle('fa-xmark');
        menuButonIcon.classList.toggle('fa-bars');
        document.body.classList.toggle('stop-scrolling');
    }

    let scrollTimeout
    var prevScrollpos = window.scrollY;
    var sideBar = document.getElementsByClassName("sidebar")[0];

    window.addEventListener('scroll', function () {
        var currentScrollPos = window.scrollY;
        var sideBarPresente;
        if (typeof sideBar !== 'undefined'){
            sideBarPresente = true;
        } else {
            sideBarPresente = false;
        }

        if (prevScrollpos > currentScrollPos) {
            menuNav.style.top = "0";
            if (sideBarPresente) {
                sideBar.style.top = "75px"
            }            
        } else {
            menuNav.style.top = "-48px";
            if (sideBarPresente) {
                sideBar.style.top = "27px"
            }             
        }        

        clearTimeout(scrollTimeout)
        scrollTimeout = setTimeout(function () {
            prevScrollpos = currentScrollPos;
        }, 0);
    });
    
});

function altoContraste() {
    console.log("contraste")
    var body = document.getElementsByTagName("body")[0];
    if (body.classList.contains('contraste')) {
     body.classList.remove('contraste'); 
     localStorage.setItem('xContraste', 0);
    } else {
     body.classList.add('contraste'); 
     localStorage.setItem('xContraste', 1);
    }
}

function autismo() {
    console.log("contraste")
    var body = document.getElementsByTagName("body")[0];
    if (body.classList.contains('autismo')) {
     body.classList.remove('autismo'); 
     localStorage.setItem('xAutismo', 0);
    } else {
     body.classList.add('autismo'); 
     localStorage.setItem('xAutismo', 1);
    }
}