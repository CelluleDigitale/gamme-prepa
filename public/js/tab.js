document.addEventListener("DOMContentLoaded", function () {
  // Sélectionner tous les onglets et le contenu associé
  const tabItems = document.querySelectorAll(".tab-item");
  const tabContentItems = document.querySelectorAll(".tab-content-item");

  // Fonction pour changer d'onglet
  function selectItem(e) {
    // Supprimer toutes les classes "active" des onglets et du contenu
    removeActiveClass();

    // Ajouter la classe "active" à l'onglet sélectionné
    this.classList.add("active");
    const indexItem = this.getAttribute('data-tab');

    // Trouver le contenu associé à l'onglet et lui ajouter la classe "active"
    const tabContentItem = document.querySelector('div.tab-content-item[data-tab="'+indexItem+'"]');
    tabContentItem.classList.add("active");
   
  }

  // Fonction pour supprimer toutes les classes "active" des onglets et du contenu
  function removeActiveClass() {
    tabItems.forEach((item) => item.classList.remove("active"));
    tabContentItems.forEach((item) => item.classList.remove("active"));
  }
  // Écouter les clics sur les onglets
  tabItems.forEach((item) => item.addEventListener("click", selectItem));
});
