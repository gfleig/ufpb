document.addEventListener('DOMContentLoaded', function () {
 
    const arrowButton = document.querySelectorAll("#mobile-menu .menu-item-has-children > a");

    arrowButton.forEach((el) =>
        el.addEventListener("click", (event) => {
            const subMenu = event.currentTarget.parentNode;
            subMenu.classList.toggle("submenu-aberto");
        })
    );

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
    try {
        var menuNav = document.getElementById('menu-nav');   
        var menuHeight = menuNav.offsetHeight;
    } catch {
        menuHeight = 0;
    }        

    var cabecalho = document.getElementById('cabecalho-id');
    var offsetValue = cabecalho.offsetHeight;
     
    

    function toggleMenuOverlay() {  

        offsetValue = cabecalho.offsetHeight;     
        if (window.scrollY < offsetValue) {
            overlay.style.top = offsetValue + menuHeight - window.scrollY - 1 + 'px';
            var altura = windowHeight - offsetValue - menuHeight + window.scrollY + 'px';
            overlay.style.height = altura;
        } else {
            overlay.style.top = menuHeight - 1 + 'px';
            var altura = windowHeight - menuHeight + 'px';
            overlay.style.height = altura;
        }
        overlay.classList.toggle('menu-hidden');
        menuButonIcon.classList.toggle('fa-xmark');
        menuButonIcon.classList.toggle('fa-bars');
        document.body.classList.toggle('stop-scrolling');
    }
    
});

function altoContraste() {
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
    var body = document.getElementsByTagName("body")[0];
    if (body.classList.contains('autismo')) {
     body.classList.remove('autismo'); 
     localStorage.setItem('xAutismo', 0);
    } else {
     body.classList.add('autismo'); 
     localStorage.setItem('xAutismo', 1);
    }
}

function home() {
    // get JSON url
    var WpJsonUrl = document.querySelector('link[rel="https://api.w.org/"]').href
    // then take out the '/wp-json/' part
    var homeurl = WpJsonUrl.replace('/wp-json/','');
    window.open(homeurl, "_self");
}

function traduzir_ingles() {
    // get JSON url
    var WpJsonUrl = document.querySelector('link[rel="https://api.w.org/"]').href
    // then take out the '/wp-json/' part
    var homeurl = WpJsonUrl.replace('/wp-json/','');
    window.open("https://translate.google.com/translate?sl=auto&tl=en&u=" + homeurl , "_self");
}

function traduzir_espanhol() {
    // get JSON url
    var WpJsonUrl = document.querySelector('link[rel="https://api.w.org/"]').href
    // then take out the '/wp-json/' part
    var homeurl = WpJsonUrl.replace('/wp-json/','');
    window.open("https://translate.google.com/translate?sl=auto&tl=es&u=" + homeurl , "_self");
}

function traduzir_frances() {
    // get JSON url
    var WpJsonUrl = document.querySelector('link[rel="https://api.w.org/"]').href
    // then take out the '/wp-json/' part
    var homeurl = WpJsonUrl.replace('/wp-json/','');
    window.open("https://translate.google.com/translate?sl=auto&tl=fr&u=" + homeurl , "_self");
}

function traduzir_alemao() {
    // get JSON url
    var WpJsonUrl = document.querySelector('link[rel="https://api.w.org/"]').href
    // then take out the '/wp-json/' part
    var homeurl = WpJsonUrl.replace('/wp-json/','');
    window.open("https://translate.google.com/translate?sl=auto&tl=de&u=" + homeurl , "_self");
}

