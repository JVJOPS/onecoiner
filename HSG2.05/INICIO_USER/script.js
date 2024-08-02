document.addEventListener('DOMContentLoaded', () => {
    // Selecciona todos los elementos con la clase 'carousel-item' y los guarda en una lista
    const carouselItems = document.querySelectorAll('.carousel-item');
    // Cuenta el número total de elementos en el carrusel
    const totalItems = carouselItems.length;
    // Inicializa el índice del elemento actualmente visible
    let currentIndex = 0;

    // Función para mostrar un elemento específico del carrusel
    function showItem(index) {
        // Recorre todos los elementos del carrusel
        carouselItems.forEach((item, i) => {
            // Si el índice del elemento coincide con el índice proporcionado
            if (i === index) {
                // Agrega la clase 'active' para mostrar el elemento
                item.classList.add('active');
            } else {
                // Remueve la clase 'active' para ocultar el elemento
                item.classList.remove('active');
            }
        });
    }

    // Función para mostrar el siguiente elemento del carrusel
    function nextItem() {
        // Incrementa el índice actual y asegura que se mantenga dentro del rango
        currentIndex = (currentIndex + 1) % totalItems;
        // Muestra el elemento correspondiente al nuevo índice
        showItem(currentIndex);
    }

    // Función para mostrar el elemento anterior del carrusel
    function prevItem() {
        // Decrementa el índice actual y asegura que se mantenga dentro del rango
        currentIndex = (currentIndex - 1 + totalItems) % totalItems;
        // Muestra el elemento correspondiente al nuevo índice
        showItem(currentIndex);
    }

    // Muestra el primer elemento del carrusel al cargar la página
    showItem(currentIndex);

    // Configura un intervalo para cambiar automáticamente al siguiente elemento cada 5 segundos
    setInterval(nextItem, 5000);
});
