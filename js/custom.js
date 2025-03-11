const tbody = document.querySelector(".listar-usuarios");

const cadForm = document.getElementById("cad-usuario-form");

const msgAlertError = document.getElementById("msgAlertError");

const msgAlert = document.getElementById("msgAlert");

const cadModal = new bootstrap.Modal(
  document.getElementById("cadUsuarioModal")
);

const listUsers = async (page) => {
  const data = await fetch("./list.php?page=" + page);
  const response = await data.text();
  tbody.innerHTML = response;
};

listUsers(1);

cadForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  // console.log("Cadastrado");

  document.getElementById("cad-usuario-btn").value = "Salvando...";

  if (document.getElementById("nome").value === "") {
    console.log("Erro: Preencha seu nome!");
    msgAlertError.innerHTML =
      "<div class='alert alert-danger' role='alert'>Erro: Preencha seu nome!</div>";
  } else if (document.getElementById("email").value === "") {
    console.log("Erro: Preencha seu e-mail!");
    msgAlertError.innerHTML =
      "<div class='alert alert-danger' role='alert'>Erro: Preencha seu e-mail!</div>";
  } else {
    const dataForm = new FormData(cadForm);

    dataForm.append("add", 1);
    // console.log(dataForm);

    const datas = await fetch("cadastrar.php", {
      method: "POST",
      body: dataForm,
    });

    const response = await datas.json();
    // console.log(response);

    if (response["erro"]) {
      msgAlertError.innerHTML = response["msg"];
    } else {
      msgAlert.innerHTML = response["msg"];
      cadForm.reset();
      cadModal.hide();
      listUsers(1);
    }
  }

  document.getElementById("cad-usuario-btn").value = "Cadastrar";
});

async function viewUser(id) {
  // console.log("Acessou: " + id);
  const datas = await fetch("view.php?id=" + id);
  const response = await datas.json();
  // console.log(response);

  if (response["erro"]) {
    msgAlert.innerHTML = response["msg"];
  } else {
    const viewModal = new bootstrap.Modal(
      document.getElementById("viewUsuarioModal")
    );
    viewModal.show();

    document.getElementById("idUser").innerHTML = response["datas"].id;
    document.getElementById("nameUser").innerHTML = response["datas"].nome;
    document.getElementById("emailUser").innerHTML = response["datas"].email;
  }
}