var timer1, timer2;
var menuItems = document.querySelectorAll('#desktop-menu > li.menu-item-has-children');
var menuSubItems = document.querySelectorAll('#desktop-menu > li.menu-item-has-children > ul > li.menu-item-has-children');
//console.log(menuItems);
//console.log(menuSubItems);
Array.prototype.forEach.call(menuItems, function(el, i){
    ///*
    el.addEventListener("mouseover", function(event){
        clearTimeout(timer1);
        var opennav = document.querySelectorAll("#desktop-menu > .menu-item-has-children.menu-open");
        opennav.forEach(element => {
            element.classList.remove("menu-open");
        });
		//opennav.classList.remove("menu-open");
		this.classList.add("menu-open");
		
        this.setAttribute('aria-expanded', "true");
	});
	el.addEventListener("mouseout", function(event){
		timer1 = setTimeout(function(event){
            var opennav = document.querySelector("#desktop-menu > .menu-item-has-children.menu-open");
			opennav.classList.remove("menu-open");
            opennav.querySelector('a').setAttribute('aria-expanded', "false");
		}, 150);
	}); 
    //*/
	el.querySelector('a').addEventListener("click",  function(event){
		if (this.parentNode.classList.contains("menu-open")) {
			this.parentNode.classList.toggle("menu-open");
			this.setAttribute('aria-expanded', "false");
		} else {
			this.parentNode.classList.toggle("menu-open");
			this.setAttribute('aria-expanded', "true");
		}
		event.preventDefault();
		return false;
	});
    
    var links = el.querySelectorAll('#desktop-menu > .menu-item-has-children > .sub-menu > li > a');
    Array.prototype.forEach.call(links, function(el, i){
        el.addEventListener("focus", function() {
            if (timer2) {
                clearTimeout(timer2);
                timer2 = null;
            }
        });
        el.addEventListener("blur", function(event) {
            timer2 = setTimeout(function () {
                var opennav = document.querySelectorAll("#desktop-menu > .menu-item-has-children.menu-open")
                if(opennav) {
                    opennav.forEach(element => {
                        element.classList.remove("menu-open");
                        element.querySelector('a').setAttribute('aria-expanded', "false");
                    });
                }
                /*
                if (opennav) {
                    opennav.classList.remove("menu-open");
                    opennav.querySelector('a').setAttribute('aria-expanded', "false");
                }
                    */
            }, 10);
        });
    });
});

Array.prototype.forEach.call(menuSubItems, function(el, i){
    ///*
    el.addEventListener("mouseover", function(event){
        clearTimeout(timer1);
        var opennav2 = document.querySelectorAll("#desktop-menu > li.menu-item-has-children.menu-open > ul > li.menu-item-has-children.menu-open");
        opennav2.forEach(element => {
            element.classList.remove("menu-open");
        });
		//opennav.classList.remove("menu-open");
		this.classList.add("menu-open");
		
        this.setAttribute('aria-expanded', "true");
	});
	el.addEventListener("mouseout", function(event){
		timer1 = setTimeout(function(event){
            var opennav2 = document.querySelector("#desktop-menu > li.menu-item-has-children.menu-open > ul > li.menu-item-has-children.menu-open");
			opennav2.classList.remove("menu-open");
            opennav2.querySelector('a').setAttribute('aria-expanded', "false");
		}, 150);
	}); 
    //*/
	el.querySelector('a').addEventListener("click",  function(event){
		if (this.parentNode.classList.contains("menu-open")) {
			this.parentNode.classList.toggle("menu-open");
			this.setAttribute('aria-expanded', "false");
		} else {
			this.parentNode.classList.toggle("menu-open");
			this.setAttribute('aria-expanded', "true");
		}
		event.preventDefault();
		return false;
	});

    var links = el.querySelectorAll('#desktop-menu > li.menu-item-has-children > ul > li.menu-item-has-children > ul > li > a');
    console.log(links);
    Array.prototype.forEach.call(links, function(el, i){
        el.addEventListener("focus", function() {
            if (timer2) {
                clearTimeout(timer2);
                timer2 = null;
            }
        });
        el.addEventListener("blur", function(event) {
            timer2 = setTimeout(function () {
                var opennav2 = document.querySelectorAll("#desktop-menu > li.menu-item-has-children > ul > li.menu-item-has-children.menu-open")
                if(opennav2) {
                    opennav2.forEach(element => {
                        element.classList.remove("menu-open");
                        element.querySelector('a').setAttribute('aria-expanded', "false");
                    });
                }
                /*
                if (opennav2) {
                    opennav2.classList.remove("menu-open");
                    opennav2.querySelector('a').setAttribute('aria-expanded', "false");
                }
                    */
            }, 10);
        });
    });
});
//*/
