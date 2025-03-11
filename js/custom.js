const tbody = document.querySelector(".listar-usuarios");

const cadForm = document.getElementById("cad-usuario-form");

const editForm = document.getElementById("edit-usuario-form");

const msgAlertError = document.getElementById("msgAlertError");

const msgAlertErrorEdit = document.getElementById("msgAlertErrorEdit");

const msgAlert = document.getElementById("msgAlert");

const cadModal = new bootstrap.Modal(
  document.getElementById("cadUsuarioModal")
);

// Lista os usuários
const listUsers = async (page) => {
  const data = await fetch("./list.php?page=" + page);
  const response = await data.text();
  tbody.innerHTML = response;
};

listUsers(1);

// Modal Formulário de cadastro
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

// Visualizar usuário
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

// Editar usuário
async function editUser(id) {
  msgAlertErrorEdit.innerHTML = "";

  const datas = await fetch("view.php?id=" + id);
  const response = await datas.json();
  // console.log(response);

  if (response["erro"]) {
    msgAlert.innerHTML = response["msg"];
  } else {
    const editModal = new bootstrap.Modal(
      document.getElementById("editUsuarioModal")
    );
    editModal.show();

    document.getElementById("editId").value = response["datas"].id;
    document.getElementById("editNome").value = response["datas"].nome;
    document.getElementById("editEmail").value = response["datas"].email;
  }
}

// formulário para salvar
editForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  document.getElementById("edit-usuario-form").value = "Salvando...";

  const dataForm = new FormData(editForm);
  // console.log(dataForm);
  // for (var dataFormEdit of datas.entries()) {
  //   console.log(dataFormEdit[0] + " - " + dataFormEdit[1]);
  // }

  const datas = await fetch("edit.php", {
    method: "POST",
    body: dataForm,
  });

  const response = await datas.json();

  if (response["erro"]) {
    msgAlertErrorEdit.innerHTML = response["msg"];
  } else {
    msgAlertErrorEdit.innerHTML = response["msg"];
    listUsers(1);
  }
  document.getElementById("edit-usuario-form").value = "Salvar";
});

async function deleteUser(id) {
  var confirma = confirm("Tem certeza que deseja excluir este registro?");

  if (confirma == true) {
    console.log("Acessou " + id);

    const datas = await fetch("delete.php?id=" + id);

    const response = await datas.json();

    if (response["erro"]) {
      msgAlert.innerHTML = response["msg"];
    } else {
      msgAlert.innerHTML = response["msg"];
      listUsers(1);
    }
  } 

  
}
