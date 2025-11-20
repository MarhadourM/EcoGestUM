// Tableau de données de chaque event (à adapter si tu veux une version dynamique depuis PHP)
const eventsData = [
  {
    img: "src/assets/Images/pic01.jpg",
    title: "Festival zéro déchets",
    desc: "Venez participer à notre festival dédié au zéro déchet ! Au programme : quiz, jeux et concours pour apprendre en s’amusant. Découvrez des astuces pratiques pour réduire vos déchets au quotidien et repartez avec des idées inspirantes."
  },
  {
    img: "src/assets/Images/pic02.jpg",
    title: "Collecte communautaire",
    desc: "Participez à la grande collecte sur le campus ! Réunissons nos efforts pour récupérer gob-objets et matériaux, dans une ambiance conviviale et solidaire."
  },
  {
    img: "src/assets/Images/pic03.jpg",
    title: "Sensibilisation au recyclage",
    desc: "Conférences, jeux et cadeaux pour mieux comprendre les enjeux du recyclage, avec des intervenants et des ateliers pour tous."
  },
  {
    img: "src/assets/Images/pic04.jpg",
    title: "Ventes d’objets de seconde main",
    desc: "Donnez une seconde vie à des objets : profitez de ventes solidaires et faites des trouvailles utiles et responsables sur le campus."
  },
  {
    img: "src/assets/Images/pic05.jpg",
    title: "Mise en place tri sur le campus",
    desc: "Aidez à installer les nouveaux systèmes de tri : participez activement à la transition écologique de votre université !"
  },
  {
    img: "src/assets/Images/pic06.jpg",
    title: "Atelier manuel sur le recyclage",
    desc: "Atelier fun pour découvrir le recyclage en mettant la main à la pâte, et repartir avec vos créations !"
  }
];

const overlay = document.getElementById('event-overlay');
const popupImg = document.getElementById('event-popup-img');
const popupTitle = document.getElementById('event-popup-title');
const popupDesc = document.getElementById('event-popup-desc');
const closeBtn = document.getElementById('close-popup');

// Ajoute l'événement sur chaque event-card
document.querySelectorAll('.event-card').forEach((card, idx) => {
  card.addEventListener('click', () => {
    const event = eventsData[idx];
    popupImg.src = event.img;
    popupTitle.textContent = event.title;
    popupDesc.innerHTML = "<strong>Description :</strong><br>" + event.desc;
    overlay.classList.add('visible');
  });
});

// Fermer overlay si click sur la croix ou sur le fond
closeBtn.addEventListener('click', () => overlay.classList.remove('visible'));
overlay.addEventListener('mousedown', e => {
  if (e.target === overlay) overlay.classList.remove('visible');
});

// Optionnel : rendre la fermeture possible par "Escape"
window.addEventListener('keydown', e => {
  if (e.key === 'Escape') overlay.classList.remove('visible');
});
