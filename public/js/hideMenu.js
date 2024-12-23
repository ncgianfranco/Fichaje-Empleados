function hideBurgerMenu(){
    //Función para ocultar y deshabilitar el (botón del) menú hamburguesa
    document.getElementById("menuBurgerButton").style.opacity=0;
    document.getElementById("menuBurgerButton").disabled="true"
}

document.addEventListener('DOMContentLoaded', function() { 
        hideBurgerMenu();
    }
);