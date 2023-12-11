function submitForm() {
  var name = document.getElementById("name").value;
  var location = document.getElementById("location").value;
  var about = document.getElementById("about").value;
  var date = document.getElementById("date").value;
  var image = document.getElementById("image").files[0];
  var social = document.getElementById("social").value;
  var contact = document.getElementById("contact").value;

  console.log("Dados do formulário:");
  console.log("Nome: " + name);
  console.log("Localização: " + location);
  console.log("Sobre: " + about);
  console.log("Data: " + date);
  console.log("Imagem: " + image.name);
  console.log("Social: " + social);
  console.log("Contato: " + contact);

  if (
      name == "" ||
      location == "" ||
      about == "" ||
      date == "" ||
      image == null ||
      social == "" ||
      contact == ""
  ) {
      alert("Por favor, preencha todos os campos.");
      return false;
  }

  var formData = new FormData();
  formData.append("name", name);
  formData.append("location", location);
  formData.append("about", about);
  formData.append("date", date);
  formData.append("image", image);
  formData.append("social", social);
  formData.append("contact", contact);

  console.log("Enviando dados para o servidor...");

  fetch("insert.php", {
      method: "POST",
      body: formData,
  })
      .then((response) => response.json())
      .then((data) => {
          console.log("Resposta do servidor:");
          console.log(data);

          if (data.success) {
              alert("Instituição cadastrada com sucesso!");
              document.getElementById("form").reset();

              // Redirecionar para a página de exibição das instituições
              window.location.href = "instituicoes.html"; // Substitua pelo nome correto do arquivo de exibição das instituições
          } else {
              alert("Ocorreu um erro ao cadastrar a instituição.");
          }
      })
      .catch((error) => {
          console.log("Erro na requisição fetch:");
          console.error(error);
          alert("Ocorreu um erro ao enviar os dados do formulário.");
      });

  return false;
}
