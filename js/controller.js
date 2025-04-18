document.addEventListener('DOMContentLoaded', function () {
 
    const arrowButton = document.querySelectorAll("#mobile-menu .menu-item-has-children");

    arrowButton.forEach((el) =>
        el.addEventListener("click", (event) => {
            const subMenu = event.currentTarget;
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
    
    /*
    window.addEventListener('scroll', function () {
        var currentScrollPos = window.scrollY;
        //var sideBarPresente;
        //if (typeof sideBar !== 'undefined'){
        //    sideBarPresente = true;
        //} else {
        //    sideBarPresente = false;
        //}

        if (prevScrollpos > currentScrollPos) {
            menuNav.style.top = "0";
            //if (sideBarPresente) {
            //    sideBar.style.top = menuHeight + 3 + "px"
            //}            
        } else {
            menuNav.style.top = "-" + menuHeight + "px";
            //if (sideBarPresente) {
            //    sideBar.style.top = "62px"
            //}             
        }        

        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function () {
            prevScrollpos = currentScrollPos;
        }, 0);
    });
    */
    
    function nextSlide() {
        const slides = document.querySelector("[data-carrossel]").querySelector("[data-slides]");
        const activeSlide = slides.querySelector("[data-active]");
        let newIndex = [...slides.children].indexOf(activeSlide) + 1;        
        if (newIndex >= slides.childElementCount){
            newIndex = 0;
        }
        
        slides.children[newIndex].dataset.active = true;
        delete activeSlide.dataset.active;
    }

    //const timerInterval = 8000;                         // intervalo de tempo para passar slide do carrossel, em ms
    //var slideTimer = setInterval(nextSlide, timerInterval);      // inicia slide automático do carrossel

    const buttons = document.querySelectorAll("[data-carrossel-button]")

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            //clearInterval(slideTimer);                  // interrompe o timer de pasar automaticamente slide

            const offset = button.dataset.carrosselButton === "next" ? 1 : -1;
            const slides = button
                .closest('[data-carrossel]')
                .querySelector('[data-slides]');

            const activeSlide = slides.querySelector("[data-active]");
            let newIndex = [...slides.children].indexOf(activeSlide) + offset;
            if (newIndex < 0) {
                newIndex = slides.childElementCount - 1;
            }
            if (newIndex >= slides.childElementCount){
                newIndex = 0;
            }
            
            slides.children[newIndex].dataset.active = true;
            delete activeSlide.dataset.active;

            //slideTimer = setInterval(nextSlide, timerInterval);  // reinicia timer de pasar slide
        })
    })

    
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

function traduzir_frances() {
    // get JSON url
    var WpJsonUrl = document.querySelector('link[rel="https://api.w.org/"]').href
    // then take out the '/wp-json/' part
    var homeurl = WpJsonUrl.replace('/wp-json/','');
    window.open("https://translate.google.com/translate?sl=auto&tl=de&u=" + homeurl , "_self");
}

/*
var menuItems = document.querySelectorAll('li.menu-item-has-children');
Array.prototype.forEach.call(menuItems, function(el, i){
	el.querySelector('a').addEventListener("focus",  (event) => {
		event.target.parentNode.classList.toggle("menu-open");
	});
    el.querySelector('a').addEventListener("focusout",  (event) => {
		event.target.parentNode.classList.remove("menu-open");
	});
});
*/

//*

var timer1, timer2;
var menuItems = document.querySelectorAll('li.menu-item-has-children');
Array.prototype.forEach.call(menuItems, function(el, i){
    
    el.addEventListener("mouseover", function(event){
		this.classList.add("menu-open");
		clearTimeout(timer1);
        this.setAttribute('aria-expanded', "true");
	});
	el.addEventListener("mouseout", function(event){
		timer1 = setTimeout(function(event){
            var opennav = document.querySelector(".menu-item-has-children.menu-open");
			opennav.classList.remove("menu-open");
            opennav.querySelector('a').setAttribute('aria-expanded', "false");
		}, 100);
	}); 

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
    var links = el.querySelectorAll('a');
    Array.prototype.forEach.call(links, function(el, i){
        el.addEventListener("focus", function() {
            if (timer2) {
                clearTimeout(timer2);
                timer2 = null;
            }
        });
        el.addEventListener("blur", function(event) {
            timer2 = setTimeout(function () {
                var opennav = document.querySelector(".menu-item-has-children.menu-open")
                if (opennav) {
                    opennav.classList.remove("menu-open");
                    opennav.querySelector('a').setAttribute('aria-expanded', "false");
                }
            }, 10);
        });
    });
});
//*/
