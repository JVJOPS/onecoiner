<style>
   body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .footer {
            background-color: #333; /* Color de fondo oscuro */
            color: #fff; /* Color del texto en blanco */
            text-align: center; /* Centra el texto */
            padding: 20px 0; /* Espaciado vertical */
            position: fixed; /* Fija el footer en la parte inferior de la ventana */
            bottom: 0;
            width: 100%; /* Ancho completo */
            box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.1); /* Sombra para un efecto de profundidad */
        }

        .footer p {
            margin: 0; /* Elimina el margen por defecto del párrafo */
            font-size: 14px; /* Tamaño de fuente adecuado */
        }

        /* Estilos para mejorar la visibilidad en dispositivos móviles */
        @media (max-width: 600px) {
            .footer {
                padding: 15px 0; /* Reduce el espaciado en dispositivos móviles */
            }

            .footer p {
                font-size: 12px; /* Tamaño de fuente más pequeño en dispositivos móviles */
            }
        }
    </style>
    <footer class="footer">
        <p>&copy; 2024 HSG. Todos los derechos reservados.</p>
    </footer>
</body>
</html>