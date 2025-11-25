// Charger html2pdf depuis CDN
const script1 = document.createElement('script');
script1.src = 'https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js';
script1.onload = function() {
    console.log('html2pdf chargé avec succès');
};
script1.onerror = function() {
    console.error('Erreur : html2pdf ne s\'est pas chargé');
};
document.head.appendChild(script1);

// Fonction pour télécharger un rapport en PDF
function telechargerRapportPDF(id_rapport) {
    if (typeof html2pdf === 'undefined') {
        alert('La librairie PDF n\'est pas encore chargée.');
        return;
    }

    fetch(`?page=telecharger_rapport&id=${id_rapport}`)
        .then(response => response.json())
        .then(rapport => {
            console.log('✓ Données reçues :', rapport);

            // TEST SIMPLE : du texte basique
            const element = document.createElement('div');
            element.innerHTML = `
                <div style="padding: 20px; font-family: Arial; color: black; background: white;">
                    <h1>RAPPORT : ${rapport.nom_rapport}</h1>
                    <p>Description : ${rapport.desc_rapport}</p>
                    <p>Date : ${rapport.date_creation}</p>
                    <p>Contenu du rapport :</p>
                    <div>${rapport.contenu}</div>
                </div>
            `;
            
            element.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 210mm;
                background: white;
                padding: 10px;
                z-index: 9999;
            `;
            document.body.appendChild(element);

            console.log('✓ Élément ajouté, voici son contenu :');
            console.log(element.textContent); // Affiche le texte brut
            console.log('✓ Cet élément est visible à l\'écran en haut à gauche');

            setTimeout(() => {
                const opt = {
                    margin: 5,
                    filename: `rapport_${rapport.nom_rapport.replace(/\s+/g, '_')}.pdf`,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: {
                        scale: 2,
                        useCORS: true,
                        allowTaint: true,
                        backgroundColor: '#ffffff',
                        logging: true  // ✅ Active les logs de html2canvas
                    },
                    jsPDF: { orientation: 'portrait', unit: 'mm', format: 'a4' }
                };

                console.log('⏳ Génération PDF en cours...');
                
                html2pdf()
                    .set(opt)
                    .from(element)
                    .save()
                    .then(() => {
                        console.log('✅ PDF téléchargé !');
                        // Garde l'élément 5 secondes pour que tu voies
                        setTimeout(() => {
                            if (document.body.contains(element)) {
                                document.body.removeChild(element);
                            }
                        }, 5000);
                    })
                    .catch(err => {
                        console.error('❌ ERREUR :', err);
                        if (document.body.contains(element)) {
                            document.body.removeChild(element);
                        }
                    });
            }, 500);
        })
        .catch(error => {
            console.error('❌ Erreur fetch :', error);
        });
}
