class MobileMenu{
    constructor(){
        this.header = document.querySelector(".header");
        this.menuToggler = document.querySelector(".navbar-toggler");
        this.mainMenu = document.querySelector("#menu-main-menu");
        //this.parentMenu = document.querySelectorAll(".menu-item-has-children");
        this.mobileParentMenuItem = jQuery(".menu-item-has-children > a");
        this.menuItems = document.querySelectorAll("#menu-main-menu li a");
        
        this.events();
    }


    events(){
        if(this.menuToggler){
            this.menuToggler.addEventListener("click", this.toggleMenu.bind(this),false);
            this.menuToggler.addEventListener("click", this.animateToggle.bind(this),false);
        }
       
        // Attaching the event listener function to window's resize event
        jQuery( this.mobileParentMenuItem ).click( this.mobileSubMenuToggle );
        window.addEventListener('resize', this.clearMobileMenuClass, true);

        jQuery(".menu-item-has-children a").focus(function(){
            jQuery(this).closest(".menu-item-has-children").addClass("menu-focused");
        }).blur(function(){
            jQuery(this).closest(".menu-item-has-children").removeClass("menu-focused");
        });
        
        // this.parentMenu.forEach(element => {
        //     element.addEventListener("click", ()=>{
        //         this.subMenu = element.querySelector('.sub-menu');
        //         if (window.matchMedia("(max-width: 1100px)").matches) {
        //             if(this.subMenu.classList.contains("show")){
        //                 this.subMenu.classList.remove("show");
        //             }else{
        //                 this.subMenu.classList.add("show");
        //             }
        //           }
               
               
        //     },false);
        // });       
    }

    clearMobileMenuClass(){

        jQuery(".header").removeClass("show");
        jQuery(".navbar-toggler").removeClass("open");
        jQuery(".sub-menu").removeClass("sub-menu--open");
        jQuery("html").removeClass("no-scroll");
    }

    mobileSubMenuToggle(e){

        console.log("submenu open");
        // e.preventDefault();
        if (e.target == this){
            e.preventDefault();
        }
        // jQuery(this).trigger('click');
         let subMenu = jQuery(this).next(".sub-menu");
         if(jQuery(subMenu).hasClass("sub-menu--open")){
             jQuery(subMenu).removeClass("sub-menu--open");
             jQuery(this).closest(".menu-item-has-children").removeClass("menu-focused");
            
         }else{
             jQuery(subMenu).addClass("sub-menu--open");
            
         }
    }


    toggleMenu(){
        //console.log("submenu opens");
        if(jQuery(this.header).hasClass("show")){
            jQuery(this.header).removeClass("show");
            jQuery("html").removeClass("no-scroll");
        }else{
            jQuery(this.header).addClass("show");
            jQuery("html").addClass("no-scroll");
        }


        // jQuery(this.header).toggleClass("show");
        // jQuery(this.mainMenu).toggleClass("show");
        // if(this.mainMenu.classList.contains("show")){
        //     this.mainMenu.classList.remove("show");
        // }else{
        //     this.mainMenu.classList.add("show");
        // }
    }
    animateToggle(){
        if(jQuery(this.menuToggler).hasClass("open")){
            jQuery(this.menuToggler).removeClass("open");
            jQuery(".sub-menu").removeClass("sub-menu--open");
        }else{
            jQuery(this.menuToggler).addClass("open");
        }
    }
   
   
}
export default MobileMenu;