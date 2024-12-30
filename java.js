const header =document.querySelector("header");
window.addEventListener("scroll",function(){

    header.classList.toggle("stiky",this.windows.scrollY>0);
})

// pour le saut a la page produit 
    document.querySelectorAll('a[href^="#trending"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
/////////////////pour le login de admin//////////////
// Récupérer les éléments
const adminIcon = document.querySelector('.nav-icon a[href="#formeadmin"]'); // Icône admin
const loginAdmin = document.getElementById('formeadmin'); // Fenêtre de connexion
const closeBtn = document.createElement('div'); // Bouton de fermeture

// Ajouter un bouton de fermeture
closeBtn.className = 'close-btn';
closeBtn.innerHTML = '&times;'; // Symbole "X"
loginAdmin.querySelector('.form-box').appendChild(closeBtn);

// Ouvrir la fenêtre de connexion
adminIcon.addEventListener('click', (e) => {
    e.preventDefault(); // Empêche le comportement par défaut du lien
    console.log("Admin icon clicked!");
    loginAdmin.classList.add('active');
});

// Fermer la fenêtre de connexion
closeBtn.addEventListener('click', () => {
    loginAdmin.classList.remove('active');
});

// Fermer la fenêtre si on clique en dehors
loginAdmin.addEventListener('click', (e) => {
    if (e.target === loginAdmin) {
        loginAdmin.classList.remove('active');
    }
});
//////////////pour le formulaire de enregistrer  et connexion de user///////

// Récupérer les éléments nécessaires
const userIcon = document.getElementById('userIcon'); // Icône utilisateur
const formUser  = document.getElementById('formuser'); // Formulaire utilisateur
const registerUser  = document.getElementById('registerForm'); // Formulaire d'enregistrement
const showRegisterForm = document.getElementById('showRegisterForm'); // Lien pour s'enregistrer
const showLoginForm = document.getElementById('showLoginForm'); // Lien pour se connecter
const closeBtns = document.querySelectorAll('.close-btn'); // Boutons de fermeture

// Empêche l'ancre de provoquer un défilement
userIcon.addEventListener('click', (event) => {
    event.preventDefault(); // Empêche l'action par défaut du lien
    formUser .classList.add('active'); // Affiche le formulaire de connexion
});

// Afficher le formulaire d'enregistrement
showRegisterForm.addEventListener('click', (event) => {
    event.preventDefault(); // Empêche l'action par défaut du lien
    formUser .classList.remove('active'); // Cache le formulaire de connexion
    registerUser .classList.add('active'); // Affiche le formulaire d'enregistrement
});

// Afficher le formulaire de connexion
showLoginForm.addEventListener('click', (event) => {
    event.preventDefault(); // Empêche l'action par défaut du lien
    registerUser .classList.remove('active'); // Cache le formulaire d'enregistrement
    formUser .classList.add('active'); // Affiche le formulaire de connexion
});

// Boutons de fermeture pour cacher les formulaires
closeBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        formUser .classList.remove('active'); // Cache le formulaire de connexion
        registerUser .classList.remove('active'); // Cache le formulaire d'enregistrement
    });
});

// Clic en dehors du formulaire pour le fermer
window.addEventListener('click', (event) => {
    if (event.target === formUser  || event.target === registerUser ) {
        formUser .classList.remove('active'); // Cache le formulaire de connexion
        registerUser .classList.remove('active'); // Cache le formulaire d'enregistrement
    }
});

///pour listes de produit cote admin
document.addEventListener("DOMContentLoaded", function () {
    const addModal = document.getElementById("addProductModal");
    const editModal = document.getElementById("editProductModal");

    const closeAddModal = document.getElementById("closeAddModal");
    const closeEditModal = document.getElementById("closeEditModal");

    // Ouvrir le modal d'ajout
    document.querySelectorAll(".action-link").forEach((link) => {
        link.addEventListener("click", () => {
            if (link.innerText.includes("Ajouter")) {
                addModal.style.display = "flex";
            }
        });
    });

    // Fermer les modals
    closeAddModal.addEventListener("click", () => {
        addModal.style.display = "none";
    });

    if (closeEditModal) {
        closeEditModal.addEventListener("click", () => {
            editModal.style.display = "none";
        });
    }

    // Fermer le modal en cliquant à l'extérieur
    window.addEventListener("click", (e) => {
        if (e.target === addModal) {
            addModal.style.display = "none";
        }
        if (e.target === editModal) {
            editModal.style.display = "none";
        }
    });
});
document.addEventListener('DOMContentLoaded', () => {
    // Fermer les modaux
    document.getElementById('closeAddModal').addEventListener('click', () => {
        document.getElementById('addProductModal').style.display = 'none';
    });

    document.getElementById('closeEditModal').addEventListener('click', () => {
        document.getElementById('editProductModal').style.display = 'none';
    });
});

function openAddForm() {
    document.getElementById('addProductModal').style.display = 'block';
}

function openEditForm(id, name, description, price, image) {
    document.getElementById('editProductModal').style.display = 'block';
    document.getElementById('edit-product-name').value = name;
    document.getElementById('edit-product-description').value = description;
    document.getElementById('edit-product-price').value = price;
    document.getElementById('edit-product-image').value = image;
    document.querySelector('[name="id"]').value = id;
}


