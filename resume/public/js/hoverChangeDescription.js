export function hoverChangeDescription(nameCard, text) {
  var changeDescription = document.querySelector(".changeDescription");
  var selection = document.querySelector(nameCard) !== null;
  if (selection) {
    document.querySelector(nameCard).addEventListener("mouseover", () => {
      changeDescription.innerHTML = text;
    });

    document.querySelector(nameCard).addEventListener("mouseout", () => {
      changeDescription.innerHTML = `*traverser les cartes avec votre curseur pour les lire*`;
    });
  }
}
