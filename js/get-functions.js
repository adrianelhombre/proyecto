export function loadPhrase() {
  const frase = document.getElementById("frase-entrenador");
  const entrenador = document.getElementById("nombre-entrenador");

  if (!frase || !entrenador) {
    console.error("Los elementos con ID 'frase-entrenador' o 'nombre-entrenador' no fueron encontrados.");
    return;
  }

  let phrases = [];

  fetch("./db/get-phrase.php")
      .then((response) => {
          if (!response.ok) {
              throw new Error("La solicitud ha fallado");
          }
          return response.json();
      })
      .then((data) => {
        console.log(data)
        if(data) {
          phrases = data;
          updateRandomPhrase();
          setInterval(updateRandomPhrase, 10000);
        } else {
          console.error("No se encontraron frases")
        }

      })
      .catch((error) => {
          console.error("Error al cargar la frase:", error);
      });

  function updateRandomPhrase() {
    const randomIndex = Math.floor(Math.random() * phrases.length);
    const randomPhrase = phrases[randomIndex];

    frase.classList.add('fade-out');
    entrenador.classList.add('fade-out');

    setTimeout(() => {
      frase.innerText = randomPhrase.frase;
      entrenador.innerText = randomPhrase.autor;

      frase.classList.remove('fade-out');
      entrenador.classList.remove('fade-out');
    }, 500); 
  }
}