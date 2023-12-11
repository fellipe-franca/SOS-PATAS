// Função para carregar e exibir as instituições na tela
function getInstitutions() {
    fetch("get.php")
      .then((response) => response.json())
      .then((data) => {
        let fragment = document.createDocumentFragment();
        let template = document.getElementById("institution-template");
  
        for (let institution of data) {
          let clone = template.content.cloneNode(true);
          let image = clone.querySelector("[data-image]");
          let name = clone.querySelector("[data-name]");
          let location = clone.querySelector("[data-location]");
          let about = clone.querySelector("[data-about]");
          let date = clone.querySelector("[data-date]");
          let social = clone.querySelector("[data-social]");
          let contact = clone.querySelector("[data-contact]");
  
          image.setAttribute("src", institution.image);
          image.setAttribute("alt", institution.name);
          name.textContent = institution.name;
          location.textContent = institution.location;
          about.textContent = institution.about;
          date.textContent = institution.date;
          social.textContent = institution.social;
          contact.textContent = institution.contact;
  
          fragment.appendChild(clone);
        }
  
        let section = document.querySelector(".animals-container");
        section.appendChild(fragment);
      })
      .catch((error) => {
        alert("Ocorreu um erro ao obter os dados das instituições.");
      });
  }
  
  // Chamar a função getInstitutions para carregar as instituições na página quando a página é carregada
  getInstitutions();