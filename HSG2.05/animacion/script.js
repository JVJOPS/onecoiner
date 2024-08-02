document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM completamente cargado y analizado');
    const contenedor = document.getElementById('contenedor');
    const numLineas = 50;
    const colores = ['#ff00ff', '#00ff00', '#00ffff', '#ffff00', '#ff0000'];

    for (let i = 0; i < numLineas; i++) {
        const linea = document.createElement('div');
        linea.className = 'linea';

        const randomColor = colores[Math.floor(Math.random() * colores.length)];
        const randomWidth = Math.random() * 100 + 50;
        const randomTop = Math.random() * window.innerHeight;
        const randomDuration = Math.random() * 15 + 5;

        linea.style.width = `${randomWidth}px`;
        linea.style.top = `${randomTop}px`;
        linea.style.backgroundColor = randomColor;
        linea.style.animation = `moverLinea ${randomDuration}s linear infinite`;
        linea.style.left = `${-randomWidth}px`;

        contenedor.appendChild(linea);
    }
});
